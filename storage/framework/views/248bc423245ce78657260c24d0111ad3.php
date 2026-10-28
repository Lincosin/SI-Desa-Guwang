<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fas fa-bars mr-1"></i><?php echo e($judul_widget); ?></h3>
    </div>
    <div class="box-body content">
        <ul class="divide-y">
            <?php $__currentLoopData = $menu_kiri; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><a href="<?php echo e(site_url('artikel/kategori/' . $data['slug'])); ?>" class="py-2 block"><?php echo e($data['kategori']); ?></a>
                    <?php if(count($data['submenu'] ?? []) > 0): ?>
                        <ul class="divide-y">
                            <?php $__currentLoopData = $data['submenu']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a href="<?php echo e(site_url('artikel/kategori/' . $submenu['slug'])); ?>" class="py-2 block"><?php echo e($submenu['kategori']); ?></a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\opensid\/desa/themes/samudra/resources/views/widgets/menu_kategori.blade.php ENDPATH**/ ?>