

<?php $__env->startSection('layout'); ?>
    <div class="container mx-auto lg:px-5 px-3 flex flex-col lg:flex-row my-5 gap-3 lg:gap-5 justify-between text-gray-600">
        <main class="w-full space-y-1 bg-white rounded-lg px-4 py-2 lg:py-4 lg:px-5 shadow">
            
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('theme::template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\opensid\/desa/themes/temaku/resources/views/layouts/full-content.blade.php ENDPATH**/ ?>