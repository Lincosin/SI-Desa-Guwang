<?php if($modal): ?>
    <?php if($buttonOnly): ?>
        <a href="<?php echo e($url); ?>" class="btn <?php echo e($type); ?> btn-sm" <?php if($onclick): ?> onclick="<?php echo e($onclick); ?>" <?php endif; ?> <?php if($dataHref): ?> data-href="<?php echo e($dataHref); ?>" <?php endif; ?>  <?php if($dataBody): ?> data-body="<?php echo e($dataBody); ?>" <?php endif; ?> <?php echo e($attribut); ?> data-remote="false" data-toggle="modal" data-target="#<?php echo e($modalTarget ?? 'modalBox'); ?>" data-title="<?php echo e($judul); ?>" title="<?php echo e($judul); ?>"><i class="<?php echo e($icon); ?>"></i><?php echo e($withJudul ? ' '.$withJudul : ''); ?></a>
    <?php elseif($confirm): ?>
        <a href="#<?php echo e($confirmTarget ?? 'confirm-delete'); ?>"
        onclick="<?php echo e($onclick); ?>"
        class="btn btn-social <?php echo e($type); ?> btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"
        title="<?php echo e($judul); ?>">
            <i class="<?php echo e($icon); ?>"></i> <?php echo e($judul); ?>

        </a>
    <?php else: ?>
        <a
        <?php if($url): ?> href="<?php echo e(site_url($url)); ?>" <?php endif; ?>
        class="btn btn-social <?php echo e($type); ?> btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"
        title="<?php echo e($judul); ?>"
        data-target="#<?php echo e($modalTarget ?? 'modalBox'); ?>"
        data-remote="false"
        data-toggle="modal"
        data-backdrop="false"
        data-keyboard="false"
        data-title="<?php echo e($judul); ?>"
    ><i class="<?php echo e($icon); ?>"></i>
        <?php echo e($judul); ?></a>   
    <?php endif; ?>
    
<?php else: ?>
    <?php if($buttonOnly): ?>
        <a href="<?php echo e($url); ?>" <?php echo e($attribut); ?> class="btn <?php echo e($type); ?> btn-sm" <?php if($blank): ?> target="_blank" <?php endif; ?>  title="<?php echo e($judul); ?>"><i class="<?php echo e($icon); ?>"></i></a>
    <?php elseif($formAction): ?>
        <a href="#" <?php if($tooltip): ?> title="<?php echo e($tooltip); ?>" id="kirim" onclick="formAction('mainform','<?php echo e($url); ?>')" <?php endif; ?> class="btn btn-social <?php echo e($type); ?> btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block aksi-terpilih"><i class="<?php echo e($icon); ?> "></i><?php echo e($judul); ?></a>
    <?php else: ?>
        <a href="<?php echo e($slug ? $url : ($file ? base_url($url) : ($url ? site_url($url) : '#'))); ?>" <?php if($disabled): ?> disabled <?php endif; ?> <?php if($tooltip): ?> title="<?php echo e($tooltip); ?>" <?php endif; ?> class="btn btn-social <?php echo e($type); ?> btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="<?php echo e($judul); ?> Data" <?php if($blank): ?> target="_blank" <?php endif; ?>><i class="<?php echo e($icon); ?> "></i><?php echo e($judul); ?></a>
    <?php endif; ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/layouts/components/buttons/btn.blade.php ENDPATH**/ ?>