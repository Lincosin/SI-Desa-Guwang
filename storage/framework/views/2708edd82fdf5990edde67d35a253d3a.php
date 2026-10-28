<?php $__currentLoopData = $surat['kode_isian']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php echo $__env->make('admin.surat.baris_kode_isian', ['groupLabel' => $item, 'label' => $label], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/surat/kode_isian.blade.php ENDPATH**/ ?>