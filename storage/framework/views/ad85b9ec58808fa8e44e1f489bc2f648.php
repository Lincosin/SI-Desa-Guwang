
<?php
    $smd_versi_mandiri = 'v2.1.1';
    $smd_warna_mandiri = theme_config('warna_utama', '#1d64d8') ?: '#1d64d8';
?>
<?php if(cek_koneksi_internet()): ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap">
<?php endif; ?>
<link rel="stylesheet" href="<?php echo e(theme_asset('css/mandiri.css', ['themeVersion' => $smd_versi_mandiri])); ?>">
<style>
    :root {
        --smd-primary: <?php echo e($smd_warna_mandiri); ?>;
    }
</style>
<script>
    // Tandai menu yang sedang dibuka (navbar, menu samping, dan tab Surat).
    document.addEventListener('DOMContentLoaded', function () {
        var kini = location.href.split(/[?#]/)[0].replace(/\/+$/, '');
        var daftar = document.querySelectorAll('#navbar-collapse a[href], .content .col-md-3 .box-body a[href], .content-wrapper .box-header + .box-body a.btn[href]');
        Array.prototype.forEach.call(daftar, function (a) {
            var tujuan = (a.getAttribute('href') || '').split(/[?#]/)[0].replace(/\/+$/, '');
            if (tujuan && tujuan.indexOf('http') === 0 && tujuan === kini) {
                a.classList.add('smd-aktif');
            }
        });
    });
</script>
<?php /**PATH C:\xampp\htdocs\opensid\/desa/themes/samudra/resources/views/partials/layanan_mandiri.blade.php ENDPATH**/ ?>