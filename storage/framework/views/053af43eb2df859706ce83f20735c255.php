<?php defined('BASEPATH') || exit('No direct script access allowed'); ?>

<script src="<?php echo e(theme_asset('js/wow.min.js')); ?>"></script>
<script src="<?php echo e(theme_asset('js/slick.min.js')); ?>"></script>
<script src="<?php echo e(theme_asset('js/custom.js')); ?>"></script>
<script>
    $.extend($.fn.dataTable.defaults, {
        lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "Semua"]
        ],
        pageLength: 10,
        language: {
            url: "<?php echo e(asset('bootstrap/js/dataTables.indonesian.lang')); ?>",
        }
    });
</script>
<?php if(!setting('inspect_element')): ?>
    <script src="<?php echo e(asset('js/disabled.min.js')); ?>"></script>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\opensid\/storage/app/themes/natra/resources/views/commons/meta_footer.blade.php ENDPATH**/ ?>