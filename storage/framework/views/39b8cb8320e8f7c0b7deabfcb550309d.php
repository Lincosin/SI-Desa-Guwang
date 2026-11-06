<style>
@media (max-width: 767.98px) {
    /* Mengecilkan teks judul hero di layar HP */
    .text-display-hero,
    .font-display-hero {
        font-size: 20px !important;
        line-height: 1.35 !important;
        letter-spacing: -0.01em !important;
        margin-bottom: 16px !important;
        padding: 0 8px !important;
    }
}

@media (max-width: 480px) {
    /* Penyesuaian untuk layar HP kecil */
    .text-display-hero,
    .font-display-hero {
        font-size: 32px !important;
        line-height: 1.3 !important;
    }
}

/* =========================================
   KUSTOMISASI WARNA & EFEK BERANDA
   ========================================= */

/* Latar Belakang Selang-Seling */
.bg-alternate {
    background-color: #f8fafc; /* Abu-abu sangat muda / Slate 50 */
}
html.dark .bg-alternate {
    background-color: #0f172a; /* Slate 900 untuk mode gelap */
}

/* Pembatas Ombak (Shape Divider) */
.custom-shape-divider-bottom {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    overflow: hidden;
    line-height: 0;
    transform: translateY(1px); /* Mencegah garis putih tipis */
}
.custom-shape-divider-bottom svg {
    position: relative;
    display: block;
    width: calc(100% + 1.3px);
    height: 45px;
}
.custom-shape-divider-bottom .shape-fill {
    fill: #f8fafc; /* Sama dengan bg-alternate */
}
html.dark .custom-shape-divider-bottom .shape-fill {
    fill: #0f172a;
}

/* Efek Hover Mengambang pada Kartu Layanan Digital */
.hover-float {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.hover-float:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}
.hover-float:hover .hover-icon-wrapper {
    background-color: #006496; /* Warna primer */
    color: #ffffff;
    transform: scale(1.1);
}
.hover-icon-wrapper {
    transition: all 0.3s ease;
}

/* Warna Aksen Emas (Accent Color) */
.text-accent {
    color: #d97706; /* Amber 600 */
}
html.dark .text-accent {
    color: #fbbf24; /* Amber 400 */
}
.border-b-accent {
    border-bottom: 3px solid #d97706;
    display: inline-block;
    padding-bottom: 4px;
}
html.dark .border-b-accent {
    border-bottom-color: #fbbf24;
}

/* 1. Kanvas Peta & Pinpoint */
    .guwang-map-canvas {
        position: relative;
        width: 100%;
        height: 440px;
        border-radius: 16px;
        overflow: hidden;
        background-color: #0f172a;
        border: 1px solid #e2e8f0;
        user-select: none;
    }
    html.dark .guwang-map-canvas {
        border-color: #1e293b;
    }
    @media (max-width: 640px) {
        .guwang-map-canvas {
            height: 280px;
        }
    }

    .guwang-map-bg {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        opacity: 0.88;
        transition: transform 0.6s ease;
    }
    .guwang-map-canvas:hover .guwang-map-bg {
        transform: scale(1.02);
    }

    .pin-item {
        position: absolute;
        z-index: 20;
        cursor: pointer;
        transform: translate(-50%, -50%);
        transition: transform 0.25s ease, z-index 0.25s ease;
    }
    .pin-item:hover {
        z-index: 35;
        transform: translate(-50%, -50%) scale(1.15);
    }
    .pin-item.is-active {
        z-index: 40 !important;
        transform: translate(-50%, -58%) scale(1.28);
    }

    .pin-circle {
        width: 34px;
        height: 34px;
        border-radius: 9999px;
        border: 2px solid #ffffff;
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.35);
        position: relative;
        z-index: 2;
    }
    .pin-item.is-active .pin-circle {
        outline: 4px solid #38bdf8 !important;
        outline-offset: 2px;
        box-shadow: 0 0 20px rgba(56, 189, 248, 0.85), 0 8px 16px rgba(0, 0, 0, 0.4) !important;
    }

    .pin-pulse {
        position: absolute;
        width: 38px;
        height: 38px;
        border-radius: 9999px;
        z-index: 1;
        animation: guwangPing 1.6s cubic-bezier(0, 0, 0.2, 1) infinite;
    }
    @keyframes guwangPing {
        75%, 100% {
            transform: scale(1.9);
            opacity: 0;
        }
    }

    .pin-label {
        position: absolute;
        top: 38px;
        left: 50%;
        transform: translateX(-50%);
        white-space: nowrap;
        background: rgba(15, 23, 42, 0.85);
        backdrop-filter: blur(4px);
        color: #ffffff;
        font-weight: 700;
        font-size: 11px;
        padding: 3px 9px;
        border-radius: 6px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
        pointer-events: none;
    }
    @media (max-width: 640px) {
        .pin-label {
            display: none;
        }
    }
    .pin-item.is-active .pin-label {
        display: inline-block !important;
        background-color: #0f172a !important;
        border: 1px solid #38bdf8;
        color: #38bdf8 !important;
    }

    /* 2. Modal Pop-up (Pure CSS agar ukuran gambar & box terkunci rapi) */
    #modal-detail-potensi {
        position: fixed !important;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 9999 !important;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 16px;
        background-color: rgba(15, 23, 42, 0.72);
        backdrop-filter: blur(5px);
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
        transition: opacity 0.28s ease, visibility 0.28s ease;
    }
    #modal-detail-potensi.is-open {
        opacity: 1 !important;
        visibility: visible !important;
        pointer-events: auto !important;
    }

    .guwang-modal-box {
        position: relative;
        width: 100%;
        max-width: 480px !important;
        max-height: 90vh;
        background-color: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 22px;
        overflow: hidden;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.45);
        display: flex;
        flex-direction: column;
        transform: scale(0.94) translateY(10px);
        transition: transform 0.28s ease;
    }
    html.dark .guwang-modal-box {
        background-color: #111827;
        border-color: #1f2937;
    }
    #modal-detail-potensi.is-open .guwang-modal-box {
        transform: scale(1) translateY(0);
    }

    /* Kunci tinggi gambar di dalam modal agar tidak raksasa */
    .guwang-modal-img-wrap {
        position: relative;
        width: 100%;
        height: 215px !important;
        background-color: #0f172a;
        flex-shrink: 0;
        overflow: hidden;
    }
    @media (max-width: 640px) {
        .guwang-modal-img-wrap {
            height: 185px !important;
        }
    }

    #potensi-foto {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        display: block;
        transition: opacity 0.22s ease, transform 0.35s ease;
    }
    .foto-fade-out {
        opacity: 0.25;
        transform: scale(1.04);
    }

    .guwang-modal-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.82) 0%, rgba(0,0,0,0.2) 55%, rgba(0,0,0,0.3) 100%);
        pointer-events: none;
    }

    .guwang-modal-badge {
        position: absolute;
        top: 14px;
        left: 14px;
        background-color: #006496;
        color: #ffffff;
        font-size: 11px;
        font-weight: 700;
        padding: 4px 12px;
        border-radius: 9999px;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        box-shadow: 0 2px 8px rgba(0,0,0,0.25);
    }

    .guwang-modal-close {
        position: absolute;
        top: 12px;
        right: 12px;
        width: 34px;
        height: 34px;
        border-radius: 9999px;
        background: rgba(0, 0, 0, 0.55);
        color: #ffffff;
        border: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background 0.2s ease;
    }
    .guwang-modal-close:hover {
        background: rgba(0, 0, 0, 0.85);
    }

    .guwang-modal-arrows {
        position: absolute;
        top: 50%;
        left: 10px;
        right: 10px;
        transform: translateY(-50%);
        display: flex;
        justify-content: space-between;
        pointer-events: none;
    }
    .guwang-arrow-btn {
        pointer-events: auto;
        width: 34px;
        height: 34px;
        border-radius: 9999px;
        background: rgba(0, 0, 0, 0.45);
        color: #ffffff;
        border: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background 0.2s ease, transform 0.15s ease;
    }
    .guwang-arrow-btn:hover {
        background: rgba(0, 0, 0, 0.8);
        transform: scale(1.08);
    }

    .guwang-modal-title-wrap {
        position: absolute;
        bottom: 12px;
        left: 16px;
        right: 16px;
        pointer-events: none;
    }

    /* Transisi Konten Body Modal */
    .potensi-anim-wrap {
        padding: 18px 20px;
        overflow-y: auto;
        transition: opacity 0.2s ease, transform 0.2s ease;
    }
    .potensi-anim-out-left {
        opacity: 0;
        transform: translateX(-12px);
    }
    .potensi-anim-out-right {
        opacity: 0;
        transform: translateX(12px);
    }

    .guwang-info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
        padding: 12px 14px;
        border-radius: 14px;
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
        margin-top: 14px;
    }
    html.dark .guwang-info-grid {
        background-color: #1e293b;
        border-color: #334155;
    }

    .guwang-modal-footer {
        padding: 12px 20px;
        border-top: 1px solid #f1f5f9;
        background-color: #f8fafc;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }
    html.dark .guwang-modal-footer {
        background-color: #0f172a;
        border-top-color: #1e293b;
    }

    /* Dots Pagination */
    .guwang-dot {
        height: 7px;
        width: 7px;
        border-radius: 9999px;
        background-color: #cbd5e1;
        border: 0;
        padding: 0;
        cursor: pointer;
        transition: all 0.25s ease;
    }
    html.dark .guwang-dot {
        background-color: #334155;
    }
    .guwang-dot.is-active {
        width: 20px;
        background-color: #006496;
    }
    html.dark .guwang-dot.is-active {
        background-color: #38bdf8;
    }
    /* =========================================
    EFEK PARALLAX & GLASSMORPHISM
    ========================================= */
    .bg-parallax {
        position: relative;
        /* Kunci parallax: fixed attachment */
        background-attachment: fixed !important; 
        background-position: center !important;
        background-repeat: no-repeat !important;
        background-size: cover !important;
    }

    /* Overlay gelap agar teks putih tetap terbaca */
    .bg-parallax::before {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(15, 23, 42, 0.85); /* Warna navy transparan 85% */
        z-index: 1;
    }

    /* Memastikan konten berada di atas overlay */
    .bg-parallax > section {
        position: relative;
        z-index: 2; 
    }

    /* Glassmorphism: Membuat kartu menjadi kaca buram */
    .bg-parallax .bg-surface-container-lowest,
    .bg-parallax .bg-surface-container-low,
    .bg-parallax .bg-surface-container-high,
    .bg-parallax .bg-surface-container {
        background: rgba(255, 255, 255, 0.08) !important;
        backdrop-filter: blur(12px) !important;
        -webkit-backdrop-filter: blur(12px) !important;
        border: 1px solid rgba(255, 255, 255, 0.15) !important;
        box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3) !important;
    }

    /* Memaksa semua teks di dalam area Parallax menjadi putih */
    .bg-parallax h2, .bg-parallax h3, .bg-parallax h4, 
    .bg-parallax p, .bg-parallax span, .bg-parallax div.text-on-surface-variant {
        color: #f8fafc !important;
    }

    /* Penyesuaian elemen warna aksen agar tetap menyala di latar gelap */
    .bg-parallax .text-accent { color: #fbbf24 !important; } /* Emas menyala */
    .bg-parallax .bg-primary { background-color: #38bdf8 !important; } /* Biru terang */
    .bg-parallax .bg-secondary { background-color: #a78bfa !important; } /* Ungu terang */
    .bg-parallax .border-b-accent { border-bottom-color: #fbbf24 !important; }

    /* =========================================
       PERBAIKAN WARNA TEKS MODAL PETA
       ========================================= */
    /* Mengembalikan warna teks menjadi gelap karena tertimpa CSS Parallax */
    #modal-detail-potensi p,
    #modal-detail-potensi #potensi-lokasi,
    #modal-detail-potensi #potensi-jam,
    #modal-detail-potensi #potensi-pengelola,
    #modal-detail-potensi button.text-on-surface {
        color: #334155 !important; /* Warna abu-abu gelap / Slate 700 */
    }
    
    #modal-detail-potensi .guwang-info-grid span:first-child,
    #modal-detail-potensi #potensi-urutan {
        color: #64748b !important; /* Warna abu-abu redup / Slate 500 */
    }
    
    #modal-detail-potensi #potensi-rute, 
    #modal-detail-potensi #potensi-rute span {
        color: #0284c7 !important; /* Warna biru petunjuk arah */
    }

    /* Penyesuaian jika website menggunakan Mode Gelap (Dark Mode) */
    html.dark #modal-detail-potensi p,
    html.dark #modal-detail-potensi #potensi-lokasi,
    html.dark #modal-detail-potensi #potensi-jam,
    html.dark #modal-detail-potensi #potensi-pengelola,
    html.dark #modal-detail-potensi button.text-on-surface {
        color: #f1f5f9 !important; /* Warna putih terang */
    }

    /* Menghilangkan pattern titik-titik bawaan tema pada Hero Banner */
