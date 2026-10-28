<div class="tab-pane" id="lainnya">
    <div class="box-body">
        <div class="form-group">
            <label>Jenis Font Bawaan </label>
            <div class="row">
                <div class="col-lg-4 col-md-7 col-sm-12">
                    <select class="select2 form-control" name="font_surat">
                        <?php $__currentLoopData = $font_option; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $font): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($font); ?>" <?= ($font == setting('font_surat')) ? 'selected' : ''; ?>>
                                <?php echo e($font); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>Upload Font Custom</label>
            <input type="file" name="font_custom" class="form-control input-sm" accept=".ttf">
        </div>
        <div class="form-group">
            <label>Format Penomoran Surat </label>
            <input type="text" name="format_nomor_surat" class="form-control input-sm" value="<?php echo e(setting('format_nomor_surat')); ?>">
        </div>
        <div class="form-group">
            <label><?php echo e($penomoran_surat->judul); ?> </label>
            <select <?php echo $penomoran_surat->attribute ? str_replace('class="', 'class="form-control input-sm select2 required ', $penomoran_surat->attribute) : 'class="form-control input-sm select2 required"'; ?> id="<?php echo e($penomoran_surat->key); ?>" name="<?php echo e($penomoran_surat->key); ?>">
                <?php $__currentLoopData = $penomoran_surat->option; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($key); ?>" <?= ($penomoran_surat->value == $key) ? 'selected' : ''; ?>><?php echo e($value); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <span class="help-block small text-red"><?php echo $penomoran_surat->keterangan; ?></span>
        </div>
        <?php
            $panjang_no_surat = $list_setting->where('key', 'panjang_nomor_surat')->first();
        ?>
        <div class="form-group">
            <label><?php echo e($panjang_no_surat->judul); ?> </label>
            <input type="text" name="<?php echo e($panjang_no_surat->key); ?>" class="form-control input-sm" value="<?php echo e($panjang_no_surat->value); ?>">
            <span class="help-block small text-red"><?php echo $panjang_no_surat->keterangan; ?></span>
        </div>
        <div class="form-group">
            <label>Kode Isian Data Kosong </label>
            <input type="text" name="ganti_data_kosong" class="form-control input-sm" value="<?php echo e(setting('ganti_data_kosong')); ?>">
        </div>
        <div class="form-group">
            <label>Format Tanggal Surat </label>
            <a href="<?php echo e(ci_route('surat_master.form')); ?>" title="Lihat Informasi Format Tanggal" class="btn btn-social bg-olive btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" data-remote="false" data-toggle="modal" data-target="#format-tanggal">
                <i class="fa fa-book"></i> Informasi</a>
            <input type="text" name="format_tanggal_surat" class="format_tanggal form-control input-sm required" placeholder="d F Y" value="<?php echo e(setting('format_tanggal_surat')); ?>">
            <span class="help-block small text-red"><?php echo $list_setting->where('key', 'format_tanggal_surat')->first()->keterangan; ?></span>
        </div>
        <div class="form-group">
            <label>Margin</label>
            <div class="row">
                <?php $__currentLoopData = $margins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-sm-6">
                        <div class="input-group" style="margin-top: 3px; margin-bottom: 3px">
                            <span class="input-group-addon input-sm"><?php echo e(ucwords($key)); ?></span>
                            <input
                                type="number"
                                class="form-control input-sm required"
                                min="0"
                                name="surat_margin[<?php echo e($key); ?>]"
                                min="0"
                                max="10"
                                step="0.01"
                                style="text-align:right;"
                                value="<?php echo e($value); ?>"
                            >
                            <span class="input-group-addon input-sm">cm</span>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <div class="form-group">
            <label>Data Pelaku Digunakan Berulang</label>
            <div class="row">
                <div class="btn-group col-xs-12 col-sm-8" data-toggle="buttons" style="margin: 0 0 5px 0">
                    <label class="tipe btn btn-info btn-sm col-xs-12 col-sm-6 col-lg-3 form-check-label <?= (setting('sumber_penduduk_berulang_surat') ?? 0) ? 'active' : ''; ?>">
                        <input type="radio" name="sumber_penduduk_berulang_surat" class="form-check-input" value="1" <?= (setting('sumber_penduduk_berulang_surat') ?? 0) ? 'checked' : ''; ?> autocomplete="off">Ya
                    </label>
                    <label class="tipe btn btn-info btn-sm col-xs-12 col-sm-6 col-lg-3 form-check-label <?= (!(setting('sumber_penduduk_berulang_surat') ?? 0)) ? 'active' : ''; ?>">
                        <input type="radio" name="sumber_penduduk_berulang_surat" class="form-check-input" value="0" <?= (!(setting('sumber_penduduk_berulang_surat') ?? 0)) ? 'checked' : ''; ?> autocomplete="off">Tidak
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $__env->make('admin.pengaturan_surat.partials.format_tanggal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/pengaturan_surat/partials/pengaturan_lainnya.blade.php ENDPATH**/ ?>