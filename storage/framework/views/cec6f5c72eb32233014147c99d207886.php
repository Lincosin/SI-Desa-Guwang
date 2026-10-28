<?php if(can('u')): ?>
    <?php if($active == 0): ?>
        <a href="<?php echo e($url); ?>" 
           class="btn bg-purple btn-sm" 
           title="Jadikan TTD <?php echo e($label); ?>"><?php echo e($label); ?></a>
    <?php else: ?>
        <a href="<?php echo e($url); ?>" 
           class="btn bg-navy btn-sm" 
           title="Bukan TTD <?php echo e($label); ?>"><?php echo e($label); ?></a>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/layouts/components/tombol_ttd.blade.php ENDPATH**/ ?>