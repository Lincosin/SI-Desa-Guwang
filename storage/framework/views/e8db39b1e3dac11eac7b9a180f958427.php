<div class="row">
    <div class="col-lg-3 col-sm-6 col-xs-12 widget-surat">
        <a href="<?php echo e(ci_route('surat_dinas_arsip.masuk')); ?>">
            <div class="info-box bg-aqua <?php echo e($tab_ini == 11 ? 'active' : ''); ?>">
                <span class="info-box-icon"><i class="fa fa-envelope-o fa-nav"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Permohonan</span>
                    <span class="info-box-number"><?php echo e($widgets['suratMasuk']); ?></span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">Total : <b><?php echo e($widgets['suratMasuk']); ?></b></span>
                </div>
            </div>
        </a>
    </div>

    <div class="col-lg-3 col-sm-6 col-xs-12 widget-surat">
        <a href="<?php echo e(ci_route('surat_dinas_arsip')); ?>">
            <div class="info-box bg-green <?php echo e($tab_ini == 10 ? 'active' : ''); ?>">
                <span class="info-box-icon"><i class="fa fa-book fa-nav"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Arsip</span>
                    <span class="info-box-number"><?php echo e($widgets['arsip']); ?></span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">Total : <b><?php echo e($widgets['arsip']); ?></b></span>
                </div>
            </div>
        </a>
    </div>

    <?php if($operator && (setting('verifikasi_kades') == 1 || setting('verifikasi_sekdes') == 1)): ?>
        <div class="col-lg-3 col-sm-6 col-xs-12 widget-surat">
            <a href="<?php echo e(ci_route('surat_dinas_arsip.ditolak')); ?>">
                <div class="info-box bg-red <?php echo e($tab_ini == 12 ? 'active' : ''); ?>">
                    <span class="info-box-icon"><i class="fa fa-window-close fa-nav"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Ditolak</span>
                        <span class="info-box-number"><?php echo e($widgets['tolak']); ?></span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 100%"></div>
                        </div>
                        <span class="progress-description">Total : <b><?php echo e($widgets['tolak']); ?></b></span>
                    </div>
                </div>
            </a>
        </div>
    <?php endif; ?>
</div>
<?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/surat_dinas/arsip/widgets.blade.php ENDPATH**/ ?>