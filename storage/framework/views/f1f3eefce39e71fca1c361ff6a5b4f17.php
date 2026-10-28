<div class="tab-pane" id="alur">
    <div class="box-body">
        <div class="alert alert-warning alert-dismissible">
            <h4><i class="icon fa fa-warning"></i> Info Penting!</h4>
            Menonaktifkan verifikasi akan mempengaruhi log surat maka pastikan bahwa benar surat ingin
            diarsipkan semua.
        </div>
        
        <div class="form-group">
            <label>Verifikasi Kepala Dusun</label>
            <div class="input-group col-xs-12 col-sm-8">
                <div class="btn-group col-xs-12 col-sm-8" data-toggle="buttons" style="padding: 0px;">
                    <label class="btn btn-info btn-flat btn-sm col-xs-6 col-sm-5 col-lg-3 form-check-label <?= (setting('verifikasi_kadus') == '1') ? 'active' : ''; ?>">
                        <input
                            type="radio"
                            name="verifikasi_kadus"
                            class="form-check-input"
                            value="1"
                            autocomplete="off"
                            <?= (setting('verifikasi_kadus') == '1') ? 'checked' : ''; ?>
                        >Ya</label>
                    <label class="btn btn-info btn-flat btn-sm col-xs-6 col-sm-5 col-lg-3 form-check-label <?= (setting('verifikasi_kadus') != '1') ? 'active' : ''; ?>">
                        <input
                            type="radio"
                            name="verifikasi_kadus"
                            class="form-check-input"
                            value="0"
                            autocomplete="off"
                            <?= (setting('verifikasi_kadus') != '1') ? 'checked' : ''; ?>
                        >Tidak
                    </label>
                </div>
            </div>
            <span class="help-block">Surat diverifikasi Kepala Dusun sesuai dusun pemohon, setelah operator dan sebelum
                <?php echo e(setting('sebutan_sekretaris_desa')); ?> / <?php echo e(setting('sebutan_kepala_desa')); ?>. Dusun tanpa akun Kepala Dusun dilewati.</span>
            <?php if(isset($daftar_kadus)): ?>
                <ul class="help-block" style="margin-top: 0;">
                    <?php $__currentLoopData = $daftar_kadus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kadus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>Dusun <?php echo e($kadus['dusun']); ?>: <?php echo e($kadus['nama'] ?? 'Kepala dusun belum diisi'); ?>

                            <?php if($kadus['nama']): ?>
                                <span class="<?php echo e($kadus['akun'] ? 'text-green' : 'text-red'); ?>">(<?php echo e($kadus['akun'] ? 'akun tersedia' : 'belum punya akun pengguna'); ?>)</span>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
    <div class="box-body">
        <div class="form-group">
            <label>Verifikasi <?php echo e(setting('sebutan_sekretaris_desa')); ?></label>
            <div class="input-group col-xs-12 col-sm-8">
                <div class="btn-group col-xs-12 col-sm-8" data-toggle="buttons" style="padding: 0px;">
                    <label class="btn btn-info btn-flat btn-sm col-xs-6 col-sm-5 col-lg-3 form-check-label <?= (setting('verifikasi_sekdes') == '1') ? 'active' : ''; ?> <?= (!$sekdes) ? 'disabled' : ''; ?>">
                        <input
                            type="radio"
                            name="verifikasi_sekdes"
                            class="form-check-input"
                            value="1"
                            autocomplete="off"
                            <?= (setting('verifikasi_sekdes') == '1' && $sekdes) ? 'checked' : ''; ?>
                            <?= (!$sekdes) ? 'disabled' : ''; ?>
                        >Ya</label>
                    <label class="btn btn-info btn-flat btn-sm col-xs-6 col-sm-5 col-lg-3 form-check-label <?= (setting('verifikasi_sekdes') == '0') ? 'active' : ''; ?> <?= (!$sekdes) ? 'disabled' : ''; ?>">
                        <input
                            type="radio"
                            name="verifikasi_sekdes"
                            class="form-check-input"
                            value="0"
                            autocomplete="off"
                            <?= (setting('verifikasi_sekdes') == '0' && $sekdes) ? 'checked' : ''; ?>
                            <?= (!$sekdes) ? 'disabled' : ''; ?>
                        >Tidak
                    </label>
                </div>
            </div>
            <span class="help-block text-red <?= (!$sekdes) ? 'show' : 'hide'; ?>">User
                <?php echo e(setting('sebutan_sekretaris_desa')); ?> belum tersedia</span>
        </div>
    </div>
    <div class="box-body">
        <div class="form-group">
            <label>Verifikasi <?php echo e(setting('sebutan_kepala_desa')); ?></label>
            <div class="input-group col-xs-12 col-sm-8">
                <div class="btn-group col-xs-12 col-sm-8" data-toggle="buttons" style="padding: 0px;">
                    <label class="btn btn-info btn-flat btn-sm col-xs-6 col-sm-5 col-lg-3 form-check-label <?= (setting('verifikasi_kades') == '1') ? 'active' : ''; ?> <?= (setting('tte') == '1' || !$kades) ? 'disabled' : ''; ?>">
                        <input
                            type="radio"
                            name="verifikasi_kades"
                            class="form-check-input"
                            value="1"
                            autocomplete="off"
                            <?= (setting('verifikasi_kades') == '1') ? 'checked' : ''; ?>
                            <?= (setting('tte') == '1' || !$kades) ? 'disabled' : ''; ?>
                        >Ya</label>
                    <label class="btn btn-info btn-flat btn-sm col-xs-6 col-sm-5 col-lg-3 form-check-label <?= (setting('verifikasi_kades') == '0') ? 'active' : ''; ?> <?= (setting('tte') == '1' || !$kades) ? 'disabled' : ''; ?>">
                        <input
                            type="radio"
                            name="verifikasi_kades"
                            class="form-check-input"
                            value="0"
                            autocomplete="off"
                            <?= (setting('verifikasi_kades') == '0') ? 'checked' : ''; ?>
                            <?= (setting('tte') == '1' || !$kades) ? 'disabled' : ''; ?>
                        >Tidak
                    </label>
                </div>
            </div>
            <span class="help-block text-red <?= (!$kades) ? 'show' : 'hide'; ?>">User
                <?php echo e(setting('sebutan_kepala_desa')); ?> belum tersedia</span>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/pengaturan_surat/partials/pengaturan_alur.blade.php ENDPATH**/ ?>