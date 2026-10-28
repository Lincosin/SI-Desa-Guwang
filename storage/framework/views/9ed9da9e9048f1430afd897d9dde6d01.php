<form id="validasi" action="<?php echo e($form_action); ?>" method="POST" enctype="multipart/form-data">
    <div class="modal-body">
        <div class="form-group">
            <label for="alasan">Alasan</label>
            <textarea class="form-control input-sm required" placeholder="alasan" name="alasan" rows="5"></textarea>
        </div>
    </div>
    <div class="modal-footer">
        <?php echo batal(); ?>

        <button type="submit" class="btn btn-social btn-info btn-sm" id="ok"><i class='fa fa-check'></i> Simpan</button>
    </div>
</form>

<?php echo $__env->make('admin.layouts.components.form_modal_validasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/surat/keluar/ajax_edit_surat.blade.php ENDPATH**/ ?>