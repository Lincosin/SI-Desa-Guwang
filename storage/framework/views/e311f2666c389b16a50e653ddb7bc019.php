<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="box box-primary box-solid">
    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-comments mr-2 mr-1"></i><?php echo e($judul_widget); ?></h3>
    </div>
    <div class="box-body">
        <marquee
            onmouseover="this.stop()"
            onmouseout="this.start()"
            scrollamount="2"
            direction="up"
            width="100%"
            height="150"
            align="center"
        >
            <ul class="divide-y">
                <?php $__currentLoopData = $komen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="py-2 space-y-2">
                        <blockquote class="italic"> <?php echo e(potong_teks($data['komentar'], 50)); ?></blockquote>... <a href="<?php echo e(site_url('artikel/' . buat_slug($data))); ?>" class="text-link">selengkapnya</a>
                        <p class="text-xs lg:text-sm"><i class="fas fa-comment"></i> <?php echo e($data['owner']); ?></p>
                        <p class="text-xs lg:text-sm"><?php echo e(tgl_indo2($data['tgl_upload'])); ?></p>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </marquee>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\opensid\/desa/themes/samudra/resources/views/widgets/komentar.blade.php ENDPATH**/ ?>