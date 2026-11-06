<div class="form-group" data-kategori="<?php echo e($keyname ?? ''); ?>">
    <label for="<?php echo e(str_replace(['[form_', ']'], '', $groupLabel[0]->kode)); ?>" class="col-sm-3 control-label"><?php echo e($label); ?></label>
    <div class="col-sm-9 row">
        <?php $__currentLoopData = $groupLabel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                // $nama = isset($keyname) ? underscore($item->nama, true, true) . '_' . $keyname : underscore($item->nama, true, true);
                $nama = str_replace(['[form_', ']'], '', $item->kode);
                $class = buat_class($item->atribut, '', $item->required);
                $widthClass = $item->kolom ? 'col-sm-' . $item->kolom : 'col-sm-12';
                $dataKaitkan = strlen($item->kaitkan_kode ?? '') > 10 ? "data-kaitkan='" . $item->kaitkan_kode . "'" : '';
            ?>
            <?php if($item->tipe == 'select-manual'): ?>
                <div class="<?php echo e($widthClass); ?>">
                    <select name="<?php echo e($nama); ?>" <?php echo $class; ?> <?php echo $dataKaitkan; ?>>
                        <option value="">-- <?php echo e($item->deskripsi); ?> --</option>
                        <?php $__currentLoopData = $item->pilihan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $pilih): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option <?= (old($nama, $periksa?->isian_form[$nama] ?? '') == $pilih) ? 'selected' : ''; ?> value="<?php echo e($pilih); ?>"><?php echo e($pilih); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            <?php elseif($item->tipe == 'select-otomatis'): ?>
                <div class="<?php echo e($widthClass); ?>">
                    <select name="<?php echo e($nama); ?>" <?php echo $class; ?> placeholder="<?php echo e($item->deskripsi); ?>">
                        <option value="">-- <?php echo e($item->deskripsi); ?> --</option>
                        <?php $__currentLoopData = ref($item->refrensi); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $pilih): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option <?= (old($nama, $periksa?->isian_form[$nama] ?? '') == $pilih->nama) ? 'selected' : ''; ?> value="<?php echo e($pilih->nama); ?>"><?php echo e($pilih->nama); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            <?php elseif($item->tipe == 'textarea'): ?>
                <div class="<?php echo e($widthClass); ?>">
                    <textarea name="<?php echo e($nama); ?>" <?php echo $class; ?> placeholder="<?php echo e($item->deskripsi); ?>"><?php echo e(old($nama, $periksa?->isian_form[$nama] ?? '')); ?></textarea>
                </div>
            <?php elseif($item->tipe == 'date' || $item->tipe == 'hari' || $item->tipe == 'hari-tanggal'): ?>
                <div class="<?php echo e($widthClass); ?>">
                    <div class="input-group input-group-sm date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" <?php if(strpos($item->atribut, 'datepicker') !== false): ?> <?php echo buat_class($item->atribut, 'form-control input-sm', $item->required); ?> <?php else: ?> <?php echo buat_class($item->atribut, 'form-control input-sm tgl', $item->required); ?> <?php endif; ?> name="<?php echo e($nama); ?>" placeholder="<?php echo e($item->deskripsi); ?>" value="<?php echo e(old($nama, $periksa?->isian_form[$nama] ?? '')); ?>" />
                    </div>
                </div>
            <?php elseif($item->tipe == 'time'): ?>
                <div class="<?php echo e($widthClass); ?>">
                    <div class="input-group input-group-sm date">
                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                        <input type="text" <?php echo buat_class($item->atribut, 'form-control input-sm jam', $item->required); ?> name="<?php echo e($nama); ?>" placeholder="<?php echo e($item->deskripsi); ?>" value="<?php echo e(old($nama, $periksa?->isian_form[$nama] ?? '')); ?>" />
                    </div>
                </div>
            <?php elseif($item->tipe == 'datetime'): ?>
                <div class="<?php echo e($widthClass); ?>">
                    <div class="input-group input-group-sm date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" <?php echo buat_class($item->atribut, 'form-control input-sm tgl_jam', $item->required); ?> name="<?php echo e($nama); ?>" placeholder="<?php echo e($item->deskripsi); ?>" value="<?php echo e(old($nama, $periksa?->isian_form[$nama] ?? '')); ?>" />
                    </div>
                </div>
            <?php else: ?>
                <div class="<?php echo e($widthClass); ?>" <?php echo count($groupLabel) > 2 ? 'style="margin-bottom: 10px"' : ''; ?>>
                    <input type="<?php echo e($item->tipe); ?>" <?php echo $class; ?> name="<?php echo e($nama); ?>" placeholder="<?php echo e($item->deskripsi); ?>" value="<?php echo e(old($nama, $periksa?->isian_form[$nama] ?? '')); ?>" />
                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/surat/baris_kode_isian.blade.php ENDPATH**/ ?>