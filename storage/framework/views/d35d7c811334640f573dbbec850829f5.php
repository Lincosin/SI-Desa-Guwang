<?php if(can('u')): ?>
    <?php if($active == '0'): ?>
        <a href="<?php echo e($url); ?>" class="btn bg-aqua btn-sm btn-lock" title="Aktifkan Kehadiran Perangkat"><i class="fa fa-ban"></i></a>
    <?php else: ?>
        <a href="<?php echo e($url); ?>" class="btn bg-aqua btn-sm btn-lock" title="Nonaktifkan Kehadiran Perangkat"><i class="fa fa-check"></i></a>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/layouts/components/tombol_kehadiran.blade.php ENDPATH**/ ?>