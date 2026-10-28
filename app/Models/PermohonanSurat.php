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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

defined('BASEPATH') || exit('No direct script access allowed');

class PermohonanSurat extends BaseModel
{
    use ConfigId;

    public const BELUM_LENGKAP         = 0;
    public const SEDANG_DIPERIKSA      = 1;
    public const MENUNGGU_TANDA_TANGAN = 2;
    public const SIAP_DIAMBIL          = 3;
    public const SUDAH_DIAMBIL         = 4;
    public const DIBATALKAN            = 5;
    public const STATUS_PERMOHONAN     = [
        self::BELUM_LENGKAP         => 'Belum Lengkap',
        self::SEDANG_DIPERIKSA      => 'Sedang Diperiksa',
        self::MENUNGGU_TANDA_TANGAN => 'Menunggu Tandatangan',
        self::SIAP_DIAMBIL          => 'Siap Diambil',
        self::SUDAH_DIAMBIL         => 'Sudah Diambil',
        self::DIBATALKAN            => 'Dibatalkan',
    ];

    /**
     * {@inheritDoc}
     */
    protected $table = 'permohonan_surat';

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'id_pemohon',
        'id_surat',
        'isian_form',
        'alasan',
        'keterangan',
        'status',
        'no_hp_aktif',
        'syarat',
        'alasan',
    ];

    /**
     * {@inheritDoc}
     */
    protected $casts = [
        'isian_form' => 'json',
        'syarat'     => 'json',
    ];

    /**
     * {@inheritDoc}
     */
    protected $appends = ['kodeStatusPermohonan'];

    /**
     * {@inheritDoc}
     */
    protected $with = ['surat', 'penduduk'];

    // Notifikasi pada layanan mandiri, ditampilkan jika ada surat belum lengkap (0) atau surat siap diambil (3)
    public static function notifikasi($id = '')
    {
        return self::where('id_pemohon', $id)
            ->whereIn('status', [self::BELUM_LENGKAP, self::SIAP_DIAMBIL])
            ->count();
    }

    /**
     * Getter untuk mapping status permohonan.
     *
     * @return string
     */
    public function getStatusPermohonanAttribute()
    {
        return static::STATUS_PERMOHONAN[$this->status];
    }

    /**
     * Getter untuk kode status permohonan.
     *
     * @return string
     */
    public function getKodeStatusPermohonanAttribute()
    {
        // Mengembalikan id model saat ini secara spesifik, meskipun ada relasi model lain
        return $this->getAttribute('status');
    }

    /**
     * Getter untuk mapping syartsurat permohonan.
     *
     * @return string
     */
    public function getSyaratSuratAttribute()
    {
        if ($this->syarat == null) {
            return null;
        }

        $dokumen = Dokumen::where('id_pend', $this->id_pemohon)->whereIn('id', $this->syarat)->get();

        return $dokumen->map(static function ($syarat) {
            $syarat->nama_syarat = $syarat->jenisDokumen->ref_syarat_nama;

            return $syarat;
        });
    }

    /**
     * Scope query untuk pengguna.
     *
     * @param Builder $query
     */
    public function scopePengguna($query): void
    {
        // return $query->where('id_pemohon', auth('jwt')->user()->penduduk->id);
    }

    /**
     * Scope query untuk status.
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeStatus($query, string $status = '')
    {
        if ($status == '') {
            return $query;
        }

        return $query->where($this->getTable() . '.status', $status);
    }

    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class, 'id_pemohon');
    }

    public function surat()
    {
        return $this->belongsTo(FormatSurat::class, 'id_surat')->withoutGlobalScope(\App\Scopes\RemoveRtfScope::class);
    }

    public function scopeBelumDiambil($query)
    {
        return $query->where('status', '!=', self::SUDAH_DIAMBIL);
    }

    public function scopeBaru($query)
    {
        return $query->where('status', self::SEDANG_DIPERIKSA);
    }

    /**
     * Scope query untuk membatasi permohonan surat hanya milik penduduk tertentu.
     *
     * @param Builder $query
     */
    public function scopeMilikPenduduk($query, int $idPemohon)
    {
        return $query->where('id_pemohon', $idPemohon);
    }

    /**
     * Get all of the logSurat for the PermohonanSurat
     */
    public function logSurat(): HasMany
    {
        return $this->hasMany(LogSurat::class, 'id_format_surat', 'id_surat')->withoutGlobalScope(\App\Scopes\RemoveRtfScope::class);
    }

    public function mapSyaratSurat()
    {
        return collect($this->syarat)->map(static function ($item, $key): array {
            $syaratSurat        = SyaratSurat::select(['ref_syarat_nama'])->find($key);
            $dokumenKelengkapan = Dokumen::select(['nama'])->find($item);

            return [
                'ref_syarat_id'   => $key,
                'ref_syarat_nama' => $syaratSurat->ref_syarat_nama,
                'dok_id'          => $item,
                'dok_nama'        => ($item == '-1') ? 'Bawa bukti fisik ke Kantor Desa' : $dokumenKelengkapan->nama,
            ];
        })->values();
    }

    /**
     * Ambil arsip surat (log_surat) yang dibuat dari permohonan ini.
     * Relasi permohonan -> log_surat dicocokkan dengan jenis surat, pemohon dan nomor surat
     * (sama seperti yang digunakan pada proses verifikasi di Keluar).
     */
    public function logSuratTerkait(): ?LogSurat
    {
        $nomor = $this->isian_form['nomor'] ?? null;

        if ($nomor === null || $nomor === '') {
            return null;
        }

        return LogSurat::withoutGlobalScope(\App\Scopes\RemoveRtfScope::class)
            ->where('id_format_surat', $this->id_surat)
            ->where('id_pend', $this->id_pemohon)
            ->where('no_surat', $nomor)
            ->whereNull('deleted_at')
            ->latest('id')
            ->first();
    }

    /**
     * Label tahapan persetujuan untuk ditampilkan ke warga:
     * Warga (creator) -> Kepala Dusun (checker) -> Kepala Desa/Perbekel (approval).
     */
    public function tahapPersetujuan(?LogSurat $logSurat = null): string
    {
        if (! setting('verifikasi_kades')) {
            return $this->statusPermohonan;
        }

        $checker  = 'Kepala ' . ucwords(setting('sebutan_dusun') ?: 'Dusun');
        $approval = ucwords(setting('sebutan_kepala_desa') ?: 'Kepala Desa');

        switch ((int) $this->status) {
            case self::SEDANG_DIPERIKSA:
                return 'Menunggu Persetujuan ' . $checker;

            case self::MENUNGGU_TANDA_TANGAN:
                // KUSTOM verifikasi kadus: surat masih menunggu persetujuan Kepala Dusun di Arsip Layanan
                if ($logSurat && $logSurat->verifikasi_kadus !== null && (int) $logSurat->verifikasi_kadus === 0) {
                    return 'Menunggu Persetujuan ' . $checker;
                }
                if ($logSurat && $logSurat->verifikasi_operator == LogSurat::TERIMA) {
                    return 'Menunggu Persetujuan ' . $approval;
                }

                return 'Diperiksa ' . $checker;

            case self::SIAP_DIAMBIL:
                return 'Disetujui ' . $approval;

            default:
                return $this->statusPermohonan;
        }
    }

    public function proses($status): void
    {
        if ($status == PermohonanSurat::BELUM_LENGKAP) {
            // Belum Lengkap
            $this->where('status', PermohonanSurat::SEDANG_DIPERIKSA);
        } elseif ($status == PermohonanSurat::DIBATALKAN) {
            // Batalkan hanya jika status = 0 (belum lengkap) atau 1 (sedang diproses)
            $this->where_in('status', [PermohonanSurat::BELUM_LENGKAP, PermohonanSurat::SEDANG_DIPERIKSA]);
        } else {
            // Lainnya
            $this->where('status', ($status - 1));
        }

        $this->update(['status' => $status]);
    }
}
