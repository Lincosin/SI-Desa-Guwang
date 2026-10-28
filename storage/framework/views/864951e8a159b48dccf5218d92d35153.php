<div class="box">
    <div class="box-header">
        <h3 class="box-title">
            <i class="fas fa-user mr-1"></i><?php echo e($judul_widget); ?>

        </h3>
    </div>
    <div class="box-body">
        <div class="owl-carousel">
            <?php $__currentLoopData = $aparatur_desa['daftar_perangkat']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="relative space-y-2">
                    <div class="w-3/4 mx-auto">
                        <img src="<?php echo e($data['foto']); ?>" alt="<?php echo e($data['nama']); ?>" class="object-cover object-center bg-gray-300">
                    </div>
                    <?php if(getWidgetSetting('aparatur_desa', 'overlay') == true): ?>
                        <div class="space-y-1 text-sm text-center z-10">
                            <span class="text-h6"><?php echo e($data['nama']); ?></span>
                            <span class="block"><?php echo e($data['jabatan']); ?></span>
                            <?php if($data['pamong_niap']): ?>
                                <span class="block"><?php echo e(setting('sebutan_nip_desa')); ?> : <?php echo e($data['pamong_niap']); ?></span>
                            <?php endif; ?>
                            <?php if($tampilkan_status_kehadiran): ?>
                                <?php if($data['kehadiran'] == 1): ?>
                                    <?php if($data['status_kehadiran'] == 'hadir'): ?>
                                        <span class="btn btn-primary w-auto mx-auto inline-block">Hadir</span>
                                    <?php endif; ?>
                                    <?php if($data['tanggal'] == date('Y-m-d') && $data['status_kehadiran'] != 'hadir'): ?>
                                        <span class="btn btn-danger w-auto mx-auto inline-block"><?php echo e(ucwords($data['status_kehadiran'])); ?></span>
                                    <?php endif; ?>
                                    <?php if($data['tanggal'] != date('Y-m-d')): ?>
                                        <span class="btn btn-danger w-auto mx-auto inline-block">Belum Rekam Kehadiran</span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php else: ?>
                                <span class="btn btn-default w-auto mx-auto inline-block">Hari Libur</span>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\opensid\/desa/themes/samudra/resources/views/widgets/aparatur_desa.blade.php ENDPATH**/ ?>