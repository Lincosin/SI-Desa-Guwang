<?php $__env->startSection('content'); ?>
    
    <link rel="stylesheet" href="<?php echo e(asset('css/login-guwang.css')); ?>">

    <?php echo $__env->make('admin.layouts.components.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="guwang-auth-header">
        <div class="guwang-auth-headerTop">
            <a href="<?php echo e(base_url('/')); ?>" class="btn-back-website">
                Beranda Desa <i class="fa fa-arrow-right"></i>
            </a>
        </div>
        <h2>Pemulihan PIN</h2>
        <p>Masukkan NIK terdaftar Anda untuk mendapatkan kembali akses Layanan Mandiri.</p>
    </div>

    <form id="validasi" action="<?= ci_route('layanan-mandiri.cek-pin') ?>" method="post" class="login-form">
        <div class="form-group form-login">
            <input
                type="text"
                autocomplete="off"
                value=""
                class="form-control required nik <?= jecho($cek_anjungan['keyboard'] == 1, true, 'kbvnumber') ?>"
                name="nik"
                placeholder="Masukkan 16 Digit NIK"
                maxlength="16"
            >
        </div>

        <div class="auth-divider">
            <span>Kirim Instruksi Melalui</span>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-submit-guwang" name="via" value="telegram">
                <i class="fa fa-telegram" style="margin-right: 6px;"></i> Kirim via Telegram
            </button>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-submit-guwang" name="via" value="email" style="background: linear-gradient(135deg, #0369a1 100%, #0c4a6e 0%) !important;">
                <i class="fa fa-envelope" style="margin-right: 6px;"></i> Kirim via Email
            </button>
        </div>

        <div class="auth-divider">
            <span>Kembali ke Menu</span>
        </div>

        <div class="secondary-actions-grid">
            <a href="<?= site_url('layanan-mandiri/masuk') ?>">
                <button type="button" class="btn-outline-guwang">
                    <i class="fa fa-sign-in"></i> Masuk NIK
                </button>
            </a>
            <a href="<?= site_url('layanan-mandiri/masuk-ektp') ?>">
                <button type="button" class="btn-outline-guwang">
                    <i class="fa fa-id-card-o"></i> Masuk e-KTP
                </button>
            </a>
        </div>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layanan_mandiri.auth.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\opensid\resources\views/layanan_mandiri/auth/forgot-password.blade.php ENDPATH**/ ?>