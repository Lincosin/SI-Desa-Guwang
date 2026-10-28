<?php echo $__env->make('admin.layouts.components.datetime_picker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="form-group subtitle_head" id="label_lainnya">
    <label class="col-sm-12 control-label" for="label_lainnya">LAINNYA</label>
</div>

<div class="form-group">
    <label for="mulai_berlaku" class="col-sm-3 control-label">Berlaku Dari - Sampai</label>
    <div class="col-sm-3 col-lg-2">
        <div class="input-group input-group-sm date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input
                title="Pilih Tanggal"
                id="surat_tgl_mulai"
                class="form-control input-sm required"
                name="mulai_berlaku"
                type="text"
                data-masa-berlaku="<?php echo e($surat->masa_berlaku); ?>"
                data-satuan-masa-berlaku="<?php echo e($surat->satuan_masa_berlaku); ?>"
            />
        </div>
    </div>
    <div class="col-sm-3 col-lg-2">
        <div class="input-group input-group-sm date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input
                title="Pilih Tanggal"
                id="surat_tgl_akhir"
                class="form-control input-sm required"
                name="berlaku_sampai"
                type="text"
                readonly
                data-masa-berlaku="<?php echo e($surat->masa_berlaku); ?>"
                data-satuan-masa-berlaku="<?php echo e($surat->satuan_masa_berlaku); ?>"
            />
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/surat/form_tgl_berlaku.blade.php ENDPATH**/ ?>