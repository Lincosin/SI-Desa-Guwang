<?php
    $nama_desa = ucwords(setting('sebutan_desa')) . ' ' . ucwords($desa['nama_desa']);

    $title = preg_replace('/[^A-Za-z0-9- ]/', '', trim(str_replace('-', ' ', get_dynamic_title_page_from_path())));
    $suffix = setting('website_title') . ' ' . ucwords(setting('sebutan_desa')) . ($desa['nama_desa'] ? ' ' . $desa['nama_desa'] : '');
    $desa_title = $title ? $title . ' - ' . $suffix : $suffix;
?>

<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name='viewport' content='width=device-width, initial-scale=1' />
<meta name='google' content='notranslate' />
<meta name='theme' content='Samudra' />
<meta name='designer' content='Ngurah Oka (dasar: Esensi oleh Diki Siswanto)' />
<meta name='theme:designer' content='Ngurah Oka (dasar: Esensi oleh Diki Siswanto)' />
<meta name='theme:version' content='<?php echo e($themeVersion); ?>' />
<meta name="theme-color" content="#1d64d8">
<meta name='keywords'
    content="<?php echo e($desa_title); ?> <?php if(!strpos($desa_title, $nama_desa)): ?> <?php echo e($nama_desa); ?> <?php endif; ?> <?php echo e(ucfirst(setting('sebutan_kecamatan'))); ?> <?php echo e(ucwords($desa['nama_kecamatan'])); ?>, <?php echo e(ucfirst(setting('sebutan_kabupaten'))); ?> <?php echo e(ucwords($desa['nama_kabupaten'])); ?>, Provinsi  <?php echo e(ucwords($desa['nama_propinsi'])); ?>"
/>
<meta property="og:site_name" content="<?php echo e($nama_desa); ?>" />
<meta property="og:type" content="article" />
<link rel="canonical" href="<?php echo e(site_url()); ?>" />
<meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />
<meta name="subject" content="Situs Web Desa">
<meta name="copyright" content="<?php echo e($nama_desa); ?>">
<meta name="language" content="Indonesia">
<meta name="revised" content="Sunday, July 18th, 2010, 5:15 pm" />
<meta name="Classification" content="Government">
<meta name="url" content="<?php echo e(site_url()); ?>">
<meta name="identifier-URL" content="<?php echo e(site_url()); ?>">
<meta name="category" content="Desa, Pemerintahan">
<meta name="coverage" content="Worldwide">
<meta name="distribution" content="Global">
<meta name="rating" content="General">
<meta name="revisit-after" content="7 days">
<meta name="revisit-after" content="7" />
<meta name="webcrawlers" content="all" />
<meta name="rating" content="general" />
<meta name="spiders" content="all" />
<link rel="alternate" type="application/rss+xml" title="Feed <?php echo e($nama_desa); ?>" href="<?php echo e(site_url('sitemap')); ?>" />

<?php if(isset($single_artikel)): ?>
    <title><?php echo e($single_artikel['judul'] . ' - ' . $nama_desa); ?></title>
    <meta name='description' content="<?php echo e(str_replace('"', "'", substr(strip_tags($single_artikel['isi']), 0, 150))); ?>" />
    <meta property="og:title" content="<?php echo e($single_artikel['judul']); ?>" />
    <meta itemprop="name" content="<?php echo e($single_artikel['judul']); ?>" />
    <meta itemprop='description' content="<?php echo e(str_replace('"', "'", substr(strip_tags($single_artikel['isi']), 0, 150))); ?>" />
    <?php if(trim($single_artikel['gambar']) != ''): ?>
        <meta property="og:image:width" content="1200" />
        <meta property="og:image:height" content="630" />
        <meta property="og:image" content="<?php echo e(site_url('og-image/' . $single_artikel['gambar'])); ?>">
        <meta property="og:image:type" content="image/png">
        <meta itemprop="image" content="<?php echo e(base_url(LOKASI_FOTO_ARTIKEL . 'sedang_' . $single_artikel['gambar'])); ?>?v=<?php echo e(time()); ?>" />
    <?php endif; ?>
    <meta property='og:description' content="<?php echo e(str_replace('"', "'", substr(strip_tags($single_artikel['isi']), 0, 150))); ?>" />
<?php else: ?>
    <title><?php echo e($desa_title); ?></title>
    <meta name='description'
        content="<?php echo e($desa_title); ?> <?php if(!strpos($desa_title, $nama_desa)): ?> <?php echo e($nama_desa); ?> <?php endif; ?> <?php echo e(ucfirst(setting('sebutan_kecamatan'))); ?> <?php echo e(ucwords($desa['nama_kecamatan'])); ?>, <?php echo e(ucfirst(setting('sebutan_kabupaten'))); ?> <?php echo e(ucwords($desa['nama_kabupaten'])); ?>, Provinsi  <?php echo e(ucwords($desa['nama_propinsi'])); ?>"
    />
    <meta itemprop="name" content="<?php echo e($desa_title); ?>" />
    <meta property="og:title" content="<?php echo e($desa_title); ?>" />
    <meta property='og:description'
        content="<?php echo e($desa_title); ?> <?php if(!strpos($desa_title, $nama_desa)): ?> <?php echo e($nama_desa); ?> <?php endif; ?> <?php echo e(ucfirst(setting('sebutan_kecamatan'))); ?> <?php echo e(ucwords($desa['nama_kecamatan'])); ?>, <?php echo e(ucfirst(setting('sebutan_kabupaten'))); ?> <?php echo e(ucwords($desa['nama_kabupaten'])); ?>, Provinsi  <?php echo e(ucwords($desa['nama_propinsi'])); ?>"
    />
<?php endif; ?>
<meta property='og:url' content="<?php echo e(current_url()); ?>" />
<link rel="shortcut icon" href="<?php echo e(favico_desa()); ?>" />
<noscript>You must have JavaScript enabled in order to use this theme. Please enable JavaScript and then reload this page in order to continue.</noscript>
<?php if(cek_koneksi_internet()): ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<?php endif; ?>
<script>
    var BASE_URL = '<?php echo e(base_url()); ?>';
    var SITE_URL = '<?php echo e(site_url()); ?>';
    var setting = <?php echo json_encode(setting(), 15, 512) ?>;
    var config = <?php echo json_encode(identitas(), 15, 512) ?>;
</script>
<?php /**PATH C:\xampp\htdocs\opensid\/desa/themes/samudra/resources/views/commons/meta.blade.php ENDPATH**/ ?>