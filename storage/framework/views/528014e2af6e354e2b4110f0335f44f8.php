<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('lib/print/css/960.css')); ?>asset/" type="text/css" media="screen">
    <link rel="stylesheet" href="<?php echo e(asset('lib/print/css/screen.css')); ?>" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo e(asset('lib/print/css/print-preview.css')); ?>" type="text/css" media="screen">
    <link rel="stylesheet" href="<?php echo e(asset('lib/print/css/print.css')); ?>" type="text/css" media="print" />
    <link rel="shortcut icon" href="<?php echo e(favico_desa()); ?>" />
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('lib/print/js/jquery.tools.min.js')); ?>"></script>
    <script src="<?php echo e(asset('lib/print/js/jquery.print-preview.js')); ?>" type="text/javascript" charset="utf-8"></script>

    <script type="text/javascript">
        $(function() {
            $("#feature > div").scrollable({
                interval: 2000
            }).autoscroll();

            $('#aside').prepend('<a class="print-preview">Cetak </a>');
            $('a.print-preview').printPreview();

            //$(document).bind('keydown', function(e) {
            var code = 80;
            //if (code == 80 && !$('#print-modal').length) {
            $.printPreview.loadPrintPreview();
            //return false;
            //}
            //});
        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH D:\laragon\www\opensid\resources\views/admin/layouts/components/headjs.blade.php ENDPATH**/ ?>