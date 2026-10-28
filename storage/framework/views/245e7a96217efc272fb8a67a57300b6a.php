<?php
    $smd_sebutan = ucwords(setting('sebutan_desa'));
    $smd_nama = $smd_sebutan . ' ' . ucwords($desa['nama_desa']);
    $smd_alt_slug = PREMIUM ? 'artikel' : 'first';
    $smd_mandiri = setting('layanan_mandiri') == 1;

    // Kabar: berita utama di depan, lalu artikel terbaru (tanpa duplikat)
    $smd_kabar = collect($artikel ?? []);
    if (!empty($headline) && !empty($headline['id'])) {
        $smd_kabar = $smd_kabar->reject(static fn ($a) => $a['id'] == $headline['id'])->prepend($headline);
    }
    $smd_kabar = $smd_kabar->values();
    $smd_n = $smd_kabar->count();
    // Kartu lebar dipakai agar baris terakhir grid 3 kolom tetap penuh
    $smd_lebar = $smd_n % 3 === 2 ? [0] : ($smd_n % 3 === 1 && $smd_n >= 4 ? [0, $smd_n - 1] : []);

    // Galeri
    $smd_galeri = collect($w_gal ?? [])->filter(static fn ($g) => is_file(LOKASI_GALERI . 'sedang_' . $g['gambar']))->take(4)->values();

    // Komentar warga
    $smd_komen = collect($komen ?? [])->filter(static fn ($k) => trim(strip_tags($k['komentar'] ?? '')) !== '')->take(9)->values();

    // Layanan (kartu kaca gelap)
    $smd_layanan = [];
    if ($smd_mandiri) {
        $smd_layanan[] = ['url' => site_url('layanan-mandiri'), 'ikon' => 'fa-id-card', 'judul' => 'Layanan Mandiri', 'ket' => 'Ajukan surat dan pantau statusnya dari rumah, tanpa antre.'];
    }
    $smd_layanan[] = ['url' => site_url('data-statistik/jenis-kelamin'), 'ikon' => 'fa-chart-pie', 'judul' => 'Data Statistik', 'ket' => 'Data kependudukan terbuka dan selalu diperbarui.'];
    $smd_layanan[] = ['url' => site_url('pembangunan'), 'ikon' => 'fa-hard-hat', 'judul' => 'Pembangunan', 'ket' => 'Pantau kegiatan pembangunan beserta anggarannya.'];
    $smd_layanan[] = ['url' => site_url('pengaduan'), 'ikon' => 'fa-comments', 'judul' => 'Pengaduan', 'ket' => 'Sampaikan aspirasi dan laporan, kami tindak lanjuti.'];
    if (count($smd_layanan) < 4) {
        $smd_layanan[] = ['url' => site_url('galeri'), 'ikon' => 'fa-images', 'judul' => 'Galeri', 'ket' => 'Dokumentasi kegiatan dan momen bersama warga.'];
    }

    // Transparansi APBDes
    $smd_apbdes = $transparansi['data_widget'] ?? [];
    $smd_rp = static function ($n) {
        $n = (float) $n;
        if ($n >= 1e9) return 'Rp ' . rtrim(rtrim(number_format($n / 1e9, 2, ',', '.'), '0'), ',') . ' M';
        if ($n >= 1e6) return 'Rp ' . rtrim(rtrim(number_format($n / 1e6, 1, ',', '.'), '0'), ',') . ' jt';
        return 'Rp ' . number_format($n, 0, ',', '.');
    };

    // Jam pelayanan untuk FAQ
    $smd_jam_teks = collect($jam_kerja ?? [])->filter(static fn ($j) => data_get($j, 'status'))
        ->map(static fn ($j) => data_get($j, 'nama_hari') . ' ' . str_replace(':', '.', substr((string) data_get($j, 'jam_masuk'), 0, 5)) . '–' . str_replace(':', '.', substr((string) data_get($j, 'jam_keluar'), 0, 5)))
        ->implode(', ');

    $smd_faq = [];
    $smd_faq[] = $smd_mandiri
        ? ['t' => 'Bagaimana cara mengurus surat secara online?', 'j' => 'Masuk ke Layanan Mandiri dengan NIK dan PIN dari operator ' . setting('sebutan_desa') . ', pilih jenis surat, lalu pantau statusnya hingga surat siap diambil.']
        : ['t' => 'Bagaimana cara mengurus surat?', 'j' => 'Datang ke kantor ' . setting('sebutan_desa') . ' dengan membawa KTP dan Kartu Keluarga. Petugas akan membantu sesuai jenis surat yang dibutuhkan.'];
    $smd_faq[] = ['t' => 'Kapan jam pelayanan kantor ' . setting('sebutan_desa') . '?', 'j' => $smd_jam_teks ? 'Pelayanan buka: ' . $smd_jam_teks . '.' : 'Silakan hubungi kantor ' . setting('sebutan_desa') . ' untuk jadwal pelayanan terbaru.'];
    $smd_faq[] = ['t' => 'Bagaimana menyampaikan pengaduan atau aspirasi?', 'j' => 'Buka menu Pengaduan, tulis laporan Anda beserta foto pendukung. Petugas akan menanggapi secara terbuka.'];
    $smd_faq[] = ['t' => 'Di mana melihat data penduduk dan anggaran?', 'j' => 'Data kependudukan ada di menu Statistik, sedangkan ringkasan APBDes tampil di bagian Transparansi Anggaran pada halaman ini.'];

    // Kontak untuk ajakan aksi
    $smd_wa = collect($sosmed ?? [])->first(static fn ($s) => !empty($s['link']) && str_contains(strtolower($s['nama'] ?? ''), 'whatsapp'));
    $smd_ada_peta = !empty($desa['lat']) && !empty($desa['lng']) && is_numeric($desa['lat']) && is_numeric($desa['lng']);
    $smd_latar_cta = $latar_website ?? null;

    // Widget yang sudah punya bagian sendiri di beranda tidak diulang
    $smd_lewati = array_filter([$smd_komen->isNotEmpty() ? 'komentar' : null, $smd_galeri->isNotEmpty() ? 'galeri' : null]);
    $smd_widget = collect($widgetAktif ?? [])->reject(static fn ($w) => in_array($w['isi'], $smd_lewati))->values();
