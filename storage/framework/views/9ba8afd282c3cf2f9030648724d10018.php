<?php if(($transparansi ?? null) && !($smd_landing ?? false)): ?>
    <div class="smd-container smd-apbdes">
        <?php echo $__env->make('theme::partials.apbdesa', $transparansi, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php endif; ?>

<?php
    $smd_nama_desa = ucwords(setting('sebutan_desa')) . ' ' . ucwords($desa['nama_desa']);
    $alt_slug = PREMIUM ? 'artikel' : 'first';
    $smd_ikon_sosmed = [
        'facebook' => 'fa-facebook-f',
        'twitter' => 'fa-twitter',
        'x' => 'fa-twitter',
        'instagram' => 'fa-instagram',
        'telegram' => 'fa-telegram-plane',
        'whatsapp' => 'fa-whatsapp',
        'youtube' => 'fa-youtube',
        'tiktok' => 'fa-tiktok',
    ];
?>

<?php echo $__env->make('theme::commons.back_to_top', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<footer class="smd-footer footer">
    <svg class="smd-footer__wave" viewBox="0 0 1440 80" preserveAspectRatio="none" aria-hidden="true">
        <path d="M0,48 C240,88 480,8 720,40 C960,72 1200,24 1440,44 L1440,80 L0,80 Z" />
    </svg>
    <div class="smd-container smd-footer__grid">
        <div class="smd-footer__col smd-footer__about">
            <a href="<?php echo e(site_url('/')); ?>" class="smd-brand smd-brand--light">
                <img src="<?php echo e(gambar_desa($desa['logo'])); ?>" alt="Logo <?php echo e($smd_nama_desa); ?>" class="smd-brand__logo">
                <span class="smd-brand__text">
                    <span class="smd-brand__name"><?php echo e($smd_nama_desa); ?></span>
                    <span class="smd-brand__loc"><?php echo e(ucfirst(setting('sebutan_kabupaten'))); ?> <?php echo e(ucwords($desa['nama_kabupaten'])); ?></span>
                </span>
            </a>
            <p>Website resmi Pemerintah <?php echo e($smd_nama_desa); ?>. Media informasi, transparansi, dan pelayanan publik bagi seluruh warga.</p>
            <?php if(!empty($sosmed)): ?>
                <ul class="smd-social" aria-label="Media sosial">
                    <?php $__currentLoopData = $sosmed; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(!empty($sm['link'])): ?>
                            <?php $kunci = strtolower(trim($sm['nama'])) ?>
                            <li>
                                <a href="<?php echo e($sm['link']); ?>" target="_blank" rel="noopener" title="<?php echo e($sm['nama']); ?>" aria-label="<?php echo e($sm['nama']); ?>">
                                    <?php if(isset($smd_ikon_sosmed[$kunci])): ?>
                                        <i class="fab <?php echo e($smd_ikon_sosmed[$kunci]); ?>" aria-hidden="true"></i>
                                    <?php else: ?>
                                        <img src="<?php echo e($sm['icon']); ?>" alt="">
                                    <?php endif; ?>
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            <?php endif; ?>
        </div>

        <div class="smd-footer__col">
            <h2 class="smd-footer__title">Kontak</h2>
            <ul class="smd-footer__contact">
                <?php if(!empty($desa['alamat_kantor'])): ?>
                    <li><i class="fas fa-map-marker-alt" aria-hidden="true"></i><span><?php echo e($desa['alamat_kantor']); ?><?php if(!empty($desa['kode_pos'])): ?>, <?php echo e($desa['kode_pos']); ?><?php endif; ?></span></li>
                <?php endif; ?>
                <?php if(!empty($desa['telepon'])): ?>
                    <li><i class="fas fa-phone-alt" aria-hidden="true"></i><a href="tel:<?php echo e(preg_replace('/[^0-9+]/', '', $desa['telepon'])); ?>"><?php echo e($desa['telepon']); ?></a></li>
                <?php endif; ?>
                <?php if(!empty($desa['email_desa'])): ?>
                    <li><i class="far fa-envelope" aria-hidden="true"></i><a href="mailto:<?php echo e($desa['email_desa']); ?>"><?php echo e($desa['email_desa']); ?></a></li>
                <?php endif; ?>
                <li><i class="fas fa-globe-asia" aria-hidden="true"></i><span><?php echo e(ucfirst(setting('sebutan_kecamatan'))); ?> <?php echo e(ucwords($desa['nama_kecamatan'])); ?>, Provinsi <?php echo e(ucwords($desa['nama_propinsi'])); ?></span></li>
            </ul>
        </div>

        <div class="smd-footer__col">
            <h2 class="smd-footer__title">Tautan</h2>
            <ul class="smd-footer__links">
                <li><a href="<?php echo e(site_url('/')); ?>">Beranda</a></li>
                <li><a href="<?php echo e(site_url('arsip')); ?>">Arsip Berita</a></li>
                <li><a href="<?php echo e(site_url('galeri')); ?>">Galeri</a></li>
                <?php if(setting('layanan_mandiri') == 1): ?>
                    <li><a href="<?php echo e(site_url('layanan-mandiri')); ?>">Layanan Mandiri</a></li>
                <?php endif; ?>
                <li><a href="<?php echo e(site_url('siteman')); ?>">Login Admin</a></li>
            </ul>
        </div>

        <?php if(!empty($menu_kiri)): ?>
            <div class="smd-footer__col">
                <h2 class="smd-footer__title">Kategori</h2>
                <ul class="smd-footer__links">
                    <?php $__currentLoopData = array_slice(is_array($menu_kiri) ? $menu_kiri : collect($menu_kiri)->all(), 0, 6); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><a href="<?php echo e(site_url("{$alt_slug}/kategori/{$menu['slug']}")); ?>"><?php echo e($menu['kategori']); ?></a></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>

    <div class="smd-footer__bottom">
        <div class="smd-container smd-footer__bottom-inner">
            <p>&copy; <?php echo e(date('Y')); ?> <?php echo e($smd_nama_desa); ?>. Hak cipta dilindungi.</p>
            <p class="smd-footer__credit">
                Tema Samudra <?php echo e($themeVersion); ?> &middot;
                <a href="https://opensid.my.id" target="_blank" rel="noopener">OpenSID <?php echo e(ambilVersi()); ?></a>
                <?php if(file_exists('mitra')): ?>
                    &middot; Hosting didukung
                    <a href="https://my.idcloudhost.com/aff.php?aff=3172" rel="noopener noreferrer" target="_blank">
                        <img src="<?php echo e(base_url('/assets/images/Logo-IDcloudhost.png')); ?>" class="smd-footer__mitra" alt="Logo IDCloudHost" title="Logo IDCloudHost">
                    </a>
                <?php endif; ?>
            </p>
            <?php if(setting('tte')): ?>
                <img src="<?php echo e(asset('assets/images/bsre.png?v', false)); ?>" alt="Didukung BSrE" class="smd-footer__bsre" />
            <?php endif; ?>
        </div>
    </div>
</footer>
<?php /**PATH C:\xampp\htdocs\opensid\/desa/themes/samudra/resources/views/commons/footer.blade.php ENDPATH**/ ?>