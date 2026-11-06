<?php $__env->startSection('content'); ?>
    <form id="validasi" autocomplete="off" action="<?php echo e($form_action); ?>" method="post" class="login-form">
        <div class="login-footer-top">
            <?php if($cek_anjungan): ?>
                Tempelkan e-KTP Pada Card Reader
            <?php endif; ?>
            <div class="thumbnail">
                <img src="<?php echo e(asset('images/camera-scan.gif')); ?>" alt="scanner" class="center" style="width:30%">
            </div>
        </div>
        <input type="hidden" name="anjungan_uuid" id="anjungan_uuid">
        <div class="form-group form-login" style="<?php echo e(jecho($cek_anjungan == 0 || ENVIRONMENT == 'development', false, 'width: 0; height: 0; overflow: hidden;')); ?>">
            <input
                name="tag_id_card"
                id="tag"
                autocomplete="off"
                placeholder="Tempelkan e-KTP Pada Card Reader"
                class="form-control required number"
                type="password"
                onkeypress="if (event.keyCode == 13){$('#'+'validasi').attr('action', '<?php echo e($form_action); ?>');$('#'+'validasi').submit();}"
            >
        </div>
        <?php if(!$cek_anjungan): ?>
            <div class="form-group form-login">
                <input type="password" class="form-control required" name="password" placeholder="Masukkan Password" autocomplete="off" maxlength="50">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-block bg-green"><b>MASUK</b></button>
            </div>
        <?php endif; ?>
        <div class="form-group">
            <a href="<?php echo e(site_url('layanan-mandiri/masuk')); ?>">
                <button type="button" class="btn btn-block bg-green"><b>MASUK DENGAN NIK</b></button>
            </a>
        </div>
        <div class="form-group">
            <a href="<?php echo e(site_url('layanan-mandiri/lupa-pin')); ?>">
                <button type="button" class="btn btn-block bg-green"><b>LUPA PASSWORD</b></button>
            </a>
        </div>
        
        <?php if(setting('tampilkan_pendaftaran')): ?>
            <div class="form-group smd-daftar">
                <span class="smd-daftar__teks">Belum punya akun?</span>
                <a href="<?php echo e(site_url('layanan-mandiri/daftar')); ?>">
                    <button type="button" class="btn btn-block bg-green smd-daftar__tombol"><b>DAFTAR AKUN BARU</b></button>
                </a>
            </div>
        <?php endif; ?>
        <?php if(in_array(\Modules\Anjungan\Models\Anjungan::ANJUNGAN, $cek_anjungan['tipe'] ?? [])): ?>
            <div class="form-group">
                <a href="<?php echo e(route('anjungan.index')); ?>">
                    <button type="button" class="btn btn-block bg-green"><b>ANJUNGAN</b></button>
                </a>
            </div>
        <?php endif; ?>
    </form>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script type="text/javascript">
        $('document').ready(function() {
            // Get UUID from local storage and set it to the hidden input
            const anjungan_uuid = localStorage.getItem('anjungan_uuid');
            if (anjungan_uuid) {
                $('#anjungan_uuid').val(anjungan_uuid);
            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layanan_mandiri.auth.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\opensid\resources\views/layanan_mandiri/auth/login-ektp.blade.php ENDPATH**/ ?>