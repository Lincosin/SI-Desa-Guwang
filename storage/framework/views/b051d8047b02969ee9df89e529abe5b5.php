<?php
    $post = $single_artikel;
    $alt_slug = PREMIUM ? 'artikel' : 'first';

    $judulBersih = strtolower(trim($post['judul'] ?? ''));
    $isHalamanStatis = (isset($post['id_kategori']) && (int) $post['id_kategori'] === 1000)
        || in_array($judulBersih, ['profil desa', 'profil', 'pemerintah desa', 'sejarah desa', 'visi dan misi', 'visi misi'])
        || empty($post['kategori']);
?>

<?php echo $__env->make('theme::commons.asset_highcharts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('content'); ?>
    <?php if($post): ?>
        <?php if($isHalamanStatis): ?>
            
            <div class="w-full pb-16">
                <div class="w-full bg-gradient-to-r from-primary via-primary-container to-secondary text-on-primary py-12 px-4 sm:px-6 lg:px-8 shadow-sm">
                    <div class="max-w-6xl mx-auto">
                        <nav aria-label="Breadcrumb" class="mb-4 text-xs sm:text-sm opacity-90 font-medium flex items-center gap-2">
                            <a href="<?php echo e(ci_route()); ?>" class="hover:underline flex text-black items-center gap-1">
                                <span class="material-symbols-outlined text-[15px]">home</span>
                                <span>Beranda</span>
                            </a>
                            <span class="text-black">/</span>
                            <span class="text-black">artikel</span>
                            <span class="text-black">/</span>
                            <span class="text-black"><?php echo e($post['judul']); ?></span>
                        </nav>
                        <h1 class="text-3xl sm:text-4xl text-black font-extrabold tracking-tight"><?php echo e($post['judul']); ?></h1>
                    </div>
                </div>

                <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 -mt-6">
                    <div class="bg-surface-container-lowest border border-outline-variant/30 rounded-2xl shadow-sm p-6 sm:p-10">
                        <div class="flex items-center justify-between border-b border-outline-variant/20 pb-5 mb-6">
                            <div class="flex items-center gap-2 text-xs font-semibold text-on-surface-variant uppercase tracking-wider">
                                <span class="material-symbols-outlined text-[18px] text-primary">account_balance</span>
                                <span>Pemerintah <?php echo e(setting('sebutan_desa')); ?> <?php echo e($desa['nama_desa']); ?></span>
                            </div>
                            <div class="flex items-center gap-1.5 bg-surface-container-low px-2 py-1 rounded-lg text-on-surface">
                                <button type="button" id="artikel-font-minus" aria-label="Perkecil Font" class="w-7 h-7 flex items-center justify-center rounded hover:bg-surface-container font-bold text-xs">A-</button>
                                <span class="text-outline-variant text-xs">|</span>
                                <button type="button" id="artikel-font-plus" aria-label="Perbesar Font" class="w-7 h-7 flex items-center justify-center rounded hover:bg-surface-container font-bold text-sm">A+</button>
                                <span class="text-outline-variant text-xs">|</span>
                                <button type="button" id="artikel-cetak" aria-label="Cetak" title="Cetak Halaman" class="w-7 h-7 flex items-center justify-center rounded hover:bg-surface-container">
                                    <span class="material-symbols-outlined text-[17px]">print</span>
                                </button>
                            </div>
                        </div>

                        <?php if($post['gambar']): ?>
                            <div class="mb-8 overflow-hidden rounded-xl shadow-sm max-h-[420px]">
                                <img src="<?php echo e(AmbilFotoArtikel($post['gambar'], 'sedang')); ?>" alt="<?php echo e($post['judul']); ?>" class="w-full h-full object-cover">
                            </div>
                        <?php endif; ?>

                        <div id="artikel-isi" class="artikel-isi prose dark:prose-invert max-w-none text-on-surface leading-relaxed font-normal text-base">
                            <?php echo $post['isi']; ?>

                        </div>
                    </div>
                </div>
            </div>

        <?php else: ?>
            
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
                <nav aria-label="Breadcrumb" class="mb-6 text-xs sm:text-sm text-on-surface-variant font-medium flex items-center gap-2">
                    <a href="<?php echo e(ci_route()); ?>" class="hover:text-primary transition-colors flex items-center gap-1">
                        <span class="material-symbols-outlined text-[15px]">home</span>
                        <span>Beranda</span>
                    </a>
                    <span>/</span>
                    <a href="<?php echo e(site_url('kategori/' . ($post['kategori_slug'] ?? ''))); ?>" class="hover:text-primary transition-colors">
                        <?php echo e($post['kategori'] ?? 'Kabar Desa'); ?>

                    </a>
                    <span>/</span>
                    <span class="text-on-surface font-semibold line-clamp-1"><?php echo e($post['judul']); ?></span>
                </nav>

                <article class="bg-surface-container-lowest border border-outline-variant/30 rounded-3xl shadow-sm p-6 sm:p-10">
                    <h1 class="font-headline-lg text-headline-lg text-on-surface tracking-tight mb-4 text-2xl sm:text-3xl font-extrabold">
                        <?php echo e($post['judul']); ?>

                    </h1>

                    <div class="flex items-center flex-wrap gap-4 text-xs text-on-surface-variant pb-6 mb-6 border-b border-outline-variant/20">
                        <div class="flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[16px] text-primary">calendar_today</span>
                            <span><?php echo e(tgl_indo($post['tgl_upload'])); ?></span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[16px] text-primary">person</span>
                            <span><?php echo e($post['penulis'] ?? 'Admin Desa'); ?></span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[16px] text-primary">visibility</span>
                            <span><?php echo e($post['hit'] ?? 0); ?> kali dibaca</span>
                        </div>
                    </div>

                    <?php if($post['gambar']): ?>
                        <div class="mb-8 overflow-hidden rounded-2xl shadow-md max-h-[460px] bg-surface-container">
                            <img src="<?php echo e(AmbilFotoArtikel($post['gambar'], 'sedang')); ?>" alt="<?php echo e($post['judul']); ?>" class="w-full h-full object-cover">
                        </div>
                    <?php endif; ?>

                    <div id="artikel-isi" class="artikel-isi prose dark:prose-invert max-w-none text-on-surface leading-relaxed text-base space-y-4">
                        <?php echo $post['isi']; ?>

                    </div>

                    
                    <div class="mt-10 pt-6 border-t border-outline-variant/20 flex items-center justify-between flex-wrap gap-4">
                        <a href="javascript:history.back()" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-surface-container-low hover:bg-surface-container text-primary font-semibold text-xs transition-colors">
                            <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                            <span>Kembali</span>
                        </a>
                        <div class="flex items-center gap-2 text-xs text-on-surface-variant font-medium">
                            <span>Bagikan berita:</span>
                            <a href="https://api.whatsapp.com/send?text=<?php echo e(urlencode($post['judul'] . ' ' . current_url())); ?>" target="_blank" rel="noopener" class="w-8 h-8 rounded-full bg-emerald-500 text-white flex items-center justify-center hover:opacity-90">
                                <i class="fab fa-whatsapp"></i> WA
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(current_url())); ?>" target="_blank" rel="noopener" class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center hover:opacity-90">
                                <i class="fab fa-facebook-f"></i> FB
                            </a>
                        </div>
                    </div>
                </article>
            </div>
        <?php endif; ?>

        
        <script>
            (function () {
                var isi = document.getElementById('artikel-isi');
                var ukuran = 100;
                function atur(delta) {
                    ukuran = Math.min(140, Math.max(80, ukuran + delta));
                    if (isi) isi.style.fontSize = ukuran + '%';
                }
                var p = document.getElementById('artikel-font-plus');
                var m = document.getElementById('artikel-font-minus');
                var c = document.getElementById('artikel-cetak');
                if (p) p.addEventListener('click', function() { atur(10); });
                if (m) m.addEventListener('click', function() { atur(-10); });
                if (c) c.addEventListener('click', function() { window.print(); });
            })();
        </script>
    <?php else: ?>
        <div class="max-w-5xl mx-auto px-4 py-16 text-center">
            <?php echo $__env->make('theme::commons.404', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('theme::layouts.full-width', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\opensid\/desa/themes/temaku/resources/views/partials/artikel/detail.blade.php ENDPATH**/ ?>