<?php $__env->startSection('content'); ?>
    <style type="text/css">
        #body {
            page-break-after: always;
        }
    </style>
    <div id="container">
        <link href="<?php echo e(asset('css/report.css')); ?>" rel="stylesheet" type="text/css">
        <?php $__currentLoopData = $all_kk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $__env->make('layanan_mandiri.kependudukan.cetak_kk', ['kepala_kk' => $kk['kepala_kk'], 'desa' => $kk['desa'], 'main' => $kk['main']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <div id="aside"></div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layanan_mandiri.layouts.print.headjs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\opensid\resources\views/layanan_mandiri/kependudukan/cetak_kk_all.blade.php ENDPATH**/ ?>