<?php if(can('u')): ?>
    <?php if($modal): ?>
    <a
        <?php if($noTarget): ?>
            href="<?php echo e($url); ?>"
        <?php else: ?>
            href="<?php echo e(site_url($url)); ?>"
        <?php endif; ?>
        class="btn btn-social btn-success btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"
        title="<?php echo e($judul ?? 'Tambah Data'); ?>"
        <?php if(!$noTarget): ?>
            data-target="#<?php echo e($modalTarget ?? 'modalBox'); ?>"
        <?php endif; ?>
        data-remote="false"
        data-toggle="modal"
        data-backdrop="false"
        data-keyboard="false"
        data-title="<?php echo e($judul ?? 'Tambah Data'); ?>"><i class="fa fa fa-plus"></i>
        <?php echo e($judul ?? 'Tambah'); ?></a>
    <?php else: ?>
        <?php if($buttonOnly): ?>
        <a href="<?php echo e(site_url($url)); ?>" class="btn btn-success btn-sm" title="<?php echo e($judul ?? 'Tambah Data'); ?>" <?php if($blank): ?> target="_blank" <?php endif; ?>><i class="<?php echo e($icon ?? 'fa fa-plus'); ?>"></i></a>
        <?php else: ?>   
        <a href="<?php echo e(site_url($url)); ?>" class="btn btn-social btn-success btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="<?php echo e($judul ?? 'Tambah Data'); ?>" <?php if($blank): ?> target="_blank" <?php endif; ?>><i
            class="fa fa-plus "></i><?php echo e($judul ?? 'Tambah'); ?></a>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/layouts/components/buttons/tambah.blade.php ENDPATH**/ ?>