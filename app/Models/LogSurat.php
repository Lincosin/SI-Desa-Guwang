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

namespace App\Models;

use App\Traits\ConfigId;
use App\Traits\ShortcutCache;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

defined('BASEPATH') || exit('No direct script access allowed');

class LogSurat extends BaseModel
{
    use ConfigId;
    use ShortcutCache;

    public const KONSEP  = 0;
    public const CETAK   = 1;
    public const TOLAK   = -1;
    public const PERIKSA = 0;
    public const TERIMA  = 1;

    /**
     * The timestamps for the model.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'log_surat';

    /**
     * The guarded with the model.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['formatSurat', 'penduduk', 'pamong', 'tolak'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'boolean',
    ];

    /**
     * Cari surat dengan nomor terakhir sesuai setting aplikasi
     *
     * @param		string 	nama tabel surat
     * @param mixed|null $url
     *
     * @return array surat terakhir
     */
    public static function suratTerakhir(mixed $type, $url = null)
    {
        $setting = setting('penomoran_surat');

        if ($setting == 3) {
            $last_sl = self::suratTerakhirType('log_surat', null, 1);
            $last_sm = self::suratTerakhirType('surat_masuk', null, 1);
            $last_sk = self::suratTerakhirType('surat_keluar', null, 1);

            $surat[$last_sl['no_surat']]   = $last_sl;
            $surat[$last_sm['nomor_urut']] = $last_sm;
            $surat[$last_sk['nomor_urut']] = $last_sk;
            krsort($surat);

            return current($surat);
        }

        return self::suratTerakhirType($type, $url);
    }

    public static function suratTerakhirType($type, $url = null, $setting = null)
    {
        $thn                 = date('Y');
        $setting || $setting = setting('penomoran_surat');

        switch ($type) {
                // no break
            case 'log_surat':
                if ($setting == 1) {
                    $surat = LogSurat::whereNull('deleted_at')
                        ->where('no_surat', '!=', '')
                        ->whereYear('tanggal', $thn)
                        ->whereStatus(1)
                        ->orderBy(DB::raw('CAST(no_surat as unsigned)'), 'desc')
                        ->first();
                } elseif ($setting == 4) {
                    $surat = LogSurat::whereNull('deleted_at')
                        ->where('no_surat', '!=', '')
                        ->whereYear('tanggal', $thn)
                        ->rightJoin('tweb_surat_format', 'tweb_surat_format.id', '=', 'log_surat.id_format_surat')
                        ->where('kode_surat', static function ($q) use ($url): void {
                            $q->select('kode_surat')
                                ->from('tweb_surat_format')
                                ->where('url_surat', $url)
                                ->where('config_id', identitas('id'));
                        })
                        ->orderBy(DB::raw('CAST(no_surat as unsigned)'), 'desc')
                        ->first();
                } else {
                    $surat = LogSurat::whereNull('deleted_at')
                        ->where('no_surat', '!=', '')
                        ->whereYear('tanggal', $thn)
                        ->rightJoin('tweb_surat_format', 'tweb_surat_format.id', '=', 'log_surat.id_format_surat')
                        ->where(static fn ($q) => $q->where('url_surat', $url)->orWhereRaw("url_surat = REPLACE(REPLACE('{$url}', 'erangan', ''), '-', '_')"))
                        ->orderBy(DB::raw('CAST(no_surat as unsigned)'), 'desc')
                        ->first();
                }
                break;

            case 'surat_masuk':
                $surat = SuratMasuk::whereYear('tanggal_surat', $thn)
                    ->orderBy(DB::raw('CAST(nomor_urut as unsigned)'), 'desc')
                    ->first();
                break;

            case 'surat_keluar':
                $surat = SuratKeluar::whereYear('tanggal_surat', $thn)
                    ->orderBy(DB::raw('CAST(nomor_urut as unsigned)'), 'desc')
                    ->first();
        }
        $surat                                             = $surat ? $surat->toArray() : ['no_surat' => 0];
        $surat['nomor_urut']    || $surat['nomor_urut']    = $surat['no_surat'];
        $surat['no_surat']      || $surat['no_surat']      = $surat['nomor_urut'];
        $surat['tanggal_surat'] || $surat['tanggal_surat'] = $surat['tanggal'];
        $surat['tanggal']       || $surat['tanggal']       = $surat['tanggal_surat'];
        $surat['tanggal']                                  = tgl_indo2($surat['tanggal']);

        return $surat;
    }

