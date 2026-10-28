<div class="col-sm-2">
    <select name="status" id="status" class="form-control input-sm select2">
        <option value="">Semua</option>
        <?php $__currentLoopData = \App\Enums\AktifEnum::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>
<?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/layouts/components/select_status.blade.php ENDPATH**/ ?>