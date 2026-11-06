<?php $__env->startSection('content'); ?>
    <div class="box box-solid">
        <div class="box-header with-border bg-yellow">
            <h4 class="box-title">Pesan</h4>
        </div>
        <div class="box-body box-line">
            <div class="form-group">
                <?php echo $__env->make('admin.layouts.components.tombol_kembali_layanan_mandiri', ['url' => ci_route('layanan-mandiri.' . $tujuan), 'label' => ucwords(spaceunpenetration($tujuan))], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            </div>
        </div>
        <div class="box-body box-line">
            <h4><b><?php echo e($kat == 2 ? 'BALAS' : 'TULIS'); ?> PESAN</b></h4>
        </div>
        <div class="box-body">
            <!-- Notifikasi -->
            <?php if(session('notif') && session('notif')['data']): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo e(session('notif')['pesan']); ?>

                </div>
            <?php endif; ?>
            <form id="validasi" action="<?php echo e(ci_route('layanan-mandiri.pesan.kirim')); ?>" method="post">
                <div class="form-group">
                    <label for="subjek">Subjek</label>
                    <input type="text" class="form-control required <?php echo e($cek_anjungan['keyboard'] == 1 ? 'kbvtext' : ''); ?>" name="subjek" placeholder="Subjek" value="<?php echo e($subjek ?? session('notif')['data']['subjek']); ?>" <?php echo e($kat == 2 ? 'readonly' : ''); ?>>
                </div>
                <div class="form-group">
                    <label for="pesan">Isi Pesan</label>
                    <textarea class="form-control required <?php echo e($cek_anjungan['keyboard'] == 1 ? 'kbvtext' : ''); ?>" name="pesan" placeholder="Isi Pesan"><?php echo e(session('notif')['data']['pesan'] ?? ''); ?></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn bg-green btn-social">
                        <i class="fa fa-send-o"></i>Kirim Pesan
                    </button>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layanan_mandiri.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\opensid\resources\views/layanan_mandiri/pesan/tulis.blade.php ENDPATH**/ ?>