<div class="box box-primary box-solid">
    <div class="box-header">
        <h3 class="box-title">
            <a href="<?php echo e(site_url('galeri')); ?>"><i class="fas fa-camera mr-1"></i><?php echo e($judul_widget); ?></a>
        </h3>
    </div>
    <div class="box-body grid grid-cols-3 gap-2 flex-wrap">
        <?php $__currentLoopData = $w_gal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(is_file(LOKASI_GALERI . 'sedang_' . $data['gambar'])): ?>
                <a href='<?php echo e(route('web.galeri.detail', $data['id'])); ?>' title="<?php echo e("Album : {$data['nama']}"); ?>">
                    <img src="<?php echo e(AmbilGaleri($data['gambar'], 'kecil')); ?>" alt="<?php echo e("Album : {$data['nama']}"); ?>" class="w-full">
                </a>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\opensid\/desa/themes/samudra/resources/views/widgets/galeri.blade.php ENDPATH**/ ?>