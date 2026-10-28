
<?php
    $smd_menu = menu_tema();
    $smd_nama = ucwords(setting('sebutan_desa')) . ' ' . ucwords($desa['nama_desa']);
?>
<div class="smd-overlay" data-smd-close="drawer" hidden></div>
<aside class="smd-drawer" id="smd-drawer" aria-label="Menu" aria-hidden="true">
    <div class="smd-drawer__head">
        <a href="<?php echo e(site_url('/')); ?>" class="smd-brand smd-brand--sm">
            <img src="<?php echo e(gambar_desa($desa['logo'])); ?>" alt="Logo <?php echo e($smd_nama); ?>" class="smd-brand__logo">
            <span class="smd-brand__name"><?php echo e($smd_nama); ?></span>
        </a>
        <button type="button" class="smd-iconbtn" data-smd-close="drawer" aria-label="Tutup menu">
            <i class="fas fa-times" aria-hidden="true"></i>
        </button>
    </div>

    <form action="<?php echo e(site_url('/')); ?>" method="get" role="search" class="smd-drawer__search">
        <i class="fas fa-search" aria-hidden="true"></i>
        <input type="search" name="cari" placeholder="Cari..." aria-label="Kata kunci pencarian">
    </form>

    <nav class="smd-drawer__nav" aria-label="Menu utama">
        <ul class="smd-acc">
            <li><a href="<?php echo e(site_url('/')); ?>" class="smd-acc__link"><i class="fas fa-home" aria-hidden="true"></i> Beranda</a></li>
            <?php if($smd_menu): ?>
                <?php $__currentLoopData = $smd_menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $punya_anak = count($menu['childrens'] ?? []) > 0 ?>
                    <li>
                        <?php if($punya_anak): ?>
                            <button type="button" class="smd-acc__link smd-acc__toggle" aria-expanded="false">
                                <span><?php echo $menu['nama']; ?></span>
                                <i class="fas fa-chevron-down" aria-hidden="true"></i>
                            </button>
                            <ul class="smd-acc__panel" hidden>
                                <?php $__currentLoopData = $menu['childrens']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $anak): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $punya_cucu = count($anak['childrens'] ?? []) > 0 ?>
                                    <li>
                                        <?php if($punya_cucu): ?>
                                            <button type="button" class="smd-acc__link smd-acc__toggle" aria-expanded="false">
                                                <span><?php echo $anak['nama']; ?></span>
                                                <i class="fas fa-chevron-down" aria-hidden="true"></i>
                                            </button>
                                            <ul class="smd-acc__panel" hidden>
                                                <?php $__currentLoopData = $anak['childrens']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cucu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php $punya_cicit = count($cucu['childrens'] ?? []) > 0 ?>
                                                    <li>
                                                        <?php if($punya_cicit): ?>
                                                            <button type="button" class="smd-acc__link smd-acc__toggle" aria-expanded="false">
                                                                <span><?php echo $cucu['nama']; ?></span>
                                                                <i class="fas fa-chevron-down" aria-hidden="true"></i>
                                                            </button>
                                                            <ul class="smd-acc__panel" hidden>
                                                                <?php $__currentLoopData = $cucu['childrens']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cicit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <li><a href="<?php echo e($cicit['link_url']); ?>" class="smd-acc__link"><?php echo $cicit['nama']; ?></a></li>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </ul>
                                                        <?php else: ?>
                                                            <a href="<?php echo e($cucu['link_url']); ?>" class="smd-acc__link"><?php echo $cucu['nama']; ?></a>
                                                        <?php endif; ?>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        <?php else: ?>
                                            <a href="<?php echo e($anak['link_url']); ?>" class="smd-acc__link"><?php echo $anak['nama']; ?></a>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        <?php else: ?>
                            <a href="<?php echo e($menu['link_url']); ?>" class="smd-acc__link"><?php echo $menu['nama']; ?></a>
                        <?php endif; ?>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </ul>
    </nav>

    <div class="smd-drawer__foot">
        <?php if(setting('layanan_mandiri') == 1): ?>
            <a href="<?php echo e(site_url('layanan-mandiri')); ?>" class="smd-btn smd-btn--primary smd-btn--block"><i class="fas fa-id-card" aria-hidden="true"></i> Layanan Mandiri</a>
        <?php endif; ?>
        <a href="<?php echo e(site_url('siteman')); ?>" class="smd-btn smd-btn--ghost smd-btn--block"><i class="fas fa-sign-in-alt" aria-hidden="true"></i> Login Admin</a>
    </div>
</aside>
<?php /**PATH C:\xampp\htdocs\opensid\/desa/themes/samudra/resources/views/commons/mobile_menu.blade.php ENDPATH**/ ?>