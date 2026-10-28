<?php defined('BASEPATH') || exit('No direct script access allowed'); ?>

<div class="single_bottom_rightbar">
    <h2><i class="fa fa-book"></i> <a href="<?php echo e(site_url('galeri')); ?>">&ensp;<?php echo e($judul_widget); ?></a></h2>
    <div class="latest_slider">
        <div class="slick_slider">
            <?php $__currentLoopData = $w_gal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(is_file(LOKASI_GALERI . 'sedang_' . $data['gambar'])): ?>
                    <div class="single_iteam"><img src="<?php echo e(AmbilGaleri($data['gambar'], 'kecil')); ?>" alt="Album : <?php echo e($data['nama']); ?>">
                        <h2><a class="slider_tittle" href="<?php echo e(site_url("galeri/$data[id]")); ?>"><?php echo e($data['nama']); ?></a></h2>
                    </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\opensid\/storage/app/themes/natra/resources/views/widgets/galeri.blade.php ENDPATH**/ ?>