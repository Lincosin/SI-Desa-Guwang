<?php $__env->startSection('title'); ?>
    <h1>
        Pengaturan Database
    </h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="active"><a href="<?php echo e(ci_route('database')); ?>">Pengaturan Database</a></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.layouts.components.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li <?php echo $act_tab == 1 ? 'class="active"' : ''; ?>>
                <a href="<?php echo e(ci_route('database')); ?>">Backup
                    <?php echo e(jecho(config_item('demo_mode'), false, ' /Restore')); ?>

                </a>
            </li>
            <?php if(can('u')): ?>
                <li <?php echo $act_tab == 2 ? 'class="active"' : ''; ?>><a href="<?php echo e(ci_route('database.migrasi_cri')); ?>">Migrasi DB</a></li>
            <?php endif; ?>
        </ul>
        <div class="tab-content">
            <?php echo $__env->make($content, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    <?php $__env->stopSection(); ?>

    <?php $__env->startPush('scripts'); ?>
        <script src="<?php echo e(asset('js/sweetalert2/sweetalert2.all.min.js')); ?>"></script>
        <script>
            function showLoadingForm(text = 'Sedang memproses data', autoClose = false, autoCloseDelay = 2000) {
                Swal.fire({
                    title: 'Mohon tunggu...',
                    text: text,
                    allowOutsideClick: false,
                    allowEscapeKey: !autoClose,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Auto-close untuk download/proses yang tidak reload page
                if (autoClose) {
                    setTimeout(() => {
                        Swal.close();
                    }, autoCloseDelay);
                }

                const submitBtn = document.querySelector('form button[type="submit"]');
                if (submitBtn) {
                    submitBtn.disabled = true;
                }
            }
        </script>
    <?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/database/index.blade.php ENDPATH**/ ?>