<?php echo $__env->make('admin.pengaturan_surat.asset_tinymce', ['height' => 350], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('admin.layouts.components.asset_validasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->startSection('title'); ?>
    <h1>
        Daftar Surat
        <small><?php echo e($action); ?> Pengaturan Surat</small>
    </h1>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(ci_route('surat_master')); ?>">Daftar Surat</a></li>
    <li class="active"><?php echo e($action); ?> Pengaturan Surat</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.layouts.components.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo form_open($formAksi, ['id' => 'validasi', 'enctype' => 'multipart/form-data']); ?>

    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#header" data-toggle="tab">Header</a></li>
            <li><a href="#footer" data-toggle="tab">Footer</a></li>
            <li><a href="#alur" data-toggle="tab">Alur Surat</a></li>
            <li><a href="#tte" data-toggle="tab">Pengaturan TTE</a></li>
            <li><a href="#sumber-penduduk" data-toggle="tab">Form Penduduk Luar</a></li>
            <li><a href="#kode-isian" data-toggle="tab">Kode Isian Alias</a></li>
            <li><a href="#lainnya" data-toggle="tab">Lainnya</a></li>
        </ul>
        <div class="tab-content">
            <?php echo $__env->make('admin.pengaturan_surat.kembali', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('admin.pengaturan_surat.partials.pengaturan_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('admin.pengaturan_surat.partials.pengaturan_footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('admin.pengaturan_surat.partials.pengaturan_alur', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('admin.pengaturan_surat.partials.pengaturan_tte', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('admin.pengaturan_surat.partials.pengaturan_sumber_penduduk', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('admin.pengaturan_surat.partials.pengaturan_kodeisian', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('admin.pengaturan_surat.partials.pengaturan_lainnya', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="box-footer">
                <button type="reset" class="btn btn-social btn-danger btn-sm"><i class="fa fa-times"></i>
                    Batal</button>
                <button type="submit" class="btn btn-social btn-info btn-sm pull-right"><i class="fa fa-check"></i>
                    Simpan</button>
            </div>
        </div>
    </div>
    </form>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script type="text/javascript">
        $(function() {
            ganti_tte();
            ganti_visual();
            $('input[name="tte"]').on('change', function(e) {
                ganti_tte()
            });

            function ganti_tte() {
                var tte_password = "<?php echo e($list_setting->firstWhere('key', 'tte_password')?->value); ?>";
                if ($('input[name="tte"]').filter(':checked').val() == 1) {
                    $('input[name="tte_api"]');
                    if (tte_password == "") {
                        $('input[name="tte_password"]').attr("required", true);
                        $('#info-tte-password').hide();
                    } else {
                        $('#info-tte-password').show();
                    }
                    $('input[name="tte_username"]').attr("required", true);
                    $('#modul-tte').show();
                } else {
                    $('input[name="tte_api"]').attr("required", false);
                    $('input[name="tte_password"]').attr("required", false);
                    $('input[name="tte_username"]').attr("required", false);
                    $('#modul-tte').hide();
                }
            }
            $('input[name="visual_tte"]').change(function(e) {
                ganti_visual();
            })

            function ganti_visual() {
                if ($('input[name="visual_tte"]').filter(':checked').val() == 1) {
                    $('#visual-tte-form').show();
                } else {
                    $('#visual-tte-form').hide();
                }
            }

            $('#standar').click(function(event) {
                Swal.fire({
                    title: 'Informasi',
                    icon: 'question',
                    text: 'Apakah Anda yakin ingin mengubah ke standar spesifikasi surat?',
                    showCancelButton: true,
                    confirmButtonText: 'Ok',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Informasi',
                            text: 'Sedang menyesuaikan...',
                            icon: 'info',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            showConfirmButton: false,

                            didOpen: () => {
                                Swal.showLoading()
                            }
                        });

                        $('input[name="tinggi_header"]').val('<?php echo e(\App\Libraries\TinyMCE::TOP); ?>');
                        $('input[name="tinggi_footer"]').val('<?php echo e(\App\Libraries\TinyMCE::BOTTOM); ?>');
                        $('select[name="font_surat"]').val('<?php echo e(\App\Libraries\TinyMCE::DEFAULT_FONT); ?>').trigger('change');
                        $('input[name="surat_margin[kiri]"]').val('<?php echo e(\App\Models\FormatSurat::MARGINS['kiri']); ?>');
                        $('input[name="surat_margin[kanan]"]').val('<?php echo e(\App\Models\FormatSurat::MARGINS['kanan']); ?>');
                        $('input[name="surat_margin[atas]"]').val('<?php echo e(\App\Models\FormatSurat::MARGINS['atas']); ?>');
                        $('input[name="surat_margin[bawah]"]').val('<?php echo e(\App\Models\FormatSurat::MARGINS['bawah']); ?>');

                        $('#validasi').submit();
                    }
                })
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/pengaturan_surat/pengaturan.blade.php ENDPATH**/ ?>