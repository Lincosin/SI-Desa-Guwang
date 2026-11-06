<?php

/*
 *
 * File ini bagian dari:
 *
 * OpenSID
 *
 * Sistem informasi desa sumber terbuka untuk memajukan desa
 *
 * Aplikasi dan source code ini dirilis berdasarkan lisensi GPL V3
 *
 * Hak Cipta 2009 - 2015 Combine Resource Institution (http://lumbungkomunitas.net/)
 * Hak Cipta 2016 - 2025 Perkumpulan Desa Digital Terbuka (https://opendesa.id)
 *
 * Dengan ini diberikan izin, secara gratis, kepada siapa pun yang mendapatkan salinan
 * dari perangkat lunak ini dan file dokumentasi terkait ("Aplikasi Ini"), untuk diperlakukan
 * tanpa batasan, termasuk hak untuk menggunakan, menyalin, mengubah dan/atau mendistribusikan,
 * asal tunduk pada syarat berikut:
 *
 * Pemberitahuan hak cipta di atas dan pemberitahuan izin ini harus disertakan dalam
 * setiap salinan atau bagian penting Aplikasi Ini. Barang siapa yang menghapus atau menghilangkan
 * pemberitahuan ini melanggar ketentuan lisensi Aplikasi Ini.
 *
 * PERANGKAT LUNAK INI DISEDIAKAN "SEBAGAIMANA ADANYA", TANPA JAMINAN APA PUN, BAIK TERSURAT MAUPUN
 * TERSIRAT. PENULIS ATAU PEMEGANG HAK CIPTA SAMA SEKALI TIDAK BERTANGGUNG JAWAB ATAS KLAIM, KERUSAKAN ATAU
 * KEWAJIBAN APAPUN ATAS PENGGUNAAN ATAU LAINNYA TERKAIT APLIKASI INI.
 *
 * @package   OpenSID
 * @author    Tim Pengembang OpenDesa
 * @copyright Hak Cipta 2009 - 2015 Combine Resource Institution (http://lumbungkomunitas.net/)
 * @copyright Hak Cipta 2016 - 2025 Perkumpulan Desa Digital Terbuka (https://opendesa.id)
 * @license   http://www.gnu.org/licenses/gpl.html GPL V3
 * @link      https://github.com/OpenSID/OpenSID
 *
 */

defined('BASEPATH') || exit('No direct script access allowed');

use App\Events\Surat\PermohonanSuratSubmitted;
use App\Libraries\TinyMCE;
use App\Models\Dokumen as DokumenModel;
use App\Models\DokumenHidup;
use App\Models\FormatSurat;
use App\Models\LogSurat;
use App\Models\Penduduk;
use App\Models\PermohonanSurat;
use App\Models\PesanMandiri;
use App\Models\SyaratSurat;
use App\Services\LayananSuratCetakService;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\Printer;

class Surat extends Mandiri_Controller
{
    // KUSTOM permohonan dibatalkan: lama (hari) permohonan dibatalkan tetap tampil di daftar utama
    public const HARI_TAMPIL_DIBATALKAN = 7;

    protected TinyMCE $tinymce;

    private LayananSuratCetakService $layananSuratCetak;

    public function __construct()
    {
        parent::__construct();

        $this->tinymce           = new TinyMCE();
        $this->layananSuratCetak = new LayananSuratCetakService();
    }

