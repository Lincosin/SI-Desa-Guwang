<div class="form-group">
    <label class="col-sm-3 control-label">Tertanda Atas Nama</label>
    <div class="col-sm-6 col-lg-6">
        <select class="form-control input-sm" id="atas_nama" name="pilih_atas_nama" onchange="ganti_ttd($(this).val());">
            <?php $__currentLoopData = $atas_nama; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($key); ?>"><?php echo e($data); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label">Staf <?php echo e(ucwords(setting('sebutan_pemerintah_desa'))); ?></label>
    <div class="col-sm-6 col-lg-6">
        <select class="form-control required input-sm" id="pamong" name="pamong_id">
            <option value='' selected="selected">-- <?php echo e('Pilih ' . ucwords(setting('sebutan_pemerintah_desa'))); ?> --</option>
            <?php $__currentLoopData = $pamong; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option
                    value="<?php echo e($data->pamong_id); ?>"
                    data-jenis="<?php echo e($data->jenis); ?>"
                    data-jabatan="<?php echo e(trim($data->jabatan->nama)); ?>"
                    data-nip="<?php echo e($data->pamong_nip); ?>"
                    data-niap="<?php echo e($data->pamong_niap); ?>"
                    data-ttd="<?php echo e($data->pamong_ttd); ?>"
                    data-ub="<?php echo e($data->pamong_ub); ?>"
                >
                    <?php echo e($data->pamong_nip ? 'NIP : ' . ($data->pamong_nip ?: '-') . ' | ' : setting('sebutan_nip_desa') . ' : ' . ($data->pamong_niap ?: '-') . ' | '); ?>

                    <?php echo e($data->pamong_nama . ' | ' . $data->jabatan->nama); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#atas_nama').change();
        });

        function ganti_ttd(atas_nama) {
            if (atas_nama.includes('a.n')) {
                ub = $("#pamong option[data-ttd='1']").val();

                if (ub) {
                    $('#pamong').val(ub);
                } else {
                    $('#pamong').val('');
                }
                $('#pamong').attr('disabled', true);
            } else if (atas_nama.includes('u.b')) {
                $('#pamong').val('');
                $("#pamong option[data-jenis='1']").hide();
                $("#pamong option[data-ttd='1']").hide();
                $('#pamong').attr('disabled', false);
            } else {
                $('#pamong').val($("#pamong option[data-jenis='1']").val());
                $('#pamong').attr('disabled', true);
            }

            $('#pamong').change();
        }
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\opensid\resources\views/layanan_mandiri/surat/form_pamong.blade.php ENDPATH**/ ?>