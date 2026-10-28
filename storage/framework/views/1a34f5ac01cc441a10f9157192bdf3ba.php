
<?php $smd_menu = menu_tema() ?>
<nav class="smd-nav" aria-label="Menu utama">
    <ul class="smd-nav__list">
        <li class="smd-nav__item">
            <a href="<?php echo e(site_url('/')); ?>" class="smd-nav__link">Beranda</a>
        </li>
        <?php if($smd_menu): ?>
            <?php $__currentLoopData = $smd_menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $punya_anak = count($menu['childrens'] ?? []) > 0 ?>
                <li class="smd-nav__item <?php echo e($punya_anak ? 'smd-has-sub' : ''); ?>">
                    <a href="<?php echo e($punya_anak ? '#!' : $menu['link_url']); ?>" class="smd-nav__link" <?php if($punya_anak): ?> aria-haspopup="true" <?php endif; ?>>
                        <?php echo $menu['nama']; ?>

                        <?php if($punya_anak): ?>
                            <i class="fas fa-chevron-down smd-caret" aria-hidden="true"></i>
                        <?php endif; ?>
                    </a>
                    <?php if($punya_anak): ?>
                        <ul class="smd-sub">
                            <?php $__currentLoopData = $menu['childrens']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $anak): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $punya_cucu = count($anak['childrens'] ?? []) > 0 ?>
                                <li class="<?php echo e($punya_cucu ? 'smd-has-sub' : ''); ?>">
                                    <a href="<?php echo e($punya_cucu ? '#!' : $anak['link_url']); ?>" <?php if($punya_cucu): ?> aria-haspopup="true" <?php endif; ?>>
                                        <span><?php echo $anak['nama']; ?></span>
                                        <?php if($punya_cucu): ?>
                                            <i class="fas fa-chevron-right" aria-hidden="true"></i>
                                        <?php endif; ?>
                                    </a>
                                    <?php if($punya_cucu): ?>
                                        <ul class="smd-sub smd-sub--side">
                                            <?php $__currentLoopData = $anak['childrens']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cucu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php $punya_cicit = count($cucu['childrens'] ?? []) > 0 ?>
                                                <li class="<?php echo e($punya_cicit ? 'smd-has-sub' : ''); ?>">
                                                    <a href="<?php echo e($punya_cicit ? '#!' : $cucu['link_url']); ?>" <?php if($punya_cicit): ?> aria-haspopup="true" <?php endif; ?>>
                                                        <span><?php echo $cucu['nama']; ?></span>
                                                        <?php if($punya_cicit): ?>
                                                            <i class="fas fa-chevron-right" aria-hidden="true"></i>
                                                        <?php endif; ?>
                                                    </a>
                                                    <?php if($punya_cicit): ?>
                                                        <ul class="smd-sub smd-sub--side">
                                                            <?php $__currentLoopData = $cucu['childrens']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cicit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <li><a href="<?php echo e($cicit['link_url']); ?>"><span><?php echo $cicit['nama']; ?></span></a></li>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </ul>
                                                    <?php endif; ?>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </ul>
</nav>
<?php /**PATH C:\xampp\htdocs\opensid\/desa/themes/samudra/resources/views/commons/main_menu.blade.php ENDPATH**/ ?>