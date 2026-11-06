<div class="col-md-3">
    <?php if(!$kk_baru): ?>
        <input name="no_kk" type="hidden" value="<?php echo e($penduduk['no_kk']); ?>">
    <?php endif; ?>
    <?php echo $__env->make('admin.layouts.components.ambil_foto', ['id_sex' => $penduduk['id_sex'], 'foto' => $penduduk['foto']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<div class="col-md-9">
    <div class="box box-primary">
        <div class="box-header with-border">
            <?php if(preg_match('/keluarga/i', $_SERVER['HTTP_REFERER'])): ?>
                <?php echo $__env->make('admin.layouts.components.tombol_kembali', ['url' => $_SERVER['HTTP_REFERER'], 'label' => 'Daftar Anggota Keluarga'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
            <?php if(preg_match('/rtm/i', $_SERVER['HTTP_REFERER'])): ?>
                <?php echo $__env->make('admin.layouts.components.tombol_kembali', ['url' => $_SERVER['HTTP_REFERER'], 'label' => 'Anggota Rumah Tangga'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
            <?php echo $__env->make('admin.layouts.components.tombol_kembali', ['url' => ci_route('penduduk.clear'), 'label' => 'Daftar Penduduk'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="box-body">
            <?php echo $__env->make('admin.penduduk.penduduk_form_isian_bersama', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <?php if($penduduk['status_dasar_id'] == 1 || !isset($penduduk['status_dasar_id'])): ?>
            <div class="box-footer">
                <button type="reset" class="btn btn-social btn-danger btn-sm"><i class='fa fa-times'></i> Batal</button>
                <button type="submit" class="btn btn-social btn-info btn-sm pull-right" onclick="$('#'+'mainform').attr('action', '<?php echo e($form_action); ?>');$('#'+'mainform').submit();"><i class="fa fa-check"></i> Simpan</button>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/penduduk/penduduk_form_isian.blade.php ENDPATH**/ ?>