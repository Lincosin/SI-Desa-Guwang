<?php echo $__env->make('admin.layouts.components.token', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script src="<?php echo e(asset('js/jquery.validate.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/validasi.js')); ?>"></script>
<script src="<?php echo e(asset('js/localization/messages_id.js')); ?>"></script>
<script src="<?php echo e(asset('js/script.js')); ?>"></script>
<?php if(empty($web_ui) || $web_ui == false): ?>
    <script src="<?php echo e(asset('js/custom-select2.js')); ?>"></script>
    <script src="<?php echo e(asset('js/custom-datetimepicker.js')); ?>"></script>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\opensid\resources/views/admin/layouts/components/validasi_form.blade.php ENDPATH**/ ?>