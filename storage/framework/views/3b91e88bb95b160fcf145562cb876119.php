<?php echo $__env->make('admin.layouts.components.asset_datatables', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('title'); ?>
    <h1>
        Arsip <?php echo e(ucwords(setting('sebutan_desa'))); ?> | <?php echo e(${$ci->input->get('kategori')}['title'] ?? 'Layanan Surat'); ?>

    </h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class='active'>Arsip <?php echo e(ucwords(setting('sebutan_desa'))); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.layouts.components.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="row">
        <div class="col-lg-4 col-xs-4">
            <div class="small-box rounded bg-yellow">
                <div class="inner">
                    <h3><?php echo e($dokumen_desa['total']); ?></h3>
                    <p><?php echo e($dokumen_desa['title']); ?></p>
                </div>
                <div class="icon">
                    <i class="ion ion-document"></i>
                </div>
                <a href="<?php echo e(site_url("{$ci->controller}?kategori={$dokumen_desa['uri']}")); ?>" class="small-box-footer">Lihat Detail <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-4 col-xs-4">
            <div class="small-box rounded bg-aqua">
                <div class="inner">
                    <h3><?php echo e($surat_masuk['total']); ?></h3>
                    <p><?php echo e($surat_masuk['title']); ?></p>
                </div>
                <div class="icon">
                    <i class="ion ion-email"></i>
                </div>
                <a href="<?php echo e(site_url("{$ci->controller}?kategori={$surat_masuk['uri']}")); ?>" class="small-box-footer">Lihat Detail <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-4 col-xs-4">
            <div class="small-box rounded bg-blue">
                <div class="inner">
                    <h3><?php echo e($surat_keluar['total']); ?></h3>
                    <p><?php echo e($surat_keluar['title']); ?></p>
                </div>
                <div class="icon">
                    <i class="ion ion-email"></i>
                </div>
                <a href="<?php echo e(site_url("{$ci->controller}?kategori={$surat_keluar['uri']}")); ?>" class="small-box-footer">Lihat Detail <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-4 col-xs-4">
            <div class="small-box rounded bg-purple">
                <div class="inner">
                    <h3><?php echo e($kependudukan['total']); ?></h3>
                    <p><?php echo e($kependudukan['title']); ?></p>
                </div>
                <div class="icon">
                    <i class="ion ion-person"></i>
                </div>
                <a href="<?php echo e(site_url("{$ci->controller}?kategori={$kependudukan['uri']}")); ?>" class="small-box-footer">Lihat Detail <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-4 col-xs-4">
            <div class="small-box rounded bg-green">
                <div class="inner">
                    <h3><?php echo e($layanan_surat['total']); ?></h3>
                    <p><?php echo e($layanan_surat['title']); ?></p>
                </div>
                <div class="icon">
                    <i class="ion ion-document-text"></i>
                </div>
                <a href="<?php echo e(site_url("{$ci->controller}?kategori={$layanan_surat['uri']}")); ?>" class="small-box-footer">Lihat Detail <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
    <div class="box box-info">
        <div class="box-body with-border">
            <div class="row mepet">
                <div class="col-sm-4">
                    <select class="form-control input-sm select2" name="jenis">
                        <option value="0">Pilih Jenis Dokumen</option>
                        <?php $__currentLoopData = $list_jenis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $jenis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($key); ?>"><?php echo e(strtoupper(str_replace('_', ' ', $jenis))); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-sm-2">
                    <select class="form-control input-sm select2" name="tahun">
                        <option value="0">Pilih Tahun</option>
                        <?php $__currentLoopData = $list_tahun; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tahun): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($tahun); ?>"><?php echo e($tahun); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <hr class="batas">
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table id="tabeldata" class="table table-bordered table-striped table-hover">
                            <thead class="bg-gray color-palette">
                                <tr>
                                    <th class="padat">NO</th>
                                    <th class="padat">AKSI</th>
                                    <th>NOMOR DOKUMEN</th>
                                    <th>TANGGAL DOKUMEN</th>
                                    <th>NAMA DOKUMEN</th>
                                    <th>JENIS DOKUMEN</th>
                                    <th>LOKASI ARSIP</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php echo $__env->make('admin.layouts.components.konfirmasi_hapus', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function() {
            var urlParams = new URLSearchParams(window.location.search);
            let kategori = urlParams.get('kategori');

            var TableData = $('#tabeldata').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "<?php echo e(ci_route('bumindes_arsip')); ?>",
                    data: function(req) {
                        req.jenis = $('[name="jenis"').val();
                        req.tahun = $('[name="tahun"').val();
                        req.kategori = kategori ?? 'layanan_surat';
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        class: 'padat',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'aksi',
                        class: 'aksi',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'nomor_dokumen',
                        name: 'nomor_dokumen',
                        class: 'aksi',
                    },
                    {
                        data: 'tanggal_dokumen',
                        name: 'tanggal_dokumen',
                        class: 'aksi',
                    },
                    {
                        data: 'nama_dokumen',
                        name: 'nama_dokumen',
                    },
                    {
                        data: 'nama_jenis',
                        name: 'nama_jenis',
                        class: 'aksi',
                    },
                    {
                        data: 'lokasi_arsip',
                        name: 'lokasi_arsip',
                    },
                ],
                order: [
                    [3, 'desc']
                ],
            });

            $('[name="jenis"').change(function() {
                TableData.draw()
            })

            $('[name="tahun"').change(function() {
                TableData.draw()
            })

            if (ubah == 0) {
                TableData.column(1).visible(false)
            }
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\opensid\resources\views/admin/bumindes/arsip/index.blade.php ENDPATH**/ ?>