    public static function lastNomerSurat($url)
    {
        $settingNomer = setting('penomoran_surat');
        $data         = self::suratTerakhir('log_surat', $url);
        if ($settingNomer == 2 && empty($data['nama'])) {
            $data['nama'] = FormatSurat::where('url_surat', $url)->first()->nama;
        } elseif ($settingNomer == 4) {
            $data['kode_surat'] = FormatSurat::where('url_surat', $url)->first()->kode_surat;
        }

        $ket = [
            1 => 'Terakhir untuk semua surat layanan: ',
            2 => "Terakhir untuk jenis surat {$data['nama']}: ",
            3 => 'Terakhir untuk semua surat layanan, keluar dan masuk: ',
            4 => "Terakhir untuk klasifikasi surat: {$data['kode_surat']}: ",
        ];

        $data['no_surat_berikutnya'] = $data['no_surat'] + 1;
        $data['no_surat_berikutnya'] = str_pad((string) $data['no_surat_berikutnya'], (int) setting('panjang_nomor_surat'), '0', STR_PAD_LEFT);
        $data['ket_nomor']           = $ket[$settingNomer];

        return $data;
    }

    public static function boot(): void
    {
        parent::boot();

        static::deleting(static function ($model): void {
            static::deleteFile($model, 'nama_surat', true);
        });
    }

    public static function deleteFile($model, ?string $file, $deleting = false): void
    {
        if ($model->isDirty($file) || $deleting) {
            $surat = LOKASI_ARSIP . $model->getOriginal($file);
            if (file_exists($surat)) {
                unlink($surat);
            }
        }
    }

    public static function isDuplikat($type, $nomor_surat, $url = null)
    {
        $thn     = date('Y');
        $setting = setting('penomoran_surat');
        if ($setting == 3) {
            // Nomor urut gabungan surat layanan, surat masuk dan surat keluar
            $suratMasuk  = SuratMasuk::where(['nomor_urut' => $nomor_surat])->whereYear('tanggal_surat', $thn)->exists();
            $suratKeluar = SuratKeluar::where(['nomor_urut' => $nomor_surat])->whereYear('tanggal_surat', $thn)->exists();
            $logSurat    = self::whereNull('deleted_at')->where(['no_surat' => $nomor_surat])->whereYear('tanggal', $thn)->exists();

            $result = $logSurat || $suratMasuk || $suratKeluar;
        } elseif ($setting == 1) {
            $result = LogSurat::selectRaw('no_surat as nomor_urut')->whereNull('deleted_at')->where(['no_surat' => $nomor_surat])->whereYear('tanggal', $thn)->count();
        } elseif ($setting == 4) {
            $kodeSurat = FormatSurat::where('url_surat', $url)->first()->kode_surat;
            $result    = LogSurat::selectRaw('no_surat as nomor_urut')->whereNull('deleted_at')
                ->whereYear('tanggal', $thn)
                ->whereNoSurat($nomor_surat)
                ->rightJoin('tweb_surat_format', 'tweb_surat_format.id', '=', 'log_surat.id_format_surat')
                ->where(static fn ($q) => $q->where('kode_surat', $kodeSurat))
                ->count();
        } else {
            $result = LogSurat::selectRaw('no_surat as nomor_urut')->whereHas('surat', static fn ($q) => $q->where(['url_surat' => $url]))->whereNull('deleted_at')->where(['no_surat' => $nomor_surat])->whereYear('tanggal', $thn)->count();
        }

        return $result;
    }

    public static function buatQrCode($namaSurat, ?string $logo): array
    {
        // Ambil data surat (bisa dari LogSurat atau model turunan lain)
        $log_surat = self::select(['id', 'urls_id'])
            ->where('nama_surat', $namaSurat)
            ->first();

        // Pastikan hasil selalu array (meskipun tidak ada data)
        if ($log_surat) {
            //redirect link tidak ke path aslinya dan encode ID surat
            $urls = Urls::urlPendek($log_surat->toArray());

            $qrCode = [
                'isiqr'   => $urls['isiqr'],
                'urls_id' => $urls['urls_id'],
                'logoqr'  => gambar_desa($logo, false, true),
                'sizeqr'  => 6,
                'foreqr'  => '#000000',
            ];

            $qrCode['viewqr'] = qrcode_generate($qrCode);
        } else {
            $qrCode['viewqr'] = null;
        }

        return $qrCode;
    }

