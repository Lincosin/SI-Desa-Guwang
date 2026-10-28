<?php defined('BASEPATH') || exit('No direct script access allowed'); ?>
<?php defined('THEME_VERSION') or define('THEME_VERSION', 'v2409.0.0') ?>
<?php defined('FOTO_TIDAK_TERSEDIA') or define('FOTO_TIDAK_TERSEDIA', theme_config('foto_tidak_tersedia') ? base_url(theme_config('foto_tidak_tersedia')) : asset('images/404-image-not-found.jpg')) ?>
<?php $desa_title =  ucwords(setting('sebutan_desa')) . ' '. $desa['nama_desa'] . ' '. ucwords(setting('sebutan_kecamatan')) . ' '. $desa['nama_kecamatan'] . ' '. ucwords(setting('sebutan_kabupaten')) . ' '. $desa['nama_kabupaten']; ?>

<meta http-equiv="encoding" content="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name='viewport' content='width=device-width, initial-scale=1' />
<meta name='google' content='notranslate' />
<meta name='theme' content='Natra' />
<meta name='designer' content='Ariandi Ryan Kahfi, S.Pd.' />
<meta name='theme:designer' content='Ariandi Ryan Kahfi, S.Pd.' />
<meta name='theme:version' content='<?php echo e(THEME_VERSION); ?>' />
<meta name="keywords" content="<?php echo e(setting('website_title') . ' ' . $desa_title); ?>" />
<meta property="og:site_name" content="<?php echo e($desa_title); ?>" />
<meta property="og:type" content="article" />
<meta property="fb:app_id" content="147912828718">
<title>
    <?php if($single_artikel['judul'] == ''): ?>
        <?php echo e(setting('website_title') . ' ' . $desa_title); ?>

    <?php else: ?>
        <?php echo e($single_artikel['judul'] . ' - ' . ucwords(setting('sebutan_desa')) . ' ' . $desa['nama_desa']); ?>

    <?php endif; ?>
</title>

<link rel="shortcut icon" href="<?php echo e(favico_desa()); ?>" />
<link rel="stylesheet" href="<?php echo e(theme_asset('css/bootstrap.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(theme_asset('css/font-awesome.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(theme_asset('css/animate.css')); ?>">
<link rel="stylesheet" href="<?php echo e(theme_asset('css/slick.css')); ?>">
<link rel="stylesheet" href="<?php echo e(theme_asset('css/theme.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(theme_asset('css/style.min.css')); ?>">
<link rel='stylesheet' href="<?php echo e(asset('css/font-awesome.min.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('css/leaflet.css')); ?>" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
<link rel="stylesheet" href="<?php echo e(asset('css/mapbox-gl.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('css/peta.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('bootstrap/css/dataTables.bootstrap.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(theme_asset('css/custom.css')); ?>">
<?php echo $__env->yieldPushContent('styles'); ?>
<?php if(isset($single_artikel)): ?>
    <meta property="og:title" content="<?php echo e(htmlspecialchars($single_artikel['judul'])); ?>" />
    <meta property="og:url" content="<?php echo e(current_url()); ?>" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
    <meta property="og:image" content="<?php echo e(site_url('og-image/' . $single_artikel['gambar'])); ?>">
    <meta property="og:image:type" content="image/png">
    <meta property="og:description" content="<?php echo e(potong_teks($single_artikel['isi'], 300)); ?> ..." />
<?php else: ?>
    <meta property="og:title" content="<?php echo e($desa_title); ?>" />
    <meta property="og:url" content="<?php echo e(site_url()); ?>" />
    <meta property="og:description" content="<?php echo e(setting('website_title') . ' ' . $desa_title); ?>" />
