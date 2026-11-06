<?php if(session('success')): ?>
    <div id="notifikasi" class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Berhasil</h4>
        <p><?php echo session('success'); ?></p>
    </div>
<?php endif; ?>

<?php if(session('error')): ?>
    <div <?php if(session('autodismiss')): ?> <?php else: ?> id="notifikasi" <?php endif; ?> class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-ban"></i> Gagal</h4>
        <p><?php echo is_array(session('error')) ? implode(', ', session('error')) : session('error'); ?></p>
    </div>
<?php endif; ?>

<?php if($errors->any()): ?>
    <div <?php if(session('autodismiss')): ?> <?php else: ?> id="notifikasi" <?php endif; ?> class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-ban"></i> Gagal</h4>
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($item); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<?php if(session('warning')): ?>
    <div id="notifikasi" class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-warning"></i> Peringatan</h4>
        <p><?php echo session('warning'); ?></p>
    </div>
<?php endif; ?>

<?php if(session('information')): ?>
    <div id="notifikasi" class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-info"></i> Informasi</h4>
        <p><?php echo session('information'); ?></p>
    </div>
<?php endif; ?>
<?php /**PATH D:\laragon\www\opensid\/desa/themes/temaku/resources/views/commons/notifikasi.blade.php ENDPATH**/ ?>