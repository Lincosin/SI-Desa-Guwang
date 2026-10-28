<div class="box box-<?php echo e($status == 1 ? 'success' : ($sistem == 1 ? 'info' : 'danger')); ?>">
    <div class="box-header with-border text-center">
        <strong><?php echo e($nama); ?></strong>
        <div class="ribbon-wrapper">
            <?php
                $ribbonClass = $status == 1 ? 'btn-success' : ($sistem == 1 ? 'btn-info' : 'btn-danger');
                $ribbonText = $status == 1 ? 'Aktif' : ($sistem == 1 ? 'Umum' : 'Premium');
            ?>
            <div class="<?php echo e($ribbonClass); ?> ribbon">
                <?php echo e($ribbonText); ?>

            </div>
        </div>
    </div>

    <div class="box-body">
        <div class="text-center">
            <center>
                <?php $file = $asset_path . '/thumbnail/preview-1.jpg' ?>
                <?php if(file_exists(FCPATH . $file)): ?>
                    <img style="width:100%; max-height: 160px;" src="<?php echo e(base_url($asset_path . '/thumbnail/preview-1.jpg')); ?>" class="img-responsive" alt="<?php echo e($nama); ?>">
                <?php elseif($thumbnail): ?>
                    <img style="width:100%; max-height: 160px;" src="<?php echo e($thumbnail); ?>" class="img-responsive" alt="<?php echo e($nama); ?>">
                <?php else: ?>
                    <img style="max-height: 160px;" src="<?php echo e(asset('images/404-image-not-found.jpg')); ?>" class="img-responsive" alt="<?php echo e($nama); ?>">
                <?php endif; ?>
            </center>
        </div>
        <br>
        <div class="text-center">
            <?php if($status == 1): ?>
                <a href="#" class="btn btn-social btn-success btn-sm" readonly><i class="fa fa-star"></i>Aktif</a>
            <?php elseif($marketplace): ?>
                <?php if($providers): ?>
                    <a href="<?php echo e($providers); ?>" class="btn btn-social btn-info btn-sm" target="_blank"><i class="fa fa-eye"></i>Preview</a>
                <?php endif; ?>
                <a href="https://opendesa.id/tema-premium" class="btn btn-social btn-warning btn-sm" target="_blank"><i class="fa fa-info"></i>Hubungi</a>
                <?php if($themeOrder?->firstWhere('nama', $nama)): ?>
                    <form action="<?php echo e(site_url('theme/unduh')); ?>" method="POST" style="display:inline;">
                        <input type="hidden" name="nama" value="<?php echo e($nama); ?>">
                        <input type="hidden" name="url" value="<?php echo e($url); ?>">
                        <button type="submit" class="btn btn-social bg-navy btn-sm" title="Unduh Tema">
                            <i class="fa fa-download"></i> Unduh
                        </button>
                    </form>
                <?php endif; ?>
            <?php else: ?>
                <?php if(can('u')): ?>
                    <a href="<?php echo e(site_url('theme/aktifkan/' . $id)); ?>" class="btn btn-info btn-sm" title="Aktifkan Tema"><i class="fa fa-star-o"></i></a>
                <?php endif; ?>
                <?php if(!cache('siappakai') && !setting('multi_desa') && can('h') && $sistem !== 1): ?>
                    <a href="#" data-href="<?php echo e(site_url('theme/delete/' . $id)); ?>" class="btn btn-danger btn-sm" title="Hapus Tema" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash"></i></a>
                <?php endif; ?>
            <?php endif; ?>
            <?php if(!$marketplace && can('u')): ?>
                <a href="<?php echo e(site_url('theme/pengaturan/' . $id)); ?>" class="btn bg-navy btn-sm" title="Pengaturan Tema"><i class="fa fa-cog"></i></a>
            <?php endif; ?>
        </div>
    </div>

</div>
<?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/theme/components/general/box.blade.php ENDPATH**/ ?>