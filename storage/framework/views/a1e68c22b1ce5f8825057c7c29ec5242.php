<?php if(can('u')): ?>
<div class="btn-group-vertical radius-3">
    <a class="btn btn-social btn-sm bg-navy" data-toggle="dropdown"><i class='fa fa-arrow-circle-down'></i>
        Impor / Ekspor</a>
    <ul class="dropdown-menu" role="menu">
        <li>
            <a
                href="<?php echo e($impor); ?>"
                class="btn btn-social btn-block btn-sm"
                data-target="#<?php echo e($target ? $target : 'impor-pengguna'); ?>"
                data-remote="false"
                data-toggle="modal"
                data-backdrop="false"
                data-keyboard="false"
            ><i class="fa fa-upload"></i> <?php echo e($label ?? 'Impor'); ?></a>
        </li>
        <li>
            <a target="_blank" class="btn btn-social btn-block btn-sm aksi-terpilih" title="Ekspor Pengguna" onclick="formAction('mainform', '<?php echo e($ekspor); ?>'); return false;"><i class="fa fa-download"></i> <?php echo e($label ?? 'Ekspor'); ?></a>
        </li>
    </ul>
</div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/layouts/components/tombol_impor_ekspor_grup.blade.php ENDPATH**/ ?>