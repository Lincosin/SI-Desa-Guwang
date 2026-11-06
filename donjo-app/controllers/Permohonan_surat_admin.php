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

use App\Libraries\TinyMCE;
use App\Models\Dokumen;
use App\Models\DokumenHidup;
use App\Models\FormatSurat;
use App\Models\LogSurat;
use App\Models\Penduduk;
use App\Models\PermohonanSurat;
use App\Models\PesanMandiri;
use Illuminate\Support\Facades\View;

defined('BASEPATH') || exit('No direct script access allowed');

class Permohonan_surat_admin extends Admin_Controller
{
    public $modul_ini     = 'layanan-surat';
    public $sub_modul_ini = 'permohonan-surat';

    public function __construct()
    {
        parent::__construct();
        isCan('b');
    }

    public function index()
    {
        return view('admin.permohonan_surat.index', array_merge([
            'list_status_permohonan' => PermohonanSurat::STATUS_PERMOHONAN,
            // KUSTOM tanda tangan Kades: hanya Kades (dan super admin) yang mengelola gambar tanda tangan
            'ttd_kades' => $this->bolehUbahTtdKades() ? ['gambar' => LogSurat::gambarTtdKades()] : null,
        ], $this->tugasPengguna())); // KUSTOM
    }

    /**
     * KUSTOM tanda tangan Kades: unggah atau hapus gambar tanda tangan Kepala Desa untuk kode [ttd_kades].
     */
    public function ttd_kades(): void
    {
        isCan('u');
        $kembali = ci_route('permohonan_surat_admin');

        if (! $this->bolehUbahTtdKades()) {
            redirect_with('error', 'Hanya ' . setting('sebutan_kepala_desa') . ' yang dapat mengubah tanda tangan.', $kembali);
        }

        if ($this->input->post('hapus')) {
            LogSurat::simpanTtdKades(null);
            redirect_with('success', 'Tanda tangan dihapus.', $kembali);
        }

        $berkas = $_FILES['ttd'] ?? null;
        if (! $berkas || $berkas['error'] !== UPLOAD_ERR_OK || $berkas['size'] > 2 * 1024 * 1024) {
            redirect_with('error', 'Pilih gambar tanda tangan berformat PNG atau JPG, paling besar 2 MB.', $kembali);
        }

        $gambar = @imagecreatefromstring((string) file_get_contents($berkas['tmp_name']));
        $hasil  = $gambar ? $this->olahGambarTtd($gambar) : null;
        if (! $hasil) {
            redirect_with('error', 'Gambar tidak terbaca atau tidak berisi goresan tanda tangan.', $kembali);
        }

        LogSurat::simpanTtdKades($hasil);
        redirect_with('success', 'Tanda tangan disimpan. Tulis kode [ttd_kades] di template surat agar tanda tangan muncul pada surat yang sudah disetujui.', $kembali);
    }

