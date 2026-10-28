<div class="form-group subtitle_head">
    <label class="col-sm-12 control-label" for="lampiran">LAMPIRAN</label>
</div>

<div class="form-group">
    <?php $__currentLoopData = $lampiran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-sm-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" checked="checked" name="lampiran[]" value="<?php echo e($item); ?>">
                <label class="form-check-label">
                    <?php echo e(strtoupper($item)); ?>

                </label>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/surat/lampiran.blade.php ENDPATH**/ ?>