<?php endif; ?>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ if (window.scrollY == 0) window.scrollTo(0,1); } </script>
<script language='javascript' src="<?php echo e(asset('front/js/jquery.min.js')); ?>"></script>
<script language='javascript' src="<?php echo e(asset('front/js/jquery.cycle2.min.js')); ?>"></script>
<script language='javascript' src="<?php echo e(asset('front/js/jquery.cycle2.carousel.js')); ?>"></script>
<script src="<?php echo e(theme_asset('js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/leaflet.js')); ?>"></script>
<script src="<?php echo e(asset('front/js/layout.js')); ?>"></script>
<script src="<?php echo e(asset('front/js/jquery.colorbox.js')); ?>"></script>
<script src="<?php echo e(asset('js/leaflet-providers.js')); ?>"></script>
<script src="<?php echo e(asset('js/mapbox-gl.js')); ?>"></script>
<script src="<?php echo e(asset('js/leaflet-mapbox-gl.js')); ?>"></script>
<script src="<?php echo e(asset('js/peta.js')); ?>"></script>
<script src="<?php echo e(asset('bootstrap/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('bootstrap/js/dataTables.bootstrap.min.js')); ?>"></script>
<?php echo $__env->make('core::admin.layouts.components.validasi_form', ['web_ui' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script>
    var BASE_URL = '<?php echo e(base_url()); ?>';
    var SITE_URL = '<?php echo e(site_url()); ?>';
    var setting = <?php echo json_encode(setting(), 15, 512) ?>;
    var config = <?php echo json_encode(identitas(), 15, 512) ?>;
</script>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<?php echo $__env->make('theme::commons.style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php if(theme_config('jam', true)): ?>
    <script type="text/javascript">
        window.setTimeout("renderDate()", 1);
        days = new Array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu");
        months = new Array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

        function renderDate() {
            var mydate = new Date();
            var year = mydate.getYear();
            if (year < 2000) {
                if (document.all)
                    year = "19" + year;
                else
                    year += 1900;
            }
            var day = mydate.getDay();
            var month = mydate.getMonth();
            var daym = mydate.getDate();
            if (daym < 10)
                daym = "0" + daym;
            var hours = mydate.getHours();
            var minutes = mydate.getMinutes();
            var seconds = mydate.getSeconds();
            if (hours <= 9)
                hours = "0" + hours;
            if (minutes <= 9)
                minutes = "0" + minutes;
            if (seconds <= 9)
                seconds = "0" + seconds;
            $('#jam').html('<b class="white">' + days[day] + ", " + daym + " " + months[month] + " " + year + "<br>" + hours + " : " + minutes + " : " + seconds + '</b>');
            setTimeout("renderDate()", 1000)
        }
    </script>
<?php endif; ?>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v3.2&appId=147912828718&autoLogAppEvents=1"></script>

<!-- lazy load images -->
<script src="<?php echo e(theme_asset('js/yall/yall.min.js')); ?>"></script>

<style>
    img.yall_loaded {
        animation: progressiveReveal 0.2s linear;
    }

    @keyframes progressiveReveal {
        0% {
            opacity: 0;
            transform: scale(1.05)
        }

        to {
            opacity: 1;
            transform: scale(1)
        }
    }

    embed-responsive {
        position: relative;
        display: block;
        height: 0;
        padding: 0;
        overflow: hidden;
        padding-bottom: 56.25%;
        /* For a 16:9 ratio */
    }

    embed-responsive iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: 0;
    }
</style>

<script>
    let yall_option = {
        useLoading: true
    }
    var lazyload = new yall(yall_option);

    window.addEventListener('DOMContentLoaded', (e) => {
        lazyload.run();
    });
</script>

<!--[if lt IE 9]>
<script src="<?php echo e(theme_asset('js/html5shiv.min.js')); ?>"></script>
<script src="<?php echo e(theme_asset('js/respond.min.js')); ?>"></script>
<![endif]-->
<?php echo view('admin.layouts.components.token'); ?>

<?php /**PATH C:\xampp\htdocs\opensid\/storage/app/themes/natra/resources/views/commons/meta.blade.php ENDPATH**/ ?>