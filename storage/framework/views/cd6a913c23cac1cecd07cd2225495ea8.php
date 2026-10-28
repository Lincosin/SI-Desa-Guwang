<div class="slick_slider" style="margin-bottom:5px;">
    <?php $active = true; ?>
    <?php $__currentLoopData = $slider_gambar['gambar']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gambar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $file_gambar = $slider_gambar['lokasi'] . 'sedang_' . $gambar['gambar']; ?>
        <?php if(is_file($file_gambar)): ?>
            <div class="single_iteam <?php echo e($active ? 'active' : ''); ?>" data-artikel="<?php echo e($gambar['id']); ?>"
                <?php if($slider_gambar['sumber'] != 3): ?> onclick="location.href='<?php echo e(ci_route('artikel.' . buat_slug($gambar))); ?>'" <?php endif; ?>>
                <img class="tlClogo" src="<?php echo e(base_url($file_gambar)); ?>">
                <div class="<?php echo e($gambar['judul'] ? 'textgambar' : ''); ?> hidden-xs"><?php echo e($gambar['judul']); ?></div>
            </div>
            <?php $active = false; ?>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<script>
    $('.tlClogo').bind('contextmenu', function(e) {
        return false;
    });
</script>
<?php /**PATH C:\xampp\htdocs\opensid\/storage/app/themes/natra/resources/views/partials/slider.blade.php ENDPATH**/ ?>