    public function datatables()
    {
        if ($this->input->is_ajax_request()) {
            // KUSTOM verifikasi kadus: akun Kepala Dusun hanya melihat permohonan warga dusunnya
            $dusunKadus = LogSurat::dusunKadusLogin();
            $penyetuju = $this->isPenyetuju(); // KUSTOM: Kades/Sekdes
            // KUSTOM verifikasi kadus: pemeriksaan oleh Kepala Dusun pemohon, Kades/Sekdes hanya menyetujui
            $periksaDikunci = $penyetuju && setting('verifikasi_kadus');
            // KUSTOM: persetujuan surat dilakukan langsung dari daftar ini, bukan dari Arsip Layanan
            $tahapLogin = $this->tahapLogin($dusunKadus);

            // KUSTOM: 'surat' kini memuat kolom jenis; dulu hanya id,nama sehingga tombol Menunggu Tandatangan tidak pernah terkunci
            $query = PermohonanSurat::select('permohonan_surat.*')
                ->with(['penduduk:id,nik,nama', 'surat:id,nama,jenis'])
                ->status((string) $this->input->get('status'))
                // Pengguna yang dibatasi wilayahnya (mis. Kepala Dusun) hanya melihat permohonan warga di wilayahnya
                ->when(ci_auth()->batasi_wilayah, static fn ($q) => $q->whereHas('penduduk'))
                ->when($dusunKadus !== [], static fn ($q) => $q->whereIn('id_pemohon', LogSurat::idPendudukDusun($dusunKadus)));

            return datatables($query)
                ->addIndexColumn()
                ->addColumn('aksi', static function ($row) use ($periksaDikunci, $tahapLogin, $penyetuju): string {
                    $aksi = '';

                    if (can('u')) {
                        if ($row->status == PermohonanSurat::BELUM_LENGKAP) {
                            $aksi .= View::make('admin.layouts.components.buttons.btn', [
                                'url'     => '',
                                'judul'   => PermohonanSurat::STATUS_PERMOHONAN[PermohonanSurat::BELUM_LENGKAP],
                                'icon'    => 'fa fa-info-circle',
                                'type'    => 'bg-navy btn-proses',
                                'tooltip' => 'Surat Belum Lengkap',
                            ])->render();
                        } elseif ($row->status == PermohonanSurat::SEDANG_DIPERIKSA) {
                            $aksi .= View::make('admin.layouts.components.buttons.btn', [
                                'url'      => $periksaDikunci ? '' : 'permohonan_surat_admin/periksa/' . $row->id, // KUSTOM
                                'judul'    => PermohonanSurat::STATUS_PERMOHONAN[PermohonanSurat::SEDANG_DIPERIKSA],
                                'icon'     => 'fa fa-spinner',
                                'type'     => 'btn-info' . ($periksaDikunci ? ' btn-proses' : ''),
                                'attribut' => 'style="width:170px"',
                                'tooltip'  => $periksaDikunci ? 'Sedang diperiksa Kepala Dusun pemohon' : 'Klik untuk memeriksa',
                                'disabled' => $periksaDikunci,
                            ])->render();
                        } elseif ($row->status == PermohonanSurat::MENUNGGU_TANDA_TANGAN) {
                            if (in_array($row->surat->jenis, FormatSurat::TINYMCE) && (setting('verifikasi_sekdes') || setting('verifikasi_kades') || setting('verifikasi_kadus'))) {
                                // KUSTOM: jika surat sedang menunggu persetujuan pengguna ini (Kadus/Sekdes/Kades),
                                // tombol membuka surat untuk diperiksa lalu disetujui/ditolak; selain itu tombol terkunci.
                                $logSurat = $row->logSuratTerkait();
                                if ($logSurat && (int) $logSurat->verifikasi_operator === LogSurat::TOLAK) {
                                    // KUSTOM: surat ditolak kembali ke Kepala Dusun (atau operator) untuk dikirim ulang,
                                    // diperbaiki isinya, atau dikembalikan ke warga
                                    $alasan = $logSurat->alasanTolakTerakhir();
                                    $aksi .= View::make('admin.layouts.components.buttons.btn', $penyetuju ? [
                                        'url'      => '',
                                        'judul'    => 'Diperbaiki Kepala Dusun',
                                        'icon'     => 'fa fa-undo',
                                        'type'     => 'bg-maroon btn-proses',
                                        'tooltip'  => 'Ditolak' . ($alasan ? ': ' . $alasan : ''),
                                        'disabled' => true,
                                    ] : [
                                        'url'     => 'keluar/periksa/' . $logSurat->id . '?kembali=permohonan',
                                        'judul'   => 'Ditolak, Perbaiki',
                                        'icon'    => 'fa fa-exclamation-circle',
                                        'type'    => 'btn-danger',
                                        'tooltip' => 'Alasan ditolak' . ($alasan ? ': ' . $alasan : '') . '. Klik untuk kirim ulang, perbaiki isi surat, atau kembalikan ke warga',
                                    ])->render();
                                } elseif ($tahapLogin && $logSurat && (string) $logSurat->{$tahapLogin} === '0') {
                                    $aksi .= View::make('admin.layouts.components.buttons.btn', [
                                        'url'     => 'keluar/periksa/' . $logSurat->id . '?kembali=permohonan',
                                        'judul'   => 'Periksa & Setujui',
                                        'icon'    => 'fa fa-check-square-o',
                                        'type'    => 'bg-olive',
                                        'tooltip' => 'Lihat surat, lalu setujui atau tolak',
                                    ])->render();
                                } else {
                                    $aksi .= View::make('admin.layouts.components.buttons.btn', [
                                        'url'      => '',
                                        'judul'    => PermohonanSurat::STATUS_PERMOHONAN[PermohonanSurat::MENUNGGU_TANDA_TANGAN],
                                        'icon'     => 'fa fa-edit',
                                        'type'     => 'bg-purple btn-proses',
                                        'tooltip'  => $row->tahapPersetujuan($logSurat),
                                        'disabled' => true,
                                    ])->render();
                                }
                            } else {
                                $aksi .= View::make('admin.layouts.components.buttons.btn', [
                                    'url'      => 'permohonan_surat_admin/proses/' . $row->id . '/3',
                                    'judul'    => PermohonanSurat::STATUS_PERMOHONAN[PermohonanSurat::MENUNGGU_TANDA_TANGAN],
                                    'icon'     => 'fa fa-edit',
                                    'type'     => 'bg-purple',
                                    'attribut' => 'style="width:170px"',
                                    'tooltip'  => 'Surat Menunggu Tandatangan',
                                ])->render();
                            }
                        } elseif ($row->status == PermohonanSurat::SIAP_DIAMBIL) {
                            $aksi .= View::make('admin.layouts.components.buttons.btn', [
                                'url'      => 'permohonan_surat_admin/proses/' . $row->id . '/4',
                                'judul'    => PermohonanSurat::STATUS_PERMOHONAN[PermohonanSurat::SIAP_DIAMBIL],
                                'icon'     => 'fa fa-thumbs-o-up',
                                'type'     => 'bg-orange',
                                'attribut' => 'style="width:170px"',
                                'tooltip'  => 'Klik jika telah diambil',
                            ])->render();
                        } elseif ($row->status == PermohonanSurat::SUDAH_DIAMBIL) {
                            $aksi .= View::make('admin.layouts.components.buttons.btn', [
                                'url'      => '',
                                'judul'    => PermohonanSurat::STATUS_PERMOHONAN[PermohonanSurat::SUDAH_DIAMBIL],
                                'icon'     => 'fa fa-check',
                                'type'     => 'btn-success btn-proses',
                                'attribut' => 'style="width:170px"',
                                'tooltip'  => 'Surat Sudah Diambil',
                            ])->render();
                        } else {
                            $aksi .= View::make('admin.layouts.components.buttons.btn', [
                                'url'      => '',
                                'judul'    => PermohonanSurat::STATUS_PERMOHONAN[PermohonanSurat::DIBATALKAN],
                                'icon'     => 'fa fa-times',
                                'type'     => 'btn-danger btn-proses',
                                'attribut' => 'style="width:170px"',
                                'tooltip'  => 'Surat Dibatalkan',
                            ])->render();

                            if (can('h') && ci_auth()->id == super_admin()) {
                                $aksi .= View::make('admin.layouts.components.buttons.hapus', [
                                    'url'           => ci_route('permohonan_surat_admin.delete', $row->id),
                                    'confirmDelete' => true,
                                ])->render();
                            }
                        }
                    }

                    return $aksi;
                })
                ->editColumn('no_antrian', static fn ($row) => get_antrian($row->no_antrian))
                ->editColumn('created_at', static fn ($row) => tgl_indo2($row->created_at))
                ->rawColumns(['aksi'])
                ->make();
        }

        return show_404();
    }

