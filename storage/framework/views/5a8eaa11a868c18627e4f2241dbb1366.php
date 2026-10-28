<?php echo $__env->make('admin.layouts.components.asset_validasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->startSection('title'); ?>
    <h1>
        Wilayah Administratif <?php echo e($wilayahLabel); ?>

        <small><?php echo e($aksi ? 'Ubah' : 'Tambah'); ?> Data</small>
    </h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li><a href="<?php echo e(ci_route('wilayah.index')); ?>"> Wilayah Administratif <?php echo e($wilayahLabel); ?></a></li>
    <li class="active"><?php echo e($aksi ? 'Ubah' : 'Tambah'); ?> Data</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.layouts.components.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="box box-info">
        <div class="box-header with-border">
            <?php echo $__env->make('admin.layouts.components.tombol_kembali', ['url' => '#', 'label' => 'Wilayah Administratif ' . $wilayahLabel, 'onclick' => 'window.history.back()'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        </div>
        <?php echo form_open_multipart($form_action, 'class="form-horizontal" id="validasi"'); ?>

        <div class="box-body">
            <div class="form-group">
                <label class="col-sm-3 control-label" for="nama">Nama <?php echo e($wilayahLabel); ?></label>
                <div class="col-sm-7">
                    <input
                        id="nama"
                        class="form-control input-sm nama_terbatas required"
                        maxlength="50"
                        type="text"
                        placeholder="Nama <?php echo e($wilayahLabel); ?>"
                        name="<?php echo e($level); ?>"
                        value="<?php echo e($wilayah->$level); ?>"
                    >
                </div>
            </div>
            <?php if($wilayah->kepala): ?>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="kepala_lama">Kepala <?php echo e($wilayahLabel); ?> Sebelumnya</label>
                    <div class="col-sm-7">
                        <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                            <strong><?php echo e($wilayah->kepala->nama); ?></strong>
                            <br />NIK - <?php echo e($wilayah->kepala->nik); ?>

                        </p>
                    </div>
                </div>
            <?php endif; ?>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="id_kepala">NIK / Nama Kepala <?php echo e($wilayahLabel); ?></label>
                <div class="col-sm-7">
                    <select class="form-control select2 select2-infinite" data-url="wilayah/apipendudukwilayah" data-filter-status="<?php echo e(\App\Enums\StatusDasarEnum::HIDUP); ?>" style="width: 100%;" id="id_kepala" name="id_kepala">
                        <option selected="selected">-- Silakan Masukan NIK / Nama--</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <button type="reset" class="btn btn-social btn-danger btn-sm"><i class="fa fa-times"></i> Batal</button>
            <button type="submit" class="btn btn-social btn-info btn-sm pull-right"><i class="fa fa-check"></i> Simpan</button>
        </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('js/custom-select2.js')); ?>"></script>
    <script>
        $(document).ready(function() {

        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/wilayah/form.blade.php ENDPATH**/ ?>