<?php $__env->startSection('layout'); ?>
    <section>
        <div class="content_bottom">
            <div class="row">
                <div class="col-lg-9 col-md-9">
                    <div class="content_left">
                        <?php echo $__env->yieldContent('content'); ?>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <?php echo $__env->make('theme::partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('theme::template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\opensid\/storage/app/themes/natra/resources/views/layouts/right-sidebar.blade.php ENDPATH**/ ?>