    public function periksa($id = ''): void
    {
        // Cek hanya status = 1 (sedang diperiksa) yg boleh di proses
        $periksa = PermohonanSurat::whereStatus(PermohonanSurat::SEDANG_DIPERIKSA)->find($id);

        if (! $id || ! $periksa) {
            show_404();
        }

        $this->cegahPemeriksaanOlehPenyetuju(); // KUSTOM

        // KUSTOM verifikasi kadus: Kepala Dusun hanya boleh memeriksa permohonan warga dusunnya
        $dusunKadus = LogSurat::dusunKadusLogin();
        if ($dusunKadus !== [] && ! in_array(LogSurat::dusunPenduduk($periksa->id_pemohon), $dusunKadus)) {
            redirect_with('error', 'Permohonan ini dari warga dusun lain, jadi tidak dapat diperiksa oleh akun Kepala Dusun ini.', ci_route('permohonan_surat_admin'));
        }
        $url = $periksa->surat->url_surat;

        // Penduduk menggunakan AccessWilayahScope, sehingga kosong jika pemohon di luar wilayah pengguna (Kepala Dusun)
        $penduduk = Penduduk::find($periksa->id_pemohon);

        if (! $penduduk) {
            redirect_with('error', 'Pemohon berada di luar wilayah akses Anda', 'permohonan_surat_admin');
        }

        $data['periksa']  = $periksa;
        $data['surat']    = $periksa->surat;
        $data['url']      = $url;
        $data['individu'] = $penduduk->toArray();
        $this->get_data_untuk_form($url, $data);
        $data['isian_form']        = json_encode($this->ambil_isi_form($periksa->isian_form), JSON_THROW_ON_ERROR);
        $data['surat_url']         = rtrim((string) $_SERVER['REQUEST_URI'], '/clear');
        $data['syarat_permohonan'] = $periksa->mapSyaratSurat();
        $data['list_dokumen']      = empty($_POST['nik']) ? null : DokumenHidup::whereIdPend($periksa->id_pemohon)->get()->toArray();
        $data['form_action']       = ci_route("surat.pratinjau.{$url}.{$id}");

        $pesan   = 'Permohonan Surat - ' . $periksa->surat->nama . ' - sedang dalam proses oleh operator';
        $judul   = 'Permohonan Surat - ' . $periksa->surat->nama . ' - sedang dalam proses';
        $payload = '/layanan';
        // kirim notifikasi fcm
        $this->kirim_notifikasi_penduduk($periksa->id_pemohon, $pesan, $judul, $payload);

        $data['surat']['kode_isian'] = collect($data['surat']->kode_isian)->groupByLabel();

        view('admin.permohonan_surat.periksa_surat', $data);
    }

