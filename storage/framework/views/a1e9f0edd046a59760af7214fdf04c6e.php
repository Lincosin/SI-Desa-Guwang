
<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
        $anak = $child['childrens'] ?? [];
        $url = $child['link_url'] ?? $child['link'] ?? '#';
    ?>
    <a href="<?php echo e($url); ?>" class="block py-1.5 text-sm"><?php echo $child['nama']; ?></a>
    <?php if(! empty($anak)): ?>
        <div class="pl-4 border-l border-gray-200 ml-2">
            <?php echo $__env->make('theme::commons.nav_mobile', ['items' => $anak], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH D:\laragon\www\opensid\/desa/themes/temaku/resources/views/commons/nav_mobile.blade.php ENDPATH**/ ?>