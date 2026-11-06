<?php $__env->startPush('scripts'); ?>
    <!-- Highcharts -->
    <script src="<?php echo e(asset('js/highcharts/highcharts.js')); ?>"></script>
    <script src="<?php echo e(asset('js/highcharts/highcharts-3d.js')); ?>"></script>
    <script src="<?php echo e(asset('js/highcharts/exporting.js')); ?>"></script>
    <script src="<?php echo e(asset('js/highcharts/highcharts-more.js')); ?>"></script>
    <script src="<?php echo e(asset('js/highcharts/sankey.js')); ?>"></script>
    <script src="<?php echo e(asset('js/highcharts/organization.js')); ?>"></script>
    <script src="<?php echo e(asset('js/highcharts/accessibility.js')); ?>"></script>
    <script>
        Highcharts.setOptions({
            lang: {
                thousandsSep: '.'
            }
        })
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH D:\laragon\www\opensid\resources\views/admin/layouts/components/highchartjs.blade.php ENDPATH**/ ?>