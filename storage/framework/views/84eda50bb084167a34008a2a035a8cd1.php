<?php
    // Deteksi apakah menu ini memiliki anak menu berkategori (Mega Menu)
    $hasGrandChildren = collect($items)->contains(function($item) {
        return !empty($item['childrens']);
    });
?>

<div class="guwang-dropdown <?php echo e($level > 1 ? 'guwang-dropdown-sub' : ''); ?> <?php echo e($hasGrandChildren && $level === 1 ? 'guwang-mega-menu' : ''); ?>">
    <?php if($hasGrandChildren && $level === 1): ?>
        
        <div class="guwang-mega-grid">
            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $anak = $child['childrens'] ?? [];
                    $url = $child['link_url'] ?? $child['link'] ?? '#';
                ?>
                <div class="guwang-mega-col">
                    
                    <span class="guwang-mega-header"><?php echo $child['nama']; ?></span>
                    <div class="guwang-mega-links">
                        <?php if(!empty($anak)): ?>
                            <?php $__currentLoopData = $anak; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subChild): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $subUrl = $subChild['link_url'] ?? $subChild['link'] ?? '#';
                                ?>
                                <a href="<?php echo e($subUrl); ?>" class="guwang-mega-item"><?php echo $subChild['nama']; ?></a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <a href="<?php echo e($url); ?>" class="guwang-mega-item"><?php echo $child['nama']; ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        
        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $anak = $child['childrens'] ?? [];
                $url = $child['link_url'] ?? $child['link'] ?? '#';
            ?>
            <?php if(! empty($anak)): ?>
                <div class="guwang-sub-item">
                    <a href="<?php echo e($url); ?>" class="guwang-sub-link">
                        <span><?php echo $child['nama']; ?></span>
                        <span class="material-symbols-outlined text-[16px]" aria-hidden="true">chevron_right</span>
                    </a>
                    <?php echo $__env->make('theme::commons.nav_dropdown', ['items' => $anak, 'level' => $level + 1], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            <?php else: ?>
                <a href="<?php echo e($url); ?>" class="guwang-dropdown-link"><?php echo $child['nama']; ?></a>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</div><?php /**PATH D:\laragon\www\opensid\/desa/themes/temaku/resources/views/commons/nav_dropdown.blade.php ENDPATH**/ ?>