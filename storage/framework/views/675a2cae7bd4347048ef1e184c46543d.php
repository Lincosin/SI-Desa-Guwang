<?php if(can('u')): ?>
    <?php if($show == '1'): ?>
        <?php if($active == '0'): ?>
            <a href="<?php echo e($url); ?>" class="btn bg-purple btn-sm" title="Tambahkan ke Daftar Favorit"><i class="fa fa-star-o"></i></a>
        <?php elseif($active == '1'): ?>
            <a href="<?php echo e($url); ?>" class="btn bg-purple btn-sm" title="Keluarkan dari Daftar Favorit"><i class="fa fa-star"></i></a>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/layouts/components/tombol_favorit.blade.php ENDPATH**/ ?>