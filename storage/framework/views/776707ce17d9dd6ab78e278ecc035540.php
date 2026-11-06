<?php
    $themeVersion = 'v2409.3.0';
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light dark">
    
    <script>
        (function () {
            var root = document.documentElement, pilihan = 'auto';
            try {
                var t = localStorage.getItem('temaku-tema');
                if (t === 'gelap' || t === 'terang') { pilihan = t; }
            } catch (e) { /* localStorage diblokir: ikut perangkat */ }
            var gelap = pilihan === 'gelap' || (pilihan === 'auto' && window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches);
            root.classList.toggle('dark', gelap);
            root.setAttribute('data-tema', pilihan);
        })();
    </script>
    
    <script>
        (function () {
            try {
                var a = JSON.parse(localStorage.getItem('temaku-a11y') || '{}') || {}, r = document.documentElement;
                var u = Math.max(-2, Math.min(5, parseInt(a.size, 10) || 0));
                if (u) { r.style.fontSize = (100 + u * 10) + '%'; }
                if (a.gray === true) { r.classList.add('a11y-gray'); }
                if (a.neg === true) { r.classList.add('a11y-neg'); }
                if (a.underline === true) { r.classList.add('a11y-underline'); }
            } catch (e) { /* abaikan */ }
        })();
    </script>
    <?php echo $__env->make('theme::commons.meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('theme::commons.source_css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('theme::commons.source_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body class="font-primary bg-gray-100">
    <?php echo $__env->make('theme::commons.loading_screen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('theme::commons.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->yieldContent('layout'); ?>

    <?php echo $__env->make('theme::commons.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('theme::commons.aksesibilitas', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <script src="<?php echo e(theme_asset('js/script.min.js')); ?>&<?php echo e($themeVersion); ?>"></script>
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
<?php /**PATH D:\laragon\www\opensid\/desa/themes/temaku/resources/views/template.blade.php ENDPATH**/ ?>