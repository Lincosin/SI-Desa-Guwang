<?php
    $themeVersion = 'v2.2.1';
    $smd_warna = theme_config('warna_utama', '#1d64d8') ?: '#1d64d8';
    $smd_animasi = theme_config('animasi', '1') == '1';
    // Kelas body: banner foto di beranda (navbar bening) & tata letak landing
    $smd_kelas = [];
    if (!request()->segment(1) && empty($cari ?? null) && theme_config('tampilkan_banner', '1') == '1') {
        $smd_kelas[] = 'smd-has-hero';
    }
    if ($smd_landing ?? false) {
        $smd_kelas[] = 'smd-is-landing';
    }
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if($smd_animasi): ?>
        <script>
            // Aktifkan animasi hanya jika peramban mendukung & pengguna tidak meminta gerakan dikurangi.
            (function (d) {
                var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
                if (!reduce && 'IntersectionObserver' in window) {
                    d.documentElement.classList.add('smd-motion');
                    // Pengaman: tampilkan semua konten jika skrip tema gagal dimuat.
                    setTimeout(function () { if (!window.__smdReady) d.documentElement.classList.remove('smd-motion'); }, 3000);
                }
            })(document);
        </script>
    <?php endif; ?>
    <?php echo $__env->make('theme::commons.meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('theme::commons.source_css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <style>
        :root {
            --smd-primary: <?php echo e($smd_warna); ?>;
        }
    </style>
    <?php echo $__env->make('theme::commons.source_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body class="font-primary smd-body <?php echo e(implode(' ', $smd_kelas)); ?>">
    <a href="#smd-konten" class="smd-skip">Langsung ke konten</a>
    <?php echo $__env->make('theme::commons.loading_screen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('theme::commons.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div id="smd-konten" class="smd-page">
        <?php echo $__env->yieldContent('layout'); ?>
    </div>

    <?php echo $__env->make('theme::commons.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <script src="<?php echo e(theme_asset('js/script.min.js')); ?>&<?php echo e($themeVersion); ?>"></script>
    <script src="<?php echo e(theme_asset('js/samudra.js', ['themeVersion' => $themeVersion])); ?>"></script>
    <script type="text/javascript">
        function formatRupiah(angka, prefix = 'Rp ') {
            var number_string = angka.toString().replace(/[^,\d]/g, ''),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '') + ',00';
        }
    </script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\opensid\/desa/themes/samudra/resources/views/template.blade.php ENDPATH**/ ?>