    public function index()
    {
        if ($this->input->is_ajax_request()) {
            $printer = $this->print_connector();

            // KUSTOM permohonan dibatalkan: daftar utama menyembunyikan permohonan yang dibatalkan
            // lebih dari HARI_TAMPIL_DIBATALKAN hari; semuanya tetap ada di filter Dibatalkan.
            $tampil = $this->input->get('tampil') === 'dibatalkan' ? 'dibatalkan' : 'aktif';

            $query = PermohonanSurat::with([
                'logSurat:id,tte',
                'surat:id,nama',
            ])
                ->without(['penduduk'])
                ->belumDiambil()
                ->whereIdPemohon($this->is_login->id_pend)
                ->when($tampil === 'dibatalkan', static fn ($q) => $q->where('status', PermohonanSurat::DIBATALKAN))
                ->when($tampil === 'aktif', static fn ($q) => $q->where(static function ($q): void {
                    $q->where('status', '!=', PermohonanSurat::DIBATALKAN)
                        ->orWhere('updated_at', '>=', date('Y-m-d H:i:s', strtotime('-' . self::HARI_TAMPIL_DIBATALKAN . ' days')));
                }));

            return datatables($query)
                ->addIndexColumn()
                ->addColumn('aksi', function ($item) use ($printer) {
                    $aksi      = '';
                    $logSurat  = in_array($item->status, [PermohonanSurat::MENUNGGU_TANDA_TANGAN, PermohonanSurat::SIAP_DIAMBIL]) ? $item->logSuratTerkait() : null;
                    $tahap     = e($item->tahapPersetujuan($logSurat));

                    if ($item->status == 0) {
                        $url = site_url("layanan-mandiri/surat/buat/{$item->id}");
                        $aksi .= "<a href='{$url}' class='btn btn-social bg-navy btn-sm' title='Lengkapi Surat' style='width: 170px'><i class='fa fa-info-circle'></i>Lengkapi Surat</a> ";
                    } elseif ($item->status == 1) {
                        $aksi .= "<a class='btn btn-social btn-info btn-sm btn-proses' title='Surat {$tahap}' style='min-width: 170px'><i class='fa fa-spinner'></i>{$tahap}</a> ";
                    } elseif ($item->status == 2) {
                        $aksi .= "<a class='btn btn-social bg-purple btn-sm btn-proses' title='Surat {$tahap}' style='min-width: 170px'><i class='fa fa-edit'></i>{$tahap}</a> ";
                    } elseif ($item->status == 3) {
                        $aksi .= "<a class='btn btn-social bg-orange btn-sm btn-proses' title='Surat {$tahap}' style='min-width: 170px'><i class='fa fa-thumbs-o-up'></i>{$tahap}</a> ";
                    } elseif ($item->status == 4) {
                        $aksi .= "<a class='btn btn-social btn-success btn-sm btn-proses' title='Surat {$item->statusPermohonan}' style='width: 170px'><i class='fa fa-check'></i>{$item->statusPermohonan}</a> ";
                    } else {
                        // KUSTOM permohonan dibatalkan: ganti label merah dengan tombol Ajukan Ulang (form terisi data lama)
                        if (self::sudahDiajukanUlang($item)) {
                            $aksi .= "<a class='btn btn-social btn-default btn-sm disabled' title='Permohonan ini sudah diajukan ulang' style='width: 170px'><i class='fa fa-check'></i>Sudah Diajukan Ulang</a> ";
                        } else {
                            $url = ci_route('layanan-mandiri.surat.buat') . '?ulang=' . $item->id;
                            $aksi .= "<a href='{$url}' class='btn btn-social btn-warning btn-sm' title='Ajukan lagi surat ini dengan data yang sudah diisi sebelumnya' style='width: 170px'><i class='fa fa-refresh'></i>Ajukan Ulang</a> ";
                        }
                        // KUSTOM hapus riwayat: warga menghapus permohonan yang dibatalkan
                        $url   = ci_route('layanan-mandiri.surat.hapus-dibatalkan', $item->id);
                        $judul = e($item->surat->nama ?? 'Surat');
                        $aksi .= "<button type='button' class='btn btn-social btn-danger btn-sm hapus-dibatalkan' data-url='{$url}' data-judul='{$judul}' title='Hapus riwayat permohonan ini' style='width: 170px'><i class='fa fa-trash-o'></i>Hapus</button> ";
                    }

                    if (in_array($item->status, ['0', '1'])) {
                        $url = site_url(MANDIRI . "/surat/proses/{$item->id}");
                        $aksi .= "<a href='{$url}' title='Batalkan Surat' class='btn bg-maroon btn-sm'><i class='fa fa-times'></i></a> ";
                    }

                    if ($item->no_antrian && $this->cek_anjungan && $printer) {
                        $url = site_url(MANDIRI . "/surat/cetak_no_antrian/{$item->no_antrian}");
                        $aksi .= "<a href='{$url}' class='btn btn-social btn-sm bg-navy' title='Cetak No. Antrean'><i class='fa fa-print'></i>No. Antrean</a> ";
                    }

                    // PDF bisa diunduh setelah surat disetujui seluruh tahap (Kadus -> Kades/Perbekel)
                    if ($item->status == PermohonanSurat::SIAP_DIAMBIL && $logSurat && $logSurat->sudahDisetujui()) {
                        $aksi .= self::tombolSuratJadi($logSurat, $item->surat->nama ?? null);
                    }

                    // KUSTOM: warga menandai surat yang sudah diterima sebagai selesai
                    if ($item->status == PermohonanSurat::SIAP_DIAMBIL) {
                        $url   = ci_route('layanan-mandiri.surat.selesai', $item->id);
                        $judul = e($item->surat->nama ?? 'Surat');
                        $aksi .= " <button type='button' class='btn btn-social btn-success btn-sm selesai-surat' data-url='{$url}' data-judul='{$judul}' title='Tandai surat sudah Anda terima'><i class='fa fa-check-circle'></i>Selesai</button> ";
                    }

                    return $aksi;
                })
                // KUSTOM: tahapan surat untuk warga
                ->addColumn('tahapan', static function ($item): string {
                    $logSurat = in_array($item->status, [PermohonanSurat::MENUNGGU_TANDA_TANGAN, PermohonanSurat::SIAP_DIAMBIL]) ? $item->logSuratTerkait() : null;

                    return self::tahapanSurat($item, $logSurat);
                })
                ->editColumn('no_antrian', static fn ($item) => get_antrian($item->no_antrian))
                ->editColumn('created_at', static fn ($item) => tgl_indo2($item->created_at))
                ->rawColumns(['aksi', 'tahapan'])
                ->make();
        }

        // KUSTOM: ringkasan permohonan surat warga
        $jumlah = PermohonanSurat::withOnly([])
            ->where('id_pemohon', $this->is_login->id_pend)
            ->selectRaw('status, COUNT(*) AS jumlah')
            ->groupBy('status')
            ->pluck('jumlah', 'status');

        return view('layanan_mandiri.surat.permohonan', [
            'ringkasan' => [
                'dilengkapi' => (int) ($jumlah[PermohonanSurat::BELUM_LENGKAP] ?? 0),
                // Surat yang sudah disetujui tetap dihitung diproses sampai warga menekan Selesai
                'diproses' => (int) ($jumlah[PermohonanSurat::SEDANG_DIPERIKSA] ?? 0) + (int) ($jumlah[PermohonanSurat::MENUNGGU_TANDA_TANGAN] ?? 0)
                    + (int) ($jumlah[PermohonanSurat::SIAP_DIAMBIL] ?? 0),
                'siap'       => (int) ($jumlah[PermohonanSurat::SIAP_DIAMBIL] ?? 0),
                'selesai'    => (int) ($jumlah[PermohonanSurat::SUDAH_DIAMBIL] ?? 0),
                'dibatalkan' => (int) ($jumlah[PermohonanSurat::DIBATALKAN] ?? 0), // KUSTOM permohonan dibatalkan
            ],
            'hari_tampil_dibatalkan' => self::HARI_TAMPIL_DIBATALKAN, // KUSTOM permohonan dibatalkan
            'sebutan_kades' => ucwords(setting('sebutan_kepala_desa') ?: 'Kepala Desa'),
        ]);
    }

