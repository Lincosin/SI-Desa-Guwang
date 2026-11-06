<?php $__env->startSection('layout'); ?>
    <div class="smd-container smd-layout">
        
        <main class="smd-main text-gray-600">
            <?php echo $__env->yieldContent('content'); ?>
        </main>
        
        <div class="smd-aside">
            <?php echo $__env->make('theme::partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('theme::template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\opensid\/desa/themes/samudra/resources/views/layouts/right-sidebar.blade.php ENDPATH**/ ?>