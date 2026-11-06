<?php if(can('b')): ?>
    <?php if($modal): ?>
        <a href="<?php echo e(site_url($url)); ?>"
           class="btn btn-social bg-purple btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"
           data-remote="false"
           data-toggle="modal"
           data-target="<?php echo e($modalTarget ?? '#modalBox'); ?>"
           data-title="<?php echo e($judul ?? 'Cetak'); ?> Data">
           <i class="fa fa-print"></i>
           <?php echo e($judul ?? 'Cetak'); ?> Data
        </a>
    <?php else: ?>
        <a href="<?php echo e(site_url($url)); ?>"
           class="btn btn-social bg-purple btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"
           title="<?php echo e($judul ?? 'Cetak'); ?> Data"
           target="_blank">
           <i class="fa fa-print"></i>
           <?php echo e($judul ?? 'Cetak'); ?> Data
        </a>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/layouts/components/buttons/cetak.blade.php ENDPATH**/ ?>