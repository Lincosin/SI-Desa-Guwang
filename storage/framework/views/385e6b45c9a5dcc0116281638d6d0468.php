<?php if(can('u')): ?>
    <?php if($active == '0'): ?>
        <a href="<?php echo e($url); ?>" class="btn bg-navy btn-sm btn-lock" title="Aktifkan"><i class="fa fa-lock"></i></a>
    <?php elseif($active == '1'): ?>
        <a href="<?php echo e($url); ?>" class="btn bg-navy btn-sm btn-lock" title="Nonaktifkan"><i class="fa fa-unlock"></i></a>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/layouts/components/tombol_aktifkan.blade.php ENDPATH**/ ?>