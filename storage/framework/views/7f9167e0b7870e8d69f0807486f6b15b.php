<?php $__env->startSection('content'); ?>
    <form id="validasi" action="<?= ci_route('layanan-mandiri.cek-pin') ?>" method="post" class="login-form">
        <div class="form-group form-login">
            <input
                type="text"
                autocomplete="off"
                value=""
                class="form-control required nik <?= jecho($cek_anjungan['keyboard'] == 1, true, 'kbvnumber') ?>"
                name="nik"
                placeholder="NIK"
                maxlength="16"
            >
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-block bg-green" name="via" value="telegram"><b>Telegram</b></button>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-block bg-green" name="via" value="email"><b>Email</b></button>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-6">
                    <a href="<?= site_url('layanan-mandiri/masuk') ?>">
                        <button type="button" class="btn btn-block bg-green"><b>MASUK</b></button>
                    </a>
                </div>
                <div class="col-sm-6">
                    <a href="<?= site_url('layanan-mandiri/masuk-ektp') ?>">
                        <button type="button" class="btn btn-block bg-green"><b>MASUK EKTP</b></button>
                    </a>
                </div>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layanan_mandiri.auth.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\opensid\resources\views/layanan_mandiri/auth/forgot-password.blade.php ENDPATH**/ ?>