    public function formatSurat()
    {
        return $this->belongsTo(FormatSurat::class, 'id_format_surat')->withoutGlobalScope(\App\Scopes\RemoveRtfScope::class);
    }

    public function formatSuratArsip()
    {
        return $this->formatSurat();
    }

    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class, 'id_pend');
    }

    public function pendudukSaja()
    {
        return $this->belongsTo(PendudukSaja::class, 'id_pend');
    }

    public function pamong()
    {
        return $this->belongsTo(Pamong::class, 'id_pamong');
    }

    public function tolak()
    {
        return $this->hasMany(LogTolak::class, 'id_surat');
    }

    /**
     * Get the user that owns the LogSurat
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    /**
     * Scope query untuk pengguna.
     *
     * @param Builder $query
     */
    public function scopePengguna($query): void
    {
        // return $query->where('id_pend', auth('jwt')->user()->penduduk->id);
    }

    /**
     * Scope query untuk Status LogSurat
     *
     * @return Builder
     */
    public function scopeStatus(mixed $query, mixed $value = 1)
    {
        return $query->where('status', $value);
    }

    public function surat()
    {
        return $this->belongsTo(FormatSurat::class, 'id_format_surat');
    }

    /**
     * Scope daftar arsip fisik layanan surat.
     *
     * @var Builder
     */
    public function scopeArsipFisikLayananSurat(mixed $query)
    {
        return $query->select('log_surat.id', 'log_surat.no_surat as nomor_dokumen', DB::raw('DATE(log_surat.tanggal) as tanggal_dokumen'), 'log_surat.nama_surat as nama_dokumen', DB::raw('CONCAT(\'5-\', tweb_surat_format.id) as jenis'), 'tweb_surat_format.nama as nama_jenis', 'log_surat.lokasi_arsip', DB::raw('CONCAT(\'keluar/perorangan/\', tweb_penduduk.id) as modul_asli'), 'log_surat.tahun', DB::raw('\'layanan_surat\' as kategori'), DB::raw('IF(log_surat.lampiran IS NOT NULL, log_surat.lampiran, \'\') as lampiran'))
            ->leftJoin('tweb_penduduk', 'log_surat.id_pend', '=', 'tweb_penduduk.id')
            ->leftJoin('tweb_surat_format', 'log_surat.id_format_surat', '=', 'tweb_surat_format.id')
            ->where(static fn ($query) => $query->where('log_surat.verifikasi_operator', 1)->orWhere('log_surat.verifikasi_operator', null))
            ->whereNull('log_surat.deleted_at');
    }

    public function getFormatPenomoranSuratAttribute(): string|array
    {
        $thn                = $this->tahun ?? date('Y');
        $bln                = $this->bulan ?? date('m');
        $format_nomor_surat = format_penomoran_surat($this->formatSurat->format_nomor_global, setting('format_nomor_surat'), $this->formatSurat->format_nomor);

        // $format_nomor_surat = str_replace('[nomor_surat]', "{$this->no_surat}", $format_nomor_surat);
        $format_nomor_surat = substitusiNomorSurat($this->no_surat, $format_nomor_surat);
        $array_replace      = [
            '[kode_surat]'   => $this->formatSurat->kode_surat,
            '[tahun]'        => $thn,
            '[bulan_romawi]' => bulan_romawi((int) $bln),
            '[kode_desa]'    => identitas()->kode_desa,
        ];

        return str_ireplace(array_keys($array_replace), array_values($array_replace), $format_nomor_surat);
    }

    public function getFileSuratAttribute(): ?string
    {
        if ($this->lampiran != null) {
            return FCPATH . LOKASI_ARSIP . pathinfo($this->nama_surat, PATHINFO_FILENAME);
        }

        return null;
    }

    public function statusPeriksa($jabatanId, $idJabatanKades, $idJabatanSekdes, $isKadus = false): int
    {
        $statusPeriksa = 0;
        // KUSTOM verifikasi kadus
        if ($isKadus && ! in_array($jabatanId, [$idJabatanKades, $idJabatanSekdes])) {
            if ($this->verifikasi_kadus == 1) {
                if (null === $this->tte) {
                    $statusPeriksa = $this->verifikasi_kades ?? $this->verifikasi_sekdes ?? 1;
                } else {
                    $statusPeriksa = $this->tte;
                }
            }

            return (int) $statusPeriksa;
        }
        if ($jabatanId == $idJabatanKades && setting('verifikasi_kades') == 1) {
            if ($this->verifikasi_kades == 1) {
                $statusPeriksa = null === $this->tte ? $this->verifikasi_kades : 2;
            }
        } elseif ($jabatanId == $idJabatanSekdes && setting('verifikasi_sekdes') == 1) {
            if ($this->verifikasi_sekdes == 1) {
                if (null === $this->tte) {
                    $statusPeriksa = $this->verifikasi_kades == null ? 1 : $this->verifikasi_kades;
                } else {
                    $statusPeriksa = $this->tte;
                }
            }
        } elseif ($this->verifikasi_operator == 1) {
            // $statusPeriksa = $this->tte == null ? $this->verifikasi_kades ?? $this->verifikasi_sekdes ?? 1 : $this->tte
            if (null === $this->tte) {
                if ($this->verifikasi_kades == null) {
                    // KUSTOM verifikasi kadus
                    $statusPeriksa = $this->verifikasi_sekdes == null ? ($this->verifikasi_kadus ?? 1) : $this->verifikasi_sekdes;
                } else {
                    $statusPeriksa = $this->verifikasi_kades;
                }
            } else {
                $statusPeriksa = $this->tte;
            }
        }

        return $statusPeriksa;
    }

    public function rtfFile(): string
    {
        $nama_surat = pathinfo($this->nama_surat, PATHINFO_FILENAME);

        if ($nama_surat !== '' && $nama_surat !== '0') {
            $berkas_rtf = $nama_surat . '.rtf';
        } else {
            $berkas_rtf = $this->formatSurat->url_surat . '_' . $this->penduduk->nik . '_' . date('Y-m-d') . '.rtf';
        }

        return LOKASI_ARSIP . $berkas_rtf;
    }

    public function pdfFile(): string
    {
        $nama_surat = pathinfo($this->nama_surat, PATHINFO_FILENAME);

        if ($nama_surat !== '' && $nama_surat !== '0') {
            $berkas_pdf = $nama_surat . '.pdf';
        } else {
            $berkas_pdf = $this->formatSurat->url_surat . '_' . $this->penduduk->nik . '_' . date('Y-m-d') . '.pdf';
        }

        return LOKASI_ARSIP . $berkas_pdf;
    }

    public function lampiranFile(): string
    {
        $nama_surat = pathinfo($this->nama_surat, PATHINFO_FILENAME);

        if ($nama_surat !== '' && $nama_surat !== '0') {
            $berkas_lampiran = $nama_surat . '_lampiran.pdf';
        } else {
            $berkas_lampiran = $this->formatSurat->url_surat . '_' . $this->penduduk->nik . '_' . date('Y-m-d') . '._lampiran.pdf';
        }

        return LOKASI_ARSIP . $berkas_lampiran;
    }

    public function arsipKeluar()
    {
        return $this->hasOne(SuratKeluar::class, 'arsip_id');
    }

    public function scopeMasuk($query, $isAdmin, array $listJabatan = [])
    {
        $jabatanId       = $listJabatan['jabatan_id'];
        $jabatanKadesId  = $listJabatan['jabatan_kades_id'];
        $jabatanSekdesId = $listJabatan['jabatan_sekdes_id'];
        // KUSTOM verifikasi kadus
        $dusunKadus = in_array($jabatanId, [$jabatanKadesId, $jabatanSekdesId]) ? [] : self::dusunKadus($isAdmin);
        if ($dusunKadus !== []) {
            return $query->where('verifikasi_kadus', '=', '0')->dariDusun($dusunKadus);
        }

        return $query
            ->when($jabatanId == $jabatanKadesId, static fn ($q) => $q->when(setting('tte') == 1, static fn ($tte) => $tte->where(static fn ($r) => $r->where('verifikasi_kades', '=', 0)->orWhere('tte', '=', 0)))
                ->when(setting('tte') == 0, static fn ($tte) => $tte->where('verifikasi_kades', '=', '0')))
            ->when($jabatanId == $jabatanSekdesId, static fn ($q) => $q->where('verifikasi_sekdes', '=', '0'))
            ->when($isAdmin == null || ! in_array($jabatanId, [$jabatanKadesId, $jabatanSekdesId]), static fn ($q) => $q->where('verifikasi_operator', '=', '0'));
    }

    public function scopeArsip($query, $isAdmin, array $listJabatan = [])
    {
        $jabatanId       = $listJabatan['jabatan_id'];
        $jabatanKadesId  = $listJabatan['jabatan_kades_id'];
        $jabatanSekdesId = $listJabatan['jabatan_sekdes_id'];
        // KUSTOM verifikasi kadus
        $dusunKadus = in_array($jabatanId, [$jabatanKadesId, $jabatanSekdesId]) ? [] : self::dusunKadus($isAdmin);
        if ($dusunKadus !== []) {
            return $query->where('verifikasi_kadus', '=', '1')->dariDusun($dusunKadus);
        }

        return $query->when($jabatanId == $jabatanKadesId, static fn ($q) => $q->when(setting('tte') == 1, static fn ($tte) => $tte->where('verifikasi_kades', '=', '1'))
            ->when(setting('tte') == 0, static fn ($tte) => $tte->where('verifikasi_kades', '=', '1'))
            ->orWhere(static function ($verifikasi): void {
                $verifikasi->whereNull('verifikasi_operator');
            }))
            ->when($jabatanId == $jabatanSekdesId, static fn ($q) => $q->where('verifikasi_sekdes', '=', '1')->orWhereNull('verifikasi_operator'))
            ->when($isAdmin == null || ! in_array($jabatanId, [$jabatanKadesId, $jabatanSekdesId]), static fn ($q) => $q->where('verifikasi_operator', '=', '1')->orWhereNull('verifikasi_operator'));
    }

    /**
     * KUSTOM verifikasi kadus: buat kolom log_surat.verifikasi_kadus dan
     * pengaturan verifikasi_kadus jika belum ada.
     */
    public static function pastikanSkemaKadus(): void
    {
        if (! Schema::hasColumn('log_surat', 'verifikasi_kadus')) {
            Schema::table('log_surat', static function ($table): void {
                $table->tinyInteger('verifikasi_kadus')->nullable()->after('verifikasi_sekdes');
            });
        }

        if (! SettingAplikasi::where('key', 'verifikasi_kadus')->exists()) {
            $sekdes = SettingAplikasi::where('key', 'verifikasi_sekdes')->first();
            if ($sekdes) {
                $kadus             = $sekdes->replicate();
                $kadus->key        = 'verifikasi_kadus';
                $kadus->judul      = 'Verifikasi Kepala Dusun';
                $kadus->keterangan = 'Aktifkan verifikasi surat oleh Kepala Dusun sesuai dusun pemohon';
                $kadus->value      = 0;
                $kadus->save();
                (new SettingAplikasi())->flushQueryCache();
            }
        }
    }

    /**
     * KUSTOM verifikasi kadus: nama dusun yang dikepalai pamong ini.
     * Kosong jika pengaturan nonaktif atau pamong bukan kepala dusun.
     */
    public static function dusunKadus($pamong): array
    {
        if (! setting('verifikasi_kadus') || ! $pamong || ! $pamong->id_pend) {
            return [];
        }

        return Wilayah::dusun()->where('id_kepala', $pamong->id_pend)->pluck('dusun')->all();
    }

    /**
     * KUSTOM verifikasi kadus: akun pengguna aktif kepala dusun pemohon surat.
     */
    public static function penggunaKadus($idPend)
    {
        if (! setting('verifikasi_kadus') || ! $idPend) {
            return collect();
        }

        $idCluster = DB::table('tweb_penduduk')->where('id', $idPend)->value('id_cluster');
        $dusun     = $idCluster ? Wilayah::where('id', $idCluster)->value('dusun') : null;
        $idKepala  = $dusun ? Wilayah::dusun()->where('dusun', $dusun)->value('id_kepala') : null;

        if (! $idKepala) {
            return collect();
        }

        return User::where('active', 1)
            ->whereHas('pamong', static fn ($q) => $q->where('id_pend', $idKepala)->whereNotIn('jabatan_id', [kades()->id, sekdes()->id]))
            ->get();
    }

    public function scopeDariDusun($query, array $dusun)
    {
        $idCluster = Wilayah::whereIn('dusun', $dusun)->pluck('id')->all();

        return $query->whereIn('log_surat.id_pend', static fn ($q) => $q->select('id')->from('tweb_penduduk')->whereIn('id_cluster', $idCluster));
    }

    /**
     * KUSTOM verifikasi kadus: dusun yang dikepalai pengguna yang sedang login (kosong jika bukan kadus).
     */
    public static function dusunKadusLogin(): array
    {
        $pamong = get_instance()->session->isAdmin->pamong ?? null;
        if (! $pamong || in_array($pamong->jabatan_id, [kades()->id, sekdes()->id])) {
            return [];
        }

        return self::dusunKadus($pamong);
    }

    /**
     * KUSTOM verifikasi kadus: nama dusun tempat penduduk tercatat.
     */
    public static function dusunPenduduk($idPend): ?string
    {
        $idCluster = $idPend ? DB::table('tweb_penduduk')->where('id', $idPend)->value('id_cluster') : null;

        return $idCluster ? Wilayah::where('id', $idCluster)->value('dusun') : null;
    }

    /**
     * KUSTOM verifikasi kadus: jika surat dibuat oleh Kepala Dusun pemohon (pemeriksa kelengkapan),
     * tahap operator dan kadus dianggap selesai sehingga surat langsung ke Sekdes/Kades.
     */
    public static function isianVerifikasiOlehKadus($idPend): array
    {
        if (! setting('verifikasi_kadus')) {
            return [];
        }

        // Surat yang dibuat langsung oleh Kades/Sekdes juga melewati tahap operator & kadus
        $pamong     = get_instance()->session->isAdmin->pamong ?? null;
        $olehSekdes = $pamong && $pamong->jabatan_id == sekdes()->id;
        $olehKades  = $pamong && $pamong->jabatan_id == kades()->id;

        if (! $olehSekdes && ! $olehKades) {
            $dusunKadus = self::dusunKadusLogin();
            if ($dusunKadus === [] || ! in_array(self::dusunPenduduk($idPend), $dusunKadus)) {
                return [];
            }
        }

        $isian = ['verifikasi_operator' => self::TERIMA, 'verifikasi_kadus' => 1];
        if (setting('verifikasi_sekdes') && ! $olehSekdes) {
            $isian['verifikasi_sekdes'] = 0;
            $isian['log_verifikasi']    = 'Verifikasi ' . setting('sebutan_sekretaris_desa');
        } elseif (setting('verifikasi_kades')) {
            if ($olehSekdes && setting('verifikasi_sekdes')) {
                $isian['verifikasi_sekdes'] = 1;
            }
            $isian['verifikasi_kades'] = 0;
            $isian['log_verifikasi']   = 'Verifikasi ' . setting('sebutan_kepala_desa');
        }

        return $isian;
    }

    /**
     * KUSTOM verifikasi kadus: subquery id penduduk yang tinggal di dusun tertentu.
     */
    public static function idPendudukDusun(array $dusun): \Closure
    {
        $idCluster = Wilayah::whereIn('dusun', $dusun)->pluck('id')->all();

        return static fn ($q) => $q->select('id')->from('tweb_penduduk')->whereIn('id_cluster', $idCluster);
    }

    public function scopeDitolak($query)
    {
        return $query->where('verifikasi_operator', '=', '-1');
    }

    /**
     * Cek apakah surat sudah melewati seluruh tahap verifikasi
     * (operator/kadus -> sekdes -> kades -> TTE sesuai pengaturan),
     * sehingga PDF boleh diunduh oleh pemohon di layanan mandiri.
     */
    public function sudahDisetujui(): bool
    {
        if ($this->deleted_at !== null || $this->verifikasi_operator == self::TOLAK) {
            return false;
        }

        // Surat lama sebelum fitur verifikasi berjenjang
        if ($this->verifikasi_operator === null) {
            return true;
        }

        if (setting('verifikasi_kades')) {
            $disetujui = $this->verifikasi_kades == self::TERIMA;
        } elseif (setting('verifikasi_sekdes')) {
            $disetujui = $this->verifikasi_sekdes == self::TERIMA;
        } elseif (setting('verifikasi_kadus') && $this->verifikasi_kadus !== null) {
            // KUSTOM verifikasi kadus
            $disetujui = $this->verifikasi_kadus == self::TERIMA;
        } else {
            $disetujui = $this->verifikasi_operator == self::TERIMA;
        }

        // Jika TTE aktif dan surat masih menunggu TTE, tunggu sampai ditandatangani
        if ($disetujui && setting('tte') && $this->tte !== null && $this->tte != 1) {
            return false;
        }

        return $disetujui;
    }

    public function logPerubahanSurat()
    {
        return $this->hasMany(LogPerubahanSurat::class, 'log_surat_id');
    }

    public function getKeteranganAttribute()
    {
        $input = json_decode((string) ($this->attributes['input'] ?? null), true);

        return $input['keperluan'] ?? $input['keterangan'] ?? null;
    }
}
