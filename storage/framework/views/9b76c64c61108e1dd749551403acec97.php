<div class="form-group form-horizontal">
    <select class="form-control input-sm syarat required" name="syarat[<?php echo e($syarat_id); ?>]" onchange="cek_perhatian($(this));">
        <option value=""> -- Pilih dokumen yang melengkapi syarat -- </option>
        <?php $__currentLoopData = $dokumen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($data['id_syarat'] == $syarat_id): ?>
                <option <?= ($data['id'] == $syarat_permohonan[$syarat_id]) ? 'selected' : ''; ?> value="<?php echo e($data['id']); ?>"><?php echo e($data['nama']); ?></option>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if($cek_anjungan): ?>
            <option <?= ('-1' == $syarat_permohonan[$syarat_id]) ? 'selected' : ''; ?> value="-1">Bawa bukti fisik ke Kantor Desa</option>
        <?php endif; ?>
    </select>
    <i class="fa fa-exclamation-triangle text-red perhatian" style="display: none; padding-left: 10px; font-weight: bold;">&nbsp;Perhatian!</i>
</div>
<?php /**PATH D:\laragon\www\opensid\resources\views/layanan_mandiri/surat/pilihan_syarat.blade.php ENDPATH**/ ?>