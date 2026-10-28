<?php
    $smd_nama_desa = ucwords(setting('sebutan_desa')) . ' ' . ucwords($desa['nama_desa']);
    $smd_lokasi = ucfirst(setting('sebutan_kecamatan_singkat')) . ' ' . ucwords($desa['nama_kecamatan']) . ', ' . ucfirst(setting('sebutan_kabupaten_singkat')) . ' ' . ucwords($desa['nama_kabupaten']);
    $smd_beranda = !request()->segment(1) && empty($cari ?? null);
?>


<div class="smd-topbar">
    <div class="smd-container smd-topbar__inner">
        <div class="smd-topbar__info">
            <span><i class="far fa-calendar-alt" aria-hidden="true"></i> <?php echo e(tgl_indo(date('Y-m-d'))); ?></span>
            <span class="smd-clock" data-smd-clock hidden><i class="far fa-clock" aria-hidden="true"></i> <time></time></span>
            <?php if(!empty($desa['telepon'])): ?>
                <a href="tel:<?php echo e(preg_replace('/[^0-9+]/', '', $desa['telepon'])); ?>" class="smd-hide-sm"><i class="fas fa-phone-alt" aria-hidden="true"></i> <?php echo e($desa['telepon']); ?></a>
            <?php endif; ?>
            <?php if(!empty($desa['email_desa'])): ?>
                <a href="mailto:<?php echo e($desa['email_desa']); ?>" class="smd-hide-sm"><i class="far fa-envelope" aria-hidden="true"></i> <?php echo e($desa['email_desa']); ?></a>
            <?php endif; ?>
        </div>
        <div class="smd-topbar__links">
            <?php if(setting('layanan_mandiri') == 1): ?>
                <a href="<?php echo e(site_url('layanan-mandiri')); ?>"><i class="fas fa-id-card" aria-hidden="true"></i> Layanan Mandiri</a>
            <?php endif; ?>
            <a href="<?php echo e(site_url('siteman')); ?>"><i class="fas fa-sign-in-alt" aria-hidden="true"></i> Login Admin</a>
        </div>
    </div>
</div>


