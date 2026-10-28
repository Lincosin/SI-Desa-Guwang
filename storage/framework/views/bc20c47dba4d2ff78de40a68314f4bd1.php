<div class="box-header with-border">
    <?php echo $__env->make('admin.layouts.components.tombol_kembali', ['url' => ci_route('surat_master'), 'label' => 'Daftar Surat'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php if(super_admin() && $ci->uri->segment(2) == 'pengaturan'): ?>
        <a href="javascript:void(0)" id="standar" title="Mengembalikan Standar Spesifikasi Surat" role="button" class="btn btn-social btn-success btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block">
            <i class="fa fa-refresh"></i>Mengembalikan Standar Spesifikasi
        </a>
    <?php endif; ?>
    <?php if(in_array($suratMaster->jenis, [3, 4])): ?>
        <?php if(setting('tte')): ?>
            <br /><br />
            <div class="alert alert-info alert-dismissible">
                <h4><i class="icon fa fa-info"></i> Info !</h4>
                Jika surat ingin dikirim ke <?php echo e(setting('sebutan_kecamatan')); ?>, letakan kode [qr_camat] pada tempat yang ingin ditempelkan QRCode
                <?php echo e(setting('sebutan_kecamatan')); ?>.
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>
<?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/pengaturan_surat/kembali.blade.php ENDPATH**/ ?>