    /**
     * KUSTOM: tahapan surat untuk warga: Diajukan -> Kepala Dusun -> Kepala Desa/Perbekel -> Selesai.
     */
    private static function tahapanSurat(PermohonanSurat $item, ?LogSurat $logSurat): string
    {
        $status     = (int) $item->status;
        $catatan    = $item->tahapPersetujuan($logSurat);
        $peringatan = false;

        switch ($status) {
            case PermohonanSurat::BELUM_LENGKAP:
                $aktif      = 0;
                $peringatan = true;
                $catatan    = 'Perlu dilengkapi' . ($item->alasan ? ': ' . $item->alasan : '');
                break;

            case PermohonanSurat::SEDANG_DIPERIKSA:
                $aktif = 1;
                break;

            case PermohonanSurat::MENUNGGU_TANDA_TANGAN:
                $ditolak    = $logSurat && (int) $logSurat->verifikasi_operator === LogSurat::TOLAK;
                $diKadus    = ! $logSurat || $ditolak || $logSurat->verifikasi_operator != LogSurat::TERIMA
                    || ($logSurat->verifikasi_kadus !== null && (int) $logSurat->verifikasi_kadus === 0);
                $aktif      = $diKadus ? 1 : 2;
                $peringatan = $ditolak;
                break;

            case PermohonanSurat::SIAP_DIAMBIL:
                $aktif   = 3;
                $catatan = 'Surat sudah disetujui. Lihat atau unduh suratnya, lalu tekan Selesai.';
                break;

            case PermohonanSurat::SUDAH_DIAMBIL:
                $aktif = 4;
                break;

            default:
                // KUSTOM permohonan dibatalkan: alasan pembatalan langsung terlihat di daftar
                $alasan = self::alasanPembatalan($item);

                return "<div class='tahapan-surat'><div class='alasan-batal'>"
                    . "<b class='text-red'><i class='fa fa-times-circle'></i> Dibatalkan</b>"
                    . ($item->updated_at ? " <span class='text-muted'>pada " . e(tgl_indo2($item->updated_at)) . '</span>' : '')
                    . "<div class='alasan-batal-isi'><b>Alasan:</b> " . ($alasan !== '' ? nl2br(e($alasan)) : "<i class='text-muted'>tidak dicantumkan</i>") . '</div>'
                    . '</div></div>';
        }

        $langkah = [
            'Diajukan',
            'Kepala ' . ucwords(setting('sebutan_dusun') ?: 'Dusun'),
            ucwords(setting('sebutan_kepala_desa') ?: 'Kepala Desa'),
            'Selesai',
        ];

        $html = "<div class='tahapan-surat'><ol>";

        foreach ($langkah as $i => $label) {
            if ($i < $aktif) {
                $kelas = 'selesai';
                $titik = "<i class='fa fa-check'></i>";
            } elseif ($i === $aktif) {
                $kelas = $peringatan ? 'perhatian' : 'aktif';
                $titik = $peringatan ? "<i class='fa fa-exclamation'></i>" : $i + 1;
            } else {
                $kelas = '';
                $titik = $i + 1;
            }
            $html .= "<li class='{$kelas}'><span class='titik'>{$titik}</span><span class='label-tahap'>" . e($label) . '</span></li>';
        }

        return $html . "</ol><div class='tahapan-catatan'>" . e($catatan) . '</div></div>';
    }

