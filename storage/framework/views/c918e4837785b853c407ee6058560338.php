

<style>
    /* Container Utama Header Sticky untuk Semua Layar */
    .guwang-header {
        position: -webkit-sticky !important;
        position: sticky !important;
        top: 0 !important;
        z-index: 1000 !important;
        background-color: #ffffff;
        border-bottom: 1px solid #e2e8f0;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        transition: background-color 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
    }

    /* Efek bayangan lebih tegas saat halaman di-scroll */
    .guwang-header.is-scrolled {
        box-shadow: 0 6px 20px rgba(15, 23, 42, 0.12) !important;
        border-bottom-color: transparent !important;
    }

    html.dark .guwang-header.is-scrolled {
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.45) !important;
    }
    
    html.dark .guwang-header {
        background-color: #0b1220 !important;
        border-bottom-color: #1e293b !important;
    }

    .guwang-header-inner {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 24px;
        height: 82px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
    }

    /* 1. Kiri: Identitas Desa */
    .guwang-brand {
        display: flex;
        align-items: center;
        gap: 12px;
        text-decoration: none;
        flex-shrink: 0;
    }
    .guwang-brand img {
        height: 46px;
        width: auto;
        object-fit: contain;
    }
    .guwang-brand-title {
        color: #0f172a;
        font-weight: 700;
        font-size: 16px;
        line-height: 1.25;
        text-transform: uppercase;
        display: block;
    }
    .guwang-brand-sub {
        color: #64748b;
        font-weight: 500;
        font-size: 12px;
        line-height: 1.25;
        text-transform: uppercase;
        display: block;
    }
    html.dark .guwang-brand-title { color: #f8fafc !important; }
    html.dark .guwang-brand-sub { color: #94a3b8 !important; }

    /* 2. Tengah: Navigasi Desktop */
    .guwang-desktop-nav {
        display: none;
        flex: 1 1 auto;
        justify-content: center;
        align-items: center;
        gap: 4px;
    }
    @media (min-width: 1024px) {
        .guwang-desktop-nav {
            display: flex !important;
        }
        .guwang-mobile-btn {
            display: none !important;
        }
    }

    .guwang-nav-item {
        position: relative;
        display: inline-flex;
        align-items: center;
        padding: 20px 0; /* Area bantalan vertikal agar hover tidak putus */
    }

    .guwang-nav-link {
        color: #475569;
        font-size: 14px;
        font-weight: 500;
        padding: 8px 12px;
        border-radius: 8px;
        text-decoration: none;
        transition: color 0.2s ease, background-color 0.2s ease;
        white-space: nowrap;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
    .guwang-nav-link:hover,
    .guwang-nav-item:hover > .guwang-nav-link {
        color: #006496;
        background-color: #f1f5f9;
    }
    html.dark .guwang-nav-link { color: #cbd5e1 !important; }
    html.dark .guwang-nav-link:hover,
    html.dark .guwang-nav-item:hover > .guwang-nav-link {
        color: #38bdf8 !important;
        background-color: #141d30 !important;
    }

    /* ========================================================
       DROPDOWN STANDAR & BERTINGKAT
       ======================================================== */
    .guwang-dropdown {
        position: absolute;
        top: 100%;
        left: 0;
        min-width: 220px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(15, 23, 42, 0.1);
        padding: 8px;
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
        transform: translateY(8px);
        transition: all 0.2s ease;
        z-index: 60;
    }

    /* Jembatan transparan di atas dropdown agar kursor tidak kehilangan trigger hover */
    .guwang-dropdown::before {
        content: '';
        position: absolute;
        top: -16px;
        left: 0;
        width: 100%;
        height: 16px;
        background: transparent;
    }

    .guwang-nav-item:hover > .guwang-dropdown {
        opacity: 1;
        visibility: visible;
        pointer-events: auto;
        transform: translateY(0);
    }

    html.dark .guwang-dropdown {
        background: #141d30 !important;
        border-color: #2a3650 !important;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.45);
    }

    .guwang-dropdown a,
    .guwang-dropdown-link {
        display: block;
        padding: 8px 12px;
        font-size: 13.5px;
        font-weight: 500;
        color: #475569;
        border-radius: 8px;
        text-decoration: none;
        white-space: nowrap;
        transition: background-color 0.15s ease, color 0.15s ease;
    }
    .guwang-dropdown a:hover,
    .guwang-dropdown-link:hover {
        background-color: #f1f5f9;
        color: #006496;
    }
    html.dark .guwang-dropdown a,
    html.dark .guwang-dropdown-link { color: #cbd5e1 !important; }
    html.dark .guwang-dropdown a:hover,
    html.dark .guwang-dropdown-link:hover {
        background-color: #1e293b !important;
        color: #38bdf8 !important;
    }

    /* Submenu Bertingkat (Flyout ke samping) */
    .guwang-sub-item {
        position: relative;
    }
    .guwang-sub-link {
        display: flex !important;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
    }
    .guwang-dropdown-sub {
        top: 0 !important;
        left: 100% !important;
        transform: translateX(6px) !important;
    }
    .guwang-sub-item:hover > .guwang-dropdown-sub {
        opacity: 1;
        visibility: visible;
        pointer-events: auto;
        transform: translateX(0) !important;
    }

    /* ========================================================
        MEGA MENU DROPDOWN
       ======================================================== */
    .guwang-dropdown.guwang-mega-menu {
        left: 50% !important;
        transform: translateX(-50%) translateY(8px) !important;
        width: max-content !important;
        max-width: 92vw !important;
        min-width: 680px !important;
        padding: 24px 28px !important;
        border-radius: 18px !important;
        border: 1px solid rgba(0, 0, 0, 0.08) !important;
        box-shadow: 0 20px 40px rgba(15, 23, 42, 0.16) !important;
    }

    .guwang-nav-item:hover > .guwang-dropdown.guwang-mega-menu {
        transform: translateX(-50%) translateY(0) !important;
    }

    .guwang-mega-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 28px;
        align-items: start;
    }

    .guwang-mega-col {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .guwang-mega-header {
        font-size: 13px;
        font-weight: 600;
        color: #94a3b8;
        letter-spacing: 0.02em;
        text-transform: capitalize;
        border-bottom: 1px solid #f1f5f9;
        padding-bottom: 8px;
        margin-bottom: 4px;
        display: block;
    }

    .guwang-mega-links {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .guwang-mega-item {
        font-size: 13.5px;
        font-weight: 500;
        color: #334155 !important;
        padding: 6px 10px !important;
        border-radius: 6px;
        line-height: 1.4 !important;
        text-decoration: none !important;
        transition: color 0.15s ease, background-color 0.15s ease, transform 0.15s ease;
        white-space: normal !important;
    }

    .guwang-mega-item:hover {
        color: #006496 !important;
        background-color: #f8fafc !important;
        transform: translateX(3px);
    }

    html.dark .guwang-dropdown.guwang-mega-menu {
        background: #101a2c !important;
        border-color: #2a3650 !important;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5) !important;
    }

    html.dark .guwang-mega-header {
        color: #64748b;
        border-bottom-color: #1e293b;
    }

    html.dark .guwang-mega-item {
        color: #cbd5e1 !important;
    }

    html.dark .guwang-mega-item:hover {
        color: #38bdf8 !important;
        background-color: #16243d !important;
    }

    /* Penataan Menu Sebelah Kanan agar Dropdown tidak terpotong tepi layar */
    .guwang-nav-item:nth-last-child(-n+2):not(:has(.guwang-mega-menu)) > .guwang-dropdown {
        left: auto !important;
        right: 0 !important;
    }
    .guwang-nav-item:nth-last-child(-n+2) .guwang-dropdown-sub {
        left: auto !important;
        right: 100% !important;
        transform: translateX(-6px) !important;
    }
    .guwang-nav-item:nth-last-child(-n+2) .guwang-sub-item:hover > .guwang-dropdown-sub {
        transform: translateX(0) !important;
    }

    /* 3. Kanan: Tombol Toggle Mode Gelap / Terang */
    .guwang-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-shrink: 0;
    }

    .guwang-theme-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 18px;
        border-radius: 9999px;
        background-color: #006496;
        color: #ffffff !important;
        font-weight: 700;
        font-size: 13.5px;
        border: 0;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(0, 100, 150, 0.25);
        transition: all 0.25s ease;
        white-space: nowrap;
    }
    .guwang-theme-pill:hover {
        background-color: #004b72;
        transform: translateY(-1px);
    }
    html.dark .guwang-theme-pill {
        background-color: #f59e0b !important;
        color: #0b1220 !important;
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
    }

    /* Tombol & Drawer Mobile */
    .guwang-mobile-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 8px;
        border-radius: 8px;
        color: #475569;
        background: transparent;
        border: 1px solid #e2e8f0;
        cursor: pointer;
    }
    html.dark .guwang-mobile-btn {
        color: #e2e8f0;
        border-color: #2a3650;
    }
    .guwang-mobile-drawer {
        border-top: 1px solid #e2e8f0;
        padding: 12px 20px;
        background: #ffffff;
    }
    html.dark .guwang-mobile-drawer {
        background: #0b1220;
        border-top-color: #1e293b;
    }

    /* ========================================================
        RESPONSIF IDENTITAS DESA PADA MOBILE
       ======================================================== */
    @media (max-width: 767.98px) {
        .guwang-header-inner {
            height: 68px; /* Sedikit perkecil tinggi header di HP */
            padding: 0 16px;
            gap: 10px;
        }

        .guwang-brand {
            gap: 8px;
            max-width: calc(100% - 130px); /* Beri ruang aman agar tidak menabrak tombol menu & mode gelap */
        }

        .guwang-brand img {
            height: 38px; /* Perkecil ukuran logo di layar HP */
        }

        .guwang-brand-title {
            font-size: 13px; /* Ukuran teks judul lebih proporsional */
            line-height: 1.2;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis; /* Potong dengan titik (...) jika teks terlalu panjang */
        }

        .guwang-brand-sub {
            font-size: 10px;
            line-height: 1.2;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Di layar HP, tombol mode gelap cukup tampilkan ikon agar hemat ruang */
        .guwang-theme-pill {
            padding: 7px 10px !important;
            font-size: 12px !important;
        }
        .guwang-theme-pill [data-tema-label] {
            display: none !important; /* Sembunyikan teks 'Mode Gelap' di HP, sisakan ikon */
        }
    }

    /* Penyesuaian khusus untuk layar sangat sempit (< 400px seperti iPhone SE / Android kecil) */
    @media (max-width: 400px) {
        .guwang-brand-sub {
            display: none; /* Sembunyikan info kecamatan & kabupaten agar tampilan tetap bersih */
        }

        .guwang-brand-title {
            font-size: 12.5px;
        }

        .guwang-brand img {
            height: 34px;
        }
    }
</style>

<header class="guwang-header relative lg:sticky lg:top-0 z-50">
    <div class="guwang-header-inner">

        
        <a href="<?php echo e(site_url('/')); ?>" class="guwang-brand">
            <img src="<?php echo e(gambar_desa($desa['logo'])); ?>"
                alt="Logo <?php echo e(ucfirst(setting('sebutan_desa')) . ' ' . ucwords($desa['nama_desa'])); ?>">
            <div class="min-w-0">
                <span class="guwang-brand-title">
                    <?php echo e(strtoupper(setting('sebutan_desa'))); ?> <?php echo e(strtoupper($desa['nama_desa'])); ?>

                </span>
                <span class="guwang-brand-sub">
                    <?php echo e(ucfirst(setting('sebutan_kecamatan_singkat'))); ?> <?php echo e(ucwords($desa['nama_kecamatan'])); ?>,
                    <?php echo e(ucfirst(setting('sebutan_kabupaten_singkat'))); ?> <?php echo e(ucwords($desa['nama_kabupaten'])); ?>

                </span>
            </div>
        </a>

        
        <nav aria-label="Menu Utama" class="guwang-desktop-nav">
            <div class="guwang-nav-item">
                <a href="<?php echo e(site_url('/')); ?>" class="guwang-nav-link">
                    <span class="material-symbols-outlined text-[18px]">home</span>
                    <span>Beranda</span>
                </a>
            </div>

            <?php $__currentLoopData = menu_tema(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $submenus = $menu['childrens'] ?? [];
                    $hasSubmenu = ! empty($submenus);
                    $linkUrl = $menu['link_url'] ?? $menu['link'] ?? '#';
                ?>
                <div class="guwang-nav-item">
                    <a href="<?php echo e($linkUrl); ?>" class="guwang-nav-link">
                        <span><?php echo $menu['nama']; ?></span>
                        <?php if($hasSubmenu): ?>
                            <span class="material-symbols-outlined text-[16px]" aria-hidden="true">expand_more</span>
                        <?php endif; ?>
                    </a>

                    
                    <?php if($hasSubmenu): ?>
                        <?php echo $__env->make('theme::commons.nav_dropdown', ['items' => $submenus, 'level' => 1], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php if(setting('layanan_mandiri') == 1): ?>
                <div class="guwang-nav-item">
                    <a href="<?php echo e(site_url('layanan-mandiri')); ?>" class="guwang-nav-link">
                        <span>Layanan Mandiri</span>
                    </a>
                </div>
            <?php endif; ?>
        </nav>

        
        <div class="guwang-actions">
            <button id="tema-toggle" type="button" title="Ganti mode gelap / terang" aria-label="Ganti mode gelap atau terang" aria-pressed="false" class="guwang-theme-pill">
                <!-- <span data-tema-label>Mode Gelap</span> -->
                <span class="material-symbols-outlined text-[18px]" data-tema-ikon aria-hidden="true">dark_mode</span>
            </button>

            <button id="mobile-menu-toggle" type="button" aria-label="Buka Menu" class="guwang-mobile-btn">
                <span class="material-symbols-outlined text-[22px]">menu</span>
            </button>
        </div>

    </div>

    
    <div id="mobile-menu-drawer" class="guwang-mobile-drawer hidden">
        <a href="<?php echo e(site_url('/')); ?>" class="block py-2 font-bold text-primary">Beranda</a>
        <?php $__currentLoopData = menu_tema(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $submenus = $menu['childrens'] ?? [];
                $linkUrl = $menu['link_url'] ?? $menu['link'] ?? '#';
            ?>
            <a href="<?php echo e($linkUrl); ?>" class="block py-2 font-medium"><?php echo $menu['nama']; ?></a>
            <?php if(! empty($submenus)): ?>
                <div class="pl-4 border-l border-gray-200 ml-2">
                    <?php echo $__env->make('theme::commons.nav_mobile', ['items' => $submenus], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if(setting('layanan_mandiri') == 1): ?>
            <a href="<?php echo e(site_url('layanan-mandiri')); ?>" class="block py-2 font-bold text-primary">Layanan Mandiri</a>
        <?php endif; ?>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var root = document.documentElement;

        /* ---- 1. Logika Mode Gelap / Terang ---- */
        var TEMA_KEY = 'temaku-tema';
        var mq = window.matchMedia ? window.matchMedia('(prefers-color-scheme: dark)') : null;
        
        function pilihanTema() {
            try {
                var t = localStorage.getItem(TEMA_KEY);
                return (t === 'gelap' || t === 'terang') ? t : 'auto';
            } catch (e) { return 'auto'; }
        }

        function terapkanTema(pilihan, animasi) {
            var gelap = pilihan === 'gelap' || (pilihan === 'auto' && mq && mq.matches);
            if (animasi) {
                root.classList.add('tema-transisi');
                setTimeout(function () { root.classList.remove('tema-transisi'); }, 350);
            }
            root.classList.toggle('dark', gelap);
            root.setAttribute('data-tema', pilihan);
            
            var tombol = document.getElementById('tema-toggle');
            if (tombol) {
                tombol.setAttribute('aria-pressed', gelap ? 'true' : 'false');
                var ikon = tombol.querySelector('[data-tema-ikon]');
                var label = tombol.querySelector('[data-tema-label]');
                if (ikon) ikon.textContent = gelap ? 'light_mode' : 'dark_mode';
                if (label) label.textContent = gelap ? 'Mode Terang' : 'Mode Gelap';
            }
        }

        var btnTema = document.getElementById('tema-toggle');
        if (btnTema) {
            btnTema.addEventListener('click', function () {
                var baru = root.classList.contains('dark') ? 'terang' : 'gelap';
                try { localStorage.setItem(TEMA_KEY, baru); } catch (e) {}
                terapkanTema(baru, true);
            });
        }

        if (mq) {
            var ikuti = function () { if (pilihanTema() === 'auto') { terapkanTema('auto', true); } };
            if (mq.addEventListener) { mq.addEventListener('change', ikuti); } else if (mq.addListener) { mq.addListener(ikuti); }
        }
        
        window.addEventListener('storage', function (e) { 
            if (e.key === TEMA_KEY) { terapkanTema(pilihanTema(), true); } 
        });
        
        terapkanTema(pilihanTema(), false);

        /* ---- 2. Toggle Menu Mobile ---- */
        var btnMobile = document.getElementById('mobile-menu-toggle');
        var drawerMobile = document.getElementById('mobile-menu-drawer');
        if (btnMobile && drawerMobile) {
            btnMobile.addEventListener('click', function () {
                drawerMobile.classList.toggle('hidden');
            });
        }
    });
</script><?php /**PATH D:\laragon\www\opensid\/desa/themes/temaku/resources/views/commons/header.blade.php ENDPATH**/ ?>