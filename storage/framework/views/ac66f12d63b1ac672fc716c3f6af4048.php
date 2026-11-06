<?php $__env->startSection('layout'); ?>
    <div class="w-full bg-background text-on-surface font-body-md text-body-md">
        <?php echo $__env->yieldContent('content'); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('theme::template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\opensid\/desa/themes/temaku/resources/views/layouts/full-width.blade.php ENDPATH**/ ?>