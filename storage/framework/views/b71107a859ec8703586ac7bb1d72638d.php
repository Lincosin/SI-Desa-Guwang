<?php
    $post = $single_artikel;
    $alt_slug = PREMIUM ? 'artikel' : 'first';
?>
<?php echo $__env->make('theme::commons.asset_highcharts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->startSection('content'); ?>
    <?php if($post): ?>
        <nav role="navigation" aria-label="navigation" class="breadcrumb">
            <ol>
                <li><a href="<?php echo e(ci_route()); ?>">Beranda</a></li>
                <li>
                    <?php if($post['kategori']): ?>
                        <a href="<?php echo e(ci_route("{$alt_slug}.kategori.{$post['kat_slug']}")); ?>">
                            <?php echo e($post['kategori']); ?>

                        </a>
                    <?php else: ?>
                        Artikel
                    <?php endif; ?>
                </li>
            </ol>
        </nav>

        <article class="smd-article-head">
            <h1 class="text-h2">
                <?php echo e($post['judul']); ?>

            </h1>

            <ul class="smd-meta smd-meta--article">
                <li><i class="far fa-user-circle" aria-hidden="true"></i> <?php echo e($post['owner']); ?> <i class="fas fa-check-circle smd-verified" title="Terverifikasi" aria-hidden="true"></i></li>
                <li><i class="far fa-calendar-alt" aria-hidden="true"></i> <?php echo e($post['tgl_upload_local']); ?></li>
                <li><i class="far fa-eye" aria-hidden="true"></i> Dibaca <?php echo e(hit($post['hit'])); ?></li>
                <li><i class="far fa-clock" aria-hidden="true"></i> <?php echo e(max(1, (int) ceil(str_word_count(strip_tags($post['isi'] ?? '')) / 200))); ?> menit baca</li>
            </ul>
        </article>

        <div class="content space-y-2 py-4">
            <?php if($post['gambar']): ?>
                <a href="<?php echo e(AmbilFotoArtikel($post['gambar'], 'sedang')); ?>" class="h-auto block pb-3" data-fancybox="images">
                    <figure>
                        <img src="<?php echo e(AmbilFotoArtikel($post['gambar'], 'sedang')); ?>" alt="<?php echo e($post['judul']); ?>" class="w-full h-auto">
                    </figure>
                </a>
            <?php endif; ?>
            <?php echo $post['isi']; ?>

        </div>

        <?php for($i = 1; $i <= 3; $i++): ?>
            <?php if($post['gambar' . $i]): ?>
                <a href="<?php echo e(AmbilFotoArtikel($post['gambar' . $i], 'sedang')); ?>" class="block" data-fancybox="images">
                    <figure>
                        <img src="<?php echo e(AmbilFotoArtikel($post['gambar' . $i], 'sedang')); ?>" alt="<?php echo e($post['nama']); ?>" class="w-full">
                    </figure>
                </a>
            <?php endif; ?>
        <?php endfor; ?>
        <?php if($post['dokumen']): ?>
            <div class="alert alert-info">
                <h4 class="text-h6">Dokumen Lampiran</h4>
                <a href="<?php echo e(ci_route('first.unduh_dokumen_artikel', $post['id'])); ?>" class="text-primary-200 text-sm flex space-x-3 pt-2">
                    <span class="fas fa-download text-secondary inline-block"></span>
                    <span class="hover:text-link"><?php echo e($post['dokumen']); ?></span>
                </a>
            </div>
        <?php endif; ?>

        <?php echo $__env->make('theme::commons.share', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('theme::partials.artikel.comment', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php else: ?>
        <?php echo $__env->make('theme::commons.404', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('theme::layouts.' . $layout, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\opensid\/desa/themes/samudra/resources/views/partials/artikel/detail.blade.php ENDPATH**/ ?>