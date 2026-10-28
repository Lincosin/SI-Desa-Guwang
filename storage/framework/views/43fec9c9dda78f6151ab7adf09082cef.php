<?php defined('BASEPATH') || exit('No direct script access allowed'); ?>

<div class="single_bottom_rightbar">
    <h2><i class="fa fa-tags"></i>&ensp;
        <?php echo e($judul_widget); ?>

    </h2>
    <ul id="ul-menu" class="sidebar-latest">
        <?php $__currentLoopData = $menu_kiri; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <a href="<?php echo e(ci_route('artikel/kategori/' . $data['slug'])); ?>">
                    <?php echo e($data['kategori']); ?>

                    <?php if(count($data['submenu'] ?? []) > 0): ?>
                        <span class="caret"></span>
                    <?php endif; ?>
                </a>
                <?php if(count($data['submenu'] ?? []) > 0): ?>
                    <ul class="nav submenu">
                        <?php $__currentLoopData = $data['submenu']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><a href="<?php echo e(ci_route('artikel/kategori/' . $submenu['slug'])); ?>">
                                    <?php echo e($submenu['kategori']); ?>

                                </a></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                <?php endif; ?>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>
<?php /**PATH C:\xampp\htdocs\opensid\/storage/app/themes/natra/resources/views/widgets/menu_kategori.blade.php ENDPATH**/ ?>