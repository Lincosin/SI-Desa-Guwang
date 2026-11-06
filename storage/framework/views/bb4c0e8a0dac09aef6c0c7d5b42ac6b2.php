

<?php $__env->startSection('layout'); ?>
    <div class="container mx-auto lg:px-5 px-3 flex flex-col lg:flex-row my-5 gap-3 lg:gap-5 justify-between text-gray-600">
        
        <main class="lg:w-2/3 w-full bg-white rounded-lg px-4 py-2 lg:py-4 lg:px-5 shadow">
            <?php echo $__env->yieldContent('content'); ?>
        </main>
        <!-- Widget -->
        <div class="lg:w-1/3 w-full">
            <?php echo $__env->make('theme::partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('theme::template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\opensid\/desa/themes/temaku/resources/views/layouts/right-sidebar.blade.php ENDPATH**/ ?>