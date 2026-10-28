<?php defined('BASEPATH') || exit('No direct script access allowed'); ?>

<div class="single_bottom_rightbar">
    <h2><i class="fa fa-globe"></i>&ensp;<?php echo e($judul_widget); ?></h2>
    <div class="box-body">
        <?php $__currentLoopData = $sosmed; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(!empty($data['link'])): ?>
                <a href="<?php echo e($data['link']); ?>" rel="noopener noreferrer" target="_blank">
                    <img src="<?php echo e($data['icon']); ?>" alt="<?php echo e($data['nama']); ?>" style="width:50px;height:50px;" />
                </a>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\opensid\/storage/app/themes/natra/resources/views/widgets/media_sosial.blade.php ENDPATH**/ ?>