<?php defined('BASEPATH') || exit('No direct script access allowed'); ?>

<div class="box box-primary box-solid">
    <div class="box-header">
        <h3 class="box-title"><i class="fas fa-globe mr-1"></i><?php echo e($judul_widget); ?></h3>
    </div>
    <div class="box-body flex gap-2">
        <?php $__currentLoopData = $sosmed; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(!empty($data['link'])): ?>
                <a href="<?php echo e($data['link']); ?>" target="_blank">
                    <img src="<?php echo e($data['icon']); ?>" alt="<?php echo e($data['nama']); ?>" style="width:50px;height:50px;" />
                </a>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\opensid\/desa/themes/samudra/resources/views/widgets/media_sosial.blade.php ENDPATH**/ ?>