    public function proses($id = '', $status = 0): void
    {
        // KUSTOM: 'surat' dimuat dengan kolom jenis untuk membedakan surat TinyMCE (berverifikasi) dan RTF
        $permohonan = PermohonanSurat::with('surat:id,jenis')->findOrFail($id);

        // Jika verifikasi berjenjang aktif, status 'Siap Diambil' hanya diberikan
        // melalui persetujuan tahap terakhir di Arsip Layanan (Keluar::verifikasi)
        $adaVerifikasi = setting('verifikasi_kadus') || setting('verifikasi_sekdes') || setting('verifikasi_kades');
        if ((int) $status === PermohonanSurat::SIAP_DIAMBIL && $adaVerifikasi && in_array($permohonan->surat->jenis ?? null, FormatSurat::TINYMCE)) {
            redirect_with('error', 'Surat harus disetujui ' . setting('sebutan_kepala_desa') . ' terlebih dahulu');
        }

        $permohonan->update(['status' => $status]);

        redirect_with('success', 'Berhasil Ubah Data');
    }

    public function konfirmasi($id_permohonan = 0, $tipe = 0): void
    {
        $data['form_action'] = route('permohonan_surat_admin.kirim_pesan', ['id_permohonan' => $id_permohonan, 'tipe' => $tipe]);

        view('admin.permohonan_surat.konfirmasi_permohonan', $data);
    }

