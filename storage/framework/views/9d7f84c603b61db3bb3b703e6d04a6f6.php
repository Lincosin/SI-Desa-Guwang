<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>
        <?php echo e(setting('login_title') . ' ' . ucwords(setting('sebutan_desa')) . ($desa['nama_desa'] ? ' ' . $desa['nama_desa'] : '') . get_dynamic_title_page_from_path()); ?>

    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" href="<?php echo e(favico_desa()); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('css/login-style.css')); ?>" media="screen">
    <link rel="stylesheet" href="<?php echo e(asset('css/login-form-elements.css')); ?>" media="screen">
    <link rel="stylesheet" href="<?php echo e(asset('css/daftar-form-elements.css')); ?>" media="screen">
    <link rel="stylesheet" href="<?php echo e(asset('css/siteman_mandiri.css')); ?>" media="screen">
    <link rel="stylesheet" href="<?php echo e(asset('bootstrap/css/bootstrap.bar.css')); ?>" media="screen">
    <!-- bootstrap datetimepicker -->
    <link rel="stylesheet" href="<?php echo e(asset('bootstrap/css/bootstrap-datetimepicker.min.css')); ?>">
    <?php if(is_file('desa/pengaturan/siteman/siteman_mandiri.css')): ?>
        <link rel="stylesheet" href="<?php echo e(base_url('desa/pengaturan/siteman/siteman_mandiri.css')); ?>">
    <?php endif; ?>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(asset('bootstrap/css/font-awesome.min.css')); ?>">
    <!-- Google Font -->
    <?php if(cek_koneksi_internet()): ?>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <?php endif; ?>
    <script src="<?php echo e(asset('bootstrap/js/jquery.min.js')); ?>"></script>

    <?php if($cek_anjungan): ?>
        <!-- Keyboard Default (Ganti dengan keyboard-dark.min.css untuk tampilan lain)-->
        <link rel="stylesheet" href="<?php echo e(asset('css/keyboard.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('front/css/mandiri-keyboard.css')); ?>">
    <?php endif; ?>

    <?php echo $__env->make('admin.layouts.components.token', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <style type="text/css">
        body.login {
            background-image: url('<?php echo e(default_file(LATAR_LOGIN . setting('latar_login_mandiri'), DEFAULT_LATAR_KEHADIRAN)); ?>');
        }
    </style>
</head>

<body class="login">
    <div class="top-content">
        <div class="inner-bg">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-4 form-box">
                        <div class="form-top">
                            <a href="<?php echo e(base_url('/')); ?>"><img src="<?php echo e(gambar_desa($desa['logo'])); ?>" alt="Lambang Desa" class="img-responsive" /></a>
                            <div class="login-footer-top">
                                <h1>LAYANAN MANDIRI<br />
                                    <?php echo e(ucwords(setting('sebutan_desa'))); ?> <?php echo e($desa['nama_desa']); ?></h1>
                                <h3>
                                    <br /><?php echo e(ucwords(setting('sebutan_kecamatan'))); ?> <?php echo e($desa['nama_kecamatan']); ?>

                                    <br /><?php echo e(ucwords(setting('sebutan_kabupaten'))); ?> <?php echo e($desa['nama_kabupaten']); ?>

                                    <br /><?php echo e($desa['alamat_kantor']); ?>

                                    <br />Kodepos <?php echo e($desa['kode_pos']); ?>

                                    <br /><br />Silakan hubungi operator desa untuk mendapatkan kode PIN anda.
                                    <br /><br /><br />IP Address: <?php echo e(request()->ip()); ?>

                                    <?php if($cek_anjungan): ?>
                                        <?php if($cek_anjungan['mac_address']): ?>
                                            <br />Mac Address : <?php echo e($cek_anjungan['mac_address']); ?>

                                        <?php endif; ?>
                                        <br />Anjungan Mandiri
                                        <?php echo jecho($cek_anjungan['keyboard'] == 1, true, ' | Virtual Keyboard : Aktif'); ?>

                                    <?php endif; ?>
                                </h3>
                            </div>
                        </div>
                        <div class="form-bottom">

                            <?php
                                preg_match('/(\d+)/', $errors->first('email'), $matches);

                                $second = $matches[0] ?? 0;
                            ?>

                            <?php if($errors->any()): ?>
                                <div <?php if(!str_contains($errors->first('email'), 'Terlalu banyak upaya masuk.')): ?> id="notif" <?php endif; ?> class="alert alert-danger">
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(str_contains($item, 'Terlalu banyak upaya masuk.')): ?>
                                            <p id="countdown"><?php echo e($item); ?></p>
                                        <?php else: ?>
                                            <p><?php echo e($item); ?></p>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php endif; ?>

                            <?php if($notif = $ci->session->flashdata('notif')): ?>
                                <div id="notif" class="alert alert-danger">
                                    <p><?php echo e($notif); ?></p>
                                </div>
                            <?php endif; ?>

                            <?php echo $__env->yieldContent('content'); ?>

                            <div class="login-footer-bottom">
                                <a href="https://github.com/OpenSID/OpenSID" class="content-color-secondary" rel="noopener noreferrer" target="_blank">OpenSID v<?= AmbilVersi() ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php echo $__env->make('admin.layouts.components.konfirmasi_cookie', ['cookie_name' => 'pengunjung'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.layouts.components.aktifkan_cookie', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- jQuery 3 -->
    <script src="<?php echo e(asset('bootstrap/js/jquery.min.js')); ?>"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?php echo e(asset('bootstrap/js/bootstrap.min.js')); ?>"></script>
    <!-- bootstrap Moment -->
    <script src="<?php echo e(asset('bootstrap/js/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('bootstrap/js/moment-timezone.js')); ?>"></script>
    <script src="<?php echo e(asset('bootstrap/js/moment-timezone-with-data.js')); ?>"></script>
    <!-- bootstrap Date time picker -->
    <script src="<?php echo e(asset('bootstrap/js/bootstrap-datetimepicker.min.js')); ?>"></script>
    <script src="<?php echo e(asset('bootstrap/js/id.js')); ?>"></script>
    <!-- SlimScroll -->
    <script src="<?php echo e(asset('bootstrap/js/jquery.slimscroll.min.js')); ?>"></script>
    <!-- FastClick -->
    <script src="<?php echo e(asset('bootstrap/js/fastclick.js')); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo e(asset('js/adminlte.min.js')); ?>"></script>
    <!-- Validasi -->
    <script src="<?php echo e(asset('js/jquery.validate.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/validasi.js')); ?>"></script>
    <script src="<?php echo e(asset('js/localization/messages_id.js')); ?>"></script>

    <?php if($cek_anjungan): ?>
        <!-- keyboard widget css & script -->
        <script src="<?php echo e(asset('js/jquery.keyboard.min.js')); ?>"></script>
        <script src="<?php echo e(asset('js/jquery.mousewheel.min.js')); ?>"></script>
        <script src="<?php echo e(asset('js/jquery.keyboard.extension-all.min.js')); ?>"></script>
        <script src="<?php echo e(asset('front/js/mandiri-keyboard.js')); ?>"></script>
    <?php endif; ?>
    <script src="<?php echo e(asset('js/id_browser.js')); ?>"></script>
    <script>
        function start_countdown() {
            let totalSeconds = <?php echo e($second); ?>;
            const timer = setInterval(function() {
                const minutes = Math.floor(totalSeconds / 60);
                const seconds = totalSeconds % 60;

                if (totalSeconds <= 0) {
                    clearInterval(timer);
                    location.reload();
                } else {
                    document.getElementById("countdown").innerHTML = `Terlalu banyak upaya masuk. Silakan coba lagi dalam ${minutes} menit ${seconds} detik.`;
                    totalSeconds--;
                }
            }, 1000);
        }

        $(document).ready(function() {
            if ($('#pin').length) {
                $('#pin').focus();
            } else if ($('#tag').length) {
                $('#tag').focus();
            }

            if ($('#countdown').length) {
                start_countdown();
            }

            window.setTimeout(function() {
                $("#notif").fadeTo(500, 0).slideUp(500, function() {
                    $(this).remove();
                });
            }, 5000);
        });
    </script>

    <?php echo $__env->yieldPushContent('script'); ?>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\opensid\resources\views/layanan_mandiri/auth/index.blade.php ENDPATH**/ ?>