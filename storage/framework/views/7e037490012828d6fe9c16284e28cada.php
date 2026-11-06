<aside class="smd-sidebar sidebar">
    <form action="<?php echo e(site_url('/')); ?>" method="get" role="search" class="smd-sidebar__search">
        <i class="fas fa-search" aria-hidden="true"></i>
        <input type="search" name="cari" class="form-input" placeholder="Cari artikel..." aria-label="Kata kunci pencarian">
    </form>
    
    <?php if($widgetAktif): ?>
        <?php $__currentLoopData = $widgetAktif; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $widget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $judul_widget = [
                    'judul_widget' => str_replace('Desa', ucwords(setting('sebutan_desa')), strip_tags($widget['judul'])),
                ];
            ?>
            <section class="smd-widget">
                <?php if ($__env->exists("theme::widgets.{$widget['isi']}", $judul_widget)) echo $__env->make("theme::widgets.{$widget['isi']}", $judul_widget, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </section>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</aside>
<?php /**PATH C:\xampp\htdocs\opensid\/desa/themes/samudra/resources/views/partials/sidebar.blade.php ENDPATH**/ ?>