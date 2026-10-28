<?php defined('BASEPATH') || exit('No direct script access allowed'); ?>

<div class="">
    <div class="single_bottom_rightbar">
        <h2>
            <i class="fa fa-map-marker"></i>&ensp;<?php echo e($judul_widget); ?>

        </h2>
    </div>
    <div class="single_bottom_rightbar">
        <div id="map_wilayah" style="height:200px;"></div>
        <a href="https://www.openstreetmap.org/#map=15/<?php echo e($desa['lat'] . '/' . $desa['lng']); ?>" class="btn btn-primary btn-block" rel="noopener noreferrer" target="_blank">Buka Peta</a>
    </div>
</div>

<script>
    //Jika posisi kantor desa belum ada, maka posisi peta akan menampilkan seluruh Indonesia
    <?php if(!empty($desa['lat']) && !empty($desa['lng'])): ?>
        var posisi = [<?php echo e($desa['lat']); ?>, <?php echo e($desa['lng']); ?>];
        var zoom = <?php echo e($desa['zoom'] ?: 10); ?>;
    <?php else: ?>
        var posisi = [-1.0546279422758742, 116.71875000000001];
        var zoom = 10;
    <?php endif; ?>

    var options = {
        maxZoom: <?php echo e(setting('max_zoom_peta')); ?>,
        minZoom: <?php echo e(setting('min_zoom_peta')); ?>,
    };

    //Style polygon
    var style_polygon = {
        stroke: true,
        color: '#FF0000',
        opacity: 1,
        weight: 2,
        fillColor: '#8888dd',
        fillOpacity: 0.5
    };
    var wilayah_desa = L.map('map_wilayah', options).setView(posisi, zoom);

    //Menampilkan BaseLayers Peta
    var baseLayers = getBaseLayers(wilayah_desa, "<?php echo e(setting('mapbox_key')); ?>", "<?php echo e(setting('jenis_peta')); ?>");

    L.control.layers(baseLayers, null, {
        position: 'topright',
        collapsed: true
    }).addTo(wilayah_desa);

    <?php if(!empty($desa['path'])): ?>
        var polygon_desa = <?php echo $desa['path']; ?>;
        var kantor_desa = L.polygon(polygon_desa, style_polygon).bindTooltip("Wilayah <?php echo e(ucwords(setting('sebutan_desa'))); ?>").addTo(wilayah_desa);
        wilayah_desa.fitBounds(kantor_desa.getBounds());
    <?php endif; ?>
</script>
<?php /**PATH C:\xampp\htdocs\opensid\/storage/app/themes/natra/resources/views/widgets/peta_wilayah_desa.blade.php ENDPATH**/ ?>