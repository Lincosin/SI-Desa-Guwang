<?php if($modal): ?>
    <a href="<?php echo e($url); ?>" class="btn bg-info btn-sm" title="<?php echo e($judul ?? 'Lihat Data'); ?>" data-target="#modalBox" data-remote="false" data-toggle="modal" data-backdrop="false" data-keyboard="false" data-title="Detail Produk"><i class="fa fa-eye"></i></a>
<?php else: ?>
<a href="<?php echo e($url); ?>" class="btn bg-info btn-sm" title="<?php echo e($judul ?? 'Lihat Data'); ?>" <?php if($blank): ?> target="_blank" <?php endif; ?>>
    <i class="fa fa-eye fa-sm"></i>
</a>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/layouts/components/buttons/lihat.blade.php ENDPATH**/ ?>