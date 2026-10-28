<?php defined('BASEPATH') || exit('No direct script access allowed'); ?>

<div class="single_bottom_rightbar">
    <h2>
        <i class="fa fa-archive"></i> <a href="<?php echo e(site_url('arsip')); ?>">&ensp;<?php echo e($judul_widget); ?></a>
    </h2>
    <ul role="tablist" class="nav nav-tabs custom-tabs">
        <li class="active" role="presentation"><a data-toggle="tab" role="tab" aria-controls="home" href="#terkini">Terbaru</a></li>
        <li role="presentation"><a data-toggle="tab" role="tab" aria-controls="messages" href="#populer">Populer</a>
        </li>
        <li role="presentation"><a data-toggle="tab" role="tab" aria-controls="messages" href="#acak">Acak</a></li>
    </ul>
    <div class="tab-content">
        <?php $__currentLoopData = ['terkini' => 'arsip_terkini', 'populer' => 'arsip_populer', 'acak' => 'arsip_acak']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jenis => $jenis_arsip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div id="<?php echo e($jenis); ?>" class="tab-pane fade in <?php if($jenis == 'terkini'): ?> active <?php endif; ?>" role="tabpanel">
                <table id="ul-menu">
                    <?php $__currentLoopData = $$jenis_arsip; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $arsip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td colspan="2">
                                <span class="meta_date"><?php echo e(tgl_indo($arsip['tgl_upload'])); ?> | <i class="fa fa-eye"></i> <?php echo e(hit($arsip['hit'])); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" align="justify">
                                <a href="<?php echo e(site_url('artikel/' . buat_slug($arsip))); ?>">
                                    <?php if(is_file(LOKASI_FOTO_ARTIKEL . 'sedang_' . $arsip['gambar'])): ?>
                                        <img width="25%" style="float:left; margin:0 8px 4px 0;" class="yall_lazy img-fluid img-thumbnail" src="<?php echo e(asset('images/img-loader.gif')); ?>" data-src="<?php echo e(base_url(LOKASI_FOTO_ARTIKEL . 'sedang_' . $arsip['gambar'])); ?>" />
                                    <?php else: ?>
                                        <img width="25%" style="float:left; margin:0 8px 4px 0;" class="yall_lazy img-fluid img-thumbnail" src="<?php echo e(asset('images/img-loader.gif')); ?>" data-src="<?php echo e(asset(FOTO_TIDAK_TERSEDIA)); ?>" />
                                    <?php endif; ?>
                                    <small>
                                        <font color="green"><?php echo e($arsip['judul']); ?></font>
                                    </small>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </table>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\opensid\/storage/app/themes/natra/resources/views/widgets/arsip_artikel.blade.php ENDPATH**/ ?>