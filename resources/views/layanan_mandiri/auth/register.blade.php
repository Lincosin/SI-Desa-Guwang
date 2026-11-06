@extends('layanan_mandiri.auth.index')

{{-- KUSTOM pendaftaran-mandiri: formulir daftar akun Layanan Mandiri dengan password,
     tanpa email/Telegram wajib. Data dicocokkan dengan data penduduk, lalu diverifikasi admin. --}}
@section('content')
    <form id="validasi" action="<?= $form_action ?>" method="post" class="login-form smd-form-daftar" enctype="multipart/form-data" autocomplete="off">
        <h3 class="smd-daftar__judul"><strong>Daftar Akun Layanan Mandiri</strong></h3>
        <p class="smd-daftar__petunjuk">Khusus warga yang sudah terdata di desa. Isi sesuai KTP dan Kartu Keluarga. Akun aktif setelah diperiksa operator desa.</p>

        <div class="form-group form-login">
            <input type="text" inputmode="numeric" class="form-control angka required" name="nik" placeholder="NIK (16 angka)" minlength="16" maxlength="16" value="{{ old('nik') }}">
        </div>
        <div class="form-group form-login">
            <input type="text" inputmode="numeric" class="form-control angka required" name="no_kk" placeholder="Nomor Kartu Keluarga (16 angka)" minlength="16" maxlength="16" value="{{ old('no_kk') }}">
        </div>
        <div class="form-group form-login">
            <input type="text" class="form-control required" name="nama" placeholder="Nama lengkap sesuai KTP" maxlength="100" value="{{ old('nama') }}">
        </div>
        <div class="form-group form-login smd-tgl">
            <input type="text" class="form-control required" id="daftar_tgl_lahir" name="tanggallahir" placeholder="Tanggal lahir (DD-MM-YYYY)" maxlength="10" autocomplete="off" value="{{ old('tanggallahir') }}">
        </div>
        <div class="form-group form-login">
            <input type="tel" inputmode="numeric" class="form-control" name="telepon" placeholder="Nomor HP / WhatsApp (tidak wajib)" maxlength="20" value="{{ old('telepon') }}">
        </div>
        <div class="form-group form-login">
            <input type="email" class="form-control email" name="email" placeholder="Email (tidak wajib, untuk lupa password)" maxlength="100" value="{{ old('email') }}">
        </div>
        <div class="form-group form-login">
            <input type="password" class="form-control pin required" name="password" id="daftar_password" placeholder="Buat password (min. 6 karakter)" minlength="6" maxlength="50" autocomplete="new-password">
        </div>
        <div class="form-group form-login">
            <input type="password" class="form-control pin required" name="password_confirmation" id="daftar_password2" placeholder="Ketik ulang password" minlength="6" maxlength="50" autocomplete="new-password">
        </div>
        <div class="form-group">
            <center><input type="checkbox" id="tampil_password" style="display: initial;"> <label for="tampil_password">Tampilkan Password</label></center>
        </div>

        <div class="smd-unggah">
            <div class="form-group">
                <label class="smd-daftar__label" for="scan_1">Foto KTP</label>
                <input type="file" id="scan_1" name="scan_1" class="form-control required smd-foto" accept=".jpg,.jpeg,.png,.gif">
            </div>
            <div class="form-group">
                <label class="smd-daftar__label" for="scan_2">Foto Kartu Keluarga</label>
                <input type="file" id="scan_2" name="scan_2" class="form-control required smd-foto" accept=".jpg,.jpeg,.png,.gif">
            </div>
            <div class="form-group">
                <label class="smd-daftar__label" for="scan_3">Foto selfie sambil memegang KTP</label>
                <input type="file" id="scan_3" name="scan_3" class="form-control required smd-foto" accept=".jpg,.jpeg,.png,.gif">
            </div>
            <small class="smd-daftar__catatan">Foto JPG/PNG. Foto dari kamera HP otomatis dikecilkan sebelum dikirim.</small>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-block bg-green" id="tombol_daftar"><b>KIRIM PENDAFTARAN</b></button>
        </div>
        <div class="form-group">
            <a href="<?= site_url('layanan-mandiri/masuk') ?>">
                <button type="button" class="btn btn-block bg-green"><b>SUDAH PUNYA AKUN? MASUK</b></button>
            </a>
        </div>
    </form>