    /**
     * KUSTOM permohonan dibatalkan: alasan pembatalan. Diambil dari kolom alasan; untuk permohonan lama
     * yang dibatalkan petugas sebelum kolom itu diisi, diambil dari pesan pembatalan yang dikirim ke warga.
     */
    private static function alasanPembatalan(PermohonanSurat $item): string
    {
        $alasan = trim((string) $item->alasan);

        if ($alasan === '' && $item->surat) {
            $pesan = PesanMandiri::where('penduduk_id', $item->id_pemohon)
                ->where('subjek', 'Permohonan Surat ' . $item->surat->nama . ' Dibatalkan')
                ->orderByDesc('tgl_upload')
                ->value('komentar');
            $alasan = trim(html_entity_decode(strip_tags((string) $pesan)));
        }

        return $alasan;
    }

    /**
     * KUSTOM permohonan dibatalkan: sudah ada permohonan surat sejenis yang dibuat setelah pembatalan ini.
     */
    private static function sudahDiajukanUlang(PermohonanSurat $item): bool
    {
        return PermohonanSurat::withOnly([])
            ->where('id_pemohon', $item->id_pemohon)
            ->where('id_surat', $item->id_surat)
            ->where('status', '!=', PermohonanSurat::DIBATALKAN)
            ->where('created_at', '>=', $item->updated_at)
            ->exists();
    }

    /**
     * KUSTOM: warga menandai surat yang sudah disetujui dan diterima sebagai selesai (status Sudah Diambil).
     * Surat tetap bisa dilihat dan diunduh lagi di menu Arsip Surat.
     */
    public function selesai($id = ''): void
    {
        $permohonan = PermohonanSurat::with(['surat'])
            ->where('id', $id)
            ->milikPenduduk($this->is_login->id_pend)
            ->where('status', PermohonanSurat::SIAP_DIAMBIL)
            ->first();

        if (! $permohonan) {
            redirect_with('error', 'Surat tidak ditemukan atau belum disetujui.', 'layanan-mandiri/permohonan-surat');
        }

        $permohonan->update(['status' => PermohonanSurat::SUDAH_DIAMBIL]);

        redirect_with('success', 'Surat ' . ($permohonan->surat->nama ?? '') . ' ditandai selesai. Surat tetap bisa dilihat dan diunduh lagi di menu Arsip Surat.', 'layanan-mandiri/permohonan-surat');
    }

    /**
     * KUSTOM hapus riwayat: warga menghapus permohonan miliknya yang berstatus Dibatalkan.
     * Tanpa id: hapus semua permohonan dibatalkan milik warga. Dokumen syarat di menu Dokumen tidak ikut terhapus.
     */
    public function hapus_dibatalkan($id = ''): void
    {
        $jumlah = PermohonanSurat::withOnly([])
            ->milikPenduduk($this->is_login->id_pend)
            ->where('status', PermohonanSurat::DIBATALKAN)
            ->when($id !== '' && $id !== null, static fn ($q) => $q->where('id', (int) $id))
            ->delete();

        if (! $jumlah) {
            redirect_with('error', 'Tidak ada permohonan dibatalkan yang dihapus.', 'layanan-mandiri/permohonan-surat');
        }

        redirect_with('success', $jumlah . ' riwayat permohonan yang dibatalkan berhasil dihapus.', 'layanan-mandiri/permohonan-surat');
    }

    public function arsip()
    {
        if ($this->input->is_ajax_request()) {
            return datatables(
                LogSurat::with(['formatSurat', 'pamong'])
                    ->whereNull('deleted_at')
                    ->whereIdPend($this->is_login->id_pend)
            )
                ->addIndexColumn()
                ->addColumn('aksi', static function ($item) {
                    $aksi = '';

                    if ($item->sudahDisetujui()) {
                        $aksi .= self::tombolSuratJadi($item, $item->formatSurat->nama ?? null);
                    }

                    return $aksi;
                })
                ->editColumn('tanggal', static fn ($item) => tgl_indo2($item->tanggal))
                ->rawColumns(['aksi'])
                ->make();
        }

        return view('layanan_mandiri.surat.arsip');
    }

