<?php defined('BASEPATH') || exit('No direct script access allowed'); ?>

<style type="text/css">
    .progress-bar span {
        position: absolute;
        right: 20px;
    }
</style>
<div class="container" id="transparansi-footer" style="width: 100%; padding-top: 10px;">
    <?php $__currentLoopData = $data_widget; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subdata_name => $subdatas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-4">
            <div align="center">
                <h2>
                    <?php echo e(\Illuminate\Support\Str::of($subdatas['laporan'])->when(setting('sebutan_desa') != 'desa', function (\Illuminate\Support\Stringable $string) {
                        return $string->replace('Des', \Illuminate\Support\Str::of(setting('sebutan_desa'))->substr(0, 1)->ucfirst());
                    })); ?>

                </h2>
            </div>
            <hr>
            <div align="center">
                <h4>Realisasi | Anggaran</h4>
            </div>
            <hr>
            <?php $__currentLoopData = $subdatas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $subdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(!is_array($subdata)) continue; ?>
                <?php if($subdata['judul'] != null and $key != 'laporan' and $subdata['realisasi'] != 0 or $subdata['anggaran'] != 0): ?>
                    <div class="progress-group">
                        <?php echo e(\Illuminate\Support\Str::of($subdata['judul'])->title()->whenEndsWith('Desa', function (\Illuminate\Support\Stringable $string) {
                                if (!in_array($string, ['Dana Desa'])) {
                                    return $string->replace('Desa', setting('sebutan_desa'));
                                }
                            })->title()); ?>

                        <br>
                        <b><?php echo e(rupiah24($subdata['realisasi'], 'RP ')); ?> | <?php echo e(rupiah24($subdata['anggaran'])); ?></b>
                        <div class="progress progress-bar-striped" align="right" style="background-color: #27c8a2"><small></small>
                            <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" style="width: <?php echo e($subdata['persen']); ?>%" aria-valuenow="<?php echo e($subdata['persen']); ?>" aria-valuemin="0" aria-valuemax="100"><span><?php echo e($subdata['persen']); ?> %</span></div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<hr>
<?php /**PATH C:\xampp\htdocs\opensid\/storage/app/themes/natra/resources/views/partials/apbdesa-tema.blade.php ENDPATH**/ ?>