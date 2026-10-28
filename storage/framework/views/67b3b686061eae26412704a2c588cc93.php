<div class="box box-primary">
    <div class="box-header with-border">
        <b><?php echo e($judul); ?></b>
    </div>
    <div class="box-body box-profile text-center preview-img">
        <a href="<?php echo e($foto); ?>" class="progressive replace">
            <img class="preview" loading="lazy" src="<?php echo e(base_url('assets/images/img-loader.gif')); ?>" alt="<?php echo e($judul); ?>" width="100%" />
        </a>
        <p class="text-muted text-center text-red">(Kosongkan, jika <?php echo e(strtolower($judul)); ?> tidak berubah)</p>
        <div class="input-group input-group-sm">
            <input type="file" class="hidden file-input" id="file<?php echo e($nomor); ?>" name="<?php echo e($name); ?>" accept=".jpg,.jpeg,.png,.webp" />
            <input type="text" class="form-control hidden" id="file_path<?php echo e($nomor); ?>" name="<?php echo e($name); ?>">
        </div>
        <button type="button" class="btn btn-info btn-sm btn-block btn-mb-5" id="file_browser<?php echo e($nomor); ?>"><i class="fa fa-upload"></i>
            Unggah</button>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/layouts/components/box_unggah.blade.php ENDPATH**/ ?>