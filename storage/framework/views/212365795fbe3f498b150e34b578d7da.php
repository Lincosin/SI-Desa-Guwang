<style>
    .error {
        color: #dd4b39;
    }
</style>
<h3>Surat <?php echo e($surat['nama']); ?></h3>
<div class="box box-info">
    <div class="box-body">
        <form id="validasi" action="<?php echo e($form_action); ?>" method="POST" target="_blank" class="form-surat form-horizontal">
            <input type="hidden" id="url_surat" name="url_surat" value="<?php echo e($url); ?>">
            <input type="hidden" id="url_remote" name="url_remote" value="<?php echo e(ci_route('surat.nomor_surat_duplikat')); ?>">
            <div class="form-group cari_nik">
                <label for="nik" class="col-sm-3 control-label">NIK / Nama <?php echo e($pemohon); ?></label>
                <div class="col-sm-6 col-lg-4">
                    <select class="form-control input-sm readonly-permohonan readonly-periksa" id="nik" name="nik" style ="width:100%;">
                        <?php if($individu): ?>
                            <option value="<?php echo e($individu['id']); ?>" selected><?php echo e($individu['nik'] . ' - ' . $individu['tag_id_card'] . ' - ' . $individu['nama']); ?></option>
                        <?php endif; ?>
                    </select>
                </div>
            </div>

            <?php echo $__env->renderWhen($individu, 'admin.permohonan_surat.konfirmasi_pemohon', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>

            <div class="row jar_form">
                <label for="nomor" class="col-sm-3"></label>
                <div class="col-sm-8">
                    <input class="required" type="hidden" name="nik" value="<?php echo e($individu['id']); ?>">
                </div>
            </div>

            <?php echo $__env->make('admin.surat.nomor_surat', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('admin.surat.kode_isian', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->renderWhen((int) $surat->masa_berlaku > 0, 'admin.surat.form_tgl_berlaku', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
            <?php echo $__env->make('admin.surat.form_pamong', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </form>
    </div>
    <?php echo $__env->make('admin.layouts.components.tombol_cetak', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>

<textarea id="isian_form" hidden="hidden"><?php echo e($isian_form); ?></textarea>

<script type="text/javascript">
    $(document).ready(function() {
        // Di form surat ubah isian admin menjadi disabled
        $("#periksa-permohonan .readonly-periksa").attr('disabled', true);
        if ($('#isian_form').val()) {
            setTimeout(function() {
                isi_form();
            }, 100);
        }
    });

    function isi_form() {
        var isian_form = JSON.parse($('#isian_form').val(), function(key, value) {

            if (key) {
                var elem = $('*[name=' + key + ']');
                elem.val(value);
                elem.change();
                // Kalau isian hidden, akan ada isian lain untuk menampilkan datanya
                if (elem.is(":hidden")) {
                    var show = $('#' + key + '_show');
                    show.val(value);
                    show.change();
                }
            }
        });
    }
</script>
<?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/permohonan_surat/form_surat_tinymce.blade.php ENDPATH**/ ?>