@endsection

@push('script')
    <script>
        $('document').ready(function() {
            $('#tampil_password').on('click', function() {
                $('.pin').attr('type', this.checked ? 'text' : 'password');
            });

            setTimeout(function() {
                if ($('#daftar_password2').length && $.fn.rules) {
                    $('#daftar_password2').rules('add', {
                        equalTo: '#daftar_password',
                        messages: { equalTo: 'Password tidak sama' }
                    });
                }
            }, 500);

            // Kecilkan foto dari kamera HP (maks. sisi 1600px, JPEG) agar tidak melebihi batas unggah.
            var BATAS = 4 * 1024 * 1024;
            function kecilkan(input) {
                var file = input.files && input.files[0];
                if (!file || !/^image\/(jpeg|png)$/.test(file.type) || file.size < 700 * 1024 || typeof DataTransfer === 'undefined') {
                    if (file && file.size > BATAS) {
                        alert('Ukuran foto terlalu besar (maks. 4 MB). Silakan pilih foto lain.');
                        input.value = '';
                    }
                    return;
                }
                var url = URL.createObjectURL(file);
                var img = new Image();
                img.onload = function() {
                    var maks = 1600, w = img.naturalWidth, h = img.naturalHeight;
                    var skala = Math.min(1, maks / Math.max(w, h));
                    var c = document.createElement('canvas');
                    c.width = Math.round(w * skala);
                    c.height = Math.round(h * skala);
                    c.getContext('2d').drawImage(img, 0, 0, c.width, c.height);
                    URL.revokeObjectURL(url);
                    c.toBlob(function(blob) {
                        if (!blob) return;
                        var nama = file.name.replace(/\.[^.]+$/, '') + '.jpg';
                        var dt = new DataTransfer();
                        dt.items.add(new File([blob], nama, { type: 'image/jpeg' }));
                        input.files = dt.files;
                    }, 'image/jpeg', 0.85);
                };
                img.onerror = function() { URL.revokeObjectURL(url); };
                img.src = url;
            }
            $('.smd-foto').on('change', function() { kecilkan(this); });

            // Tanggal lahir: kalender pilih tanggal (bootstrap-datetimepicker bawaan halaman), tampil DD-MM-YYYY.
            // Klik isian -> kalender terbuka di tampilan tahun, lalu pilih bulan dan tanggal.
            if ($.fn.datetimepicker) {
                $('#daftar_tgl_lahir').datetimepicker({
                    format: 'DD-MM-YYYY',
                    locale: 'id',
                    maxDate: moment().endOf('day'),
                    viewMode: 'years',
                    useCurrent: false,
                    ignoreReadonly: true,
                    widgetPositioning: { horizontal: 'left', vertical: 'bottom' },
                    icons: { previous: 'fa fa-chevron-left', next: 'fa fa-chevron-right' }
                }).on('dp.change', function() {
                    if ($.fn.valid) $(this).valid();
                });
            }
            if ($.validator) {
                $.validator.addMethod('tglDmy', function(v, el) {
                    if (this.optional(el)) return true;
                    var m = /^(\d{2})-(\d{2})-(\d{4})$/.exec(v);
                    if (!m) return false;
                    var d = new Date(+m[3], +m[2] - 1, +m[1]);
                    return d.getFullYear() == +m[3] && d.getMonth() == +m[2] - 1 && d.getDate() == +m[1] && d <= new Date();
                }, 'Isi tanggal lahir dengan format DD-MM-YYYY, contoh 17-08-1985');
                $('#daftar_tgl_lahir').addClass('tglDmy');
            }

            $('#validasi').on('submit', function() {
                if ($(this).valid && !$(this).valid()) return;
                $('#tombol_daftar').prop('disabled', true).find('b').text('MENGIRIM...');
            });
        });
    </script>
@endpush
