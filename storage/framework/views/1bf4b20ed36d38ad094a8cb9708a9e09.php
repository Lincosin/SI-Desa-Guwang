<?php if(cek_koneksi_internet()): ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-providers/1.6.0/leaflet-providers.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mapbox-gl/1.13.0/mapbox-gl.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mapbox-gl-leaflet/0.0.14/leaflet-mapbox-gl.min.js"></script>

<?php endif; ?>
<script src="<?php echo e(theme_asset('vendor/OwlCarousel2-2.3.4/owl.carousel.min.js', ['themeVersion' => $themeVersion])); ?>"></script>

<?php echo $__env->make('core::admin.layouts.components.token', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script src="<?php echo e(asset('js/peta.js')); ?>"></script>
<script>
    var BASE_URL = '<?php echo e(base_url()); ?>';
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
<?php /**PATH C:\xampp\htdocs\opensid\/desa/themes/samudra/resources/views/commons/source_js.blade.php ENDPATH**/ ?>