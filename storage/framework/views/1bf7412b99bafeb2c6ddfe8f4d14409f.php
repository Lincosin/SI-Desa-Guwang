<textarea
    class="form-control input-sm <?php echo $value['class']; ?> required"
    id="input_<?php echo e($value['key']); ?>"
    name="<?php echo e($value['key']); ?>"
    rows="5"
    <?php echo e($value['readonly']); ?>

    <?php echo $value['attributes']; ?>

><?php echo e($value['default']); ?></textarea>
<?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/pengaturan/components/textarea.blade.php ENDPATH**/ ?>