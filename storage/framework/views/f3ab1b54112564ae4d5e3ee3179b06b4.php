<div class="btn-group-vertical">
    <a class="btn btn-social bg-purple btn-sm" data-toggle="dropdown"><i class='fa fa-arrow-circle-down' title="Cetak/Unduh Data"></i> Cetak/Unduh</a>
    <ul class="dropdown-menu" role="menu">
        <li>
            <a href="<?php echo e(site_url($cetak)); ?>" class="btn btn-social btn-block btn-sm" title="Cetak Data" <?php if($target): ?> target="_blank" <?php else: ?> data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Cetak Data" <?php endif; ?>><i class="fa fa-print"></i> Cetak</a>
        </li>
        <li>
            <a href="<?php echo e(site_url($unduh)); ?>" class="btn btn-social btn-block btn-sm" title="Unduh Data" <?php if($target): ?> target="_blank" <?php else: ?> data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Unduh Data" <?php endif; ?>><i class="fa fa-download"></i> Unduh</a>
        </li>
    </ul>
</div>
<?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/layouts/components/tombol_cetak_unduh.blade.php ENDPATH**/ ?>