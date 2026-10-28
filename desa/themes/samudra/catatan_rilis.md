Catatan Rilis Samudra v2.2.1 :

1. Kartu "Kantor Desa" di banner tidak lagi miring dan bergeser mengikuti kursor. Saat miring, Chrome melepas efek blur kacanya
   sehingga kartu tampak pudar. Kini kartu selalu diam dengan latar kaca biru yang sama.
2. .htaccess utama OpenSID menyuruh browser menyimpan file CSS selama setahun, sehingga isi baru
   desa/pengaturan/siteman/siteman_mandiri.css tidak terlihat di browser yang pernah membuka halaman masuk.
   Tambahkan file desa/pengaturan/siteman/.htaccess berisi baris berikut agar browser selalu mengecek ulang CSS di folder itu:

    <IfModule mod_expires.c>
        ExpiresActive Off
    </IfModule>
    <IfModule mod_headers.c>
        <FilesMatch "\.css$">
            Header set Cache-Control "no-cache"
            Header unset Expires
        </FilesMatch>
    </IfModule>

   Browser yang sudah terlanjur menyimpan file lama perlu sekali Ctrl+F5 di halaman masuk Layanan Mandiri.

Catatan Rilis Samudra v2.2.0 :

1. Halaman masuk Layanan Mandiri (masuk, masuk e-KTP, lupa PIN, daftar, verifikasi) ikut bergaya Samudra: latar biru di atas foto latar login, kartu putih membulat, panel identitas desa bergradasi biru, isian dengan ikon, dan tombol biru.
2. Gayanya ada di assets/css/mandiri-masuk.css. OpenSID membaca file ubahan resmi desa/pengaturan/siteman/siteman_mandiri.css,
   jadi isi mandiri-masuk.css disalin ke file itu. File di folder desa aman saat OpenSID diperbarui.
   Untuk kembali ke tampilan bawaan, hapus atau kosongkan desa/pengaturan/siteman/siteman_mandiri.css.

Catatan Rilis Samudra v2.1.0 :

1. Layanan Mandiri ikut bergaya Samudra: navbar biru tua, pita biru di atas, pintasan berupa kartu kaca, kartu putih membulat, menu samping yang rapi, tabel, formulir, tombol, dan jendela modal dengan palet biru-putih.
2. Gaya ada di tema (assets/css/mandiri.css dan resources/views/partials/layanan_mandiri.blade.php), jadi ikut terbawa saat tema diperbarui.
3. Halaman Layanan Mandiri milik inti OpenSID, sehingga perlu satu tambahan kecil di
   resources/views/layanan_mandiri/layouts/index.blade.php, tepat sebelum </head>:

    @php
        try {
            theme_active();
            if (view()->exists('theme::partials.layanan_mandiri')) {
                echo view('theme::partials.layanan_mandiri')->render();
            }
        } catch (\Throwable $e) {
        }
    @endphp

   Tambahan ini hilang bila OpenSID diperbarui; pasang ulang agar Layanan Mandiri kembali bergaya Samudra.
   Bila tema lain yang aktif, tambahan ini tidak berpengaruh dan tampilan bawaan dipakai.

Catatan Rilis Samudra v2.0.x :

1. Beranda bergaya glassmorphism (banner foto, kartu kaca, bilah statistik, dll.).
2. Peralihan foto banner ke halaman dihaluskan dan lapisan biru di atas foto tetap ada setelah animasi.

Catatan Rilis Samudra v1.0.0 :

1. Rilis pertama tema Samudra: tampilan modern bernuansa biru-putih.
2. Header lengket (sticky) dengan menu multi-tingkat, menu laci (drawer) untuk ponsel, dan panel pencarian.
3. Banner sambutan, pintasan layanan, dan teks berjalan di beranda.
4. Artikel tampil sebagai kartu (grid) yang responsif, widget bergaya kartu.
5. Footer baru berisi identitas, kontak, tautan, dan media sosial.
6. Pengaturan tema: warna utama, banner, teks sambutan, pintasan, dan layar memuat.
7. Halaman-halaman data (statistik, peta, produk hukum, dll.) memakai dasar tema Esensi v2601.0.0 dengan warna biru.
