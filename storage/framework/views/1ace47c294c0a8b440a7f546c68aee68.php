<?php $__env->startSection('title'); ?>
    <h1>
        Laporan Kependudukan Bulanan
    </h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="active">Laporan Kependudukan Bulanan</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.layouts.components.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <form id="mainform" name="mainform" action="<?php echo e(ci_route('laporan')); ?>" method="post" class="form-horizontal">
        <div class="row">
            <div class="col-md-12">
                <?php if($data_lengkap): ?>
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <a
                                href="<?php echo e(ci_route('laporan.dialog.cetak')); ?>"
                                class="btn btn-social bg-purple btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"
                                title="Cetak Laporan"
                                data-remote="false"
                                data-toggle="modal"
                                data-target="#modalBox"
                                data-title="Cetak Laporan"
                            ><i class="fa fa-print "></i> Cetak</a>
                            <a
                                href="<?php echo e(ci_route('laporan.dialog.unduh')); ?>"
                                title="Unduh Laporan"
                                class="btn btn-social bg-navy btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"
                                title="Unduh Laporan"
                                data-remote="false"
                                data-toggle="modal"
                                data-target="#modalBox"
                                data-title="Unduh Laporan"
                            ><i class="fa fa-download"></i> Unduh</a>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h4 class="text-center"><strong>PEMERINTAH KABUPATEN/KOTA <?php echo e(strtoupper($desa['nama_kabupaten'])); ?></strong></h4>
                                    <h5 class="text-center"><strong>LAPORAN PERKEMBANGAN PENDUDUK (LAMPIRAN A - 9)</strong></h5>
                                    <br />
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="kelurahan"><?php echo e(ucwords(setting('sebutan_desa'))); ?>/Kelurahan</label>
                                        <div class="col-sm-7 col-md-5">
                                            <input type="text" class="form-control input-sm" value="<?php echo e($desa['nama_desa']); ?>" disabled /></input>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="kecamatan"><?php echo e(ucwords(setting('sebutan_kecamatan'))); ?></label>
                                        <div class="col-sm-7 col-md-5">
                                            <input type="text" class="form-control input-sm" value="<?php echo e($desa['nama_kecamatan']); ?>" disabled /></input>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="tahun">Tahun</label>
                                        <div class="col-sm-2">
                                            <select class="form-control input-sm required select2" name="tahun" onchange="formAction('mainform','<?php echo e(ci_route('laporan.bulan')); ?>')" width="100%">
                                                <option value="">Pilih Tahun</option>
                                                <?php for($t = date('Y'); $t >= $tahun_lengkap; $t--): ?>
                                                    <option value="<?php echo e($t); ?>" <?= ($tahun == $t) ? 'selected' : ''; ?>><?php echo e($t); ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                        <label class="col-sm-2 col-md-1 control-label" for="tahun">Bulan</label>
                                        <div class="col-sm-3 col-md-2">
                                            <select class="form-control input-sm select2" name="bulan" onchange="formAction('mainform','<?php echo e(ci_route('laporan.bulan')); ?>')" width="100%">
                                                <option value="">Pilih bulan</option>
                                                <?php $__currentLoopData = bulan(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $no_bulan => $nama_bulan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value=<?php echo e($no_bulan); ?> <?= ($bulan == $no_bulan) ? 'selected' : ''; ?>><?php echo e($nama_bulan); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <?php if($sesudah_data_lengkap): ?>
                                        <div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <?php echo $__env->make('admin.laporan.tabel_bulanan', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <div class="box box-info">
                                            <div class="box-header with-border">
                                            </div>
                                            <div class="box-body">
                                                <div class="alert alert-warning">
                                                    Tahun-bulan sebelum tanggal lengkap data pada <?php echo e($tgl_lengkap); ?>

                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <?php echo $__env->make('admin.bumindes.penduduk.data_lengkap', ['judul' => 'Data Penduduk'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;
                <?php endif; ?>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/laporan/bulanan.blade.php ENDPATH**/ ?>