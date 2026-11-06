<form action="<?php echo e($form_action); ?>" method="post" id="validasi">
    <div class="modal-body">
        <div class="form-group">
            <label class="control-label" for="nama">Nama Kategori</label>
            <input name="kategori" class="form-control input-sm required nomor_sk" maxlength="50" type="text" value="<?php echo e($kategori->kategori ?? ''); ?>">
        </div>
    </div>
    <div class="modal-footer">
        <?php echo batal(); ?>

        <button type="submit" class="btn btn-social btn-info btn-sm confirm"><i class="fa fa-check"></i> Simpan</button>
    </div>
</form>
<?php echo $__env->make('admin.layouts.components.form_modal_validasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/web/kategori/ajax_form.blade.php ENDPATH**/ ?>