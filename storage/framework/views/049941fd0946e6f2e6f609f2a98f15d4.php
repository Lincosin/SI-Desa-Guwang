<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/peta.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/leaflet.css')); ?>" />
    <style type="text/css">
        .modal-backdrop.in {
            filter: alpha(opacity=50);
            opacity: 0;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="box box-solid">
        <div class="box-header with-border bg-aqua">
            <h4 class="box-title">Lapak</h4>
        </div>
        <div class="box-header with-border">
            <form method="get" class="form-inline text-center">
                <select class="form-control" id="id_kategori" name="id_kategori">
                    <option selected value="">Semua Kategori</option>
                    <?php $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($kategori_item->id); ?>" <?php echo e($id_kategori == $kategori_item->id ? 'selected' : ''); ?>>
                            <?php echo e($kategori_item->kategori); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <input type="text" name="keyword" maxlength="50" class="form-control" value="<?php echo e($keyword); ?>" placeholder="Cari Produk">
                <button type="submit" class="btn btn-primary">Cari</button>
                <?php if($keyword || $id_kategori): ?>
                    <a href="<?php echo e(base_url('layanan-mandiri/lapak')); ?>" class="btn btn-info">Tampilkan Semua</a>
                <?php endif; ?>
            </form>
        </div>
        <div class="box-body">
            <div class="row" style="padding: 0px 20px;">
                <?php $__empty_1 = true; $__currentLoopData = $produk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $in => $pro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php $foto = json_decode($pro->foto); ?>
                    <div class="col-md-4">
                        <div class="card mb-4 box-shadow">
                            <?php if($pro->foto): ?>
                                <div id="carousel-produk<?php echo e($in); ?>" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <?php for($i = 0; $i < setting('banyak_foto_tiap_produk'); $i++): ?>
                                            <?php if(!empty($foto[$i])): ?>
                                                <li data-target="#carousel-produk<?php echo e($in); ?>" data-slide-to="<?php echo e($i); ?>" class="<?php echo e($i == 0 ? 'active' : ''); ?>">
                                                </li>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    </ol>

                                    <div class="carousel-inner">
                                        <?php for($i = 0; $i < setting('banyak_foto_tiap_produk'); $i++): ?>
                                            <?php if(!empty($foto[$i])): ?>
                                                <div class="item <?php echo e($i == 0 ? 'active' : ''); ?>">
                                                    <?php if(is_file(LOKASI_PRODUK . $foto[$i])): ?>
                                                        <img class="image-produk card-img-top" src="<?php echo e(base_url(LOKASI_PRODUK . $foto[$i])); ?>" alt="Produk <?php echo e($i + 1); ?>">
                                                    <?php else: ?>
                                                        <img class="card-img-top" style="width: auto; max-height: 170px;" src="<?php echo e(asset('images/404-image-not-found.jpg')); ?>" alt="Foto Produk">
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    </div>
                                    <a class="left carousel-control" href="#carousel-produk<?php echo e($in); ?>" data-slide="prev">
                                        <span class="fa fa-angle-left"></span>
                                    </a>
                                    <a class="right carousel-control" href="#carousel-produk<?php echo e($in); ?>" data-slide="next">
                                        <span class="fa fa-angle-right"></span>
                                    </a>
                                </div>
                            <?php else: ?>
                                <img class="card-img-top" style="width: auto; max-height: 170px;" src="<?php echo e(asset('images/404-image-not-found.jpg')); ?>" alt="Foto Produk">
                            <?php endif; ?>

                            <div class="card-body">
                                <h4><b><?php echo e($pro->nama); ?></b></h4>
                                <?php $harga_potongan = $pro->tipe_potongan == 1 ? $pro->harga * ($pro->potongan / 100) : $pro->potongan; ?>
                                <h6><b style="color:green;">Harga : <?php echo e(rupiah($pro->harga - $harga_potongan)); ?>

                                        <?php if($pro->potongan != 0): ?>
                                            &nbsp;&nbsp;<small style="color:red; text-decoration: line-through red;"><?php echo e(rupiah($pro->harga)); ?></small>
                                        <?php endif; ?>
                                    </b></h6>
                                <div class="d-flex justify-content-between align-items-center" style="margin-bottom: 30px;">
                                    <div class="btn-group">
                                        <?php if($pro->telepon): ?>
                                            <?php $pesan = strReplaceArrayRecursive(['[nama_produk]' => $pro->nama, '[link_web]' => base_url('lapak'), '<br />' => '%0A'], nl2br(setting('pesan_singkat_wa'))); ?>
                                            <a class="btn btn-sm btn-success" href="https://api.whatsapp.com/send?phone=<?php echo e(format_telpon($pro->telepon)); ?>&amp;text=<?php echo e($pesan); ?>" rel="noopener noreferrer" target="_blank" title="WhatsApp">
                                                <i class="fa fa-whatsapp"></i> Beli
                                            </a>
                                        <?php endif; ?>
                                        <a
                                            class="btn btn-sm btn-warning lokasi-pelapak"
                                            data-remote="false"
                                            data-toggle="modal"
                                            data-target="#map-modal"
                                            title="Lokasi"
                                            data-lat="<?php echo e($pro->lat); ?>"
                                            data-lng="<?php echo e($pro->lng); ?>"
                                            data-zoom="<?php echo e($pro->zoom); ?>"
                                            data-title="Lokasi Pelapak (<?php echo e($pro->pelapak); ?>)"
                                        ><i class="fa fa fa-map"></i>
                                            Lokasi</a>
                                        <a class="btn btn-sm btn-primary text-white" data-remote="false" data-toggle="modal" data-target="#descModal<?php echo e($in); ?>" title="Deskripsi"><i class="fa fa-info-circle"></i>
                                            Deskripsi</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Deskripsi -->
                    <div class="modal fade" id="descModal<?php echo e($in); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog box-map">
                            <div class="modal-content-map">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title"><b><?php echo e($pro->nama); ?></b></h4>
                                </div>
                                <div class="modal-body">
                                    <p class="card-text" style="margin-bottom: 25px;">
                                        <b>Deskripsi:</b>
                                        <br>
                                        <?php echo nl2br(e($pro->deskripsi)); ?>

                                    </p>
                                    <p>
                                        <b><i class="fa fa-user"></i>&nbsp;<?php echo e($pro->pelapak ?? 'ADMIN'); ?></b><br>
                                        <b>Kontak:</b>&nbsp;<?php echo e($pro->telepon ?? 'ADMIN'); ?>

                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="text-center">
                        <h5>Belum ada produk yang ditawarkan.</h5>
                    </div>
                <?php endif; ?>
            </div>
            <div class="text-center">
                <?php echo e($produk->links('admin.layouts.components.pagination_default')); ?>

            </div>

            <!-- Modal lokasi -->
            <div class="modal fade" id="map-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog box-map">
                    <div class="modal-content-map">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title"></h4>
                        </div>
                        <div class="modal-body"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?= asset('js/mapbox-gl.js') ?>"></script>
    <script src="<?= asset('js/leaflet.js') ?>"></script>
    <script src="<?= asset('js/leaflet-providers.js') ?>"></script>
    <script src="<?= asset('js/leaflet-mapbox-gl.js') ?>"></script>
    <script src="<?= asset('js/peta.js') ?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var MAPBOX_KEY = '<?= setting('mapbox_key') ?>';
            var JENIS_PETA = '<?= setting('jenis_peta') ?>';

            var options = {
                maxZoom: '<?= setting('max_zoom_peta') ?>',
                minZoom: '<?= setting('min_zoom_peta') ?>',
                fullscreenControl: {
                    position: 'topright' // Menentukan posisi tombol fullscreen
                }
            };

            $(document).on('shown.bs.modal', '#map-modal', function(event) {
                let link = $(event.relatedTarget);
                let title = link.data('title');
                let modal = $(this);
                modal.find('.modal-title').text(title);
                modal.find('.modal-body').html("<div id='map' style='width: 100%; height:300px;'></div>");

                let posisi = [link.data('lat'), link.data('lng')];
                let zoom = link.data('zoom');
                let logo = L.icon({
                    iconUrl: "<?= setting('icon_lapak_peta') ?>",
                });

                $("#lat").val(link.data('lat'));
                $("#lng").val(link.data('lng'));

                pelapak = L.map('map', options).setView(posisi, zoom);
                getBaseLayers(pelapak, MAPBOX_KEY, JENIS_PETA);

                pelapak.addLayer(new L.Marker(posisi, {
                    icon: logo
                }));
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layanan_mandiri.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\opensid\resources\views/layanan_mandiri/lapak/index.blade.php ENDPATH**/ ?>