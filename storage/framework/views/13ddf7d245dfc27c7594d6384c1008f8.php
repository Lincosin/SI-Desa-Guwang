<?php echo $__env->make('admin.layouts.components.asset_datatables', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



<?php $__env->startSection('title'); ?>
    <h1>
        Tema
    </h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="active">Tema</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.layouts.components.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="box box-info">
        <div class="box-header with-border text-center">
            
            <?php if(can('u')): ?>
                <a href="<?php echo e(site_url('theme/pindai')); ?>" class="btn btn-social bg-purple btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"><i class="fa fa-retweet"></i> Pindai</a>
            <?php endif; ?>
            <a href="<?php echo e(site_url()); ?>" class="btn btn-social btn-info btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" target="_blank"><i class="fa fa-eye"></i> Lihat</a>
        </div>
        <div class="box-body">
            <form action="" method="get">
                <div class="row mepet">
                    <div class="col-sm-2">
                        <select id="kategori" name="kategori" class="form-control input-sm select2">
                            <option value="">Pilih Tipe</option>
                            <option <?= ($kategori === 'umum') ? 'selected' : ''; ?> value="umum">Umum</option>
                            <option <?= ($kategori === 'premium') ? 'selected' : ''; ?> value="premium">Premium</option>
                        </select>
                    </div>
                </div>
            </form>
            <hr class="batas">
            <div class="row">
                <?php $__empty_1 = true; $__currentLoopData = $themeList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $theme): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="col-md-4">
                        <?php if ($__env->exists('admin.theme.components.general.box', collect($theme)->merge($themeOrder)->toArray())) echo $__env->make('admin.theme.components.general.box', collect($theme)->merge($themeOrder)->toArray(), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-md-12">
                        <p class="text-center">Tidak ada tema yang tersedia</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php if($themeList->hasPages()): ?>
            <div class="box-footer text-center">
                <?php echo e($themeList->onEachSide(1)->links('admin.layouts.components.pagination_default')); ?>

            </div>
        <?php endif; ?>
    </div>
    <?php echo $__env->make('admin.layouts.components.konfirmasi_hapus', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        $(function() {
            $("#kategori").on("change", function() {
                let params = new URLSearchParams(window.location.search);

                $(this).val() ? params.set("kategori", $(this).val()) : params.delete("kategori");

                window.location.search = params.toString();
            }).val(new URLSearchParams(window.location.search).get("kategori"));
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/theme/index.blade.php ENDPATH**/ ?>