    public function kirim_pesan($id_permohonan = 0, $tipe = 0): void
    {
        $this->cegahPemeriksaanOlehPenyetuju(); // KUSTOM

        $tipe ??= 0;
        $periksa = PermohonanSurat::with(['surat'])->where(['id' => $id_permohonan, 'status' => PermohonanSurat::SEDANG_DIPERIKSA])->first()->toArray();
        $pemohon = Penduduk::find($periksa['id_pemohon'])->toArray();
        $post    = $this->input->post();
        $judul   = ($tipe == 0) ? 'Perlu Dilengkapi' : 'Dibatalkan';
        $data    = [
            'owner'       => $pemohon['nama'], // TODO : Gunakan id_pend
            'penduduk_id' => $periksa['id_pemohon'],
            'subjek'      => 'Permohonan Surat ' . $periksa['surat']['nama'] . ' ' . $judul,
            'komentar'    => $post['pesan'],
            'status'      => 2,
            'tipe'        => 2,
        ];

        PesanMandiri::create($data);
        // KUSTOM permohonan dibatalkan: simpan pesan petugas sebagai alasan agar tampil di daftar permohonan warga
        PermohonanSurat::whereId($id_permohonan)->update(['alasan' => trim(strip_tags((string) $post['pesan']))]);
        $this->proses($id_permohonan, $tipe);

        $this->kirim_notifikasi_penduduk($id_permohonan, $data['komentar'], $data['subjek'], '/layanan');

        redirect('permohonan_surat_admin');
    }

    public function delete($id = ''): void
    {
        isCan('h');

        $delete = PermohonanSurat::where('status', PermohonanSurat::DIBATALKAN)->find($id) ?? show_404();

        if ($delete->delete()) {
            redirect_with('success', 'Berhasil Hapus Data');
        }

        redirect_with('error', 'Gagal Hapus Data');
    }

    public function tampilkan($id_dokumen, $id_pend = 0): void
    {
        $berkasObj = Dokumen::aktif()->whereId($id_dokumen)->first();
        $berkas    = $berkasObj ? $berkasObj->satuan : null;

        if (! $id_dokumen || ! $id_pend || ! $berkas || ! file_exists(LOKASI_DOKUMEN . $berkas)) {
            $data['link_berkas'] = null;
        } else {
            $data = [
                'link_berkas' => site_url("{$this->controller}/tampilkan_berkas/{$id_dokumen}/{$id_pend}"),
                'tipe'        => get_extension($berkas),
                'link_unduh'  => site_url("{$this->controller}/unduh_berkas/{$id_dokumen}/{$id_pend}"),
            ];
        }
        view('admin.layouts.components.tampilkan', $data);
    }

    /**
     * Unduh berkas berdasarkan kolom dokumen.id
     *
     * @param int        $id_dokumen Id berkas pada koloam dokumen.id
     * @param mixed|null $id_pend
     */
    public function unduh_berkas($id_dokumen, $id_pend = null, mixed $tampil = false): void
    {
        // Ambil nama berkas dari database
        $data = Dokumen::find($id_dokumen);
        ambilBerkas($data->satuan ?? '', $this->controller, null, LOKASI_DOKUMEN, $tampil);
    }

    public function tampilkan_berkas($id_dokumen, $id_pend = null): void
    {
        $this->unduh_berkas($id_dokumen, $id_pend, $tampil = true);
    }

    /**
     * KUSTOM: apakah pengguna ini Kades/Sekdes (penyetuju surat).
     */
    private function isPenyetuju(): bool
    {
        $pamong = $this->session->isAdmin->pamong ?? null;

        return $pamong && in_array($pamong->jabatan_id, [kades()->id, sekdes()->id]);
    }

    /**
     * KUSTOM tanda tangan Kades: yang boleh mengelola gambar tanda tangan Kepala Desa.
     */
    private function bolehUbahTtdKades(): bool
    {
        $pamong = $this->session->isAdmin->pamong ?? null;

        return ($pamong && $pamong->jabatan_id == kades()->id) || ci_auth()->id == super_admin();
    }