<header class="smd-navbar" id="smd-navbar">
    <div class="smd-container smd-navbar__inner">
        <a href="<?php echo e(site_url('/')); ?>" class="smd-brand" title="Beranda <?php echo e($smd_nama_desa); ?>">
            <img src="<?php echo e(gambar_desa($desa['logo'])); ?>" alt="Logo <?php echo e($smd_nama_desa); ?>" class="smd-brand__logo">
            <span class="smd-brand__text">
                <span class="smd-brand__name"><?php echo e($smd_nama_desa); ?></span>
                <span class="smd-brand__loc"><?php echo e($smd_lokasi); ?></span>
            </span>
        </a>

        <?php echo $__env->make('theme::commons.main_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="smd-navbar__actions">
            <button type="button" class="smd-iconbtn" data-smd-toggle="search" aria-controls="smd-search" aria-expanded="false" aria-label="Cari">
                <i class="fas fa-search" aria-hidden="true"></i>
            </button>
            <button type="button" class="smd-iconbtn smd-burger" data-smd-toggle="drawer" aria-controls="smd-drawer" aria-expanded="false" aria-label="Buka menu">
                <i class="fas fa-bars" aria-hidden="true"></i>
            </button>
        </div>
    </div>

    <div class="smd-search" id="smd-search" hidden>
        <form action="<?php echo e(site_url('/')); ?>" method="get" role="search" class="smd-container smd-search__form">
            <i class="fas fa-search" aria-hidden="true"></i>
            <input type="search" name="cari" placeholder="Cari berita, pengumuman, informasi..." aria-label="Kata kunci pencarian" value="<?php echo e($cari ?? ''); ?>">
            <button type="submit" class="smd-btn smd-btn--primary">Cari</button>
        </form>
    </div>
</header>

<?php echo $__env->make('theme::commons.mobile_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php if($smd_beranda && theme_config('tampilkan_banner', '1') == '1'): ?>
    <?php
        // Angka ringkas untuk bilah statistik: penduduk (dari statistik jenis kelamin) & pengunjung
        $smd_baris = collect($stat_widget ?? [])->map(static fn ($r) => is_array($r) ? $r : (method_exists($r, 'toArray') ? $r->toArray() : (array) $r));
        $smd_cari_baris = static fn ($kata) => $smd_baris->first(static fn ($r) => str_contains(strtoupper($r['nama'] ?? ''), $kata));
        $smd_total = $smd_cari_baris('TOTAL') ?? $smd_cari_baris('JUMLAH');
        $smd_angka = [];
        if ($smd_total || $smd_baris->isNotEmpty()) {
            $smd_angka[] = ['nilai' => (int) ($smd_total['jumlah'] ?? $smd_baris->sum('jumlah')), 'label' => 'Penduduk', 'ikon' => 'fa-users'];
        }
        if ($smd_lk = $smd_cari_baris('LAKI')) {
            $smd_angka[] = ['nilai' => (int) $smd_lk['jumlah'], 'label' => 'Laki-laki', 'ikon' => 'fa-male'];
        }
        if ($smd_pr = $smd_cari_baris('PEREMPUAN')) {
            $smd_angka[] = ['nilai' => (int) $smd_pr['jumlah'], 'label' => 'Perempuan', 'ikon' => 'fa-female'];
        }
        if (isset($statistik_pengunjung['total'])) {
            $smd_angka[] = ['nilai' => (int) $statistik_pengunjung['total'], 'label' => 'Pengunjung', 'ikon' => 'fa-globe-asia'];
        }
        $smd_kata = array_values(array_filter(array_map('trim', explode(',', (string) theme_config('kata_berganti', 'Melayani, Transparan, Inovatif, Berdaya')))));

        // Latar banner: gambar latar website, disusul gambar slider (berganti otomatis)
        $smd_latar = array_filter([$latar_website ?? null]);
        foreach (array_slice($slider_gambar['gambar'] ?? [], 0, 4) as $smd_slide) {
            $smd_img = ($slider_gambar['lokasi'] ?? '') . 'sedang_' . $smd_slide['gambar'];
            if (is_file($smd_img)) {
                $smd_latar[] = base_url($smd_img);
            }
        }
        $smd_latar = array_values($smd_latar);

        // Kartu kaca: status pelayanan kantor hari ini dari Jam Kerja
        $smd_hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'][(int) date('w')];
        $smd_normal = static fn ($t) => strtolower(preg_replace('/[^a-z]/i', '', (string) $t));
        $smd_jam = collect($jam_kerja ?? [])->first(static fn ($j) => $smd_normal(data_get($j, 'nama_hari')) === $smd_normal($smd_hari));
        $smd_buka = $smd_jam && data_get($smd_jam, 'status');
        $smd_jam_masuk = $smd_buka ? substr((string) data_get($smd_jam, 'jam_masuk'), 0, 5) : null;
        $smd_jam_keluar = $smd_buka ? substr((string) data_get($smd_jam, 'jam_keluar'), 0, 5) : null;

        // Foto perangkat desa untuk deretan avatar
        $smd_perangkat = array_slice(array_values(array_filter($aparatur_desa['daftar_perangkat'] ?? [], static fn ($a) => !empty($a['foto']))), 0, 4);
        $smd_jumlah_perangkat = count($aparatur_desa['daftar_perangkat'] ?? []);
    ?>
    <section class="smd-hero smd-hero--glass" aria-label="Sambutan">
        <div class="smd-hero__media" aria-hidden="true">
            <div class="smd-hero__bg">
                <?php $__empty_1 = true; $__currentLoopData = $smd_latar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $smd_i => $smd_src): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="smd-hero__slide <?php echo e($smd_i === 0 ? 'is-active is-zoom' : ''); ?>" style="background-image: url('<?php echo e($smd_src); ?>');"></div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="smd-hero__slide is-active is-zoom"></div>
                <?php endif; ?>
            </div>
            <div class="smd-hero__shade"></div>
            
            <div class="smd-hero__veil"></div>
        </div>

        <div class="smd-container smd-hero__inner">
            <div class="smd-hero__text">
                <span class="smd-hero__eyebrow smd-enter" style="--d: 0ms"><span class="smd-dot" aria-hidden="true"></span><?php echo e(theme_config('teks_sambutan', 'Selamat Datang di Website Resmi')); ?></span>
                <h1 class="smd-hero__title smd-enter" style="--d: 120ms"><?php echo e($smd_nama_desa); ?></h1>
                <?php if(count($smd_kata) > 0): ?>
                    <p class="smd-hero__tagline smd-enter" style="--d: 220ms">
                        Bersama membangun <?php echo e(setting('sebutan_desa')); ?> yang
                        <span class="smd-rotator" data-words="<?php echo e(implode('|', $smd_kata)); ?>"><span class="smd-rotator__word"><?php echo e($smd_kata[0]); ?></span></span>
                    </p>
                <?php endif; ?>
                <p class="smd-hero__loc smd-enter" style="--d: 300ms">
                    <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                    <?php echo e($smd_lokasi); ?>, Provinsi <?php echo e(ucwords($desa['nama_propinsi'])); ?>

                </p>
                <div class="smd-hero__cta smd-enter" style="--d: 400ms">
                    <a href="#smd-kabar" class="smd-btn smd-btn--primary smd-btn--lg">Jelajahi Kabar <?php echo e(ucwords(setting('sebutan_desa'))); ?></a>
                    <a href="<?php echo e(site_url('data-statistik/jenis-kelamin')); ?>" class="smd-btn smd-btn--glass smd-btn--lg">Lihat Data <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
                </div>
                <?php if(count($smd_perangkat) > 0): ?>
                    <div class="smd-hero__proof smd-enter" style="--d: 500ms">
                        <span class="smd-avatars">
                            <?php $__currentLoopData = $smd_perangkat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $smd_p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <img src="<?php echo e($smd_p['foto']); ?>" alt="<?php echo e($smd_p['nama']); ?>" title="<?php echo e($smd_p['nama']); ?>">
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </span>
                        <span><strong><?php echo e($smd_jumlah_perangkat); ?> perangkat <?php echo e(setting('sebutan_desa')); ?></strong><br>siap melayani Anda</span>
                    </div>
                <?php elseif(isset($statistik_pengunjung['hari_ini'])): ?>
                    <div class="smd-hero__proof smd-enter" style="--d: 500ms">
                        <span class="smd-hero__proof-icon"><i class="fas fa-signal" aria-hidden="true"></i></span>
                        <span><strong><?php echo e(number_format((int) $statistik_pengunjung['hari_ini'], 0, ',', '.')); ?> kunjungan</strong><br>ke website hari ini</span>
                    </div>
                <?php endif; ?>
            </div>

            
            <div class="smd-hero__cardwrap smd-enter" style="--d: 300ms">
                <aside class="smd-glass smd-hero__card" aria-label="Pelayanan kantor hari ini">
                    <div class="smd-hero__card-top">
                        <span><i class="fas fa-landmark" aria-hidden="true"></i> Kantor <?php echo e(ucwords(setting('sebutan_desa'))); ?></span>
                        <i class="fas fa-chevron-down" aria-hidden="true"></i>
                    </div>
                    <?php if($smd_buka): ?>
                        <p class="smd-hero__card-title" data-smd-office data-buka="<?php echo e($smd_jam_masuk); ?>" data-tutup="<?php echo e($smd_jam_keluar); ?>">
                            <span class="smd-status smd-status--open"></span><span data-smd-office-text>Buka Hari Ini</span>
                        </p>
                        <p class="smd-hero__card-sub"><?php echo e($smd_hari); ?>, <?php echo e(tgl_indo(date('Y-m-d'))); ?></p>
                        <div class="smd-hero__card-line"></div>
                        <p class="smd-hero__card-label">Jam pelayanan</p>
                        <p class="smd-hero__card-big"><?php echo e(str_replace(':', '.', $smd_jam_masuk)); ?><small>&ndash;<?php echo e(str_replace(':', '.', $smd_jam_keluar)); ?></small></p>
                    <?php elseif($smd_jam): ?>
                        <p class="smd-hero__card-title"><span class="smd-status smd-status--closed"></span>Libur Hari Ini</p>
                        <p class="smd-hero__card-sub"><?php echo e($smd_hari); ?>, <?php echo e(tgl_indo(date('Y-m-d'))); ?></p>
                        <div class="smd-hero__card-line"></div>
                        <p class="smd-hero__card-label">Layanan online tetap tersedia</p>
                        <p class="smd-hero__card-big">24<small>/7</small></p>
                    <?php else: ?>
                        <p class="smd-hero__card-title">Layanan Publik</p>
                        <p class="smd-hero__card-sub"><?php echo e($desa['alamat_kantor'] ?? $smd_lokasi); ?></p>
                        <div class="smd-hero__card-line"></div>
                        <p class="smd-hero__card-label">Layanan online</p>
                        <p class="smd-hero__card-big">24<small>/7</small></p>
                    <?php endif; ?>
                    <?php if(setting('layanan_mandiri') == 1): ?>
                        <a href="<?php echo e(site_url('layanan-mandiri')); ?>" class="smd-btn smd-btn--white smd-btn--block">Ajukan Surat Online</a>
                    <?php elseif(!empty($desa['telepon'])): ?>
                        <a href="tel:<?php echo e(preg_replace('/[^0-9+]/', '', $desa['telepon'])); ?>" class="smd-btn smd-btn--white smd-btn--block">Hubungi Kantor</a>
                    <?php endif; ?>
                </aside>
            </div>
        </div>

        <?php if(theme_config('tampilkan_statistik', '1') == '1' && count($smd_angka) > 0): ?>
            <div class="smd-container smd-hero__bar">
                <div class="smd-glass smd-statbar smd-enter" style="--d: 600ms" role="list" aria-label="Angka <?php echo e(setting('sebutan_desa')); ?>">
                    <?php $__currentLoopData = $smd_angka; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $angka): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="smd-statbar__item" role="listitem">
                            <span class="smd-statbar__icon"><i class="fas <?php echo e($angka['ikon']); ?>" aria-hidden="true"></i></span>
                            <div>
                                <strong class="smd-statbar__num" data-count="<?php echo e($angka['nilai']); ?>"><?php echo e(number_format($angka['nilai'], 0, ',', '.')); ?></strong>
                                <span class="smd-statbar__label"><?php echo e($angka['label']); ?></span>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>
    </section>
<?php endif; ?>

<?php if($teks_berjalan): ?>
    <div class="smd-container">
        <div class="smd-ticker" role="region" aria-label="Info terkini">
            <span class="smd-ticker__label"><i class="fas fa-bullhorn" aria-hidden="true"></i> Info</span>
            <div class="smd-ticker__viewport">
                <div class="smd-ticker__track">
                    <?php for($smd_ulang = 0; $smd_ulang < 2; $smd_ulang++): ?>
                        <?php $__currentLoopData = $teks_berjalan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $marquee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span class="smd-ticker__item" <?php if($smd_ulang): ?> aria-hidden="true" <?php endif; ?>>
                                <?php echo e($marquee['teks']); ?>

                                <?php if(trim($marquee['tautan']) && $marquee['judul_tautan']): ?>
                                    <a href="<?php echo e($marquee['tautan']); ?>" <?php if($smd_ulang): ?> tabindex="-1" <?php endif; ?>><?php echo e($marquee['judul_tautan']); ?></a>
                                <?php endif; ?>
                            </span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php /**PATH C:\xampp\htdocs\opensid\/desa/themes/samudra/resources/views/commons/header.blade.php ENDPATH**/ ?>