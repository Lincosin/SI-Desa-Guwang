<?php if(session('success')): ?>
    <div id="notifikasi" class="callout callout-success">
        <h4><i class="icon fa fa-check"></i> Berhasil</h4>
        <p><?php echo e(session('success')); ?></p>
    </div>
<?php endif; ?>

<?php if(session('error')): ?>
    <div id="notifikasi" class="callout callout-danger">
        <h4><i class="icon fa fa-alert"></i> Gagal</h4>
        <p><?php echo e(session('error')); ?></p>
    </div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\opensid\resources\views/layanan_mandiri/layouts/components/notifikasi.blade.php ENDPATH**/ ?>