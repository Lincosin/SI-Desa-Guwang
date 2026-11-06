<?php $__env->startSection('content'); ?>
    
    <link rel="stylesheet" href="<?php echo e(asset('css/login-guwang.css')); ?>">

    <?php echo $__env->make('admin.layouts.components.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="guwang-auth-header">
        <div class="guwang-auth-headerTop">
            <a href="<?php echo e(base_url('/')); ?>" class="btn-back-website">
                Beranda Desa <i class="fa fa-arrow-right"></i>
            </a>
        </div>
        <h2>Masuk Layanan</h2>
        <p>
            <?php if(setting('tampilkan_pendaftaran')): ?>
                Belum memiliki akun warga? <a href="<?php echo e(site_url('layanan-mandiri/daftar')); ?>">Daftar di sini</a>
            <?php else: ?>
                Masukkan NIK dan 6 digit kode PIN Layanan Mandiri Anda.
            <?php endif; ?>
        </p>
    </div>

    <form id="validasi" autocomplete="off" action="<?php echo e($form_action); ?>" method="post" class="login-form">
        <div class="form-group form-login">
            <input
                type="text"
                autocomplete="off"
                class="form-control angka required <?php echo jecho($cek_anjungan['keyboard'] == 1, true, 'kbvnumber'); ?>"
                name="nik"
                maxlength="16"
                placeholder="Nomor Induk Kependudukan (NIK)"
            >
        </div>

        
        <input type="hidden" name="anjungan_uuid" id="anjungan_uuid">

        <div class="form-group form-login password-wrapper">
            <input
                type="password"
                autocomplete="off"
                class="form-control angka required <?php echo jecho($cek_anjungan['keyboard'] == 1, true, 'kbvnumber'); ?>"
                name="password"
                placeholder="Masukkan 6 Digit PIN"
                id="pin"
                maxlength="6"
            >
            <button type="button" id="togglePinBtn" class="toggle-password-btn" title="Tampilkan/Sembunyikan PIN">
                <i class="fa fa-eye" id="eyeIcon"></i>
            </button>
        </div>

        <div class="form-helper-row">
            <label class="custom-check-label" for="checkbox">
                <input type="checkbox" id="checkbox" style="display: initial;">
                <span>Tampilkan kode PIN</span>
            </label>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-submit-guwang">Masuk Sekarang</button>
        </div>

        <div class="auth-divider">
            <span>Atau akses melalui</span>
        </div>

        <div class="secondary-actions-grid">
            <a href="<?php echo e(site_url('layanan-mandiri/masuk-ektp')); ?>">
                <button type="button" class="btn-outline-guwang">
                    <i class="fa fa-id-card-o"></i> E-KTP
                </button>
            </a>

            <a href="<?php echo e(site_url('layanan-mandiri/lupa-pin')); ?>">
                <button type="button" class="btn-outline-guwang">
                    <i class="fa fa-key"></i> Lupa PIN
                </button>
            </a>

            <?php if(setting('tampilkan_pendaftaran')): ?>
                <a href="<?php echo e(site_url('layanan-mandiri/daftar')); ?>" class="full-width-col">
                    <button type="button" class="btn-outline-guwang">
                        <i class="fa fa-user-plus"></i> Daftar Akun Baru
                    </button>
                </a>
            <?php endif; ?>

            <?php if(in_array(\Modules\Anjungan\Models\Anjungan::ANJUNGAN, $cek_anjungan['tipe'] ?? [])): ?>
                <a href="<?= route('anjungan.index') ?>" class="full-width-col">
                    <button type="button" class="btn-outline-guwang">
                        <i class="fa fa-desktop"></i> Anjungan Mandiri
                    </button>
                </a>
            <?php endif; ?>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    
    <script src="<?php echo e(asset('js/login-guwang.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layanan_mandiri.auth.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\opensid\resources\views/layanan_mandiri/auth/login.blade.php ENDPATH**/ ?>