    /**
     * KUSTOM lihat surat: tombol Lihat Surat (pratinjau di halaman) dan Unduh untuk surat yang sudah disetujui.
     */
    private static function tombolSuratJadi(LogSurat $surat, ?string $nama = null): string
    {
        $url   = site_url("layanan-mandiri/surat/cetak/{$surat->id}");
        $judul = e($nama ?: 'Surat');

        return "<a href='{$url}' class='btn btn-social btn-info btn-sm lihat-surat' data-judul='{$judul}' title='Lihat Surat' target='_blank'><i class='fa fa-eye'></i>Lihat Surat</a> "
            . "<a href='{$url}' class='btn bg-fuchsia btn-sm' title='Unduh Surat PDF' download><i class='fa fa-download'></i></a>";
    }

    public function buat($id = '')
    {
        $id_pend    = $this->is_login->id_pend;
        $permohonan = [];
        // KUSTOM permohonan dibatalkan: tanda Ajukan Ulang hanya berlaku untuk satu kali pengisian form
        $this->session->unset_userdata('ajukan_ulang');
        $ajukan_ulang = null;
        // Cek hanya status = 0 (belum lengkap) yg boleh di ubah
        if (! $id && ($idUlang = (int) $this->input->get('ulang'))) {
            // KUSTOM permohonan dibatalkan: form baru terisi data permohonan yang dibatalkan
            $obj = PermohonanSurat::where(['id' => $idUlang, 'id_pemohon' => $id_pend, 'status' => PermohonanSurat::DIBATALKAN])->first();

            if (! $obj) {
                redirect('layanan-mandiri/surat/buat');
            }
            $permohonan   = $obj->toArray();
            $ajukan_ulang = $permohonan;
            $this->session->set_userdata('ajukan_ulang', $obj->id);
            $form_action = ci_route('layanan-mandiri/surat/form');
        } elseif ($id) {
            $obj = PermohonanSurat::where(['id' => $id, 'id_pemohon' => $id_pend, 'status' => 0])->first();

            if (! $obj) {
                redirect('layanan-mandiri/surat/buat');
            }
            $permohonan  = $obj->toArray();
            $form_action = ci_route("layanan-mandiri/surat/form/{$id}");
        } else {
            $form_action = ci_route('layanan-mandiri/surat/form');
        }

        $data = [
            'menu_surat_mandiri'   => FormatSurat::kunci(0)->mandiri()->get(),
            'menu_dokumen_mandiri' => SyaratSurat::get()->toArray(),
            'permohonan'           => $permohonan,
            'form_action'          => $form_action,
            'ajukan_ulang'         => $ajukan_ulang, // KUSTOM permohonan dibatalkan
        ];

        return view('layanan_mandiri.surat.buat', $data);
    }

    public function cek_syarat()
    {
        if ($this->input->is_ajax_request()) {
            $idPermohonan = $this->input->get('id_permohonan');
            $idSurat      = $this->input->get('id_surat');

            $syaratPermohonan = PermohonanSurat::find($idPermohonan)->syarat ?? '';
            $suratMaster      = FormatSurat::find($idSurat)->syarat_surat ?? '';
            $syaratSuratList  = json_decode($suratMaster, true) ?? [];
            $dokumen          = DokumenHidup::where('id_pend', $this->is_login->id_pend)->get()->toArray();

            $syaratSurat = SyaratSurat::get()
                ->filter(static fn ($val) => in_array($val['ref_syarat_id'], $syaratSuratList))
                ->all();

            return datatables($syaratSurat)
                ->addColumn('pilihan_syarat', fn ($item) => view(
                    view: 'layanan_mandiri.surat.pilihan_syarat',
                    data: [
                        'dokumen'           => $dokumen,
                        'syarat_permohonan' => is_array($syaratPermohonan)
                            ? $syaratPermohonan
                            : (json_decode($syaratPermohonan, true) ?? []),
                        'syarat_id'    => $item->ref_syarat_id,
                        'cek_anjungan' => $this->cek_anjungan,
                        // KUSTOM unggah syarat: file yang sudah diunggah tapi permohonannya belum dikirim
                        'unggah_tertunda' => $this->session->data_permohonan['syarat_unggah'] ?? [],
                    ],
                    returnView: true
                ))
                ->rawColumns(['pilihan_syarat'])
                ->addIndexColumn()
                ->skipPaging()
                ->make();
        }

        show_404();
    }