    /**
     * KUSTOM tanda tangan Kades: latar terang dibuat transparan, ruang kosong dipotong, lalu diperkecil
     * agar muat di satu baris pengaturan. Hasilnya data URI PNG, atau null jika tidak ada goresan.
     */
    private function olahGambarTtd($sumber): ?string
    {
        // Ratakan ke latar putih (PNG transparan) dan perkecil bila sangat besar
        $w      = imagesx($sumber);
        $h      = imagesy($sumber);
        $skala  = min(1, 1000 / max($w, $h));
        $lw     = max(1, (int) round($w * $skala));
        $lh     = max(1, (int) round($h * $skala));
        $kanvas = imagecreatetruecolor($lw, $lh);
        imagefill($kanvas, 0, 0, imagecolorallocate($kanvas, 255, 255, 255));
        imagecopyresampled($kanvas, $sumber, 0, 0, 0, 0, $lw, $lh, $w, $h);

        // Batas goresan (piksel gelap)
        $minX = $lw;
        $minY = $lh;
        $maxX = $maxY = -1;

        for ($y = 0; $y < $lh; $y++) {
            for ($x = 0; $x < $lw; $x++) {
                $rgb = imagecolorat($kanvas, $x, $y);
                if (((($rgb >> 16) & 0xFF) + (($rgb >> 8) & 0xFF) + ($rgb & 0xFF)) / 3 < 160) {
                    $minX = min($minX, $x);
                    $minY = min($minY, $y);
                    $maxX = max($maxX, $x);
                    $maxY = max($maxY, $y);
                }
            }
        }

        if ($maxX < 0) {
            return null;
        }

        $minX = max(0, $minX - 4);
        $minY = max(0, $minY - 4);
        $cw   = min($lw - 1, $maxX + 4) - $minX + 1;
        $ch   = min($lh - 1, $maxY + 4) - $minY + 1;

        // Potong dan perkecil; ulangi lebih kecil bila hasilnya terlalu besar untuk kolom pengaturan
        for ($batas = 480; $batas >= 120; $batas = (int) ($batas * 0.8)) {
            $s     = min(1, $batas / $cw, ($batas / 2) / $ch);
            $tw    = max(1, (int) round($cw * $s));
            $th    = max(1, (int) round($ch * $s));
            $hasil = imagecreatetruecolor($tw, $th);
            imagecopyresampled($hasil, $kanvas, 0, 0, $minX, $minY, $tw, $th, $cw, $ch);
            imagealphablending($hasil, false);
            imagesavealpha($hasil, true);

            // Makin terang makin transparan: goresan tetap hitam, latar hilang
            for ($y = 0; $y < $th; $y++) {
                for ($x = 0; $x < $tw; $x++) {
                    $rgb    = imagecolorat($hasil, $x, $y);
                    $terang = ((($rgb >> 16) & 0xFF) + (($rgb >> 8) & 0xFF) + ($rgb & 0xFF)) / 3;
                    $alpha  = (int) round(127 * min(1, max(0, ($terang - 60) / 170)));
                    imagesetpixel($hasil, $x, $y, imagecolorallocatealpha($hasil, 0, 0, 0, $alpha));
                }
            }

            ob_start();
            imagepng($hasil, null, 9);
            $uri = 'data:image/png;base64,' . base64_encode((string) ob_get_clean());

            if (strlen($uri) < 60000) {
                return $uri;
            }
        }

        return null;
    }

    /**
     * KUSTOM: kolom tahap verifikasi di log_surat yang disetujui pengguna ini, null jika bukan penyetuju.
     */
    private function tahapLogin(array $dusunKadus): ?string
    {
        $pamong = $this->session->isAdmin->pamong ?? null;

        if ($pamong && $pamong->jabatan_id == kades()->id && setting('verifikasi_kades')) {
            return 'verifikasi_kades';
        }
        if ($pamong && $pamong->jabatan_id == sekdes()->id && setting('verifikasi_sekdes')) {
            return 'verifikasi_sekdes';
        }

        if ($dusunKadus !== []) {
            return 'verifikasi_kadus';
        }

        // Operator juga memverifikasi surat permohonan yang dibuatnya dari daftar ini
        return (setting('verifikasi_kadus') || setting('verifikasi_sekdes') || setting('verifikasi_kades')) ? 'verifikasi_operator' : null;
    }

