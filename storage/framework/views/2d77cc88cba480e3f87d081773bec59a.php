<?php defined('BASEPATH') || exit('No direct script access allowed'); ?>

<?php if(!is_null($transparansi)): ?>
    <?php echo $__env->make('theme::partials.apbdesa-tema', $transparansi, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<?php if(theme_config('statistik_desa')): ?>
    <div class="col-md-12" align="center">
        <h2>Statistik <?php echo e(ucwords(setting('sebutan_desa'))); ?></h2>
        <hr>
        <div class="col-md-6">
            <a href="<?php echo e(site_url('data-wilayah')); ?>"><img alt="Statistik Wilayah" width="30%" src="<?php echo e(theme_asset('images/statistik_wil.png')); ?>" /></a>
            <a href="<?php echo e(site_url('data-statistik/pendidikan-dalam-kk')); ?>"><img alt="Statistik Pendidikan Dalam Kartu Keluarga" width="30%" src="<?php echo e(theme_asset('images/statistik_pend.png')); ?>" /></a>
            <a href="<?php echo e(site_url('data-statistik/pekerjaan')); ?>"><img alt="Statistik Pekerjaan" width="30%" src="<?php echo e(theme_asset('images/statistik_pekerjaan.png')); ?>" /></a>
            <hr>
        </div>
        <div class="col-md-6">
            <a href="<?php echo e(site_url('data-statistik/agama')); ?>"><img alt="Statistik Agama" width="30%" src="<?php echo e(theme_asset('images/statistik_agama.png')); ?>" /></a>
            <a href="<?php echo e(site_url('data-statistik/jenis-kelamin')); ?>"><img alt="Statistik Jenis Kelamin" width="30%" src="<?php echo e(theme_asset('images/statistik_kelamin.png')); ?>" /></a>
            <a href="<?php echo e(site_url('data-statistik/rentang-umur')); ?>"><img alt="Statistik Umur" width="30%" src="<?php echo e(theme_asset('images/statistik_umur.png')); ?>" /></a>
            <hr>
        </div>
    </div>
<?php endif; ?>

<div class="footer_top">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="single_footer_top wow fadeInRight">
                    <h2><?php echo e(ucwords(setting('sebutan_desa'))); ?> <?php echo e(ucwords($desa['nama_desa'])); ?></h2>
                    <p><?php echo e($desa['alamat_kantor']); ?><br><?php echo e(ucwords(setting('sebutan_kecamatan') . ' ' . $desa['nama_kecamatan'])); ?> <?php echo e(ucwords(setting('sebutan_kabupaten') . ' ' . $desa['nama_kabupaten'])); ?> Provinsi <?php echo e($desa['nama_propinsi']); ?> Kode Pos <?php echo e($desa['kode_pos']); ?></p>
                    <p>
                        <?php if(!empty($desa['email_desa'])): ?>
                            Email: <?php echo e($desa['email_desa']); ?>

                        <?php endif; ?>
                        <br />
                        <?php if(!empty($desa['telepon'])): ?>
                            Telp: <?php echo e($desa['telepon']); ?>

                        <?php endif; ?>
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="single_footer_top wow fadeInDown">
                    <h2>Kategori</h2>
                    <ul class="labels_nav">
                        <?php $__currentLoopData = $menu_kiri; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><a href="<?php echo e(site_url('artikel/kategori/' . $data['slug'])); ?>"><?php echo e($data['kategori']); ?></a></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="single_footer_top wow fadeInRight">
                    <?php if(setting('tte')): ?>
                        <img src="<?php echo e(asset('assets/images/bsre.png?v', false)); ?>" alt="Bsre" class="img-responsive" style="width: 185px;" />
                    <?php endif; ?>
                    <?php $__currentLoopData = $sosmed; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(!empty($data['link'])): ?>
                            <a href="<?php echo e($data['link']); ?>" rel="noopener noreferrer" target="_blank">
                                <img src="<?php echo e($data['icon']); ?>" alt="<?php echo e($data['nama']); ?>" style="width:50px;height:50px;" />
                            </a>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\opensid\/storage/app/themes/natra/resources/views/partials/footer_top.blade.php ENDPATH**/ ?>