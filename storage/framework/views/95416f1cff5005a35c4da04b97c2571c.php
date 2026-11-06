<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/leaflet.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/leaflet-geoman.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/L.Control.Locate.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/MarkerCluster.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/MarkerCluster.Default.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/leaflet-measure-path.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/mapbox-gl.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/L.Control.Shapefile.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/leaflet.groupedlayercontrol.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/peta.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/toastr.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/leaflet.fullscreen.css')); ?>">
    <style>
        .row {
            margin-left: -5px;
            margin-right: -5px;
        }

        .form-group a {
            color: #000;
        }
    </style>
    <div class="box box-solid">
        <div class="box-header with-border bg-aqua">
            <h4 class="box-title">PRODUK</h4>
        </div>
        <?php if($verifikasi): ?>
            <div class="box-body box-line">
                <div class="form-group">
                    <?php echo $__env->make('admin.layouts.components.tombol_kembali_layanan_mandiri', ['url' => site_url('layanan-mandiri/produk'), 'label' => 'Daftar Produk'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                </div>
            </div>
        <?php endif; ?>
        <div class="box-body box-line">
            <h4><b>PENGATURAN LAPAK</b></h4>
            <?php echo $__env->make('layanan_mandiri.layouts.components.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <form id="validasi" action="<?php echo e($form_action); ?>" method="POST">
            <div class="box-body">
                <div class="form-group">
                    <label class="control-label" for="telepon">No. Telepon</label>
                    <input class="form-control input-sm number required" type="text" name="telepon" id="telepon" placeholder="Nomer Telepon" value="<?php echo e($pelapak->telepon); ?>">
                </div>
                <div class="form-group">
                    <label class="control-label" for="lokasi">Lokasi</label>
                    <div id="tampil-map"></div>
                </div>
            </div>
            <div class="box-footer text-center">
                <input type="hidden" name="zoom" id="zoom" value="<?php echo e($lokasi['zoom']); ?>" />
                <div class="form-group hide">
                    <label class="col-sm-3 control-label" for="lat">Latitude</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control input-sm lat" name="lat" id="lat" value="<?php echo e($lokasi['lat']); ?>" />
                    </div>
                </div>

                <div class="form-group hide">
                    <label class="col-sm-3 control-label" for="lng">Longitude</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control input-sm lng" name="lng" id="lng" value="<?php echo e($lokasi['lng']); ?>" />
                    </div>
                </div>
                <?php if($verifikasi): ?>
                    <button type="reset" class="btn btn-social btn-danger"><i class="fa fa-times"></i>Batal</button>
                    <button type="submit" class="btn btn-social btn-success"><i class="fa fa-save"></i><?php echo e($aksi); ?></button>
                <?php endif; ?>
            </div>
        </form>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('js/leaflet.js')); ?>"></script>
    <script src="<?php echo e(asset('js/turf.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/leaflet-geoman.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/leaflet.filelayer.js')); ?>"></script>
    <script src="<?php echo e(asset('js/togeojson.js')); ?>"></script>
    <script src="<?php echo e(asset('js/togpx.js')); ?>"></script>
    <script src="<?php echo e(asset('js/leaflet-providers.js')); ?>"></script>
    <script src="<?php echo e(asset('js/L.Control.Locate.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/leaflet.markercluster.js')); ?>"></script>
    <script src="<?php echo e(asset('js/peta.js')); ?>"></script>
    <script src="<?php echo e(asset('js/leaflet-measure-path.js')); ?>"></script>
    <script src="<?php echo e(asset('js/apbdes_manual.js')); ?>"></script>
    <script src="<?php echo e(asset('js/mapbox-gl.js')); ?>"></script>
    <script src="<?php echo e(asset('js/leaflet-mapbox-gl.js')); ?>"></script>
    <script src="<?php echo e(asset('js/shp.js')); ?>"></script>
    <script src="<?php echo e(asset('js/leaflet.shpfile.js')); ?>"></script>
    <script src="<?php echo e(asset('js/leaflet.groupedlayercontrol.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/leaflet.browser.print.js')); ?>"></script>
    <script src="<?php echo e(asset('js/leaflet.browser.print.utils.js')); ?>"></script>
    <script src="<?php echo e(asset('js/leaflet.browser.print.sizes.js')); ?>"></script>
    <script src="<?php echo e(asset('js/dom-to-image.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/toastr.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/Leaflet.fullscreen.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/leaflet.filelayer.js')); ?>"></script>
    <script src="<?php echo e(asset('js/togeojson.js')); ?>"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var posisi = [<?php echo e($lokasi['lat'] . ',' . $lokasi['lng']); ?>];
            var zoom = <?php echo e($lokasi['zoom']); ?>;

            // Inisialisasi tampilan peta
            var peta_lapak = L.map('tampil-map').setView(posisi, zoom);

            // 1. Menampilkan overlayLayers Peta Semua Wilayah
            var marker_desa = [];
            var marker_dusun = [];
            var marker_rw = [];
            var marker_rt = [];

            // WILAYAH DESA
            <?php if(!empty($desa['path'])): ?>
                set_marker_desa(marker_desa, <?php echo json_encode($desa); ?>, "<?php echo e(ucwords(setting('sebutan_desa')) . ' ' . $desa['nama_desa']); ?>", "<?php echo e(favico_desa()); ?>");
            <?php endif; ?>

            // WILAYAH DUSUN
            <?php if(!empty($dusun_gis)): ?>
                set_marker_multi(marker_dusun, '<?php echo addslashes(json_encode($dusun_gis)); ?>', '#FFFF00', '<?php echo e(ucwords(setting('sebutan_dusun'))); ?>', 'dusun');
            <?php endif; ?>

            // WILAYAH RW
            <?php if(!empty($rw_gis)): ?>
                set_marker(marker_rw, '<?php echo addslashes(json_encode($rw_gis)); ?>', '#8888dd', 'RW', 'rw');
            <?php endif; ?>

            // WILAYAH RT
            <?php if(!empty($rt_gis)): ?>
                set_marker(marker_rt, '<?php echo addslashes(json_encode($rt_gis)); ?>', '#008000', 'RT', 'rt');
            <?php endif; ?>

            // 2. Menampilkan overlayLayers Peta Semua Wilayah
            <?php if(!empty($wil_atas['path'])): ?>
                var overlayLayers = overlayWil(marker_desa, marker_dusun, marker_rw, marker_rt, "<?php echo e(ucwords(setting('sebutan_desa'))); ?>", "<?php echo e(ucwords(setting('sebutan_dusun'))); ?>");
            <?php else: ?>
                var overlayLayers = {};
            <?php endif; ?>

            // Menampilkan BaseLayers Peta
            var baseLayers = getBaseLayers(peta_lapak);

            showCurrentPoint(posisi, peta_lapak);

            <?php if(can('u')): ?>
                // Export/Import Peta dari file GPX
                L.Control.FileLayerLoad.LABEL = '<img class="icon-map" src="<?php echo e(asset('images/gpx.png')); ?>" alt="file icon"/>';
                L.Control.FileLayerLoad.TITLE = 'Impor GPX/KML';
                controlGpxPoint = eximGpxPoint(peta_lapak);
            <?php endif; ?>

            // Menambahkan zoom scale ke peta
            L.control.scale().addTo(peta_lapak);
            L.control.layers(baseLayers, overlayLayers, {
                position: 'topleft',
                collapsed: true
            }).addTo(peta_lapak);
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layanan_mandiri.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\opensid\resources\views/layanan_mandiri/produk/pengaturan.blade.php ENDPATH**/ ?>