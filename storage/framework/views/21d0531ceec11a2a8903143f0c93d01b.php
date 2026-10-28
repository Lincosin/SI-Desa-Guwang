<div
    class="modal fade"
    id="pendapat"
    tabindex="-1"
    role="dialog"
    aria-labelledby="myModalLabel"
    aria-hidden="true"
    data-backdrop="false"
    data-keyboard="false"
>
    <div class="modal-dialog notifikasi">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h4>BERIKAN PENILAIAN ANDA TERHADAP PELAYANAN KAMI</h4>
                <?php $__currentLoopData = unserialize(NILAI_PENDAPAT); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(site_url("layanan-mandiri/pendapat/{$key}")); ?>" class="btn btn-app pendapat">
                        <img src="<?php echo e(base_url(PENDAPAT . underscore($value, true, true) . '.png')); ?>">
                        <p><?php echo e($value); ?></p>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batalkan</button>
                <a href="<?php echo e(site_url('layanan-mandiri/keluar')); ?> " class="btn btn-success">Lain Kali</a>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\opensid\resources\views/layanan_mandiri/layouts/components/pendapat.blade.php ENDPATH**/ ?>