    public function form($id = '')
    {
        $id_pend                        = $this->is_login->id_pend;
        $post                           = $this->input->post();
        // KUSTOM unggah syarat: simpan sementara file syarat yang diunggah warga
        $post                           = $post ? $this->unggahSyaratPermohonan($post, $id) : $this->session->data_permohonan;
        $this->session->data_permohonan = $post;

        if ($id) {
            $permohonan = PermohonanSurat::where(['id' => $id, 'id_pemohon' => $id_pend, 'status' => 0])->first();
            if (! $permohonan || ! $post) {
                return redirect('layanan-mandiri/surat/buat');
            }
            $data = [
                'permohonan' => $permohonan->toArray(),
                'isian_form' => json_encode($permohonan->isian_form, JSON_THROW_ON_ERROR),
                'id_surat'   => $permohonan->id_surat,
            ];
        } else {
            if (! $post) {
                return redirect('layanan-mandiri/surat/buat');
            }
            $data = [
                'permohonan' => null,
                'isian_form' => $this->isianAjukanUlang($post['id_surat']), // KUSTOM permohonan dibatalkan
                'id_surat'   => $post['id_surat'],
            ];
        }

        $surat    = FormatSurat::find($data['id_surat']);
        $penduduk = Penduduk::find($id_pend) ?? show_404();

        $penandatangan     = $this->tinymce->formPenandatangan();
        $data['pamong']    = $penandatangan['penandatangan'];
        $data['atas_nama'] = $penandatangan['atas_nama'];

        $data = array_merge($data, [
            'url'          => $surat->url_surat,
            'individu'     => $penduduk->toArray(),
            'anggota'      => $penduduk?->keluarga?->anggota?->toArray(),
            'surat_url'    => rtrim($_SERVER['REQUEST_URI'], '/clear'),
            'form_action'  => route('layanan-mandiri.surat.kirim', $permohonan['id']),
            'cek_anjungan' => $this->cek_anjungan,
            'mandiri'      => 1,
        ]);

        $this->get_data_untuk_form($surat->url_surat, $data);

        return view('layanan_mandiri.surat.form', $data);
    }

    /**
     * KUSTOM permohonan dibatalkan: isian form permohonan yang dibatalkan, untuk mengisi form Ajukan Ulang.
     * Nomor surat, token keamanan dan data teknis form tidak ikut agar diisi baru.
     */
    private function isianAjukanUlang($idSurat): ?string
    {
        $idUlang = (int) $this->session->ajukan_ulang;

        if (! $idUlang) {
            return null;
        }

        $lama = PermohonanSurat::withOnly([])
            ->where(['id' => $idUlang, 'id_pemohon' => $this->is_login->id_pend, 'status' => PermohonanSurat::DIBATALKAN])
            ->first();

        // Jenis surat diganti warga: form dikosongkan
        if (! $lama || (int) $lama->id_surat !== (int) $idSurat || ! is_array($lama->isian_form)) {
            return null;
        }

        $isian = $lama->isian_form;

        foreach (['nomor', 'url_surat', 'url_remote', 'submit_cetak', 'nik', $this->security->get_csrf_token_name()] as $kunci) {
            unset($isian[$kunci]);
        }

        return $isian ? json_encode($isian) : null;
    }

    public function kirim($id = ''): void
    {
        $data_permohonan = $this->session->data_permohonan;

        $post = $this->input->post();
        $data = [
            'config_id'   => identitas('id'),
            'id_pemohon'  => bilangan($post['nik']),
            'id_surat'    => FormatSurat::where('url_surat', $post['url_surat'])->first()->id,
            'isian_form'  => $post,
            'status'      => 1, // Selalu 1 bagi penggun layanan mandiri
            'keterangan'  => $this->security->xss_clean($data_permohonan['keterangan']),
            'no_hp_aktif' => bilangan($data_permohonan['no_hp_aktif'] ?? $post['no_hp_aktif']),
            'syarat'      => $this->simpanDokumenSyarat($data_permohonan), // KUSTOM unggah syarat
            'updated_at'  => date('Y-m-d H:i:s'),
        ];

        if ($id) {
            PermohonanSurat::whereId($id)->update($data);

            // KUSTOM notifikasi WhatsApp: permohonan dilengkapi warga -> WA ke Kepala Dusun pemohon
            LogSurat::waPermohonanBaru($data['id_pemohon'], FormatSurat::find($data['id_surat'])->nama ?? null);
        } else {
            $data['created_at'] = $data['updated_at'];

            $permohonan = PermohonanSurat::create($data);
            $surat      = $permohonan->load('surat')->surat;

            // Dispatch event to send notifications
            // KUSTOM: event butuh model Penduduk (dulu diberi PendudukMandiri -> HTTP 500).
            // Kegagalan notifikasi tidak boleh menggagalkan permohonan yang sudah tersimpan.
            try {
                $penduduk = Penduduk::withoutGlobalScope(\App\Scopes\AccessWilayahScope::class)->find($permohonan->id_pemohon);
                if ($penduduk && $surat) {
                    event(new PermohonanSuratSubmitted($permohonan, $penduduk, $surat));
                }
            } catch (Throwable $e) {
                log_message('error', 'Notifikasi permohonan surat gagal: ' . $e->getMessage());
            }

            // KUSTOM notifikasi WhatsApp: permohonan baru -> WA ke Kepala Dusun pemohon
            LogSurat::waPermohonanBaru($permohonan->id_pemohon, $surat->nama ?? null);
        }

        $this->session->unset_userdata('data_permohonan');
        $this->session->unset_userdata('ajukan_ulang'); // KUSTOM permohonan dibatalkan

        redirect('layanan-mandiri/permohonan-surat');
    }

