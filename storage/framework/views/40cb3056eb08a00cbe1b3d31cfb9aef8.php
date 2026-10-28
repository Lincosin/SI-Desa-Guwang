<?php $__env->startPush('styles'); ?>
    <style>
        .pagination {
            position: relative;
            z-index: 1000;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content_left" style="margin-bottom:10px;">
        <div class="archive_style_1">
            <div style="margin-top:10px;">
                <?php if(!empty($teks_berjalan)): ?>
                    <marquee onmouseover="this.stop()" onmouseout="this.start()">
                        <?php echo $__env->make('theme::layouts.teks_berjalan', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </marquee>
                <?php endif; ?>
            </div>
            <?php echo $__env->make('theme::partials.slider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php if(setting('covid_data')): ?>
                <?php echo $__env->make('theme::partials.corona-widget', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
            <?php if(setting('covid_desa')): ?>
                <?php echo $__env->make('theme::partials.corona-local', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
            <?php if($headline): ?>
                <?php echo $__env->make('theme::partials.artikel.list', ['post' => $headline], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        </div>
        <?php $title = (!empty($judul_kategori)) ? $judul_kategori : 'Artikel Terkini' ?>
        <?php if(is_array($title)): ?>
            <?php $__currentLoopData = $title; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $title = $item ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        <div class="single_category wow fadeInDown">
            <h2> <span class="bold_line"><span></span></span> <span class="solid_line"></span> <span class="title_text"><?php echo e($title); ?></span> </h2>
        </div>
        <?php if($artikel->count() > 0): ?>
            <div class="single_category wow fadeInDown" style="position: relative; z-index: 10000;">
                <div class="archive_style_1">
                    <?php $__currentLoopData = $artikel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make('theme::partials.artikel.list', ['post' => $post], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <?php echo $__env->make('theme::commons.page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php else: ?>
            <?php echo $__env->make('theme::partials.artikel.empty', ['title' => $title], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('theme::layouts.right-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\opensid\/storage/app/themes/natra/resources/views/partials/artikel/index.blade.php ENDPATH**/ ?>