.bg-gradient-to-b {
    background-image: linear-gradient(to bottom, var(--tw-gradient-stops)) !important;
}
.bg-cover::before, 
.bg-cover::after {
    display: none !important;
    background-image: none !important;
}
</style>



<?php
    $title = !empty($judul_kategori) ? $judul_kategori : 'Artikel Terkini';
    $slug = 'terkini';
    if (is_array($title)) {
        $slug = $title['slug'];
        $title = $title['kategori'];
    }

    // Halaman awal = bukan pencarian, bukan kategori, bukan halaman paging
    $isBeranda = empty($cari) && empty($judul_kategori) && request()->segment(2) != 'kategori' && request()->segment(2) !== 'index' && request()->segment(1) !== 'index';
?>

<?php $__env->startSection('content'); ?>
    <?php if($isBeranda): ?>
        <?php
            $namaDesa = ucfirst(setting('sebutan_desa')) . ' ' . ucwords($desa['nama_desa']);
            $lokasiDesa = ucfirst(setting('sebutan_kecamatan_singkat')) . ' ' . ucwords($desa['nama_kecamatan']) . ', ' . ucfirst(setting('sebutan_kabupaten_singkat')) . ' ' . ucwords($desa['nama_kabupaten']);

            // Gambar hero: gambar slider pertama yang ada, jika tidak ada pakai latar website
            $heroImg = null;
            foreach ($slider_gambar['gambar'] ?? [] as $s) {
                foreach ([$s['gambar'] ?? '', 'sedang_' . ($s['gambar'] ?? '')] as $berkas) {
                    $path = ($slider_gambar['lokasi'] ?? '') . $berkas;
                    if (!empty($s['gambar']) && is_file($path)) {
                        $heroImg = base_url($path);
                        break 2;
                    }
                }
            }
            $heroImg = $heroImg ?: $latar_website;

            $bulan = ['JAN', 'FEB', 'MAR', 'APR', 'MEI', 'JUN', 'JUL', 'AGU', 'SEP', 'OKT', 'NOV', 'DES'];
        ?>

        
        <section class="relative w-full overflow-hidden">
            <div class="relative w-full min-h-[520px] lg:min-h-[600px] flex items-center justify-center bg-cover bg-center" style="background-image: url('<?php echo e($heroImg); ?>');">
                
                
                
                <div class="absolute inset-0 z-0" style="background: linear-gradient(to bottom, rgba(0, 100, 150, 0.65) 0%, rgba(0, 100, 150, 0.35) 60%, rgba(255, 255, 255, 0) 100%);"></div>

                <div class="relative z-10 max-w-5xl mx-auto mt-16 px-4 sm:px-6 lg:px-8 py-16 text-center flex flex-col items-center">
                    <h1 class="font-display-hero text-display-hero text-surface-bright tracking-tight sm:text-md max-w-4xl text-balance drop-shadow-md mb-8">
                        Portal informasi dan layanan publik Pemerintah <?php echo e($namaDesa); ?>

                    </h1>
                    <!-- <p class="font-body-xl text-body-xl text-surface-bright/90 max-w-3xl mb-10 text-balance leading-relaxed">
                        Temukan berita terbaru, informasi penting, dan layanan publik dari pemerintah desa <?php echo e($namaDesa); ?>.
                    </p> -->

                    <form action="<?php echo e(site_url('/')); ?>" method="GET" role="search" class="w-full max-w-2xl bg-surface-container-lowest p-2 rounded-2xl shadow-xl flex flex-col sm:flex-row items-center gap-2">
                        <div class="flex items-center gap-3 w-full px-4 py-2 text-on-surface-variant">
                            <span class="material-symbols-outlined text-[24px] text-primary">search</span>
                            <input type="text" name="cari" class="w-full bg-transparent focus:outline-none font-body-md text-body-md text-on-surface placeholder:text-outline" placeholder="Cari berita atau informasi desa..." aria-label="Cari">
                        </div>
                        <button type="submit" class="w-full sm:w-auto px-7 py-3.5 rounded-xl bg-primary hover:bg-primary-container text-on-primary font-body-bold text-label-lg transition-all shadow-md flex items-center justify-center gap-2 flex-shrink-0">
                            <span>Cari</span>
                            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                        </button>
                    </form>

                    <div class="flex flex-wrap items-center justify-center gap-2.5 mt-6 font-label-md text-label-md">
                        <span class="text-surface-bright/80 font-medium">Pintasan Cepat:</span>
                        <?php if(setting('layanan_mandiri') == 1): ?>
                            <a href="<?php echo e(site_url('layanan-mandiri')); ?>" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-md bg-surface-container-lowest/20 hover:bg-surface-container-lowest text-surface-bright hover:text-primary backdrop-blur-sm transition-all border border-white/10 hover:border-white/30">Layanan Mandiri</a>
                        <?php endif; ?>
                        <a href="<?php echo e(site_url('pengaduan')); ?>" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-md bg-surface-container-lowest/20 hover:bg-surface-container-lowest text-surface-bright hover:text-primary backdrop-blur-sm transition-all border border-white/10 hover:border-white/30">Pengaduan Warga</a>
                        <a href="<?php echo e(site_url('peraturan-desa')); ?>" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-md bg-surface-container-lowest/20 hover:bg-surface-container-lowest text-surface-bright hover:text-primary backdrop-blur-sm transition-all border border-white/10 hover:border-white/30">Produk Hukum</a>
                    </div>
                </div>
            </div>
            
            
            <div class="custom-shape-divider-bottom">
                <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                    <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C59.71,118.08,130.83,119.3,191.88,107.5C236.21,98.92,280.4,75.4,321.39,56.44Z" class="shape-fill"></path>
                </svg>
            </div>
        </section>

        
        <?php
            $layanan = [];
            if (setting('layanan_mandiri') == 1) {
                $layanan[] = ['badge', 'Layanan Mandiri', 'Login warga, permohonan surat, dan cetak dokumen secara mandiri.', site_url('layanan-mandiri'), 'Masuk Portal'];
            }
            $layanan[] = ['campaign', 'Pengaduan & Aspirasi', 'Sampaikan pengaduan, saran, dan aspirasi langsung kepada pemerintah desa.', site_url('pengaduan'), 'Kirim Pengaduan'];
            $layanan[] = ['gavel', 'Produk Hukum', 'Peraturan desa, keputusan kepala desa, dan regulasi lainnya.', site_url('peraturan-desa'), 'Lihat Dokumen'];
            $layanan[] = ['construction', 'Pembangunan Desa', 'Pantau kegiatan dan progres pembangunan di wilayah desa.', site_url('pembangunan'), 'Lihat Pembangunan'];
            $layanan[] = ['folder_open', 'Informasi Publik', 'Dokumen dan informasi yang terbuka untuk masyarakat.', site_url('informasi-publik'), 'Buka Informasi'];
            $layanan[] = ['storefront', 'Lapak Desa', 'Produk warga dan UMKM desa.', site_url('lapak'), 'Kunjungi Lapak'];
            $layanan[] = ['map', 'Peta Desa', 'Peta wilayah dan sebaran fasilitas desa.', site_url('peta'), 'Buka Peta'];
            $layanan[] = ['bar_chart', 'Statistik Desa', 'Data penduduk dan statistik desa.', site_url('data-statistik/jenis-kelamin'), 'Lihat Statistik'];
        ?>
        
        <div class="bg-alternate w-full pt-10 pb-16 mb-12">
            <section class="reveal max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 w-full" id="layanan">
                <div class="flex flex-col items-center text-center mb-12">
                    <div class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-md bg-surface-container-high text-primary font-body-bold text-label-md mb-3">
                        <span class="material-symbols-outlined text-[16px] text-accent">touch_app</span> 
                        <span>PELAYANAN PUBLIK</span>
                    </div>
                    <h2 class="font-headline-xl text-headline-xl text-on-surface tracking-tight mb-2 border-b-accent">Layanan Digital Warga <?php echo e(ucfirst(setting('sebutan_desa'))); ?></h2>
                    <p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl mt-3">Akses layanan dan informasi desa dengan mudah, kapan saja dan di mana saja.</p>
                </div>
                <div class="reveal-stagger grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <?php $__currentLoopData = $layanan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$ikon, $judulLayanan, $deskripsi, $tautan, $aksi]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        
                        <a href="<?php echo e($tautan); ?>" class="hover-float group bg-surface-container-lowest p-6 rounded-2xl shadow-sm flex flex-col justify-between">
                            <div>
                                <div class="hover-icon-wrapper w-12 h-12 rounded-xl bg-surface-container-low text-primary flex items-center justify-center mb-5">
                                    <span class="material-symbols-outlined text-[26px]"><?php echo e($ikon); ?></span>
                                </div>
                                <h3 class="font-headline-sm text-headline-sm text-on-surface mb-2 group-hover:text-primary transition-colors"><?php echo e($judulLayanan); ?></h3>
                                <p class="font-caption text-caption text-on-surface-variant leading-relaxed"><?php echo e($deskripsi); ?></p>
                            </div>
                            <div class="mt-6 flex items-center gap-1 text-primary font-body-bold text-label-md">
                                <span class="group-hover:text-accent transition-colors"><?php echo e($aksi); ?></span>
                                <span class="material-symbols-outlined text-[16px] group-hover:translate-x-1 group-hover:text-accent transition-all">arrow_forward</span>
                            </div>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </section>
        </div>

        
        <?php
            $kades = collect($aparatur_desa['daftar_perangkat'] ?? [])->first(fn ($p) => stripos($p['jabatan'] ?? '', 'kepala') !== false);
            $namaKades = $desa['nama_kepala_desa'] ?: ($kades['nama'] ?? null);
            $adaKades = !empty($namaKades);
        ?>
        <section class="reveal max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 py-14 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
                <div class="<?php echo e($adaKades ? 'lg:col-span-7' : 'lg:col-span-12'); ?> bg-surface-container-lowest p-8 sm:p-10 rounded-2xl shadow-sm border border-outline-variant/20 flex flex-col justify-between">
                    <div>
                        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md bg-surface-container-high text-primary font-body-bold text-label-md mb-4">
                            <span class="material-symbols-outlined text-[16px] text-accent">location_city</span>
                            <span>PROFIL WILAYAH</span>
                        </div>
                        <h2 class="font-headline-lg text-headline-lg text-on-surface tracking-tight mb-4 border-b-accent">Mengenal Lebih Dekat <?php echo e($namaDesa); ?></h2>
                        <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed mb-6">
                            <?php echo e($namaDesa); ?> berada di <?php echo e($lokasiDesa); ?>, Provinsi <?php echo e(ucwords($desa['nama_propinsi'])); ?>.
                            <?php if(!empty($desa['alamat_kantor'])): ?>
                                Kantor <?php echo e(setting('sebutan_desa')); ?> beralamat di <?php echo e($desa['alamat_kantor']); ?>.
                            <?php endif; ?>
                        </p>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <a href="<?php echo e(site_url('pemerintah')); ?>" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-primary text-on-primary font-body-bold text-label-lg hover:bg-primary-container transition-colors shadow-sm">
                            <span>Pemerintah <?php echo e(ucfirst(setting('sebutan_desa'))); ?></span>
                            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                        </a>
                        <a href="<?php echo e(site_url('peta')); ?>" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-surface-container-low text-primary font-body-bold text-label-lg hover:bg-surface-container hover:text-accent transition-colors">
                            <span>Lihat Peta</span>
                            <span class="material-symbols-outlined text-[18px]">map</span>
                        </a>
                    </div>
                </div>
                <?php if($adaKades): ?>
                <div class="lg:col-span-5 bg-gradient-to-br from-primary to-primary-container text-on-primary p-8 sm:p-10 rounded-2xl shadow-sm flex flex-col items-center justify-center text-center gap-4 hover:shadow-lg transition-shadow">
                    <?php if(!empty($kades['foto'])): ?>
                        <img src="<?php echo e($kades['foto']); ?>" alt="<?php echo e($kades['nama'] ?? ''); ?>" class="w-36 h-36 rounded-full object-cover border-4 border-white/40 shadow-lg bg-white/10 hover:scale-105 transition-transform">
                    <?php else: ?>
                        <div class="w-36 h-36 rounded-full bg-white/10 flex items-center justify-center border-4 border-white/40 shadow-lg">
                            <span class="material-symbols-outlined text-[64px]">person</span>
                        </div>
                    <?php endif; ?>
                    <div class="mt-2">
                        <span class="font-label-md text-label-md text-tertiary-fixed font-bold uppercase tracking-wider block mb-1" style="color: #fbbf24;"><?php echo e(ucfirst(setting('sebutan_kepala_desa') ?: 'Kepala Desa')); ?></span>
                        <h3 class="font-headline-md text-headline-md text-surface-bright"><?php echo e($namaKades); ?></h3>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </section>

        
        <?php
            $daftarPerangkat = collect($aparatur_desa['daftar_perangkat'] ?? [])->take(6);
        ?>
        <?php if($daftarPerangkat->count() > 0): ?>
            <div class="bg-alternate w-full py-12">
                <section class="reveal max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 w-full">
                    <div class="bg-surface-container-lowest p-8 sm:p-10 rounded-2xl shadow-sm border border-outline-variant/10">
                        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
                            <div>
                                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md bg-surface-container text-primary font-body-bold text-label-md mb-2">
                                    <span class="material-symbols-outlined text-[16px] text-accent">badge</span>
                                    <span>STRUKTUR ORGANISASI</span>
                                </div>
                                <h2 class="font-headline-lg text-headline-lg text-on-surface tracking-tight">Pamong &amp; Perangkat <?php echo e(ucfirst(setting('sebutan_desa'))); ?></h2>
                            </div>
                            <a href="<?php echo e(site_url('pemerintah')); ?>" class="inline-flex items-center gap-1 text-primary hover:text-accent font-body-bold text-label-lg transition-colors">
                                <span>Struktur Lengkap</span>
                                <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                            </a>
                        </div>
                        <div class="reveal-stagger grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                            <?php $__currentLoopData = $daftarPerangkat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="bg-surface-container-low p-4 rounded-xl text-center flex flex-col items-center hover:bg-surface-container hover:-translate-y-1 transition-all shadow-sm">
                                    <img src="<?php echo e($orang['foto']); ?>" alt="<?php echo e($orang['nama']); ?>" class="w-20 h-20 rounded-full object-cover mb-3 shadow-md bg-surface-container-high border-2 border-white/50">
                                    <h4 class="font-body-bold text-caption font-bold text-on-surface line-clamp-1"><?php echo e($orang['nama']); ?></h4>
                                    <span class="font-label-md text-[11px] text-primary font-semibold block mt-0.5"><?php echo e($orang['jabatan']); ?></span>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </section>
            </div>
        <?php endif; ?>

        
        <div class="bg-parallax w-full py-16" style="background-image: url('<?php echo e($heroImg); ?>');">
        <section class="reveal max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 py-14 w-full" id="peta-kustom-guwang">
            <div class="bg-surface-container-lowest p-6 sm:p-10 rounded-2xl shadow-sm border border-outline-variant/20">
                
                <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-6">
                    <div>
                        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md bg-surface-container text-primary font-body-bold text-xs uppercase mb-2">
                            <span class="material-symbols-outlined text-[15px] text-accent">map</span>
                            <span>Peta Wilayah & Potensi</span>
                        </div>
                        <h2 class="font-headline-lg text-headline-lg text-on-surface tracking-tight text-xl sm:text-2xl font-bold">
                            Peta Jelajah Potensi <?php echo e(ucfirst(setting('sebutan_desa'))); ?> <?php echo e($desa['nama_desa']); ?>

                        </h2>
                        <p class="text-xs sm:text-sm text-on-surface-variant mt-1">
                            Klik pada titik pin lokasi untuk melihat pesona wisata alam, seni budaya, dan daya tarik Desa Guwang.
                        </p>
                    </div>
                    
                    
                    <div class="flex flex-wrap gap-1.5" id="filter-pin-kategori">
                        <button type="button" data-filter="all" class="btn-filter-custom active px-3 py-1.5 rounded-lg text-xs font-semibold bg-primary text-white border border-primary shadow-sm transition-all">Semua</button>
                        <button type="button" data-filter="wisata" class="btn-filter-custom px-3 py-1.5 rounded-lg text-xs font-semibold bg-white/10 text-white border border-white/20 hover:bg-white/20 transition-all">Wisata Alam</button>
                        <button type="button" data-filter="seni" class="btn-filter-custom px-3 py-1.5 rounded-lg text-xs font-semibold bg-white/10 text-white border border-white/20 hover:bg-white/20 transition-all">Seni & Belanja</button>
                        <button type="button" data-filter="religi" class="btn-filter-custom px-3 py-1.5 rounded-lg text-xs font-semibold bg-white/10 text-white border border-white/20 hover:bg-white/20 transition-all">Budaya & Pura</button>
                    </div>
                </div>

                
                <div class="guwang-map-canvas shadow-inner">
                    <img src="<?php echo e(base_url('assets/images/peta_guwang_ilustrasi.jpg')); ?>" 
                        alt="Peta Ilustrasi Desa Guwang" 
                        class="guwang-map-bg"
                        onerror="this.src='https://images.unsplash.com/photo-1524661135-423995f22d0b?auto=format&fit=crop&w=1200&q=80'">

                    
                    <div class="pin-item" style="top: 45%; left: 68%;" 
                        data-key="hidden-canyon"
                        data-category="wisata"
                        onclick="bukaDetailPotensi('hidden-canyon')">
                        <div class="relative flex items-center justify-center">
                            <span class="pin-pulse" style="background-color: rgba(239, 68, 68, 0.55);"></span>
                            <div class="pin-circle" style="background-color: #dc2626;">
                                <span class="material-symbols-outlined text-[16px]">landscape</span>
                            </div>
                            <span class="pin-label">Hidden Canyon</span>
                        </div>
                    </div>

                    
                    <div class="pin-item" style="top: 35%; left: 32%;" 
                        data-key="pasar-seni"
                        data-category="seni"
                        onclick="bukaDetailPotensi('pasar-seni')">
                        <div class="relative flex items-center justify-center">
                            <span class="pin-pulse" style="background-color: rgba(245, 158, 11, 0.55);"></span>
                            <div class="pin-circle" style="background-color: #f59e0b;">
                                <span class="material-symbols-outlined text-[16px]">storefront</span>
                            </div>
                            <span class="pin-label">Pasar Seni Guwang</span>
                        </div>
                    </div>

                    
                    <div class="pin-item" style="top: 25%; left: 50%;" 
                        data-key="mini-zoo"
                        data-category="wisata"
                        onclick="bukaDetailPotensi('mini-zoo')">
                        <div class="relative flex items-center justify-center">
                            <span class="pin-pulse" style="background-color: rgba(16, 185, 129, 0.55);"></span>
                            <div class="pin-circle" style="background-color: #059669;">
                                <span class="material-symbols-outlined text-[16px]">pets</span>
                            </div>
                            <span class="pin-label">Hidden Mini Zoo</span>
                        </div>
                    </div>

                    
                    <div class="pin-item" style="top: 66%; left: 42%;" 
                        data-key="pura-dalem"
                        data-category="religi"
                        onclick="bukaDetailPotensi('pura-dalem')">
                        <div class="relative flex items-center justify-center">
                            <span class="pin-pulse" style="background-color: rgba(147, 51, 234, 0.55);"></span>
                            <div class="pin-circle" style="background-color: #9333ea;">
                                <span class="material-symbols-outlined text-[16px]">temple_hindu</span>
                            </div>
                            <span class="pin-label">Kawasan Religi & Budaya</span>
                        </div>
                    </div>

                    
                    <div style="position: absolute; bottom: 12px; left: 12px; z-index: 30; background: rgba(15, 23, 42, 0.75); backdrop-filter: blur(4px); padding: 6px 12px; border-radius: 8px; color: #fff; font-size: 11px; display: flex; align-items: center; gap: 6px;">
                        <span class="material-symbols-outlined text-[15px]" style="color: #fbbf24;">touch_app</span>
                        <span>Klik titik pin lokasi untuk membuka detail</span>
                    </div>
                </div>
            </div>
        </section>

        
        <div id="modal-detail-potensi" role="dialog" aria-modal="true">
            <div class="guwang-modal-box">
                
                <div class="guwang-modal-img-wrap">
                    <img id="potensi-foto" src="" alt="Detail Potensi">
                    <div class="guwang-modal-overlay"></div>

                    <span id="potensi-badge" class="guwang-modal-badge">Kategori</span>

                    <button type="button" onclick="tutupDetailPotensi()" aria-label="Tutup" class="guwang-modal-close">
                        <span class="material-symbols-outlined text-[18px]">close</span>
                    </button>

                    
                    <div class="guwang-modal-arrows">
                        <button type="button" onclick="geserPotensi(-1)" aria-label="Sebelumnya" class="guwang-arrow-btn">
                            <span class="material-symbols-outlined text-[20px]">chevron_left</span>
                        </button>
                        <button type="button" onclick="geserPotensi(1)" aria-label="Selanjutnya" class="guwang-arrow-btn">
                            <span class="material-symbols-outlined text-[20px]">chevron_right</span>
                        </button>
                    </div>

                    <div class="guwang-modal-title-wrap">
                        <h3 id="potensi-nama" style="color: #ffffff; font-weight: 700; font-size: 18px; margin: 0; line-height: 1.3; text-shadow: 0 2px 4px rgba(0,0,0,0.5);"></h3>
                    </div>
                </div>

                
                <div id="potensi-body-wrap" class="potensi-anim-wrap">
                    <div style="display: flex; align-items: center; justify-content: space-between; gap: 8px; flex-wrap: wrap; margin-bottom: 10px;">
                        <div class="text-primary" style="display: flex; align-items: center; gap: 4px; font-size: 12px; font-weight: 700;">
                            <span class="material-symbols-outlined text-[16px]">pin_drop</span>
                            <span id="potensi-lokasi"></span>
                        </div>

                        
                        <a id="potensi-rute" href="#" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; gap: 4px; padding: 4px 10px; border-radius: 9999px; background-color: rgba(2, 132, 199, 0.12); color: #0284c7; font-size: 11px; font-weight: 700; text-decoration: none;">
                            <span class="material-symbols-outlined text-[14px]">directions</span>
                            <span>Petunjuk Arah</span>
                        </a>
                    </div>

                    <p id="potensi-deskripsi" class="text-on-surface-variant" style="font-size: 13px; line-height: 1.6; margin: 0;"></p>

                    <div class="guwang-info-grid">
                        <div>
                            <span style="display: block; font-size: 11px; color: #94a3b8; margin-bottom: 2px;">Jam Kunjungan</span>
                            <span id="potensi-jam" class="text-on-surface" style="font-size: 12px; font-weight: 700;"></span>
                        </div>
                        <div>
                            <span style="display: block; font-size: 11px; color: #94a3b8; margin-bottom: 2px;">Pengelola</span>
                            <span id="potensi-pengelola" class="text-on-surface" style="font-size: 12px; font-weight: 700;"></span>
                        </div>
                    </div>
                </div>

                
                <div class="guwang-modal-footer">
                    <div style="display: flex; flex-direction: column; gap: 4px;">
                        <div id="potensi-dots" style="display: flex; align-items: center; gap: 5px;"></div>
                        <span id="potensi-urutan" style="font-size: 11px; font-weight: 600; color: #94a3b8;"></span>
                    </div>

                    <div style="display: flex; align-items: center; gap: 8px;">
                        <button type="button" onclick="geserPotensi(-1)" class="text-on-surface" style="padding: 6px 12px; border-radius: 10px; border: 1px solid #cbd5e1; background: transparent; font-size: 12px; font-weight: 600; cursor: pointer;">
                            Sebelumnya
                        </button>
                        <button type="button" onclick="geserPotensi(1)" class="bg-primary text-on-primary" style="padding: 6px 14px; border-radius: 10px; border: 0; font-size: 12px; font-weight: 600; cursor: pointer;">
                            Selanjutnya
                        </button>
                    </div>
                </div>
            </div>
        </div>

        
        <script>
            const dataPotensiGuwang = {
                'hidden-canyon': {
                    nama: "Hidden Canyon Beji Guwang",
                    kategori: "Wisata Alam",
                    foto: "https://images.unsplash.com/photo-1544644181-1484b3fdfc62?w=800&auto=format&fit=crop&q=80",
                    lokasi: "Banjar Wangbung, Desa Guwang",
                    deskripsi: "Ngarai alami yang terbentuk dari aliran sungai bebatuan purba ratusan tahun dengan jalur susur sungai eksotis.",
                    jam: "08:30 - 17:30 WITA",
                    pengelola: "Pokdarwis & Desa Adat Guwang",
                    rute: "https://www.google.com/maps/search/?api=1&query=Hidden+Canyon+Beji+Guwang"
                },
                'pasar-seni': {
                    nama: "Pasar Seni Guwang",
                    kategori: "Seni & UMKM",
                    foto: "https://images.unsplash.com/photo-1577717903315-1691ae25ab3f?w=800&auto=format&fit=crop&q=80",
                    lokasi: "Jl. Raya Guwang, Sukawati",
                    deskripsi: "Sentra perbelanjaan kerajinan tangan, lukisan, patung ukir, dan kain tradisional khas Bali karya perajin desa.",
                    jam: "08:00 - 18:00 WITA",
                    pengelola: "BUMDes & Pengelola Pasar",
                    rute: "https://www.google.com/maps/search/?api=1&query=Pasar+Seni+Guwang+Sukawati"
                },
                'mini-zoo': {
                    nama: "Hidden Mini Zoo Bali",
                    kategori: "Wisata Edukasi",
                    foto: "https://images.unsplash.com/photo-1534567153574-2b12153a87f0?w=800&auto=format&fit=crop&q=80",
                    lokasi: "Kawasan Wisata Guwang",
                    deskripsi: "Destinasi rekreasi keluarga yang menyediakan interaksi edukatif dengan aneka satwa jinak di lingkungan asri.",
                    jam: "09:00 - 17:00 WITA",
                    pengelola: "Swasta & Mitra Desa",
                    rute: "https://www.google.com/maps/search/?api=1&query=Hidden+Mini+Zoo+Bali+Guwang"
                },
                'pura-dalem': {
                    nama: "Kawasan Religi Pura Dalem Guwang",
                    kategori: "Budaya & Religi",
                    foto: "https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=800&auto=format&fit=crop&q=80",
                    lokasi: "Sentral Desa Guwang",
                    deskripsi: "Kawasan warisan spiritual dan arsitektur candi klasik Bali yang sarat nilai historis ukiran leluhur desa.",
                    jam: "Area Suci / Khusus Upacara",
                    pengelola: "Desa Adat Guwang",
                    rute: "https://www.google.com/maps/search/?api=1&query=Pura+Dalem+Guwang+Sukawati"
                }
            };

            const keysPotensi = Object.keys(dataPotensiGuwang);
            let indexAktif = 0;

            function sorotPinAktif(key) {
                document.querySelectorAll('.pin-item').forEach(pin => {
                    if (pin.getAttribute('data-key') === key) {
                        pin.classList.add('is-active');
                    } else {
                        pin.classList.remove('is-active');
                    }
                });
            }

            function renderDots() {
                const dotsContainer = document.getElementById('potensi-dots');
                if (!dotsContainer) return;
                dotsContainer.innerHTML = '';

                keysPotensi.forEach((k, idx) => {
                    const dot = document.createElement('button');
                    dot.type = 'button';
                    dot.setAttribute('aria-label', `Ke objek ${idx + 1}`);
                    dot.className = idx === indexAktif ? 'guwang-dot is-active' : 'guwang-dot';
                    dot.onclick = function() {
                        if (idx === indexAktif) return;
                        const arah = idx > indexAktif ? 1 : -1;
                        indexAktif = idx;
                        animasiGantiKonten(keysPotensi[indexAktif], arah);
                    };
                    dotsContainer.appendChild(dot);
                });
            }

            function isiKontenModal(key) {
                const item = dataPotensiGuwang[key];
                if (!item) return;

                document.getElementById('potensi-nama').textContent = item.nama;
                document.getElementById('potensi-badge').textContent = item.kategori;
                document.getElementById('potensi-foto').src = item.foto;
                document.getElementById('potensi-lokasi').textContent = item.lokasi;
                document.getElementById('potensi-deskripsi').textContent = item.deskripsi;
                document.getElementById('potensi-jam').textContent = item.jam;
                document.getElementById('potensi-pengelola').textContent = item.pengelola;
                document.getElementById('potensi-rute').href = item.rute || '#';
                document.getElementById('potensi-urutan').textContent = `${indexAktif + 1} dari ${keysPotensi.length} objek`;

                renderDots();
                sorotPinAktif(key);
            }

            function animasiGantiKonten(key, arah = 1) {
                const bodyWrap = document.getElementById('potensi-body-wrap');
                const fotoEl = document.getElementById('potensi-foto');
                const outClass = arah > 0 ? 'potensi-anim-out-left' : 'potensi-anim-out-right';

                bodyWrap.classList.add(outClass);
                fotoEl.classList.add('foto-fade-out');

                setTimeout(() => {
                    isiKontenModal(key);
                    bodyWrap.classList.remove(outClass);
                    fotoEl.classList.remove('foto-fade-out');
                }, 180);
            }

            function bukaDetailPotensi(id) {
                indexAktif = keysPotensi.indexOf(id);
                if (indexAktif === -1) indexAktif = 0;
                isiKontenModal(keysPotensi[indexAktif]);

                const modal = document.getElementById('modal-detail-potensi');
                modal.classList.add('is-open');
            }

            function geserPotensi(langkah) {
                indexAktif = (indexAktif + langkah + keysPotensi.length) % keysPotensi.length;
                animasiGantiKonten(keysPotensi[indexAktif], langkah);
            }

            function tutupDetailPotensi() {
                const modal = document.getElementById('modal-detail-potensi');
                modal.classList.remove('is-open');
                document.querySelectorAll('.pin-item').forEach(pin => pin.classList.remove('is-active'));
            }

            document.getElementById('modal-detail-potensi').addEventListener('click', function(e) {
                if (e.target === this) tutupDetailPotensi();
            });

            document.addEventListener('keydown', function(e) {
                const modal = document.getElementById('modal-detail-potensi');
                if (!modal.classList.contains('is-open')) return;
                if (e.key === 'ArrowRight') geserPotensi(1);
                if (e.key === 'ArrowLeft') geserPotensi(-1);
                if (e.key === 'Escape') tutupDetailPotensi();
            });

            // Deteksi Gesture Swipe Layar Sentuh
            const modalBox = document.querySelector('.guwang-modal-box');
            let touchStartX = 0;
            let touchStartY = 0;
            let touchEndX = 0;
            let touchEndY = 0;
            const minSwipeJarak = 45;

            modalBox.addEventListener('touchstart', function(e) {
                touchStartX = e.changedTouches[0].screenX;
                touchStartY = e.changedTouches[0].screenY;
            }, { passive: true });

            modalBox.addEventListener('touchend', function(e) {
                touchEndX = e.changedTouches[0].screenX;
                touchEndY = e.changedTouches[0].screenY;
                const selisihX = touchEndX - touchStartX;
                const selisihY = touchEndY - touchStartY;

                if (Math.abs(selisihX) > Math.abs(selisihY) && Math.abs(selisihX) > minSwipeJarak) {
                    if (selisihX < 0) geserPotensi(1);
                    else geserPotensi(-1);
                }
            }, { passive: true });

            // Filter Kategori Tombol
            document.querySelectorAll('.btn-filter-custom').forEach(button => {
                button.addEventListener('click', function () {
                    
                    // Kembalikan semua tombol ke mode tidak aktif (kaca transparan)
                    document.querySelectorAll('.btn-filter-custom').forEach(b => {
                        b.classList.remove('active', 'bg-primary', 'border-primary', 'shadow-sm');
                        b.classList.add('bg-white/10', 'border-white/20');
                    });
                    
                    // Jadikan tombol yang diklik menjadi aktif (biru/primer)
                    this.classList.remove('bg-white/10', 'border-white/20');
                    this.classList.add('active', 'bg-primary', 'border-primary', 'shadow-sm');

                    // Eksekusi filter pin peta
                    const filter = this.getAttribute('data-filter');
                    document.querySelectorAll('.pin-item').forEach(pin => {
                        if (filter === 'all' || pin.getAttribute('data-category') === filter) {
                            pin.style.display = 'block';
                        } else {
                            pin.style.display = 'none';
                        }
                    });
                });
            });
        </script>
        </div>

        
        <?php
            // Ekstrak Data Penduduk
            $dataStat = collect($stat_widget ?? [])->filter(fn ($r) => is_array($r) && isset($r['nama']));
            $baris_laki = $dataStat->first(fn ($r) => str_contains(strtoupper($r['nama']), 'LAKI'));
            $baris_perempuan = $dataStat->first(fn ($r) => str_contains(strtoupper($r['nama']), 'PEREMPUAN'));
            $laki = (int) ($baris_laki['jumlah'] ?? 0);
            $perempuan = (int) ($baris_perempuan['jumlah'] ?? 0);
            $totalPenduduk = (int) ($stat_widget['total']['jumlah'] ?? ($laki + $perempuan));
            $persenLaki = $totalPenduduk > 0 ? round($laki / $totalPenduduk * 100, 1) : 0;
            $persenPerempuan = $totalPenduduk > 0 ? round($perempuan / $totalPenduduk * 100, 1) : 0;
            
            // Ekstrak Data Kunjungan (Bawaan OpenSID)
            $kunjunganHariIni = (int) ($statistik_pengunjung['hari_ini'] ?? 0);
            $kunjunganKemarin = (int) ($statistik_pengunjung['kemarin'] ?? 0);
            $kunjunganTotal = (int) ($statistik_pengunjung['total'] ?? 0);
            
            $angka = fn ($n) => number_format((int) $n, 0, ',', '.');
        ?>

        <?php if($totalPenduduk > 0): ?>
            <style>
                .stat-icon-box {
                    width: 48px;
                    height: 48px;
                    border-radius: 12px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    transition: transform 0.3s ease;
                }
                .stat-card-custom:hover .stat-icon-box {
                    transform: scale(1.1) rotate(5deg);
                }
                /* Toggle Button Styles */
                .tk-toggle-btn {
                    padding: 8px 16px;
                    border-radius: 8px;
                    font-size: 13px;
                    font-weight: 600;
                    cursor: pointer;
                    transition: all 0.3s ease;
                    border: none;
                    background: transparent;
                    color: #64748b;
                }
                .tk-toggle-btn.active {
                    background-color: #006496;
                    color: #ffffff;
                    box-shadow: 0 4px 6px -1px rgba(0, 100, 150, 0.2);
                }
                html.dark .tk-toggle-btn.active {
                    background-color: #38bdf8;
                    color: #0f172a;
                }
                
                /* Transisi Konten Tab */
                .tk-tab-content {
                    animation: fadeInScale 0.4s ease forwards;
                    display: none;
                }
                .tk-tab-content.is-active {
                    display: block;
                }
                @keyframes fadeInScale {
                    from { opacity: 0; transform: translateY(10px); }
                    to { opacity: 1; transform: translateY(0); }
                }
            </style>

            <section class="reveal max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full" id="seksi-statistik">
                <div class="bg-surface-container-lowest p-8 sm:p-10 rounded-2xl shadow-sm border border-outline-variant/30">
                    
                    
                    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10 border-b border-outline-variant/30 pb-6">
                        <div>
                            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md bg-surface-container text-primary font-body-bold text-label-md mb-2">
                                <span class="material-symbols-outlined text-[16px] text-accent">pie_chart</span>
                                <span>DATA &amp; STATISTIK</span>
                            </div>
                            <h2 class="font-headline-lg text-headline-lg text-on-surface tracking-tight"><?php echo e($namaDesa); ?> dalam Angka</h2>
                        </div>

                        <!-- lihat statistik lengkap -->
                        <a href="<?php echo e(site_url('data-statistik/jenis-kelamin')); ?>" class="inline-flex items-center gap-1 text-primary hover:text-accent font-body-bold text-label-lg transition-colors">
                            <span>Selengkapnya</span>
                            <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                        </a>
                    </div>

                    
                    <div id="tab-penduduk" class="tk-tab-content is-active">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
                            
                            <div class="stat-card-custom p-6 rounded-2xl bg-surface-container-low hover:bg-surface-container hover:shadow-md transition-all border border-outline-variant/20 flex flex-col justify-between">
                                <div class="flex items-center gap-4 mb-4">
                                    <div class="stat-icon-box" style="background-color: rgba(59, 130, 246, 0.15); color: #3b82f6;">
                                        <span class="material-symbols-outlined text-[24px]">groups</span>
                                    </div>
                                    <span class="font-body-bold text-on-surface-variant uppercase tracking-wider text-sm">Total Penduduk</span>
                                </div>
                                <div class="flex items-baseline gap-1">
                                    <span class="tk-counter font-headline-xl text-4xl text-on-surface font-extrabold tracking-tight" data-target="<?php echo e($totalPenduduk); ?>">0</span>
                                    <span class="font-caption text-sm text-on-surface-variant">Jiwa</span>
                                </div>
                            </div>
                            
                            
                            <div class="stat-card-custom p-6 rounded-2xl bg-surface-container-low hover:bg-surface-container hover:shadow-md transition-all border border-outline-variant/20 flex flex-col justify-between">
                                <div class="flex items-center gap-4 mb-4">
                                    <div class="stat-icon-box" style="background-color: rgba(14, 165, 233, 0.15); color: #0ea5e9;">
                                        <span class="material-symbols-outlined text-[24px]">man</span>
                                    </div>
                                    <span class="font-body-bold text-on-surface-variant uppercase tracking-wider text-sm">Laki-Laki</span>
                                </div>
                                <div class="flex items-baseline gap-1">
                                    <span class="tk-counter font-headline-xl text-4xl text-on-surface font-extrabold tracking-tight" data-target="<?php echo e($laki); ?>">0</span>
                                    <span class="font-caption text-sm text-on-surface-variant">Jiwa</span>
                                </div>
                            </div>

                            
                            <div class="stat-card-custom p-6 rounded-2xl bg-surface-container-low hover:bg-surface-container hover:shadow-md transition-all border border-outline-variant/20 flex flex-col justify-between">
                                <div class="flex items-center gap-4 mb-4">
                                    <div class="stat-icon-box" style="background-color: rgba(236, 72, 153, 0.15); color: #ec4899;">
                                        <span class="material-symbols-outlined text-[24px]">woman</span>
                                    </div>
                                    <span class="font-body-bold text-on-surface-variant uppercase tracking-wider text-sm">Perempuan</span>
                                </div>
                                <div class="flex items-baseline gap-1">
                                    <span class="tk-counter font-headline-xl text-4xl text-on-surface font-extrabold tracking-tight" data-target="<?php echo e($perempuan); ?>">0</span>
                                    <span class="font-caption text-sm text-on-surface-variant">Jiwa</span>
                                </div>
                            </div>
                        </div>

                        
                        <div class="bg-surface-container-low p-5 rounded-2xl border border-outline-variant/20">
                            <div class="flex justify-between font-body-bold text-sm text-on-surface-variant mb-3">
                                <span style="color: #0ea5e9;">Laki-laki <?php echo e($persenLaki); ?>%</span>
                                <span style="color: #ec4899;">Perempuan <?php echo e($persenPerempuan); ?>%</span>
                            </div>
                            <div class="w-full h-4 rounded-full bg-surface-container-high overflow-hidden flex shadow-inner">
                                <div class="h-full bg-sky-500 rounded-l-full relative overflow-hidden" style="width: <?php echo e($persenLaki); ?>%">
                                    <div class="absolute inset-0 bg-white/20" style="transform: skewX(-45deg); width: 20%; animation: shine 3s infinite;"></div>
                                </div>
                                <div class="h-full bg-pink-500 rounded-r-full" style="width: <?php echo e($persenPerempuan); ?>%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            <style>
                @keyframes shine {
                    0% { left: -50%; }
                    100% { left: 150%; }
                }
            </style>

            <script>
                // Fungsi Toggle Tab
                function switchStatTab(tabId) {
                    // Update tombol aktif
                    document.querySelectorAll('.tk-toggle-btn').forEach(btn => btn.classList.remove('active'));
                    event.target.classList.add('active');
                    
                    // Sembunyikan semua konten
                    document.querySelectorAll('.tk-tab-content').forEach(content => content.classList.remove('is-active'));
                    
                    // Jalankan ulang animasi counter untuk tab yang baru dibuka
                    runCounters(targetContent);
                }

                // Fungsi Animasi Angka Berjalan (Counter Up)
                function runCounters(container) {
                    const counters = container.querySelectorAll('.tk-counter');
                    const speed = 150; // Semakin kecil semakin cepat

                    counters.forEach(counter => {
                        const target = +counter.getAttribute('data-target');
                        if (target === 0) return;
                        
                        counter.innerText = '0'; // Reset ke 0
                        
                        const updateCount = () => {
                            const count = +counter.innerText.replace(/\./g, '');
                            const inc = target / speed;

                            if (count < target) {
                                counter.innerText = Math.ceil(count + inc).toLocaleString('id-ID');
                                setTimeout(updateCount, 15);
                            } else {
                                counter.innerText = target.toLocaleString('id-ID');
                            }
                        };
                        updateCount();
                    });
                }

                // Jalankan counter saat bagian ini terlihat di layar (Intersection Observer)
                document.addEventListener("DOMContentLoaded", function() {
                    const observer = new IntersectionObserver((entries) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                // Jalankan counter di tab yang sedang aktif saja
                                const activeTab = document.querySelector('.tk-tab-content.is-active');
                                runCounters(activeTab);
                                observer.disconnect(); // Hanya jalankan 1 kali
                            }
                        });
                    }, { threshold: 0.5 });
                    
                    const statSection = document.getElementById('seksi-statistik');
                    if(statSection) observer.observe(statSection);
                });
            </script>
        <?php endif; ?>

        
        <?php
            $daftarBerita = $artikel->values();
            $beritaUtama = $headline ?: $daftarBerita->first();
            $sisaBerita = $headline ? $daftarBerita : $daftarBerita->slice(1)->values();
            $beritaSamping = $sisaBerita->take(4);
            $beritaLainnya = $sisaBerita->slice(4)->values();
        ?>
        <section class="reveal max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 py-14 w-full">
            <div class="flex items-center justify-between mb-8 border-b-2 border-outline-variant/30 pb-4">
                <div>
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md bg-surface-container-high text-primary font-body-bold text-label-md mb-2">
                        <span class="material-symbols-outlined text-[16px] text-accent">newspaper</span>
                        <span>WARTA DESA</span>
                    </div>
                    <h2 class="font-headline-lg text-headline-lg text-on-surface tracking-tight">Kabar &amp; Berita Terkini</h2>
                </div>
                <a href="<?php echo e(site_url('arsip')); ?>" class="inline-flex items-center gap-1 text-primary hover:text-accent font-body-bold text-label-lg transition-colors group">
                    <span>Lihat Semua Berita</span>
                    <span class="material-symbols-outlined text-[18px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </a>
            </div>

            <?php if($beritaUtama): ?>
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                    <div class="lg:col-span-6">
                        <?php echo $__env->make('theme::partials.artikel.card-featured', ['post' => $beritaUtama], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <div class="lg:col-span-6 flex flex-col gap-4">
                        <?php $__currentLoopData = $beritaSamping; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('theme::partials.artikel.card-compact', ['post' => $post], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                <?php if($beritaLainnya->count() > 0): ?>
                    <div class="reveal-stagger grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-10">
                        <?php $__currentLoopData = $beritaLainnya; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('theme::partials.artikel.card', ['post' => $post], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>

                <div class="pagination flex-wrap w-full mt-8">
                    <?php echo $__env->make('theme::commons.paging', ['paging_page' => $paging_page], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            <?php else: ?>
                <?php echo $__env->make('theme::partials.artikel.empty', ['title' => $title], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        </section>

        
        <?php
            $daftarAgenda = collect(array_merge($hari_ini ?? [], $yad ?? []))->take(3);
            $daftarPengumuman = collect($teks_berjalan ?? [])->take(5);
            $warnaAgenda = ['bg-primary text-on-primary', 'bg-secondary text-on-secondary', 'bg-tertiary text-on-tertiary'];
        ?>
        <?php if($daftarAgenda->count() > 0 || $daftarPengumuman->count() > 0): ?>
            <div class="bg-alternate w-full py-12">
                <section class="reveal max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 w-full">
                    <div class="grid grid-cols-1 <?php echo e($daftarAgenda->count() > 0 && $daftarPengumuman->count() > 0 ? 'lg:grid-cols-2' : ''); ?> gap-8">
                        <?php if($daftarAgenda->count() > 0): ?>
                            <div class="bg-surface-container-lowest p-6 sm:p-8 rounded-2xl shadow-sm border border-outline-variant/10">
                                <div class="flex items-center gap-2 mb-6 border-b border-outline-variant/20 pb-3">
                                    <span class="material-symbols-outlined text-primary text-[24px]">event_note</span>
                                    <h3 class="font-headline-sm text-headline-sm text-on-surface">Agenda Kegiatan</h3>
                                </div>
                                <div class="space-y-4">
                                    <?php $__currentLoopData = $daftarAgenda; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agenda): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $tglAgenda = !empty($agenda['tgl_agenda']) ? \Carbon\Carbon::parse($agenda['tgl_agenda']) : null;
                                        ?>
                                        <a href="<?php echo e(site_url('artikel/' . buat_slug($agenda))); ?>" class="p-4 rounded-xl bg-surface-container-low flex items-start gap-4 hover:bg-surface-container hover:shadow-sm transition-all transform hover:-translate-y-1">
                                            <div class="w-16 h-16 rounded-xl <?php echo e($warnaAgenda[$loop->index % 3]); ?> flex flex-col items-center justify-center flex-shrink-0 shadow-sm border border-white/20">
                                                <span class="font-headline-sm text-headline-sm font-bold leading-none"><?php echo e($tglAgenda ? $tglAgenda->format('d') : '-'); ?></span>
                                                <span class="font-label-md text-caption uppercase tracking-wider"><?php echo e($tglAgenda ? $bulan[$tglAgenda->month - 1] : ''); ?></span>
                                            </div>
                                            <div class="min-w-0">
                                                <?php if(!empty($agenda['lokasi_kegiatan'])): ?>
                                                    <span class="font-caption text-caption text-accent font-bold block"><?php echo e($agenda['lokasi_kegiatan']); ?></span>
                                                <?php endif; ?>
                                                <h4 class="font-body-bold text-body-bold text-on-surface mt-0.5"><?php echo e($agenda['judul']); ?></h4>
                                                <?php if(!empty($agenda['koordinator_kegiatan'])): ?>
                                                    <p class="font-caption text-caption text-on-surface-variant mt-1">Koordinator: <?php echo e($agenda['koordinator_kegiatan']); ?></p>
                                                <?php endif; ?>
                                            </div>
                                        </a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if($daftarPengumuman->count() > 0): ?>
                            <div class="bg-surface-container-lowest p-6 sm:p-8 rounded-2xl shadow-sm border border-outline-variant/10">
                                <div class="flex items-center gap-2 mb-6 border-b border-outline-variant/20 pb-3">
                                    <span class="material-symbols-outlined text-secondary text-[24px]">campaign</span>
                                    <h3 class="font-headline-sm text-headline-sm text-on-surface">Pengumuman Resmi</h3>
                                </div>
                                <ul class="space-y-3">
                                    <?php $__currentLoopData = $daftarPengumuman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="p-4 rounded-xl bg-surface-container-low flex items-start gap-3 border-l-4 border-l-accent shadow-sm">
                                            <span class="material-symbols-outlined text-secondary text-[20px] mt-0.5">notifications_active</span>
                                            <div class="font-body-md text-caption text-on-surface">
                                                <?php echo e($info['teks']); ?>

                                                <?php if(trim($info['tautan'] ?? '') && !empty($info['judul_tautan'])): ?>
                                                    <a href="<?php echo e($info['tautan']); ?>" class="text-primary font-body-bold hover:underline ml-1"><?php echo e($info['judul_tautan']); ?></a>
                                                <?php endif; ?>
                                            </div>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                </section>
            </div>
        <?php endif; ?>

        
        <?php
            $adaDataApbdes = false;
            foreach ($transparansi['data_widget'] ?? [] as $sub) {
                foreach ($sub as $kunci => $butir) {
                    if (is_array($butir) && $kunci != 'laporan' && (($butir['realisasi'] ?? 0) != 0 || ($butir['anggaran'] ?? 0) != 0)) {
                        $adaDataApbdes = true;
                        break 2;
                    }
                }
            }
        ?>
        <?php if($adaDataApbdes): ?>
            <section class="reveal max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 py-14 w-full">
                <div class="bg-surface-container-lowest p-8 sm:p-10 rounded-2xl shadow-sm border border-outline-variant/20">
                    <div class="mb-8 text-center sm:text-left">
                        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md bg-surface-container text-primary font-body-bold text-label-md mb-2">
                            <span class="material-symbols-outlined text-[16px] text-accent">account_balance</span>
                            <span>TRANSPARANSI KEUANGAN</span>
                        </div>
                        <h2 class="font-headline-lg text-headline-lg text-on-surface tracking-tight border-b-accent inline-block sm:block pb-1">Akuntabilitas APBDes</h2>
                        <p class="font-body-md text-body-md text-on-surface-variant mt-3">Pengelolaan keuangan desa yang terbuka dan dapat dipertanggungjawabkan.</p>
                    </div>
                    <?php echo $__env->make('theme::partials.apbdesa', $transparansi, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </section>
        <?php endif; ?>

        
        <section id="beranda-pembangunan-wrap" class="reveal max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full hidden">
            <div class="bg-surface-container-lowest p-8 sm:p-10 rounded-2xl shadow-sm border border-outline-variant/20">
                <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
                    <div>
                        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md bg-surface-container text-primary font-body-bold text-label-md mb-2">
                            <span class="material-symbols-outlined text-[16px] text-accent">construction</span>
                            <span>PEMBANGUNAN</span>
                        </div>
                        <h2 class="font-headline-lg text-headline-lg text-on-surface tracking-tight">Pembangunan <?php echo e(ucfirst(setting('sebutan_desa'))); ?></h2>
                    </div>
                    <a href="<?php echo e(site_url('pembangunan')); ?>" class="inline-flex items-center gap-1 text-primary hover:text-accent font-body-bold text-label-lg transition-colors">
                        <span>Semua Pembangunan</span>
                        <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                    </a>
                </div>
                <div id="beranda-pembangunan" class="reveal-stagger grid grid-cols-1 md:grid-cols-3 gap-6"></div>
            </div>
        </section>

        
        <?php
            $daftarGaleri = collect($w_gal ?? [])->filter(fn ($g) => !empty($g['gambar']) && is_file(LOKASI_GALERI . 'sedang_' . $g['gambar']))->take(4);
        ?>
        <?php if($daftarGaleri->count() > 0): ?>
            
            <div class="bg-parallax w-full py-16" style="background-image: url('<?php echo e($heroImg); ?>');">
                <section class="reveal max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 w-full">
                    <div class="flex items-center justify-between mb-8 border-b-2 border-outline-variant/20 pb-4">
                        <div>
                            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md bg-surface-container-high text-primary font-body-bold text-label-md mb-2">
                                <span class="material-symbols-outlined text-[16px] text-accent">photo_library</span>
                                <span>Galeri</span>
                            </div>
                            <h2 class="font-headline-lg text-headline-lg text-on-surface tracking-tight">Album Foto <?php echo e($namaDesa); ?></h2>
                        </div>
                        <a href="<?php echo e(site_url('galeri')); ?>" class="inline-flex items-center gap-1 text-primary hover:text-accent font-body-bold text-label-lg transition-colors group">
                            <span>Semua Album</span>
                            <span class="material-symbols-outlined text-[18px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
                        </a>
                    </div>
                    <div class="reveal-stagger grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <?php $__currentLoopData = $daftarGaleri; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $album): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('web.galeri.detail', $album['id'])); ?>" class="relative group rounded-2xl overflow-hidden h-64 sm:h-80 shadow-md block bg-surface-container">
                                <img src="<?php echo e(AmbilGaleri($album['gambar'], 'sedang')); ?>" alt="<?php echo e($album['nama']); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/20 to-transparent opacity-80 group-hover:opacity-100 transition-opacity flex flex-col justify-end p-5">
                                    <h4 class="font-body-bold text-body-bold text-white pl-2"><?php echo e($album['nama']); ?></h4>
                                </div>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </section>
            </div>
        <?php endif; ?>

        
        <?php
            $hariKerja = collect($jam_kerja ?? [])->where('status', true)->take(3);
            $jamPendek = fn ($t) => substr((string) $t, 0, 5);
            $waLink = collect($sosmed ?? [])->first(fn ($s) => strtolower($s['nama'] ?? '') === 'whatsapp' && !empty($s['link']))['link'] ?? null;
            $adaKontak = !empty($desa['telepon']) || !empty($desa['email_desa']) || $waLink;
        ?>
        <section class="reveal w-full bg-primary text-on-primary py-16 px-4 sm:px-6 lg:px-8 mt-6" id="pengaduan-kontak">
            <div class="max-w-[1200px] mx-auto relative z-10">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10 pb-8 border-b border-white/20">
                    <div>
                        <span class="font-label-md text-label-md text-accent font-bold uppercase tracking-wider block mb-2">PUSAT BANTUAN &amp; ASPIRASI WARGA</span>
                        <h2 class="font-headline-xl text-headline-xl text-surface-bright tracking-tight">Ada Pertanyaan atau Kendala Administrasi?</h2>
                        <p class="font-body-lg text-body-lg text-surface-bright/80 mt-2">Kami siap melayani kebutuhan warga <?php echo e($namaDesa); ?>.</p>
                    </div>
                    <?php if($hariKerja->count() > 0): ?>
                        <div class="px-5 py-4 rounded-xl bg-white/10 backdrop-blur-md text-surface-bright flex flex-col items-start md:items-end flex-shrink-0 border border-white/20 shadow-lg">
                            <span class="font-caption text-caption text-accent font-semibold mb-1">Jam Pelayanan Kantor:</span>
                            <?php $__currentLoopData = $hariKerja; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hari): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="font-body-bold text-caption"><?php echo e($hari->nama_hari); ?>: <?php echo e($jamPendek($hari->jam_masuk)); ?> - <?php echo e($jamPendek($hari->jam_keluar)); ?></span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="reveal-stagger grid grid-cols-1 <?php echo e($adaKontak ? 'md:grid-cols-3' : 'md:grid-cols-2'); ?> gap-6">
                    <div class="p-6 rounded-2xl bg-surface-container-lowest text-on-surface shadow-xl hover:-translate-y-2 transition-transform duration-300 flex flex-col justify-between">
                        <div>
                            <div class="w-12 h-12 rounded-xl bg-surface-container-low text-primary flex items-center justify-center mb-4"><span class="material-symbols-outlined text-[26px]">home_work</span></div>
                            <h3 class="font-headline-sm text-headline-sm text-on-surface mb-2">Kantor <?php echo e(ucfirst(setting('sebutan_desa'))); ?></h3>
                            <p class="font-caption text-caption text-on-surface-variant leading-relaxed mb-4">
                                <?php echo e($desa['alamat_kantor'] ?: $lokasiDesa); ?><?php if(!empty($desa['kode_pos'])): ?>, Kode Pos <?php echo e($desa['kode_pos']); ?><?php endif; ?>
                            </p>
                        </div>
                        <a href="<?php echo e(site_url('peta')); ?>" class="inline-flex items-center gap-1.5 text-primary hover:text-accent font-body-bold text-label-md transition-colors">Lihat Lokasi <span class="material-symbols-outlined text-[16px]">arrow_forward</span></a>
                    </div>
                    <?php if($adaKontak): ?>
                    <div class="p-6 rounded-2xl bg-surface-container-lowest text-on-surface shadow-xl hover:-translate-y-2 transition-transform duration-300 flex flex-col justify-between border-t-4 border-t-accent">
                        <div>
                            <div class="w-12 h-12 rounded-xl bg-surface-container-low text-primary flex items-center justify-center mb-4"><span class="material-symbols-outlined text-[26px]">call</span></div>
                            <h3 class="font-headline-sm text-headline-sm text-on-surface mb-2">Hubungi Kami</h3>
                            <div class="font-caption text-caption text-on-surface-variant leading-relaxed mb-4 space-y-1">
                                <?php if(!empty($desa['telepon'])): ?><p>Telepon: <span class="font-semibold"><?php echo e($desa['telepon']); ?></span></p><?php endif; ?>
                                <?php if(!empty($desa['email_desa'])): ?><p>Email: <span class="font-semibold"><?php echo e($desa['email_desa']); ?></span></p><?php endif; ?>
                            </div>
                        </div>
                        <?php if($waLink): ?>
                            <a href="<?php echo e($waLink); ?>" target="_blank" rel="noopener" class="inline-flex items-center gap-1.5 text-green-600 hover:text-green-700 font-body-bold text-label-md transition-colors">Chat WhatsApp <span class="material-symbols-outlined text-[16px]">chat</span></a>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                    <div class="p-6 rounded-2xl bg-surface-container-lowest text-on-surface shadow-xl hover:-translate-y-2 transition-transform duration-300 flex flex-col justify-between">
                        <div>
                            <div class="w-12 h-12 rounded-xl bg-surface-container-low text-primary flex items-center justify-center mb-4"><span class="material-symbols-outlined text-[26px]">campaign</span></div>
                            <h3 class="font-headline-sm text-headline-sm text-on-surface mb-2">Pengaduan Warga</h3>
                            <p class="font-caption text-caption text-on-surface-variant leading-relaxed mb-4">Sampaikan pengaduan atau aspirasi Anda secara online kepada pemerintah <?php echo e(setting('sebutan_desa')); ?>.</p>
                        </div>
                        <a href="<?php echo e(site_url('pengaduan')); ?>" class="inline-flex items-center gap-1.5 text-primary hover:text-accent font-body-bold text-label-md transition-colors">Buat Pengaduan <span class="material-symbols-outlined text-[16px]">arrow_forward</span></a>
                    </div>
                </div>
            </div>

        </section>
    <?php else: ?>
        
        <section class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full">
            <nav aria-label="Jalur Navigasi" class="pb-4">
                <ol class="flex items-center flex-wrap gap-2 font-caption text-caption text-on-surface-variant">
                    <li><a class="hover:text-primary transition-colors flex items-center gap-1" href="<?php echo e(site_url('/')); ?>"><span class="material-symbols-outlined text-[16px]">home</span><span>Beranda</span></a></li>
                    <li class="text-outline-variant">&bull;</li>
                    <li class="text-on-surface font-medium"><?php echo e($title); ?></li>
                </ol>
            </nav>
            <div class="flex items-center justify-between mb-8 border-b-2 border-outline-variant/30 pb-4">
                <h1 class="font-headline-lg text-headline-lg text-on-surface tracking-tight border-b-accent inline-block pb-1"><?php echo e($title); ?></h1>
                <a href="<?php echo e(site_url('arsip')); ?>" class="inline-flex items-center gap-1 text-primary hover:text-accent font-body-bold text-label-lg transition-colors group">Indeks <span class="material-symbols-outlined text-[18px] group-hover:translate-x-1 transition-transform">chevron_right</span></a>
            </div>

            <?php if($artikel->count() > 0): ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php $__currentLoopData = $artikel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make('theme::partials.artikel.card', ['post' => $post], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="pagination flex-wrap w-full mt-8">
                    <?php echo $__env->make('theme::commons.paging', ['paging_page' => $paging_page], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            <?php else: ?>
                <?php echo $__env->make('theme::partials.artikel.empty', ['title' => $title], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        </section>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php if($isBeranda): ?>
    <?php $__env->startPush('scripts'); ?>
        <script type="text/javascript">
            (function () {
                var wrap = document.getElementById('beranda-pembangunan-wrap');
                var list = document.getElementById('beranda-pembangunan');
                if (!wrap || !list) return;

                function esc(s) {
                    return String(s == null ? '' : s).replace(/[&<>"']/g, function (c) {
                        return {'&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;'}[c];
                    });
                }

                fetch("<?php echo e(route('api.pembangunan')); ?>?page[size]=3", {headers: {'Accept': 'application/json'}})
                    .then(function (r) { return r.json(); })
                    .then(function (res) {
                        var items = (res && res.data) || [];
                        if (!items.length) return;

                        items.forEach(function (item) {
                            var a = item.attributes || {};
                            var url = SITE_URL + 'pembangunan/' + a.slug;
                            var dok = a.pembangunan_dokumentasi || [];
                            var persen = 0;
                            dok.forEach(function (d) {
                                var p = parseInt(String(d.persentase).replace('%', ''), 10);
                                if (!isNaN(p) && p > persen) persen = p;
                            });
                            var progres = dok.length
                                ? '<div><div class="flex justify-between font-caption text-caption text-on-surface-variant mb-1"><span>Progres</span><span class="font-body-bold text-primary">' + persen + '%</span></div>' +
                                  '<div class="w-full h-2 rounded-md bg-surface-container-high overflow-hidden"><div class="h-full bg-primary rounded-md" style="width:' + persen + '%"></div></div></div>'
                                : '';

                            list.insertAdjacentHTML('beforeend',
                                '<a href="' + esc(url) + '" class="group bg-surface-container-low rounded-2xl overflow-hidden hover:shadow-lg transition-all flex flex-col hover:-translate-y-1">' +
                                    '<div class="h-44 overflow-hidden bg-surface-container"><img src="' + esc(a.foto) + '" alt="Foto Pembangunan" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"></div>' +
                                    '<div class="p-5 flex flex-col gap-3 flex-grow">' +
                                        '<h3 class="font-body-bold text-body-bold text-on-surface line-clamp-2 group-hover:text-primary transition-colors">' + esc(a.judul) + '</h3>' +
                                        '<div class="font-caption text-caption text-on-surface-variant space-y-1">' +
                                            '<div class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px] text-accent">event</span> ' + esc(a.tahun_anggaran) + '</div>' +
                                            '<div class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px] text-accent">location_on</span> ' + esc(a.lokasi) + '</div>' +
                                        '</div>' +
                                        progres +
                                    '</div>' +
                                '</a>');
                        });
                        wrap.classList.remove('hidden');
                    })
                    .catch(function () { /* section tetap tersembunyi jika API gagal */ });
            })();
        </script>

        <script type="text/javascript">
            // Animasi muncul saat di-scroll. Dimatikan otomatis bila pengguna memilih "kurangi gerakan".
            (function () {
                var kurangiGerak = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
                var els = document.querySelectorAll('.reveal, .reveal-stagger');
                if (kurangiGerak || !('IntersectionObserver' in window) || !els.length) return;

                document.documentElement.classList.add('js-reveal');
                els.forEach(function (el) {
                    if (el.classList.contains('reveal-stagger')) {
                        Array.prototype.forEach.call(el.children, function (anak, i) {
                            anak.style.setProperty('--i', Math.min(i, 8));
                        });
                    }
                });

                var pengamat = new IntersectionObserver(function (daftar) {
                    daftar.forEach(function (e) {
                        if (e.isIntersecting) {
                            e.target.classList.add('is-visible');
                            pengamat.unobserve(e.target);
                        }
                    });
                }, { threshold: 0.12, rootMargin: '0px 0px -6% 0px' });

                els.forEach(function (el) { pengamat.observe(el); });
            })();
        </script>
    <?php $__env->stopPush(); ?>
<?php endif; ?>
<?php echo $__env->make('theme::layouts.full-width', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\opensid\/desa/themes/temaku/resources/views/partials/artikel/index.blade.php ENDPATH**/ ?>