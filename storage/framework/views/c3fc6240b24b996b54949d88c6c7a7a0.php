<?php $__currentLoopData = $surat['kode_isian']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
        $nama = isset($keyname) ? underscore($item->nama, true, true) . '_' . $keyname : underscore($item->nama, true, true);
        $class = buat_class($item->atribut, 'form-control input-sm', $item->required);
        $widthClass = 'col-sm-' . (isset($item->kolom) && $item->kolom >= 1 && $item->kolom < 8 ? $item->kolom : 8);
        $dataKaitkan = strlen($item->kaitkan_kode ?? '') > 10 ? "data-kaitkan='" . $item->kaitkan_kode . "'" : '';
    ?>

    <div class="form-group">
        <label for="<?php echo e($nama); ?>" class="col-sm-3 control-label"><?php echo e($item->nama); ?></label>
        <div class="<?php echo e($widthClass); ?>">
            <?php if($item->tipe == 'select-manual'): ?>
                <select name="<?php echo e($nama); ?>" <?php echo $class; ?> <?php echo $dataKaitkan; ?>>
                    <option value="">-- <?php echo e($item->deskripsi); ?> --</option>
                    <?php $__currentLoopData = $item->pilihan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pilih): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option <?php echo e(selected(set_value($nama), $pilih)); ?> value="<?php echo e($pilih); ?>"><?php echo e($pilih); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            <?php elseif($item->tipe == 'select-otomatis'): ?>
                <select name="<?php echo e($nama); ?>" <?php echo $class; ?> placeholder="<?php echo e($item->deskripsi); ?>">
                    <option value="">-- <?php echo e($item->deskripsi); ?> --</option>
                    <?php $__currentLoopData = ref($item->refrensi); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pilih): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option <?php echo e(selected(set_value($nama), $pilih->nama)); ?> value="<?php echo e($pilih->nama); ?>"><?php echo e($pilih->nama); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            <?php elseif($item->tipe == 'textarea'): ?>
                <textarea name="<?php echo e($nama); ?>" <?php echo $class; ?> placeholder="<?php echo e($item->deskripsi); ?>"><?php echo e(set_value($nama)); ?></textarea>
            <?php elseif(in_array($item->tipe, ['date', 'hari', 'hari-tanggal'])): ?>
                <div class="input-group input-group-sm date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" <?php echo buat_class($item->atribut, 'form-control input-sm tgl', $item->required); ?> name="<?php echo e($nama); ?>" placeholder="<?php echo e($item->deskripsi); ?>" value="<?php echo e(set_value($nama)); ?>" />
                </div>
            <?php elseif($item->tipe == 'time'): ?>
                <div class="input-group input-group-sm date">
                    <div class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                    </div>
                    <input type="text" <?php echo buat_class($item->atribut, 'form-control input-sm jam', $item->required); ?> name="<?php echo e($nama); ?>" placeholder="<?php echo e($item->deskripsi); ?>" value="<?php echo e(set_value($nama)); ?>" />
                </div>
            <?php elseif($item->tipe == 'datetime'): ?>
                <div class="input-group input-group-sm date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" <?php echo buat_class($item->atribut, 'form-control input-sm tgl_jam', $item->required); ?> name="<?php echo e($nama); ?>" placeholder="<?php echo e($item->deskripsi); ?>" value="<?php echo e(set_value($nama)); ?>" />
                </div>
            <?php else: ?>
                <input type="<?php echo e($item->tipe); ?>" <?php echo $class; ?> name="<?php echo e($nama); ?>" placeholder="<?php echo e($item->deskripsi); ?>" value="<?php echo e(set_value($nama)); ?>" />
            <?php endif; ?>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH C:\xampp\htdocs\opensid\resources\views/layanan_mandiri/surat/form_kode_isian.blade.php ENDPATH**/ ?>