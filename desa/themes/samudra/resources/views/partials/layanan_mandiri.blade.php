{{--
    Tampilan Layanan Mandiri bergaya Samudra.
    Halaman Layanan Mandiri milik inti OpenSID, jadi berkas ini dipanggil dari
    resources/views/layanan_mandiri/layouts/index.blade.php lewat baris:
        @includeIf('theme::partials.layanan_mandiri')
    Bila OpenSID diperbarui, baris tersebut perlu dipasang ulang (lihat catatan_rilis.md).
--}}
@php
    $smd_versi_mandiri = 'v2.3.2';
    $smd_warna_mandiri = theme_config('warna_utama', '#1d64d8') ?: '#1d64d8';
@endphp
@if (cek_koneksi_internet())
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap">
@endif
<link rel="stylesheet" href="{{ theme_asset('css/mandiri.css', ['themeVersion' => $smd_versi_mandiri]) }}">
<style>
    :root {
        --smd-primary: {{ $smd_warna_mandiri }};
    }
</style>
<script>
    // Tandai menu yang sedang dibuka (navbar, menu samping, dan tab Surat).
    document.addEventListener('DOMContentLoaded', function () {
        var kini = location.href.split(/[?#]/)[0].replace(/\/+$/, '');
        var daftar = document.querySelectorAll('#navbar-collapse a[href], .content .col-md-3 .box-body a[href], .content-wrapper .box-header + .box-body a.btn[href]');
        Array.prototype.forEach.call(daftar, function (a) {
            var tujuan = (a.getAttribute('href') || '').split(/[?#]/)[0].replace(/\/+$/, '');
            if (tujuan && tujuan.indexOf('http') === 0 && tujuan === kini) {
                a.classList.add('smd-aktif');
            }
        });
    });

    // Tabel berkolom banyak tampil sebagai kartu di ponsel, atau bila tabel tidak muat di kotaknya
    // (gayanya di mandiri.css, bagian "Tabel jadi kartu"). Tiap sel diberi label dari judul kolomnya.
    // DataTables mengisi baris belakangan, jadi pelabelan diulang setiap isi halaman berubah.
    (function () {
        var JUDUL = ['jenis surat', 'subjek pesan', 'nama program', 'nama dokumen', 'produk', 'nama'];
        var teks = function (el) { return (el.textContent || '').replace(/\s+/g, ' ').trim(); };

        function labeli() {
            var daftar = document.querySelectorAll('.content-wrapper table.table');
            Array.prototype.forEach.call(daftar, function (tabel, urutan) {
                if (tabel.parentElement.closest('table') || !tabel.tHead || tabel.tHead.rows.length !== 1) return;
                var kepala = Array.prototype.map.call(tabel.tHead.rows[0].cells, teks);
                if (kepala.length < 4) return;
                tabel.classList.add('smd-kartu');

                var kecil = kepala.map(function (k) { return k.toLowerCase(); });
                var iJudul = -1;
                JUDUL.some(function (j) { iJudul = kecil.indexOf(j); return iJudul > -1; });

                var adaBaris = false;
                Array.prototype.forEach.call(tabel.tBodies, function (tbody) {
                    Array.prototype.forEach.call(tbody.rows, function (baris) {
                        if (baris.cells.length !== kepala.length) return;
                        adaBaris = true;
                        var judul = iJudul;
                        if (judul < 0) {
                            // Tanpa judul yang dikenal: pakai kolom teks pertama selain No dan Aksi.
                            for (var k = 0; k < kecil.length; k++) {
                                if (kecil[k] !== 'no' && kecil[k] !== 'aksi' && !baris.cells[k].classList.contains('padat')) { judul = k; break; }
                            }
                        }
                        Array.prototype.forEach.call(baris.cells, function (sel, i) {
                            sel.setAttribute('data-label', kepala[i]);
                            sel.classList.toggle('smd-kartu__no', kecil[i] === 'no');
                            sel.classList.toggle('smd-kartu__aksi', kecil[i] === 'aksi');
                            sel.classList.toggle('smd-kartu__judul', i === judul);
                            sel.classList.toggle('smd-kartu__kosong', !sel.children.length && !teks(sel));
                        });
                    });
                });

                // Selama baris belum datang (DataTables masih memuat), pakai bentuk terakhir di halaman ini
                // supaya tabel tidak berganti bentuk di depan mata saat datanya tiba.
                var kunci = 'smd-kartu:' + location.pathname + ':' + urutan + ':' + (window.innerWidth >= 768 ? Math.round(window.innerWidth / 50) : 0);
                if (!adaBaris) {
                    var lalu = null;
                    try { lalu = sessionStorage.getItem(kunci); } catch (e) {}
                    tabel.classList.toggle('smd-kartu--aktif', window.innerWidth < 768 || lalu === '1');
                    return;
                }

                // Ukur dalam bentuk tabel biasa; jadikan kartu bila layar sempit atau tabel melebihi kotaknya.
                tabel.classList.remove('smd-kartu--aktif');
                var gaya = getComputedStyle(tabel.parentElement);
                var ruang = tabel.parentElement.clientWidth - parseFloat(gaya.paddingLeft) - parseFloat(gaya.paddingRight);
                var sempit = window.innerWidth < 768 || tabel.offsetWidth > ruang + 1;
                tabel.classList.toggle('smd-kartu--aktif', sempit);
                try { sessionStorage.setItem(kunci, sempit ? '1' : '0'); } catch (e) {}
            });
        }

        var tertunda = false;
        function jadwalkan() {
            if (tertunda) return;
            tertunda = true;
            setTimeout(function () { tertunda = false; labeli(); }, 0);
        }

        document.addEventListener('DOMContentLoaded', function () {
            labeli();
            var isi = document.querySelector('.content-wrapper');
            if (isi && window.MutationObserver) {
                new MutationObserver(jadwalkan).observe(isi, { childList: true, subtree: true });
            }
            window.addEventListener('resize', jadwalkan);
        });
    })();

    // Pindah halaman di dalam Layanan Mandiri (mis. Permohonan Surat ke Arsip Surat) dibuat tenang:
    // animasi masuk tidak diputar ulang, dan di layar kecil (menu samping berada di atas isi) halaman baru
    // baru ditampilkan setelah digulir ke isinya, jadi tidak terlihat mulai dari atas lalu melompat.
    (function () {
        var KUNCI = 'smd-ke-isi';
        var tanda = null;
        try {
            tanda = Number(sessionStorage.getItem(KUNCI));
            sessionStorage.removeItem(KUNCI);
        } catch (e) {}

        var catat = function () {
            try { sessionStorage.setItem(KUNCI, String(Date.now())); } catch (e) {}
        };
        document.addEventListener('click', function (e) {
            if (e.defaultPrevented || e.button !== 0 || e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return;
            var a = e.target.closest && e.target.closest('a[href]');
            if (!a || a.target === '_blank' || a.hasAttribute('download') || a.hasAttribute('data-toggle') || a.closest('.modal')) return;
            var href = a.getAttribute('href') || '';
            if (!href || href.charAt(0) === '#' || /^javascript:/i.test(href) || /\/(keluar|pendapat)\b/.test(href)) return;
            if (a.origin !== location.origin) return;
            catat();
        });
        document.addEventListener('submit', function (e) {
            if (!e.defaultPrevented && e.target.target !== '_blank') catat();
        });

        // Hanya untuk halaman yang dibuka dari klik barusan (bukan muat ulang atau tombol Kembali).
        var nav = window.performance && performance.getEntriesByType ? performance.getEntriesByType('navigation')[0] : null;
        if (!tanda || Date.now() - tanda > 10000 || (nav && nav.type !== 'navigate')) return;

        var akar = document.documentElement;
        akar.classList.add('smd-pindah');
        if (window.innerWidth >= 992) return; // menu dan isi berdampingan: isi sudah terlihat
        akar.classList.add('smd-sembunyi');
        var tampilkan = function () { akar.classList.remove('smd-sembunyi'); };
        setTimeout(tampilkan, 1200); // pengaman bila ada yang tidak berjalan

        var disentuh = false;
        ['wheel', 'touchstart', 'keydown', 'mousedown'].forEach(function (n) {
            window.addEventListener(n, function () { disentuh = true; }, { passive: true, once: true });
        });

        // Mengembalikan true bila isi sudah di posisinya (atau tidak perlu digulir).
        function gulir() {
            if (disentuh) return true;
            var menu = document.querySelector('.content .col-md-3');
            var isi = document.querySelector('.content .col-md-9');
            if (!menu || !isi) return false;
            var kotak = isi.getBoundingClientRect();
            // Menu dan isi berdampingan (layar lebar): isi sudah terlihat, tidak perlu digulir.
            if (kotak.top < menu.getBoundingClientRect().bottom - 2) return true;
            var kepala = document.querySelector('.main-header');
            var tinggi = kepala && getComputedStyle(kepala).position === 'fixed' ? kepala.offsetHeight : 0;
            var y = Math.max(0, Math.round(kotak.top + window.pageYOffset - tinggi - 12));
            if (Math.abs(window.pageYOffset - y) > 2) window.scrollTo({ top: y, left: 0, behavior: 'instant' });
            return Math.abs(window.pageYOffset - y) <= 2;
        }

        // Ulangi tiap bingkai sampai isi di posisinya dan susunan halaman selesai dibaca, baru tampilkan.
        // Setelah semua selesai dimuat, posisi dicek sekali lagi (huruf atau gambar bisa mengubah tinggi).
        var siap = false;
        document.addEventListener('DOMContentLoaded', function () { siap = true; });
        var mulai = Date.now();
        (function tunggu() {
            var pas = gulir();
            if (pas && siap) return tampilkan();
            if (Date.now() - mulai < 3000) requestAnimationFrame(tunggu);
        })();
        window.addEventListener('load', function () { setTimeout(gulir, 0); });
    })();
</script>
