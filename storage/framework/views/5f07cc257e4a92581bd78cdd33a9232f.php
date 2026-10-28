<?php if(theme_config('jam', true)): ?>
    <div id="jam"></div>
<?php endif; ?>

<?php if(theme_config('pintasan_masuk', true)): ?>
    <div class="single_bottom_rightbar">
        <h2><i class="fa fa-lock"></i>&ensp;MASUK</h2>
        <div class="tab-pane fade in active">
            <a href="<?php echo e(site_url('siteman')); ?>" class="btn btn-primary btn-block" rel="noopener noreferrer" target="_blank">ADMIN</a>
            <?php if((bool) setting('layanan_mandiri')): ?>
                <a href="<?php echo e(site_url('layanan-mandiri')); ?>" class="btn btn-success btn-block" rel="noopener noreferrer" target="_blank">LAYANAN MANDIRI</a>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>

<!-- Tampilkan Widget -->
<?php if($widgetAktif): ?>
    <?php $__currentLoopData = $widgetAktif; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $widget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $judul_widget = [
                'judul_widget' => str_replace('Desa', ucwords(setting('sebutan_desa')), strip_tags($widget['judul'])),
            ];
        ?>
        <?php if ($__env->exists("theme::widgets.{$widget['isi']}", $judul_widget)) echo $__env->make("theme::widgets.{$widget['isi']}", $judul_widget, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\opensid\/storage/app/themes/natra/resources/views/partials/sidebar.blade.php ENDPATH**/ ?>