Catatan Rilis Samudra v2.3.6 :

1. Panel "Pencarian Cepat" di beranda kini kaca buram gelap seperti kartu Layanan. Panel ini dipindah ke dalam bagian
   Layanan sehingga seluruhnya berada di atas foto gelap (sebelumnya separuh bawahnya menempel di latar putih halaman
   sehingga tampak seperti kartu putih polos). Kolom isian tetap terang agar mudah dibaca.
   Bila bagian Layanan dimatikan di pengaturan tema, panel tetap kaca terang di atas latar halaman seperti biasa.

Catatan Rilis Samudra v2.3.5 :

1. Efek kaca buram (glassmorphism) kembali, tanpa garis. Kaca di atas foto kini diburamkan dengan cara lain: di balik kaca
   dipasang salinan foto di belakangnya yang diburamkan, lalu digeser agar segaris dengan foto aslinya. Cara ini tidak
   memakai backdrop-filter, jadi garis tegak, garis hitam, dan undakan warna di Chrome Windows tidak muncul lagi.
   Berlaku untuk navbar di atas banner, kartu Kantor Desa, bilah statistik, label sambutan, tombol Lihat Data,
   kartu berita bergambar, kartu Layanan di bagian gelap, kotak pencarian, dan tombol aspirasi.
2. Kartu, ticker, dan tombol kaca di atas latar halaman kembali tembus pandang seperti sebelum v2.3.4.

Catatan Rilis Samudra v2.3.4 :

1. Seluruh efek blur kaca (backdrop-filter) dihapus dari tema. Di Chrome Windows dengan zoom browser bukan 100%, efek itu
   memunculkan garis tegak tipis di navbar (misalnya saat kursor dibawa ke tombol Back/Refresh browser), garis hitam, dan
   undakan warna. Kesan kaca kini dibuat dengan latar biru/putih semi-transparan, termasuk navbar di atas banner,
   kartu Kantor Desa, bilah statistik, tombol, dan kartu-kartu lain. Layanan Mandiri memang tidak memakai efek ini.

Catatan Rilis Samudra v2.3.3 :

1. Tombol kembali ke atas kini bulat penuh, dan cincin progres gulirnya digambar di dalam tepi tombol dengan pusat yang sama,
   jadi bentuk tombol dan cincinnya selalu identik (sebelumnya tombol persegi membulat dengan cincin bulat di luarnya).

Catatan Rilis Samudra v2.3.2 :

1. Pindah halaman di Layanan Mandiri (mis. Permohonan Surat ke Arsip Surat) kini tenang:
   - animasi masuk kotak hanya diputar saat pertama masuk, tidak setiap pindah menu;
   - di ponsel dan tablet halaman baru langsung tampil di posisi isinya, tidak terlihat mulai dari atas lalu melompat;
   - tabel yang sebelumnya tampil sebagai kartu langsung tampil sebagai kartu lagi selagi datanya dimuat.

Catatan Rilis Samudra v2.3.1 :

1. Di ponsel dan tablet, menu samping Layanan Mandiri berada di atas isi halaman. Setelah membuka menu atau tautan
   (mis. Arsip Surat), halaman baru kini langsung menampilkan isinya, tidak kembali ke paling atas.
   Muat ulang, tombol Kembali, dan membuka alamat langsung tetap berperilaku biasa. Di layar lebar tidak ada perubahan.
2. Halaman Layanan Mandiri sudah bisa digulir selagi masih memuat (sebelumnya terkunci sampai semua gambar selesai dimuat).

Catatan Rilis Samudra v2.3.0 :

1. Tabel Layanan Mandiri yang berkolom banyak (Permohonan Surat, Arsip Surat, Pesan, Dokumen, Bantuan, Produk, Kehadiran)
   tidak lagi terpotong. Di ponsel, atau bila tabel tidak muat di kotaknya, setiap baris tampil sebagai kartu:
   jenis surat di atas, rincian berlabel (No Antrean, Tanggal, dll.) di tengah, tombol status dan aksi di bawah.
   Bila tabel muat, tampilannya tetap tabel biasa.
2. Perubahan hanya di tema (assets/css/mandiri.css dan resources/views/partials/layanan_mandiri.blade.php).

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