?>


<section class="smd-section" id="smd-kabar">
    <div class="smd-container">
        <header class="smd-shead smd-shead--center">
            <span class="smd-shead__eyebrow">Kabar <?php echo e($smd_sebutan); ?></span>
            <h2 class="smd-shead__title">Jelajahi kabar terbaru dari <?php echo e($smd_nama); ?></h2>
        </header>

        <?php if($smd_n > 0): ?>
            <div class="smd-tiles">
                <?php $__currentLoopData = $smd_kabar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $smd_i => $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $smd_gambar = !empty($post['gambar']);
                        $smd_kat = $post['category']['kategori'] ?? ($post['kategori'] ?? null);
                    ?>
                    <article class="smd-tile smd-spotlight <?php echo e(in_array($smd_i, $smd_lebar) ? 'smd-tile--wide' : ''); ?> <?php echo e($smd_gambar ? '' : 'smd-tile--logo'); ?>">
                        <?php $smd_url = data_get($post, 'url_slug') ?: site_url('artikel/' . buat_slug($post)); ?>
                        <a href="<?php echo e($smd_url); ?>" class="smd-tile__cover" tabindex="-1" aria-hidden="true"></a>
                        <img src="<?php echo e($smd_gambar ? AmbilFotoArtikel($post['gambar'], 'sedang') : gambar_desa($desa['logo'])); ?>" alt="" loading="lazy" class="smd-tile__img">
                        <div class="smd-tile__top">
                            <?php if(!empty($headline) && $smd_i === 0 && $post['id'] == ($headline['id'] ?? null)): ?>
                                <span class="smd-pill smd-pill--glass"><i class="fas fa-star" aria-hidden="true"></i> Utama</span>
                            <?php elseif($smd_kat && is_string($smd_kat)): ?>
                                <span class="smd-pill smd-pill--glass"><?php echo e($smd_kat); ?></span>
                            <?php else: ?>
                                <span></span>
                            <?php endif; ?>
                            <span class="smd-tile__icon" aria-hidden="true"><i class="fas fa-arrow-right"></i></span>
                        </div>
                        <div class="smd-tile__body">
                            <h3 class="smd-tile__title"><a href="<?php echo e($smd_url); ?>"><?php echo e($post['judul']); ?></a></h3>
                            <div class="smd-tile__meta">
                                <span><i class="far fa-calendar-alt" aria-hidden="true"></i> <?php echo e(tgl_indo($post['tgl_upload'])); ?></span>
                                <?php if(isset($post['hit'])): ?>
                                    <span><i class="far fa-eye" aria-hidden="true"></i> <?php echo e(number_format((int) $post['hit'], 0, ',', '.')); ?></span>
                                <?php endif; ?>
                                <span class="smd-tile__more">Baca <i class="fas fa-arrow-right" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="smd-shead__foot">
                <a href="<?php echo e(site_url('arsip')); ?>" class="smd-btn smd-btn--glass-light">Lihat Semua Berita <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
            </div>
            <div class="pagination smd-pagination smd-pagination--center">
                <?php echo $__env->make('theme::commons.paging', ['paging_page' => $paging_page], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        <?php else: ?>
            <div class="smd-glass smd-empty">
                <i class="far fa-newspaper" aria-hidden="true"></i>
                <p>Belum ada berita yang diterbitkan.</p>
            </div>
        <?php endif; ?>
    </div>
</section>


<?php if(theme_config('tampilkan_pintasan', '1') == '1'): ?>
    <section class="smd-section smd-dark" aria-labelledby="smd-layanan-judul">
        <?php if($smd_latar_cta): ?>
            <div class="smd-dark__img" style="background-image: url('<?php echo e($smd_latar_cta); ?>');" aria-hidden="true"></div>
        <?php endif; ?>
        <div class="smd-dark__blob smd-dark__blob--a" aria-hidden="true"></div>
        <div class="smd-dark__blob smd-dark__blob--b" aria-hidden="true"></div>
        <div class="smd-container smd-dark__inner">
            <header class="smd-shead smd-shead--center smd-shead--light">
                <span class="smd-shead__eyebrow">Layanan <?php echo e($smd_sebutan); ?></span>
                <h2 class="smd-shead__title" id="smd-layanan-judul">Layanan publik dalam genggaman</h2>
            </header>
            <div class="smd-features">
                <?php $__currentLoopData = $smd_layanan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e($item['url']); ?>" class="smd-glass-dark smd-feature smd-spotlight">
                        <span class="smd-feature__icon"><i class="fas <?php echo e($item['ikon']); ?>" aria-hidden="true"></i></span>
                        <span class="smd-feature__body">
                            <strong><?php echo e($item['judul']); ?></strong>
                            <small><?php echo e($item['ket']); ?></small>
                            <span class="smd-feature__more">Buka <i class="fas fa-arrow-right" aria-hidden="true"></i></span>
                        </span>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
<?php endif; ?>


<section class="smd-container smd-finder-wrap <?php echo e(theme_config('tampilkan_pintasan', '1') == '1' ? 'smd-finder-wrap--overlap' : ''); ?>">
    <form action="<?php echo e(site_url('/')); ?>" method="get" role="search" class="smd-glass smd-finder" data-smd-finder data-kategori="<?php echo e(site_url($smd_alt_slug . '/kategori')); ?>">
        <div class="smd-finder__head">
            <span class="smd-shead__eyebrow">Pencarian cepat</span>
            <h2 class="smd-finder__title">Apa yang ingin Anda ketahui?</h2>
        </div>
        <div class="smd-finder__fields <?php echo e(empty($menu_kiri) ? 'smd-finder__fields--single' : ''); ?>">
            <label class="smd-finder__field">
                <i class="fas fa-search" aria-hidden="true"></i>
                <span>
                    <small>Kata kunci</small>
                    <input type="search" name="cari" placeholder="Contoh: bantuan sosial">
                </span>
            </label>
            <?php if(!empty($menu_kiri)): ?>
                <label class="smd-finder__field">
                    <i class="fas fa-tags" aria-hidden="true"></i>
                    <span>
                        <small>Kategori</small>
                        <select data-smd-kategori aria-label="Kategori berita">
                            <option value="">Semua kategori</option>
                            <?php $__currentLoopData = $menu_kiri; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $smd_k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($smd_k['slug']); ?>"><?php echo e($smd_k['kategori']); ?></option>
                                <?php $__currentLoopData = $smd_k['submenu'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $smd_sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($smd_sub['slug']); ?>">&nbsp;&nbsp;<?php echo e($smd_sub['kategori']); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </span>
                </label>
            <?php endif; ?>
            <button type="submit" class="smd-btn smd-btn--primary smd-btn--lg smd-finder__btn"><i class="fas fa-search" aria-hidden="true"></i> Cari Sekarang</button>
        </div>
        <?php if(!empty($menu_kiri)): ?>
            <div class="smd-finder__chips">
                <span>Populer:</span>
                <?php $__currentLoopData = array_slice(is_array($menu_kiri) ? $menu_kiri : collect($menu_kiri)->all(), 0, 5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $smd_k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(site_url("{$smd_alt_slug}/kategori/{$smd_k['slug']}")); ?>" class="smd-chip smd-chip--glass"><?php echo e($smd_k['kategori']); ?></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </form>
</section>


<?php if($smd_galeri->isNotEmpty()): ?>
    <section class="smd-section">
        <div class="smd-container">
            <header class="smd-shead smd-shead--center">
                <span class="smd-shead__eyebrow">Galeri <?php echo e($smd_sebutan); ?></span>
                <h2 class="smd-shead__title">Momen terbaik bersama warga</h2>
            </header>
            <div class="smd-offers">
                <?php $__currentLoopData = $smd_galeri; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $smd_g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <article class="smd-glass smd-offer smd-spotlight">
                        <div class="smd-offer__media">
                            <img src="<?php echo e(AmbilGaleri($smd_g['gambar'], 'sedang')); ?>" alt="" loading="lazy">
                            <span class="smd-pill smd-pill--solid"><i class="fas fa-images" aria-hidden="true"></i> Album</span>
                        </div>
                        <div class="smd-offer__body">
                            <h3><?php echo e($smd_g['nama']); ?></h3>
                            <p>Dokumentasi kegiatan <?php echo e(setting('sebutan_desa')); ?></p>
                            <a href="<?php echo e(route('web.galeri.detail', $smd_g['id'])); ?>" class="smd-btn smd-btn--outline smd-btn--block">Lihat Album</a>
                        </div>
                    </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
<?php endif; ?>


<section class="smd-container smd-section smd-section--tight">
    <div class="smd-cta-strip" <?php if($smd_latar_cta): ?> style="background-image: url('<?php echo e($smd_latar_cta); ?>');" <?php endif; ?>>
        <p class="smd-cta-strip__left">Suara Anda,<br><em>membangun <?php echo e(setting('sebutan_desa')); ?></em></p>
        <a href="<?php echo e(site_url('pengaduan')); ?>" class="smd-cta-strip__play" aria-label="Kirim aspirasi atau pengaduan">
            <i class="fas fa-bullhorn" aria-hidden="true"></i>
        </a>
        <p class="smd-cta-strip__right">Sampaikan aspirasi dan pengaduan secara online.<br>Setiap laporan kami tindak lanjuti.</p>
    </div>
</section>


<?php if($smd_komen->isNotEmpty()): ?>
    <section class="smd-section">
        <div class="smd-container">
            <header class="smd-shead smd-shead--center">
                <span class="smd-shead__eyebrow">Suara Warga</span>
                <h2 class="smd-shead__title">Apa kata warga tentang kabar <?php echo e(setting('sebutan_desa')); ?></h2>
            </header>
            <div class="smd-carousel" data-smd-carousel>
                <button type="button" class="smd-carousel__btn smd-carousel__btn--prev" data-smd-prev aria-label="Sebelumnya"><i class="fas fa-chevron-left" aria-hidden="true"></i></button>
                <div class="smd-carousel__track" tabindex="0" aria-label="Komentar warga">
                    <?php $__currentLoopData = $smd_komen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $smd_k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <figure class="smd-glass smd-quote">
                            <span class="smd-quote__mark" aria-hidden="true"><i class="fas fa-quote-left"></i></span>
                            <blockquote>&ldquo;<?php echo e(potong_teks(strip_tags($smd_k['komentar']), 150)); ?><?php echo e(strlen(strip_tags($smd_k['komentar'])) > 150 ? '…' : ''); ?>&rdquo;</blockquote>
                            <figcaption>
                                <span class="smd-quote__avatar" aria-hidden="true"><?php echo e(strtoupper(mb_substr(trim($smd_k['owner'] ?? 'W'), 0, 1))); ?></span>
                                <span>
                                    <strong><?php echo e($smd_k['owner'] ?? 'Warga'); ?></strong>
                                    <small><?php echo e(!empty($smd_k['tgl_upload']) ? tgl_indo($smd_k['tgl_upload']) : ''); ?></small>
                                </span>
                            </figcaption>
                        </figure>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <button type="button" class="smd-carousel__btn smd-carousel__btn--next" data-smd-next aria-label="Berikutnya"><i class="fas fa-chevron-right" aria-hidden="true"></i></button>
            </div>
        </div>
    </section>
<?php endif; ?>


<section class="smd-section">
    <div class="smd-container">
        <div class="smd-plans-layout <?php echo e(theme_config('tampilkan_faq', '1') == '1' ? '' : 'smd-plans-layout--nofaq'); ?>">
            <div class="smd-plans-layout__main">
                <?php if($smd_apbdes): ?>
                    <header class="smd-shead">
                        <span class="smd-shead__eyebrow">Transparansi Anggaran</span>
                        <h2 class="smd-shead__title">APBDes <?php echo e(setting('apbdes_tahun') ?: date('Y')); ?></h2>
                    </header>
                    <div class="smd-plans">
                        <?php $__currentLoopData = $smd_apbdes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $smd_lap): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $smd_item = collect($smd_lap)->filter(static fn ($v, $k) => is_array($v) && $k !== 'laporan' && !empty($v['judul']) && (($v['realisasi'] ?? 0) != 0 || ($v['anggaran'] ?? 0) != 0))->values();
                                $smd_utama = $loop->iteration === 2 || ($loop->count === 1);
                                $smd_judul = \Illuminate\Support\Str::of($smd_lap['laporan'] ?? 'APBDes')->replace('APBDes ', '')->replaceMatches('/\d{4}/', '')->trim();
                            ?>
                            <article class="smd-glass smd-plan <?php echo e($smd_utama ? 'is-featured' : ''); ?>">
                                <div class="smd-plan__head">
                                    <span class="smd-plan__icon"><i class="fas <?php echo e(['fa-balance-scale', 'fa-hand-holding-usd', 'fa-shopping-basket'][($loop->index) % 3]); ?>" aria-hidden="true"></i></span>
                                    <h3><?php echo e($smd_judul ?: $smd_lap['laporan']); ?></h3>
                                    <?php if($smd_utama && $loop->count > 1): ?>
                                        <span class="smd-pill smd-pill--solid smd-pill--sm">Sorotan</span>
                                    <?php endif; ?>
                                </div>
                                <?php if($smd_item->isNotEmpty()): ?>
                                    <p class="smd-plan__big"><?php echo e($smd_rp($smd_item[0]['realisasi'] ?? 0)); ?></p>
                                    <p class="smd-plan__sub">realisasi <?php echo e(\Illuminate\Support\Str::lower($smd_item[0]['judul'])); ?> dari <?php echo e($smd_rp($smd_item[0]['anggaran'] ?? 0)); ?></p>
                                    <ul class="smd-plan__list">
                                        <?php $__currentLoopData = $smd_item->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $smd_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $smd_persen = max(0, min(100, (float) ($smd_row['persen'] ?? 0))); ?>
                                            <li>
                                                <span class="smd-plan__row"><span><?php echo e(\Illuminate\Support\Str::title($smd_row['judul'])); ?></span><b><?php echo e(rtrim(rtrim(number_format($smd_persen, 1, ',', '.'), '0'), ',')); ?>%</b></span>
                                                <span class="smd-bar"><span style="width: <?php echo e($smd_persen); ?>%"></span></span>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                <?php else: ?>
                                    <p class="smd-plan__sub">Belum ada data.</p>
                                <?php endif; ?>
                            </article>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>

                <div class="smd-glass smd-mapcard">
                    <div class="smd-mapcard__text">
                        <h3>Jelajahi wilayah<br><?php echo e($smd_nama); ?></h3>
                        <p>Lihat batas wilayah, lokasi kantor, dan sebaran fasilitas umum di peta interaktif.</p>
                        <a href="<?php echo e(site_url('peta')); ?>" class="smd-btn smd-btn--glass-light"><i class="fas fa-map-marked-alt" aria-hidden="true"></i> Buka Peta</a>
                    </div>
                    <div class="smd-mapcard__map">
                        <?php if($smd_ada_peta): ?>
                            <?php
                                $smd_lat = (float) $desa['lat'];
                                $smd_lng = (float) $desa['lng'];
                                $smd_bbox = implode(',', [$smd_lng - 0.03, $smd_lat - 0.018, $smd_lng + 0.03, $smd_lat + 0.018]);
                            ?>
                            <iframe title="Peta lokasi <?php echo e($smd_nama); ?>" loading="lazy" src="https://www.openstreetmap.org/export/embed.html?bbox=<?php echo e($smd_bbox); ?>&amp;layer=mapnik&amp;marker=<?php echo e($smd_lat); ?>,<?php echo e($smd_lng); ?>"></iframe>
                        <?php else: ?>
                            <div class="smd-mapcard__art" aria-hidden="true">
                                <i class="fas fa-map-marker-alt"></i><i class="fas fa-map-marker-alt"></i><i class="fas fa-map-marker-alt"></i>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <?php if(theme_config('tampilkan_faq', '1') == '1'): ?>
                <aside class="smd-glass smd-faq" aria-labelledby="smd-faq-judul">
                    <span class="smd-shead__eyebrow" id="smd-faq-judul">Pertanyaan Umum</span>
                    <?php $__currentLoopData = $smd_faq; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $smd_f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <details class="smd-faq__item">
                            <summary><?php echo e($smd_f['t']); ?><i class="fas fa-plus" aria-hidden="true"></i></summary>
                            <p><?php echo e($smd_f['j']); ?></p>
                        </details>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </aside>
            <?php endif; ?>
        </div>
    </div>
</section>


<?php if($smd_widget->isNotEmpty()): ?>
    <section class="smd-section">
        <div class="smd-container">
            <header class="smd-shead smd-shead--center">
                <span class="smd-shead__eyebrow">Informasi <?php echo e($smd_sebutan); ?></span>
                <h2 class="smd-shead__title">Serba-serbi <?php echo e($smd_nama); ?></h2>
            </header>
            <div class="sidebar smd-widgets">
                <?php $__currentLoopData = $smd_widget; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $widget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $judul_widget = ['judul_widget' => str_replace('Desa', $smd_sebutan, strip_tags($widget['judul']))];
                    ?>
                    <section class="smd-widget">
                        <?php if ($__env->exists("theme::widgets.{$widget['isi']}", $judul_widget)) echo $__env->make("theme::widgets.{$widget['isi']}", $judul_widget, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </section>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
<?php endif; ?>


<section class="smd-final" <?php if($smd_latar_cta): ?> style="background-image: url('<?php echo e($smd_latar_cta); ?>');" <?php endif; ?>>
    <div class="smd-container smd-final__inner">
        <div>
            <h2>Layanan <?php echo e(setting('sebutan_desa')); ?> kini<br>lebih dekat dengan Anda</h2>
            <p>Urus surat, cek data, dan sampaikan aspirasi kapan saja.</p>
        </div>
        <div class="smd-final__actions">
            <?php if($smd_mandiri): ?>
                <a href="<?php echo e(site_url('layanan-mandiri')); ?>" class="smd-btn smd-btn--primary smd-btn--lg">Layanan Mandiri</a>
            <?php endif; ?>
            <?php if($smd_wa): ?>
                <a href="<?php echo e($smd_wa['link']); ?>" target="_blank" rel="noopener" class="smd-btn smd-btn--wa smd-btn--lg"><i class="fab fa-whatsapp" aria-hidden="true"></i> Hubungi via WhatsApp</a>
            <?php elseif(!empty($desa['telepon'])): ?>
                <a href="tel:<?php echo e(preg_replace('/[^0-9+]/', '', $desa['telepon'])); ?>" class="smd-btn smd-btn--glass smd-btn--lg"><i class="fas fa-phone-alt" aria-hidden="true"></i> <?php echo e($desa['telepon']); ?></a>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php /**PATH C:\xampp\htdocs\opensid\/desa/themes/samudra/resources/views/partials/beranda.blade.php ENDPATH**/ ?>