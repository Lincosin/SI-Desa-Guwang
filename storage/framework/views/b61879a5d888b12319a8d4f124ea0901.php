<?php if($individu): ?>
    <?php echo $__env->make('admin.surat.konfirmasi_pemohon', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php if($anggota): ?>
        <div class="form-group">
            <label for="anggota" class="col-sm-3 control-label">Data Keluarga / KK</label>
            <div class="col-sm-8">
                <a id="showData" class="btn btn-social btn-danger btn-sm" onclick="$(this).closest('.form-group').next('#kel').removeClass('hide');$(this).next('a').removeClass('hide');$(this).toggleClass('hide ')"><i class="fa fa-search-plus"></i>
                    Tampilkan</a>
                <a id="hideData" class="btn btn-social btn-danger btn-sm hide" onclick="$(this).closest('.form-group').next('#kel').addClass('hide');$(this).prev('a').removeClass('hide');$(this).toggleClass('hide ')"><i class="fa fa-search-minus"></i>
                    Sembunyikan</a>
            </div>
        </div>

        <div id="kel" class="form-group hide">
            <label for="pengikut" class="col-sm-3 control-label"></label>
            <div class="col-sm-8">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover tabel-daftar">
                        <thead class="bg-gray disabled color-palette">
                            <tr>
                                <th>No</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Tempat Tanggal Lahir</th>
                                <th>Hubungan</th>
                                <th>Status Kawin</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $anggota; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="padat"><?php echo e($key + 1); ?></td>
                                    <td class="padat"><?php echo e($data->nik); ?></td>
                                    <td nowrap><?php echo e($data->nama); ?></td>
                                    <td nowrap><?php echo e($data->jenis_kelamin); ?></td>
                                    <td nowrap><?php echo e($data->tempatlahir); ?>,
                                        <?php echo e(tgl_indo($data->tanggallahir)); ?>

                                    </td>
                                    <td nowrap><?php echo e($data->penduduk_hubungan); ?></td>
                                    <td nowrap><?php echo e($data->status_perkawinan); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="form-group">
            <label for="keperluan" class="col-sm-3 control-label">Data Keluarga / KK</label>
            <div class="col-sm-8">
                <label class="text-red small">Penduduk yang dipilih bukan
                    <?php echo e(\App\Enums\SHDKEnum::valueOf(\App\Enums\SHDKEnum::KEPALA_KELUARGA)); ?></label>
            </div>
        </div>
    <?php endif; ?>

    <?php if($kategori == 'individu'): ?>
        <div class="row jar_form">
            <label for="nomor" class="col-sm-3"></label>
            <div class="col-sm-8">
                <input class="required" type="hidden" name="nik" value="<?php echo e($individu['id']); ?>">
            </div>
        </div>
    <?php else: ?>
        <div class="row jar_form">
            <label for="nomor" class="col-sm-3"></label>
            <div class="col-sm-8">
                <input class="required" type="hidden" name="id_pend_<?php echo e($kategori); ?>" value="<?php echo e($individu['id']); ?>">
            </div>
        </div>
    <?php endif; ?>

    <?php echo $__env->renderWhen(isset($pengikut), 'admin.surat.pengikut', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
    <?php echo $__env->renderWhen(isset($pengikut_kis), 'admin.surat.pengikut_kis', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
    <?php echo $__env->renderWhen(isset($pengikut_pi), 'admin.surat.pengikut_pi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
    <?php echo $__env->renderWhen(isset($pengikut_pindah), 'admin.surat.pengikut_pindah', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
<?php endif; ?>

<?php echo $__env->renderWhen(isset($peristiwa), 'admin.surat.peristiwa', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>

<?php if($pasangan): ?>
    <?php
        $individu = $pasangan;
        $list_dokumen = $list_dokumen_pasangan;
    ?>
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-lg-3 control-label bg-maroon" style="margin-top:10px;padding-top:10px;padding-bottom:10px"><strong>DATA <?php echo e($pasangan->sex == 1 ? 'SUAMI' : 'ISTRI'); ?></strong></label>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">NIK</label>
        <div class="col-sm-8">
            <input type="text" class="form-control input-sm" value="<?php echo e($pasangan->nik); ?>" disabled>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Nama</label>
        <div class="col-sm-8">
            <input type="text" class="form-control input-sm" value="<?php echo e($pasangan->nama); ?>" disabled>
        </div>
    </div>
    <?php echo $__env->make('admin.surat.konfirmasi_pemohon', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<?php if($ayah): ?>
    <?php
        $individu = $ayah;
        $list_dokumen = $list_dokumen_ayah;
    ?>
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-lg-3 control-label bg-maroon" style="margin-top:10px;padding-top:10px;padding-bottom:10px"><strong>DATA AYAH</strong></label>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">NIK</label>
        <div class="col-sm-8">
            <input type="text" class="form-control input-sm" value="<?php echo e($ayah->nik); ?>" disabled>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Nama</label>
        <div class="col-sm-8">
            <input type="text" class="form-control input-sm" value="<?php echo e($ayah->nama); ?>" disabled>
        </div>
    </div>
    <?php echo $__env->make('admin.surat.konfirmasi_pemohon', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<?php if($ibu): ?>
    <?php
        $individu = $ibu;
        $list_dokumen = $list_dokumen_ibu;
    ?>
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-lg-3 control-label bg-maroon" style="margin-top:10px;padding-top:10px;padding-bottom:10px"><strong>DATA IBU</strong></label>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">NIK</label>
        <div class="col-sm-8">
            <input type="text" class="form-control input-sm" value="<?php echo e($ibu->nik); ?>" disabled>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Nama</label>
        <div class="col-sm-8">
            <input type="text" class="form-control input-sm" value="<?php echo e($ibu->nama); ?>" disabled>
        </div>
    </div>
    <?php echo $__env->make('admin.surat.konfirmasi_pemohon', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/surat/data_penduduk.blade.php ENDPATH**/ ?>