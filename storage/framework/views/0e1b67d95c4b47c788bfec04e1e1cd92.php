<?php if(can('b')): ?>
    <?php if($modal): ?>
        <a href="<?php echo e(site_url($url)); ?>"
            class="btn btn-social bg-navy btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"
            data-remote="false"
            data-toggle="modal"
            data-target="<?php echo e($modalTarget ?? '#modalBox'); ?>"
            data-title="<?php echo e($judul ?? 'Unduh'); ?> Data">
            <i class="fa fa-download"></i>
            <?php echo e($judul ?? 'Unduh'); ?> Data
        </a>
    <?php else: ?>
        <?php if($buttonOnly): ?>
        <a href="<?php echo e($url); ?>" class="btn bg-purple btn-sm"  title="Unduh" style="margin-right: 2px"><i class="fa fa-download"></i></a>
        <?php else: ?>
        <a href="<?php echo e(site_url($url)); ?>"
            class="btn btn-social bg-navy btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"
            title="<?php echo e($judul ?? 'Unduh'); ?> Data" target="_blank"><i
            class="fa fa-download">
            </i><?php echo e($judul ?? 'Unduh'); ?> Data
        </a>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH D:\laragon\www\opensid\resources\views/admin/layouts/components/buttons/unduh.blade.php ENDPATH**/ ?>