    /**
     * KUSTOM unggah syarat: warga bisa langsung mengunggah file untuk tiap syarat surat.
     * File disimpan sementara di folder dokumen dan dicatat di sesi; baru masuk ke menu Dokumen
     * warga saat permohonan dikirim (lihat simpanDokumenSyarat).
     */
    private function unggahSyaratPermohonan(array $post, $id = ''): array
    {
        $lama    = $this->session->data_permohonan['syarat_unggah'] ?? [];
        $syarat  = (array) ($post['syarat'] ?? []);
        $unggah  = [];
        $baru    = [];
        $files   = $_FILES['syarat_file']['name'] ?? [];

        $this->load->library('upload');

        foreach ($files as $idSyarat => $namaAsli) {
            if ($namaAsli === '' || ($_FILES['syarat_file']['error'][$idSyarat] ?? UPLOAD_ERR_NO_FILE) == UPLOAD_ERR_NO_FILE) {
                continue;
            }

            $namaSyarat = SyaratSurat::where('ref_syarat_id', $idSyarat)->value('ref_syarat_nama') ?: 'Dokumen Syarat';
            $this->upload->initialize([
                'upload_path'   => LOKASI_DOKUMEN,
                'allowed_types' => 'jpg|jpeg|png|pdf',
                'file_name'     => namafile($namaSyarat),
            ]);

            // KUSTOM unggah syarat: CodeIgniter tidak bisa membaca file dari kolom array (syarat_file[id]),
            // jadi file dipindah dulu ke kolom tunggal syarat_file_{id}
            $kolom          = 'syarat_file_' . $idSyarat;
            $_FILES[$kolom] = [
                'name'     => $_FILES['syarat_file']['name'][$idSyarat],
                'type'     => $_FILES['syarat_file']['type'][$idSyarat],
                'tmp_name' => $_FILES['syarat_file']['tmp_name'][$idSyarat],
                'error'    => $_FILES['syarat_file']['error'][$idSyarat],
                'size'     => $_FILES['syarat_file']['size'][$idSyarat],
            ];

            if (! $this->upload->do_upload($kolom)) {
                foreach ($baru as $berkas) {
                    @unlink(LOKASI_DOKUMEN . $berkas);
                }
                redirect_with('error', 'Gagal mengunggah ' . $namaSyarat . ': ' . strip_tags($this->upload->display_errors(null, null)), 'layanan-mandiri/surat/buat' . ($id ? "/{$id}" : ''));
            }

            $unggah[$idSyarat] = $baru[] = $this->upload->data()['file_name'];
        }

        // File lama tetap dipakai bila syarat itu masih ada di form dan tidak diganti dengan dokumen yang sudah ada
        foreach ($lama as $idSyarat => $berkas) {
            if (! isset($unggah[$idSyarat]) && array_key_exists($idSyarat, $syarat) && $syarat[$idSyarat] === '' && is_file(LOKASI_DOKUMEN . $berkas)) {
                $unggah[$idSyarat] = $berkas;
            } elseif (($unggah[$idSyarat] ?? null) !== $berkas) {
                @unlink(LOKASI_DOKUMEN . $berkas);
            }
        }

        $post['syarat_unggah'] = $unggah;

        return $post;
    }

    /**
     * KUSTOM unggah syarat: file syarat yang diunggah saat membuat surat otomatis masuk ke menu Dokumen
     * warga (jenis dokumen sesuai syaratnya) dan dipakai sebagai dokumen syarat permohonan.
     */
    private function simpanDokumenSyarat(?array $data_permohonan): array
    {
        $syarat = (array) ($data_permohonan['syarat'] ?? []);

        foreach ($data_permohonan['syarat_unggah'] ?? [] as $idSyarat => $berkas) {
            if (! is_file(LOKASI_DOKUMEN . $berkas)) {
                continue;
            }

            $dokumen = DokumenModel::create([
                'nama'       => SyaratSurat::where('ref_syarat_id', $idSyarat)->value('ref_syarat_nama') ?: 'Dokumen Syarat',
                'satuan'     => $berkas,
                'id_pend'    => $this->is_login->id_pend,
                'id_syarat'  => (int) $idSyarat,
                'kategori'   => 1,
                'tipe'       => 1,
                'dok_warga'  => DokumenModel::DOKUMEN_WARGA,
                'enabled'    => DokumenModel::ENABLE,
                'status'     => 1,
                'tahun'      => date('Y'),
                'tgl_upload' => date('Y-m-d H:i:s'),
                'created_by' => $this->is_login->id_pend,
                'updated_by' => $this->is_login->id_pend,
            ]);

            $syarat[$idSyarat] = (string) $dokumen->id;
        }

        return $syarat;
    }

