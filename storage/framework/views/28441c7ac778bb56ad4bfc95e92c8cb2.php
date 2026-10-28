<?php $__env->startSection('layout'); ?>
    
    <div class="smd-landing">
        <?php echo $__env->yieldContent('content'); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('theme::template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\opensid\/desa/themes/samudra/resources/views/layouts/landing.blade.php ENDPATH**/ ?>