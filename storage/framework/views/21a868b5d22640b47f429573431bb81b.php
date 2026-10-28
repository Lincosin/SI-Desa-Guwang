<?php if(can('u')): ?>
    <?php if($modal): ?>
        <a
            <?php if($url): ?> href="<?php echo e(site_url($url)); ?>" <?php endif; ?>
            class="btn <?php echo e($color ?? 'bg-orange'); ?> btn-sm <?php echo e($canClass ?? ''); ?>"
            title="<?php echo e($judul ?? 'Ubah'); ?>"
            data-target="#<?php echo e($modalTarget ?? 'modalBox'); ?>"
            data-remote="false"
            data-toggle="modal"
            data-backdrop="false"
            data-keyboard="false"
            data-title="<?php echo e($judul ?? 'Ubah'); ?>"
        ><i class="<?php echo e($icon ?? 'fa fa-edit'); ?>"></i></a>
    <?php else: ?>
        <a href="<?php echo e(site_url($url)); ?>" class="btn <?php echo e($color ?? 'bg-orange'); ?> btn-sm" title="<?php echo e($judul ?? 'Ubah'); ?> Data" <?php if($blank): ?> target="_blank" <?php endif; ?>><i class="<?php echo e($icon ?? 'fa fa-edit'); ?>"></i></a>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/layouts/components/buttons/edit.blade.php ENDPATH**/ ?>