    /**
     * KUSTOM: ringkasan tugas Kades/Sekdes/Kepala Dusun di menu Permohonan Surat, ditambah surat dari Cetak Surat
     * yang menunggu persetujuan mereka (dulu hanya ada di Arsip Layanan, yang kini hanya berisi arsip).
     */
    private function tugasPengguna(): array
    {
        $kosong     = ['tugas' => null, 'surat_lain' => collect()];
        $pamong     = $this->session->isAdmin->pamong ?? null;
        $dusunKadus = LogSurat::dusunKadusLogin();

        if (! $pamong || (! $this->isPenyetuju() && $dusunKadus === []) || ! (setting('verifikasi_kadus') || setting('verifikasi_sekdes') || setting('verifikasi_kades'))) {
            return $kosong;
        }

        $listJabatan = [
            'jabatan_id'        => $pamong->jabatan_id,
            'jabatan_kades_id'  => kades()->id,
            'jabatan_sekdes_id' => sekdes()->id,
        ];
        // Surat yang menunggu persetujuan pengguna ini: dari permohonan warga (ada di daftar bawah)
        // atau dari Cetak Surat (ditampilkan terpisah)
        [$dariWarga, $suratLain] = LogSurat::whereNull('deleted_at')
            ->masuk($pamong, $listJabatan)
            ->latest('id')
            ->limit(200)
            ->get()
            ->partition(static fn ($surat) => $surat->dariPermohonanWarga());

        $tugas = [
            'kadus'      => $dusunKadus !== [],
            'disetujui'  => $dariWarga->count(),
            'diperiksa'  => 0,
            'diperbaiki' => 0,
        ];

        if ($tugas['kadus']) {
            $tugas['diperiksa']  = PermohonanSurat::whereStatus(PermohonanSurat::SEDANG_DIPERIKSA)->whereIn('id_pemohon', LogSurat::idPendudukDusun($dusunKadus))->count();
            $tugas['diperbaiki'] = LogSurat::whereNull('deleted_at')->ditolak()->dariDusun($dusunKadus)->get()
                ->filter(static fn ($surat) => $surat->dariPermohonanWarga())
                ->count();

            // Surat buatan Kadus ini dari Cetak Surat yang ditolak
            $suratLain = $suratLain->concat(
                LogSurat::whereNull('deleted_at')->ditolak()->where('id_user', ci_auth()->id)->latest('id')->get()
                    ->reject(static fn ($surat) => $surat->dariPermohonanWarga())
            );
        }

        return ['tugas' => $tugas, 'surat_lain' => $suratLain->values()];
    }

    /**
     * KUSTOM verifikasi kadus: pemeriksaan permohonan (periksa, minta dilengkapi, batalkan) adalah tugas
     * Kepala Dusun pemohon. Kades/Sekdes hanya menyetujui surat (tombol Periksa & Setujui).
     */
    private function cegahPemeriksaanOlehPenyetuju(): void
    {
        if (setting('verifikasi_kadus') && $this->isPenyetuju()) {
            redirect_with('error', 'Permohonan diperiksa oleh Kepala Dusun pemohon. ' . setting('sebutan_kepala_desa') . ' menyetujui surat lewat tombol Periksa & Setujui setelah surat dikirim Kepala Dusun.', ci_route('permohonan_surat_admin'));
        }
    }

    private function get_data_untuk_form($url, array &$data): void
    {
        // Panggil 1 penduduk berdasarkan datanya sendiri
        $data['penduduk'] = [$data['periksa']['penduduk']];

        $data['surat_terakhir']     = LogSurat::lastNomerSurat($url);
        $data['input']              = $this->input->post();
        $data['input']['nomor']     = $data['surat_terakhir']['no_surat_berikutnya'];
        $data['format_nomor_surat'] = FormatSurat::format_penomoran_surat($data);

        $tinymce           = new TinyMCE();
        $penandatangan     = $tinymce->formPenandatangan();
        $data['pamong']    = $penandatangan['penandatangan'];
        $data['atas_nama'] = $penandatangan['atas_nama'];
    }

    /**
     * @return mixed[]
     */
    private function ambil_isi_form(array $isian_form): array
    {
        $hapus = ['url_surat', 'url_remote', 'nik', 'id_surat', 'nomor', 'pilih_atas_nama', 'pamong', 'pamong_nip', 'jabatan', 'pamong_id'];

        foreach ($hapus as $kolom) {
            unset($isian_form[$kolom]);
        }

        return $isian_form;
    }
}
