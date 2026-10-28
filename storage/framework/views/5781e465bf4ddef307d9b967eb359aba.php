<?php if(can('h')): ?>
    <?php if($confirmDelete): ?>
        <?php if($selectData): ?>
            <a href="#confirm-delete" title="<?php echo e($judul ?? 'Hapus'); ?> Data" onclick="deleteAllBox('mainform','<?php echo e(site_url($url)); ?>')" class="btn btn-social <?php echo e($type ?? 'btn-danger'); ?> btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block hapus-terpilih">
                <i class="<?php echo e($icon ?? 'fa fa-trash-o'); ?>"></i> <?php echo e($judul ?? 'Hapus'); ?>

            </a>
        <?php else: ?>
            <?php if($visible): ?>
            <a href="#confirm-delete" title="<?php echo e($judul ?? 'Hapus'); ?> Data" onclick="deleteAllBox('mainform', '<?php echo e(site_url($url)); ?>')" class="btn btn-social <?php echo e($type ?? 'btn-danger'); ?> btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"><i
                                class="<?php echo e($icon ?? 'fa fa-trash-o'); ?>"
                            ></i> <?php echo e($judul ?? 'Hapus'); ?></a>
            <?php else: ?>
            <a href="#" data-href="<?php echo e($url); ?>" class="btn bg-maroon btn-sm" title="<?php echo e($judul ?? 'Hapus'); ?> Data" data-toggle="modal" data-target="#<?php echo e($target ?? 'confirm-delete'); ?>" <?php echo e($attributes); ?>>
                <i class="<?php echo e($icon ?? 'fa fa-trash-o'); ?>"></i>
            </a>
            <?php endif; ?>
        <?php endif; ?>
    <?php else: ?>
        <a type="button" class="btn btn-sm <?php echo e($type ?? 'btn-danger'); ?>"  <?php echo e($attribut); ?> onclick="<?php echo e($onclick); ?>" title="<?php echo e($judul ?? 'Hapus'); ?> Data">
            <i class="<?php echo e($icon ?? 'fa fa-trash'); ?>"></i>
        </a>
    <?php endif; ?>
<?php endif; ?>

<?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/layouts/components/buttons/hapus.blade.php ENDPATH**/ ?>