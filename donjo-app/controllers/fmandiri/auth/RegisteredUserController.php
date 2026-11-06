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

use App\Models\Penduduk;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Web_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (! setting('tampilkan_pendaftaran')) {
            show_404();
        }

        if (auth('penduduk')->check()) {
            redirect('layanan-mandiri/beranda');
        }
    }

    /**
     * Display the registration view.
     */
    public function create()
    {
        return view('layanan_mandiri.auth.register', [
            'header'              => $this->header,
            'latar_login_mandiri' => (new App\Models\Theme())->latarLoginMandiri(),
            'form_action'         => site_url('layanan-mandiri/proses-daftar'),
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws Illuminate\Validation\ValidationException
     */
    public function store()
    {
        // KUSTOM pendaftaran-mandiri: warga mendaftar dengan password (bukan PIN 6 angka),
        // email & Telegram tidak wajib, tanpa verifikasi email/Telegram.
        // Akun dibuat nonaktif dan baru bisa dipakai setelah diverifikasi admin
        // (menu Layanan Mandiri > Pendaftar Layanan Mandiri).
        $request = request();

        // Tanggal lahir diisi warga dengan format DD-MM-YYYY (boleh pakai / atau .)
        $tgl = str_replace(['/', '.'], '-', trim((string) $request->input('tanggallahir')));
        $request->merge(['tanggallahir' => $tgl]);

        $data = $this->validated($request, [
            'nama'         => ['required'],
            'tanggallahir' => ['required', 'date_format:d-m-Y', 'before_or_equal:today'],
            'nik'          => ['required', 'digits:16', 'regex:/^\d{16}$/'],
            'no_kk'        => ['required', 'digits:16', 'regex:/^\d{16}$/'],
            'telepon'      => ['nullable', 'regex:/^[0-9+]{8,20}$/'],
            'email'        => ['nullable', 'email'],
            'telegram'     => ['nullable', 'regex:/^[0-9]{1,20}$/'],
            'password'     => ['required', 'string', 'min:6', 'max:50', 'confirmed'],
            'scan_1'       => 'required|image|mimes:gif,jpeg,jpg,png|max:4096',
            'scan_2'       => 'required|image|mimes:gif,jpeg,jpg,png|max:4096',
            'scan_3'       => 'required|image|mimes:gif,jpeg,jpg,png|max:4096',
        ], [
            'password.min'       => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sama.',
            'scan_1.max'         => 'Ukuran foto KTP maksimal 4 MB.',
            'scan_2.max'         => 'Ukuran foto KK maksimal 4 MB.',
            'scan_3.max'         => 'Ukuran foto selfie maksimal 4 MB.',
            'telepon.regex'      => 'Nomor HP hanya boleh berisi angka.',
            'tanggallahir.date_format'     => 'Tanggal lahir harus berformat DD-MM-YYYY, contoh 17-08-1985.',
            'tanggallahir.before_or_equal' => 'Tanggal lahir tidak boleh melewati hari ini.',
        ]);

        // Hanya penduduk hidup yang sudah ada di database: NIK, No. KK, nama, dan tanggal lahir harus cocok
        $penduduk = Penduduk::query()
            ->whereRelation('keluarga', 'no_kk', $data['no_kk'])
            ->where('nik', $data['nik'])
            ->where('tanggallahir', DateTime::createFromFormat('!d-m-Y', $data['tanggallahir'])->format('Y-m-d'))
            ->whereRaw('TRIM(nama) = ?', [trim(preg_replace('/\s+/', ' ', $data['nama']))])
            ->where('status_dasar', 1)
            ->first();

        if (! $penduduk) {
            $this->session->set_flashdata('notif', 'Pendaftaran tidak dapat diproses. Data Anda tidak ditemukan di data penduduk desa. Pastikan NIK, Nomor KK, nama (sesuai KTP), dan tanggal lahir sudah benar, atau hubungi operator desa.');
            $this->withInput();

            return redirect('layanan-mandiri/daftar');
        }

        // Sudah pernah mendaftar / sudah punya akun
        if (null !== $mandiri = $penduduk->mandiri()->first()) {
            if (! $mandiri->aktif) {
                return redirect_with('information', 'Anda sudah mendaftar. Akun Anda sedang diperiksa oleh operator desa. Silakan tunggu sampai akun diaktifkan.', 'layanan-mandiri/masuk');
            }

            return redirect_with('information', 'NIK ini sudah memiliki akun Layanan Mandiri. Silakan masuk, atau gunakan Lupa Password / hubungi operator desa.', 'layanan-mandiri/masuk');
        }

        // Simpan kontak bila diisi (email/Telegram yang sudah terverifikasi tidak ditimpa)
        if (! empty($data['email']) && null === $penduduk->email_tgl_verifikasi) {
            if (Penduduk::where('email', $data['email'])->where('id', '!=', $penduduk->id)->exists()) {
                $this->session->set_flashdata('notif', 'Email tersebut sudah dipakai penduduk lain. Gunakan email lain atau kosongkan.');
                $this->withInput();

                return redirect('layanan-mandiri/daftar');
            }
            $penduduk->email = $data['email'];
        }
        if (! empty($data['telegram']) && null === $penduduk->telegram_tgl_verifikasi) {
            $penduduk->telegram = $data['telegram'];
        }
        if (! empty($data['telepon'])) {
            $penduduk->telepon = $data['telepon'];
        }
        $penduduk->save();

        $filePaths = [
            'scan_ktp'    => $request->file('scan_1')->store('upload/pendaftaran', 'desa'),
            'scan_kk'     => $request->file('scan_2')->store('upload/pendaftaran', 'desa'),
            'foto_selfie' => $request->file('scan_3')->store('upload/pendaftaran', 'desa'),
        ];

        // Akun nonaktif, menunggu verifikasi admin. ganti_pin = 0 karena password dibuat sendiri oleh warga.
        $penduduk->mandiri()->create([
            'aktif'       => 0,
            'scan_ktp'    => basename($filePaths['scan_ktp']),
            'scan_kk'     => basename($filePaths['scan_kk']),
            'foto_selfie' => basename($filePaths['foto_selfie']),
            'ganti_pin'   => 0,
            'pin'         => Hash::make($data['password']),
        ]);

        return redirect_with('success', 'Pendaftaran berhasil dikirim. Operator desa akan memeriksa data Anda. Setelah akun diaktifkan, masuk dengan NIK dan password yang Anda buat.', 'layanan-mandiri/masuk');
    }
}
