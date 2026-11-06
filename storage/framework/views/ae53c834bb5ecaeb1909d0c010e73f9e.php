<?php $__env->startSection('title'); ?>
    <h1>
        Salinan Kartu <?php echo e($module_name); ?>

    </h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li><a href="<?php echo e(ci_route('keluarga')); ?>"> Data <?php echo e($module_name); ?></a></li>
    <li><a href="<?php echo e(ci_route('keluarga.anggota', $id_kk)); ?>"> Data Anggota <?php echo e($module_name); ?></a></li>
    <li class="active">Kartu <?php echo e($module_name); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.layouts.components.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <form id="mainform" name="mainform" method="post">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <a href="<?php echo e(ci_route('keluarga.cetak_kk', $id_kk)); ?>" class="btn btn-social bg-purple btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" target="_blank"><i class="fa fa-print "></i> Cetak</a>
                        <a href="<?php echo e(ci_route('keluarga.doc_kk', $id_kk)); ?>" class="btn btn-social bg-navy btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" target="_blank"><i class="fa fa-download"></i> Unduh</a>
                        <a href="<?php echo e(site_url("keluarga/doc_kk/{$id_kk}?format=F1.09")); ?>" class="btn btn-social bg-navy btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" target="_blank"><i class="fa fa-download"></i> Unduh F1.09</a>
                        <?php echo $__env->make('admin.layouts.components.tombol_kembali', ['url' => ci_route('keluarga.anggota', $id_kk), 'label' => 'Daftar Anggota Keluarga'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        <?php echo $__env->make('admin.layouts.components.tombol_kembali', ['url' => ci_route('keluarga'), 'label' => 'Daftar Keluarga'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    </div>
                    <div class="box-header">
                        <h3 class="text-center"><strong>SALINAN KARTU KELUARGA</strong></h3>
                        <h5 class="text-center"><strong>No. <?php echo e(get_nokk($main['no_kk'])); ?> </strong></h5>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">ALAMAT</label>
                                    <div class="col-sm-8">
                                        <p class="text-muted">: <?php echo e(strtoupper($kepala_kk['alamat_wilayah_kartu_keluarga'])); ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">RT/RW</label>
                                    <div class="col-sm-9">
                                        <p class="text-muted">: <?php echo e($kepala_kk['keluarga']['wilayah']['rt']); ?> / <?php echo e($kepala_kk['keluarga']['wilayah']['rw']); ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">DESA / KELURAHAN</label>
                                    <div class="col-sm-9">
                                        <p class="text-muted">: <?php echo e(strtoupper($desa['nama_desa'])); ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">KECAMATAN</label>
                                    <div class="col-sm-9">
                                        <p class="text-muted">: <?php echo e(strtoupper($desa['nama_kecamatan'])); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-sm-5 control-label">KABUPATEN</label>
                                    <div class="col-sm-7">
                                        <p class="text-muted">: <?php echo e(strtoupper($desa['nama_kabupaten'])); ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-5 control-label">KODE POS</label>
                                    <div class="col-sm-7">
                                        <p class="text-muted">: <?php echo e($desa['kode_pos']); ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-5 control-label">PROVINSI</label>
                                    <div class="col-sm-7">
                                        <p class="text-muted">: <?php echo e(strtoupper($desa['nama_propinsi'])); ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-5 control-label">JUMLAH ANGGOTA</label>
                                    <div class="col-sm-7">
                                        <p class="text-muted">: <?php echo e(count($main['anggota'])); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover ">
                                        <thead class="bg-gray disabled color-palette">
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Nama Lengkap</th>
                                                <th class="text-center">NIK</th>
                                                <th class="text-center">Jenis Kelamin</th>
                                                <th class="text-center">Tempat Lahir</th>
                                                <th class="text-center">Tanggal Lahir</th>
                                                <th class="text-center">Agama</th>
                                                <th class="text-center">Pendidikan</th>
                                                <th class="text-center">Jenis Pekerjaan</th>
                                                <th class="text-center">Golongan Darah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $main['anggota']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td class="text-center"><?php echo e($key + 1); ?></td>
                                                    <td><?php echo e(strtoupper($data['nama'])); ?></td>
                                                    <td><?php echo e(get_nik($data['nik'])); ?></td>
                                                    <td><?php echo e($data['jenis_kelamin']); ?></td>
                                                    <td><?php echo e($data['tempatlahir']); ?></td>
                                                    <td><?php echo e(tgl_indo_out($data['tanggallahir'])); ?></td>
                                                    <td><?php echo e($data['agama']); ?></td>
                                                    <td><?php echo e($data['pendidikan_kk']); ?></td>
                                                    <td><?php echo e($data['pekerjaan']); ?></td>
                                                    <td><?php echo e($data['golongan_darah']); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover ">
                                        <thead class="bg-gray disabled color-palette">
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Status Perkawinan</th>
                                                <th class="text-center"><?php echo e(\Illuminate\Support\Str::headerKawinCerai(collect($main['anggota'])->pluck('status_perkawinan'))); ?></th>
                                                <th class="text-center">Status Hubungan Dalam Keluarga</th>
                                                <th class="text-center">Kewarganegaraan</th>
                                                <th class="text-center">No. Paspor</th>
                                                <th class="text-center">No. KITAS / KITAP</th>
                                                <th class="text-center">Nama Ayah</th>
                                                <th class="text-center">Nama Ibu</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $main['anggota']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td class="text-center"><?php echo e($key + 1); ?></td>
                                                    <td><?php echo e($data['status_perkawinan'] ?? ''); ?></td>
                                                    <td class="text-center"><?php echo e(str_contains($data['status_perkawinan'], 'KAWIN') ? tgl_indo_out($data['tanggalperkawinan']) : tgl_indo_out($data['tanggalperceraian'])); ?></td>
                                                    <td><?php echo e($data['penduduk_hubungan']); ?></td>
                                                    <td><?php echo e($data['warganegara']); ?></td>
                                                    <td><?php echo e($data['dokumen_pasport']); ?></td>
                                                    <td><?php echo e($data['dokumen_kitas']); ?></td>
                                                    <td><?php echo e(strtoupper($data['nama_ayah'])); ?></td>
                                                    <td><?php echo e(strtoupper($data['nama_ibu'])); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-responsive">
                                    <table class="table no-border">
                                        <tbody>
                                            <tr>
                                                <td width="25%">&nbsp;</td>
                                                <td width="50%">&nbsp;</td>
                                                <td class="text-center" width="25%"><?php echo e($desa['nama_desa']); ?>, <?php echo e(tgl_indo(date('Y m d'))); ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">KEPALA KELUARGA</td>
                                                <td>&nbsp;</td>
                                                <td class="text-center"><?php echo e(strtoupper(setting('sebutan_kepala_desa') . ' ' . $desa['nama_desa'])); ?></td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center"><?php echo e(strtoupper($kepala_kk['nama'])); ?></td>
                                                <td width="50%">&nbsp;</td>
                                                <td class="text-center"><?php echo e(strtoupper($desa['nama_kepala_desa'])); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/penduduk/keluarga/kartu_keluarga.blade.php ENDPATH**/ ?>