Catatan Rilis v2409.3.0 :

### PERBAIKAN :
1. Alat aksesibilitas kini mandiri: CSS, markup, dan JavaScript ada di commons/aksesibilitas.blade.php,
   tidak lagi bergantung pada assets/css/aksesibilitas.css dan assets/js/aksesibilitas.js (berkas itu boleh dihapus).
2. Bilah atas: tombol Kontras, A+, A-, Garis Bawah, dan Reset diganti satu tombol "Aksesibilitas"
   yang membuka panel yang sama dengan tombol mengambang (sama seperti di halaman Layanan Mandiri).
3. Fokus papan ketik kembali ke tombol yang membuka panel. Panel tidak terpasang dua kali bila skrip lama ikut termuat.

Catatan Rilis v2409.2.0 :

### FITUR :
1. Alat Aksesibilitas mengambang di tepi kanan layar (gaya surabaya.go.id), isinya:
   Perbesar Teks, Perkecil Teks (80%-150%), Skala Abu-abu, Kontras Negatif, Garis Bawah Tautan,
   Teks ke Suara (bahasa Indonesia, memakai suara bawaan browser), dan Atur Ulang.
   Pilihan tersimpan di browser warga (localStorage "temaku-a11y") dan dipakai di semua halaman.
2. Dapat dipakai dengan papan ketik: Esc menutup panel, fokus kembali ke tombol, status diumumkan ke pembaca layar.

### PERUBAHAN :
1. Tombol Kontras, A+, A-, Garis Bawah, dan Reset di bilah atas dipindah ke alat aksesibilitas baru.
   Bilah atas kini hanya berisi tombol Mode Gelap/Terang dan tombol darurat.

### TEKNIS :
1. Berkas baru: commons/aksesibilitas.blade.php, assets/css/aksesibilitas.css, assets/js/aksesibilitas.js.
2. template.blade.php: skrip kecil di <head> memasang pilihan sebelum halaman tampil; widget dan skrip dimuat di akhir <body>.
3. Ukuran teks memakai persentase font-size html, jadi hanya teks berukuran rem yang ikut berubah.

Catatan Rilis v2409.1.0 :

### FITUR :
1. Mode gelap / terang. Tombol "Mode Gelap" ada di bilah atas (samping Kontras dan A+/A-).
   - Pertama kali dibuka, tampilan mengikuti pengaturan perangkat (gelap/terang).
   - Setelah tombol ditekan, pilihan disimpan di browser warga (localStorage "temaku-tema").
   - Tombol Reset Tampilan mengembalikannya ke "ikut perangkat".

### TEKNIS :
1. assets/css/dark.css (baru): aturan warna gelap untuk seluruh kelas di app.css dan style.min.css,
   dihasilkan otomatis, ditambah penyesuaian manual di bagian paling bawah berkas.
2. template.blade.php: skrip kecil di <head> memasang class "dark" sebelum CSS dimuat (tanpa kedip).
3. commons/source_css.blade.php: memuat dark.css paling akhir.
4. commons/header.blade.php: tombol dan logika pengganti mode.
5. Bila app.css atau style.min.css dikompilasi ulang, dark.css perlu dibuat ulang.

Catatan Rilis v2409.0.0 :

### BUG : 
1. Perbaikan menu versi mobile.
2. Perbaikan sebutan dusun pada halaman DPT.
3. Perbaikan widget statistik pengunjung.

### TEKNIS :
1. Penyesuaian halaman statis.
2. Penyesuaian halaman 404.
3. Penyesuaian judul halaman statistik.