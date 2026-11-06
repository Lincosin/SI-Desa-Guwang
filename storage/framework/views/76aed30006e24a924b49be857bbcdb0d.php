<style>
    /* Memaksa elemen accordion yang sedang terbuka untuk tetap tampil */
    .accordion-collapse.collapse.show {
        display: block !important;
        height: auto !important;
        visibility: visible !important;
        opacity: 1 !important;
    }
</style>

<?php
    $daftar_statistik = daftar_statistik();
    $slug_aktif = str_replace('_', '-', $slug_aktif);
    $s_links = [
        [
            'target' => 'statistikPenduduk',
            'label' => 'Statistik Penduduk',
            'icon' => 'fa-chart-pie',
            'submenu' => $daftar_statistik['penduduk'],
        ],
        [
            'target' => 'statistikKeluarga',
            'label' => 'Statistik Keluarga',
            'icon' => 'fa-chart-bar',
            'submenu' => $daftar_statistik['keluarga'],
        ],
        [
            'target' => 'statistikBantuan',
            'label' => 'Statistik Bantuan',
            'icon' => 'fa-chart-line',
            'submenu' => $daftar_statistik['bantuan'],
        ],
        [
            'target' => 'statistikLainnya',
            'label' => 'Statistik Lainnya',
            'icon' => 'fa-chart-area',
            'submenu' => $daftar_statistik['lainnya'],
        ],
    ];
?>

<div class="sticky top-5 w-full shadow">
    <div class="accordion" id="statistikNavigation">
        <?php $__currentLoopData = $s_links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $statistik): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $is_active = in_array($slug_aktif, array_column($statistik['submenu'], 'slug')) ?>
            <div class="accordion-item bg-white border border-gray-200 overflow-hidden">
                <h4 class="accordion-header mb-0" id="heading-<?php echo e($statistik['label']); ?>">
                    <button class="accordion-button relative flex items-center w-full py-4 px-5 text-base text-left bg-white border-0 rounded-none transition focus:outline-none text-h5" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo e($statistik['target']); ?>"
                        aria-expanded="<?php echo e($is_active ? 'true' : 'false'); ?>" aria-controls="<?php echo e($statistik['target']); ?>"
                    >
                        <i class="fas <?php echo e($statistik['icon']); ?> mr-2"></i> <?php echo e($statistik['label']); ?>

                    </button>
                </h4>
                <div id="<?php echo e($statistik['target']); ?>" class="accordion-collapse collapse <?php echo e($is_active ? 'show' : ''); ?>" aria-labelledby="heading-<?php echo e($statistik['target']); ?>">
                    <div class="accordion-body">
                        <ul class="divide-y-2">
                            <?php $__currentLoopData = $statistik['submenu']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $stat_slug = in_array($statistik['target'], ['statistikBantuan', 'statistikLainnya']) ? str_replace('first/', '', $submenu['url']) : 'statistik/' . $submenu['key'];
                                    if ($stat_slug == 'data-dpt') {
                                        $stat_slug = 'dpt';
                                    }
                                ?>
                                <!-- <?php if(isset($statistik_aktif[$stat_slug])): ?> -->
                                    <li id="statistik_13">
                                        <a href="<?php echo e(site_url($submenu['url'])); ?>" class="px-5 py-2 block <?php echo e($submenu['slug'] == $slug_aktif ? 'bg-primary-100 text-white' : 'hover:cursor-pointer hover:text-primary-100'); ?>"><?php echo e($submenu['label']); ?></a>
                                    </li>
                                <!-- <?php endif; ?> -->
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php /**PATH D:\laragon\www\opensid\/desa/themes/temaku/resources/views/partials/statistik/sidenav.blade.php ENDPATH**/ ?>