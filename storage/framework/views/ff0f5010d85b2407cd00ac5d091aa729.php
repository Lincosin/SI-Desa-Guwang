<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <link rel="stylesheet" href="<?php echo e(asset('lib/print/css/960.css')); ?>" type="text/css" media="screen">
    <link rel="stylesheet" href="<?php echo e(asset('lib/print/css/screen.css')); ?>" type="text/css" media="screen">
    <link rel="stylesheet" href="<?php echo e(asset('lib/print/css/print-preview.css')); ?>" type="text/css" media="screen">
    <link rel="stylesheet" href="<?php echo e(asset('lib/print/css/print.css')); ?>" type="text/css" media="print">
    <link rel="shortcut icon" href="<?php echo e(favico_desa()); ?>">
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
</head>

<body>
    <?php echo $__env->yieldContent('content'); ?>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\opensid\resources\views/layanan_mandiri/layouts/print/headjs.blade.php ENDPATH**/ ?>