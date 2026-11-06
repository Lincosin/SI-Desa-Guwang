
<?php
    $tertunda = $unggah_tertunda[$syarat_id] ?? null;
?>
<div class="form-group form-horizontal syarat-pilihan" data-tertunda="<?php echo e($tertunda ? 1 : 0); ?>">
    <select class="form-control input-sm syarat <?php echo e($tertunda ? '' : 'required'); ?>" name="syarat[<?php echo e($syarat_id); ?>]" onchange="cek_perhatian($(this));">
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
    <div class="syarat-unggah" style="margin-top: 6px;">
        <label class="btn btn-default btn-sm" style="margin: 0;" title="Unggah file JPG, PNG atau PDF">
            <i class="fa fa-upload"></i> atau Unggah File
            <input type="file" class="hidden syarat-file" name="syarat_file[<?php echo e($syarat_id); ?>]" accept=".jpg,.jpeg,.png,.pdf" />
        </label>
        <span class="syarat-file-nama small" style="padding-left: 6px;">
            <?php if($tertunda): ?>
                <i class="fa fa-check text-green"></i> File sudah diunggah
            <?php endif; ?>
        </span>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\opensid\resources\views/layanan_mandiri/surat/pilihan_syarat.blade.php ENDPATH**/ ?>