    public function proses($id = ''): void
    {
        $permohanan = PermohonanSurat::with(['surat'])
            ->where('id', $id)
            ->milikPenduduk($this->is_login->id_pend)
            ->firstOrFail();
        // KUSTOM permohonan dibatalkan: hanya permohonan Belum Lengkap / Sedang Diperiksa yang bisa dibatalkan warga
        if (! in_array((int) $permohanan->status, [PermohonanSurat::BELUM_LENGKAP, PermohonanSurat::SEDANG_DIPERIKSA], true)) {
            redirect_with('error', 'Permohonan ini sudah diproses dan tidak bisa dibatalkan.', 'layanan-mandiri/permohonan-surat');
        }
        $permohanan->status = PermohonanSurat::DIBATALKAN;
        $permohanan->alasan = 'Dibatalkan sendiri oleh pemohon'; // KUSTOM permohonan dibatalkan
        $permohanan->save();

        $isi = 'Penduduk atas nama : ' . $this->is_login->nama . ' - Telah membatalkan permohonan surat ' . $permohanan->surat->nama;
        $this->kirim_notifikasi_admin('verifikasi_operator', $isi, 'Pembatalan Permohanan Surat - ' . $permohanan->surat->nama);

        redirect('layanan-mandiri/permohonan-surat');
    }

    public function cetak_no_antrian(string $no_antrian): void
    {
        try {
            $connector = new NetworkPrintConnector($this->cek_anjungan['printer_ip'], $this->cek_anjungan['printer_port'], 5);
            $printer   = new Printer($connector);

            $printer->initialize();
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->setTextSize(2, 2);
            $printer->setEmphasis(true);
            $printer->text('ANJUNGAN MANDIRI');
            $printer->setEmphasis(false);
            $printer->feed(1);

            $printer->setTextSize(1, 1);
            $printer->text("SELAMAT DATANG \n");
            $printer->text('NOMOR ANTREAN ANDA');
            $printer->feed();

            $printer->setTextSize(4, 4);
            $printer->text(get_antrian($no_antrian));
            $printer->feed();

            $printer->setTextSize(1, 1);
            $printer->text("TERIMA KASIH \n");
            $printer->text('ANDA TELAH MENUNGGU');
            $printer->feed();

            $printer->cut();
        } catch (Exception $e) {
            log_message('error', $e->getMessage());

            redirect($_SERVER['HTTP_REFERER']);
        } finally {
            $printer->close();
        }

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function cetak($id)
    {
        $surat = $this->layananSuratCetak->milikPenduduk($id, $this->is_login->id_pend);

        // Surat hanya bisa diunduh jika sudah disetujui Kadus dan Kades/Perbekel
        if (! $surat->sudahDisetujui()) {
            echo 'Surat belum disetujui';

            return;
        }

        // Cek ada file
        if ($surat->nama_surat && file_exists(FCPATH . LOKASI_ARSIP . $surat->nama_surat)) {
            return ambilBerkas($surat->nama_surat, $this->controller, null, LOKASI_ARSIP, true);
        }

        // File PDF dihapus saat proses verifikasi, buat ulang dari isi surat yang sudah disetujui
        if ($surat->nama_surat && $surat->isi_surat) {
            $this->tinymce->cetak_surat($surat->id);

            return;
        }

        echo 'Berkas tidak ditemukan';
    }

    public function nomor_surat_duplikat(): void
    {
        $hasil = LogSurat::isDuplikat('log_surat', $_POST['nomor'], $_POST['url']);
        echo $hasil ? 'false' : 'true';
    }

    protected function print_connector()
    {
        if (null === ($anjungan = $this->cek_anjungan)) {
            return;
        }

        try {
            $connector = new NetworkPrintConnector($anjungan['printer_ip'], $anjungan['printer_port'], 5);
        } catch (Exception $e) {
            log_message('error', $e->getMessage());

            return false;
        }

        return $connector;
    }

    private function get_data_untuk_form($url, array &$data): void
    {
        // Panggil 1 penduduk berdasarkan datanya sendiri
        $data['penduduk'] = [$data['periksa']['penduduk']];

        $data['surat_terakhir']     = LogSurat::lastNomerSurat($url);
        $data['surat']              = FormatSurat::where('url_surat', $url)->first()->toArray();
        $data['input']              = $this->input->post();
        $data['input']['nomor']     = $data['surat_terakhir']['no_surat_berikutnya'];
        $data['format_nomor_surat'] = FormatSurat::format_penomoran_surat($data);
    }
}
