<?php
    $title = !empty($judul_kategori) ? $judul_kategori : 'Artikel Terkini';
    $slug = 'terkini';
    if (is_array($title)) {
        $slug = $title['slug'];
        $title = $title['kategori'];
    }
    $smd_halaman_awal = empty($cari) && request()->segment(2) != 'kategori' && request()->segment(2) !== 'index' && request()->segment(1) !== 'index';
    // Beranda (halaman pertama tanpa pencarian) memakai tata letak landing penuh bergaya kaca
    $smd_landing = $smd_halaman_awal && !request()->segment(1);
?>

<?php $__env->startSection('content'); ?>
    <?php if($smd_landing): ?>
        <?php echo $__env->make('theme::partials.beranda', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php else: ?>
    
    <?php if($smd_halaman_awal && count($slider_gambar['gambar'] ?? []) > 0): ?>
        <?php echo $__env->make('theme::partials.slider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <?php if($smd_halaman_awal && count($slider_gambar ?? []) > 0): ?>
        <?php echo $__env->make('theme::partials.headline', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <div class="smd-section-head">
        <div>
            <span class="smd-section-head__eyebrow"><?php echo e(!empty($cari) ? 'Hasil pencarian' : 'Kabar ' . ucwords(setting('sebutan_desa'))); ?></span>
            <h2 class="smd-section-head__title"><?php echo e(!empty($cari) ? '“' . $cari . '”' : $title); ?></h2>
        </div>
        <a href="<?php echo e(site_url('arsip')); ?>" class="smd-link-more">Indeks berita <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
    </div>

    <?php if($artikel->count() > 0): ?>
        <div class="smd-post-grid">
            <?php $__currentLoopData = $artikel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('theme::partials.artikel.list', ['post' => $post], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="pagination smd-pagination">
            <?php echo $__env->make('theme::commons.paging', ['paging_page' => $paging_page], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    <?php else: ?>
        <?php echo $__env->make('theme::partials.artikel.empty', ['title' => $title], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($smd_landing ? 'theme::layouts.landing' : 'theme::layouts.right-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\opensid\/desa/themes/samudra/resources/views/partials/artikel/index.blade.php ENDPATH**/ ?>