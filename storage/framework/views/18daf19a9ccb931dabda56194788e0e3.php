<div class="form-group">
    <input type="hidden" name="id_surat" value="<?php echo e($surat['id']); ?>">
    <label class="col-sm-3 control-label">Nomor Surat</label>
    <div class="col-sm-4">
        <input id="nomor" class="form-control input-sm digits required" type="text" placeholder="Nomor Surat" name="nomor" value="<?php echo e($surat_terakhir['no_surat_berikutnya']); ?>">
        <p class="help-block text-red small">
            <?php echo e($surat_terakhir['ket_nomor']); ?><strong><?php echo e($surat_terakhir['no_surat']); ?></strong> (tgl:
            <?php echo e($surat_terakhir['tanggal']); ?>)</p>
    </div>
    <?php if(!empty(setting('format_nomor_surat'))): ?>
        <div class="col-sm-4">
            <p class="help-block"><em>Format nomor surat: </em><span id="format_nomor"><?php echo e($format_nomor_surat); ?></span></p>
        </div>
    <?php endif; ?>
</div>

<?php $__env->startPush('scripts'); ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#nomor').change(function() {
                var nomor = $('#nomor').val();
                var url = $('#url_surat').val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo e(site_url('surat/format_nomor_surat')); ?>",
                    dataType: 'json',
                    data: {
                        nomor: nomor,
                        url: url
                    },
                }).then(function(nomor) {
                    $('#format_nomor').text(nomor);
                });
            });
        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/surat/nomor_surat.blade.php ENDPATH**/ ?>