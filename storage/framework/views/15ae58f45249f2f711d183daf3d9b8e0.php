<?php $__env->startPush('css'); ?>
    <style>
        .judul-surat {
            /* margin: -10px; */
            font-size: 18px;
            font-weight: bold;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="box box-solid" id="wrapper-mandiri">
        <div class="box-header with-border bg-green">
            <h4 class="box-title">Surat</h4>
        </div>

        
        <form id="validasi" action="<?php echo e($form_action); ?>" method="POST" class="form-surat form-horizontal">
            <input type="hidden" id="url_surat" name="url_surat" value="<?php echo e($url); ?>">
            <input type="hidden" id="url_remote" name="url_remote"
                value="<?php echo e(ci_route('layanan-mandiri.nomor_surat_duplikat')); ?>">

            <div class="box-body box-line">
                <h1 class="judul-surat">Surat <?php echo e($surat['nama']); ?></h1>
                <div class="box-body permohonan-surat">

                    <div class="form-group cari_nik">
                        <label for="nik" class="col-sm-3 control-label">NIK / Nama <?php echo e($pemohon); ?></label>
                        <div class="col-sm-6 col-lg-4">
                            <select class="form-control input-sm readonly-permohonan readonly-periksa" id="nik"
                                name="nik" style="width:100%;">
                                <?php if($individu): ?>
                                    <option value="<?php echo e($individu['id']); ?>" selected>
                                        <?php echo e($individu['nik'] . ' - ' . $individu['tag_id_card'] . ' - ' . $individu['nama']); ?>

                                    </option>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <?php echo $__env->renderWhen($individu, 'layanan_mandiri.surat.form_konfirmasi_pemohon', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>

                    <div class="row jar_form">
                        <label for="nomor" class="col-sm-3"></label>
                        <div class="col-sm-8">
                            <input class="required" type="hidden" name="nik" value="<?php echo e($individu['id']); ?>">
                        </div>
                    </div>

                    <?php echo $__env->make('admin.surat.nomor_surat', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo $__env->make('layanan_mandiri.surat.form_kode_isian', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo $__env->make('layanan_mandiri.surat.form_tgl_berlaku', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo $__env->make('layanan_mandiri.surat.form_pamong', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <textarea id="isian_form" hidden="hidden"><?php echo e($isian_form); ?></textarea>
                </div>
            </div>

            
            <div class="box-footer">
                <?php if($mandiri): ?>
                    <button type="reset" onclick="window.history.back();" class="btn btn-social btn-danger btn-sm">
                        <i class="fa fa-times"></i> Batal
                    </button>
                <?php elseif($periksa): ?>
                    <a href="<?php echo e(base_url('permohonan_surat_admin/konfirmasi/' . $periksa['id'])); ?>"
                        class="btn btn-social btn-danger btn-sm" data-remote="false" data-toggle="modal"
                        data-target="#modalBox" data-title="Konfirmasi Belum Lengkap">
                        <i class="fa fa-times"></i> Belum Lengkap
                    </a>
                <?php else: ?>
                    <button type="reset" onclick="$('#validasi').trigger('reset');"
                        class="btn btn-social btn-danger btn-sm">
                        <i class="fa fa-times"></i> Batal
                    </button>
                <?php endif; ?>

                <?php if($mandiri): ?>
                    <button type="submit" class="btn btn-social btn-success btn-sm pull-right" style="margin-right: 5px;">
                        <i class="fa fa-send"></i> Kirim
                    </button>
                <?php else: ?>
                    <button type="button" id="cetak-surat" onclick="tambah_elemen_cetak('cetak_pdf');"
                        class="btn btn-social btn-info btn-sm pull-right" style="margin-right: 5px;">
                        <i class="fa fa-file-word-o"></i> Lanjutkan Cetak
                    </button>
                <?php endif; ?>

                <a href="<?php echo e(base_url('keluar/masuk')); ?>" id="next"
                    class="btn btn-social btn-info btn-sm pull-right visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"
                    style="display: none !important;">
                    ke Permohonan Surat <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </form>
        
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script type="text/javascript">
        $(document).ready(function() {
            // Di form surat ubah isian admin menjadi disabled
            $("#wrapper-mandiri .readonly-permohonan").attr('disabled', true);
            $("#wrapper-mandiri .tdk-permohonan textarea").removeClass('required');
            $("#wrapper-mandiri .tdk-permohonan select").removeClass('required');
            $("#wrapper-mandiri .tdk-permohonan input").removeClass('required');

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

        function tambah_elemen_cetak($nilai) {
            $('<input>').attr({
                type: 'hidden',
                name: 'submit_cetak',
                value: $nilai
            }).appendTo($('#validasi'));

            $('#validasi').submit();

            if ($('.box-body').find('.has-error').length < 1) {
                $('#next').removeClass('hide');
                $('#cetak-surat').remove();
            }
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layanan_mandiri.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\opensid\resources\views/layanan_mandiri/surat/form.blade.php ENDPATH**/ ?>