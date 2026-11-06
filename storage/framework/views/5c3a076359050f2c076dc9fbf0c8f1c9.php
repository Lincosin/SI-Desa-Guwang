<?php $__env->startSection('content'); ?>
    <div class="alert alert-info">
        <h3>Terima kasih telah mendaftar! Sebelum memulai, bisakah Anda melakukan verifikasi Email dan Telegram Anda dengan mengklik tautan yang baru saja kami kirimkan kepada Anda? Jika Anda tidak menerima notifikasi tersebut, kami akan dengan senang hati mengirimkan yang lain.</h3>
    </div>
    <form id="validasi" action="<?php echo e(ci_route('layanan-mandiri.daftar.verifikasi.telegram.kirim')); ?>" method="post" class="login-form" enctype="multipart/form-data">
        <div class="form-group">
            <div class="form-group">
                <button <?= (auth('penduduk')->user()->hasVerifiedTelegram()) ? 'disabled' : ''; ?> type="submit" class="btn btn-block bg-green"><b>Kirim Ulang Verifikasi Telegram</b></button>
            </div>
        </div>
    </form>
    <form id="validasi" action="<?php echo e(ci_route('layanan-mandiri.daftar.verifikasi.email.kirim')); ?>" method="post" class="login-form" enctype="multipart/form-data">
        <div class="form-group">
            <div class="form-group">
                <button <?= (auth('penduduk')->user()->hasVerifiedEmail()) ? 'disabled' : ''; ?> type="submit" class="btn btn-block bg-green"><b>Kirim Ulang Verifikasi Email</b></button>
            </div>
        </div>
    </form>
    <form action="">
        <div class="form-group">
            <a href="<?php echo e(ci_route('layanan-mandiri/keluar')); ?>">
                <button type="button" class="btn btn-block bg-green"><b>Logout</b></button>
            </a>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layanan_mandiri.auth.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\opensid\resources\views/layanan_mandiri/auth/verify.blade.php ENDPATH**/ ?>