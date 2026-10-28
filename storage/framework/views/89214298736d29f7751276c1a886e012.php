<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="box">
    <div class="box-header">
        <h3 class="box-title">
            <i class="fas fa-folder-open mr-1"></i><?php echo e($judul_widget); ?>

        </h3>
    </div>
    <div class="box-body" style="padding-top: .1rem;">
        <ul class="nav nav-tabs flex list-none border-b-0 pl-0 mb-4" id="tab-arsip" role="tablist">
            <li class="nav-item flex-grow text-center active" role="presentation">
                <a
                    href="#terkini"
                    class="nav-link w-full block font-medium border-x-0 border-t-0 border-b-2 border-transparent px-4 py-3 my-2 hover:border-transparent hover:bg-gray-100 focus:border-transparent active"
                    data-bs-toggle="pill"
                    data-bs-target="#terkini"
                    role="tab"
                    aria-controls="terkini"
                    aria-selected="true"
                    data-toggle="tab"
                >Terkini</a>
            </li>
            <li class="nav-item flex-grow text-center" role="presentation">
                <a
                    href="#populer"
                    class="nav-link w-full block font-medium border-x-0 border-t-0 border-b-2 border-transparent px-4 py-3 my-2 hover:border-transparent hover:bg-gray-100 focus:border-transparent"
                    data-bs-toggle="pill"
                    data-bs-target="#populer"
                    role="tab"
                    aria-controls="populer"
                    aria-selected="false"
                >Populer</a>
            </li>
            <li class="nav-item flex-grow text-center" role="presentation">
                <a
                    href="#acak"
                    class="nav-link w-full block font-medium border-x-0 border-t-0 border-b-2 border-transparent px-4 py-3 my-2 hover:border-transparent hover:bg-gray-100 focus:border-transparent"
                    data-bs-toggle="pill"
                    data-bs-target="#acak"
                    role="tab"
                    aria-controls="acak"
                    aria-selected="false"
                >Acak</a>
            </li>
        </ul>

        <div class="tab-content">
            <?php $__currentLoopData = ['terkini' => 'arsip_terkini', 'populer' => 'arsip_populer', 'acak' => 'arsip_acak']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jenis => $jenis_arsip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div id="<?php echo e($jenis); ?>" class="tab-pane fade <?php if($jenis == 'terkini'): ?> show active <?php endif; ?>" role="tabpanel">
                    <div class="divide-y">
                        <?php $__currentLoopData = $$jenis_arsip; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $arsip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex gap-3 py-3">
                                <a href="<?php echo e(site_url('artikel/' . buat_slug($arsip))); ?>" class="w-8 flex-shrink-0">
                                    <?php if(is_file(LOKASI_FOTO_ARTIKEL . "kecil_$arsip[gambar]")): ?>
                                        <img class="w-full h-auto" src="<?php echo e(base_url(LOKASI_FOTO_ARTIKEL . "sedang_$arsip[gambar]")); ?>" />
                                    <?php else: ?>
                                        <img class="w-full h-auto" src="<?php echo e(asset('images/404-image-not-found.jpg')); ?>" />
                                    <?php endif; ?>
                                </a>
                                <div class="flex flex-col justify-between gap-2">
                                    <a href="<?php echo e(site_url('artikel/' . buat_slug($arsip))); ?>" class="block text-sm font-bold hover:text-primary-100"><?php echo e($arsip['judul']); ?></a>
                                    <span class="text-xs"><i class="fas fa-calendar-alt mr-1 text-primary-100"></i> <?php echo e(tgl_indo($arsip['tgl_upload'])); ?></span>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\opensid\/desa/themes/samudra/resources/views/widgets/arsip_artikel.blade.php ENDPATH**/ ?>