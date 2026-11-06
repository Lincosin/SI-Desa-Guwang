<?php echo $__env->make('admin.layouts.components.asset_validasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->startSection('title'); ?>
    <h1>
        <h1><?php echo e($parent ? 'Rincian Album' : 'Daftar Album'); ?></h1>
    </h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li>
        <?php if($parent): ?>
        <a href="<?php echo e(ci_route('gallery') . '?parent=' . $parent); ?>"> Rincian Album</a>
        <?php else: ?>
        <a href="<?php echo e(ci_route('gallery')); ?>"> Daftar Album</a>
        <?php endif; ?>
    </li>
    <li class="active"><?php echo e($aksi); ?> <?php echo e($parent ? 'Form Rincian Album' : 'Form Daftar Album'); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.layouts.components.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo form_open_multipart($form_action, 'class="form-horizontal" id="validasi"'); ?>

    <div class="box box-info">
        <div class="box-header with-border">
            <?php if (isset($component)) { $__componentOriginalc11c7292aaa9235aebed7379ae351e6a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc11c7292aaa9235aebed7379ae351e6a = $attributes; } ?>
<?php $component = App\View\Components\KembaliButton::resolve(['judul' => 'Kembali Ke '.e($parent ? 'Rincian Album' : 'Daftar Album').'','url' => ''.e($parent ? 'gallery' . '?parent=' . $parent : 'gallery').''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('kembali-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\KembaliButton::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc11c7292aaa9235aebed7379ae351e6a)): ?>
<?php $attributes = $__attributesOriginalc11c7292aaa9235aebed7379ae351e6a; ?>
<?php unset($__attributesOriginalc11c7292aaa9235aebed7379ae351e6a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc11c7292aaa9235aebed7379ae351e6a)): ?>
<?php $component = $__componentOriginalc11c7292aaa9235aebed7379ae351e6a; ?>
<?php unset($__componentOriginalc11c7292aaa9235aebed7379ae351e6a); ?>
<?php endif; ?>
        </div>
        <div class="box-body">
            <div class="form-group">
                <label class="control-label col-sm-4" for="nama">Nama <?php echo e($parent ? 'Gambar' : 'Album'); ?></label>
                <div class="col-sm-6">
                    <input name="nama" class="form-control input-sm nomor_sk required" maxlength="50" type="text" value="<?php echo e($gallery['nama']); ?>"></input>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4" for="nama">Jenis</label>
                <div class="col-sm-6">
                    <select name="jenis" id="jenis" class="form-control input-sm required">
                        <option value="1" <?= ($gallery['jenis'] == 1) ? 'selected' : ''; ?>>File</option>
                        <option value="2" <?= ($gallery['jenis'] == 2) ? 'selected' : ''; ?>>URL</option>
                    </select>
                </div>
            </div>
            <div id="jenis-file">
                <?php if($gallery['gambar']): ?>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="nama"></label>
                        <div class="col-sm-6">
                            <img class="attachment-img img-responsive img-circle" src="<?php echo e(AmbilGaleri($gallery['gambar'], 'sedang')); ?>" alt="Gambar Album">
                        </div>
                    </div>
                <?php endif; ?>
                <div class="form-group">
                    <label class="control-label col-sm-4" for="upload">Unggah Gambar</label>
                    <div class="col-sm-6">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control <?php echo e(jecho($gallery['gambar'], false, 'required')); ?>" id="file_path">
                            <input id="file" type="file" class="hidden" name="gambar" accept=".gif,.jpg,.png,.jpeg,.webp">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-info btn-flat" id="file_browser"><i class="fa fa-search"></i> Browse</button>
                            </span>
                        </div>
                        <p><label class="control-label">Batas maksimal pengunggahan berkas <strong>2 MB.</strong></label></p>
                    </div>
                </div>
            </div>
            <div id="jenis-url" class="form-group">
                <label class="control-label col-sm-4" for="url">Link/URL</label>
                <div class="col-sm-6">
                    <div class="input-group input-group-sm">
                        <input id="url" name="url" class="form-control input-sm" type="url" value="<?php echo e($gallery['gambar']); ?>" />
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-info btn-danger btn-sm" id="kosongkan"><i class="fa fa-refresh" title="Kosongkan"></i>&nbsp;</button>
                            <button type="button" class="btn btn-info btn-info btn-sm" id="file_browser2" data-toggle="modal" data-target="#FileManager"><i class="fa fa-search"></i>&nbsp;</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <?php echo batal(); ?>

            <button type="submit" class="btn btn-social btn-info btn-sm pull-right confirm"><i class="fa fa-check"></i> Simpan</button>
        </div>
    </div>
    </form>

    <!-- File Manager -->
    <div class="modal fade" id="FileManager" role="dialog" aria-labelledby="FileManagerLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                    <h4 class='modal-title' id='FileManagerLabel'>File Manager</h4>
                </div>
                <div class="modal-body">
                    <iframe width="100%" height="400px" src="<?php echo e(base_url('rfm/dialog.php?type=1&lang=id&field_id=url&fldr=&akey=' . $session->fm_key)); ?>" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; "></iframe>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function() {
            const file_path_required = <?php echo e($file_path_required ? 1 : 0); ?>

            $('#jenis').on('change', function() {
                jenis(this.value);
            });

            $('#jenis').trigger('change')

            function jenis(params) {
                if (params == 1) {
                    $('#jenis-file').show();
                    $('#jenis-url').hide();
                    if (file_path_required) {
                        $("#file_path").addClass("required");
                    }
                    $("#url").removeClass("required");
                    $("#url").val('');
                } else {
                    $('#jenis-file').hide();
                    $('#jenis-url').show();
                    $("#file_path").removeClass("required");
                    $("#url").addClass("required");
                }
            }

            $('#kosongkan').on('click', function() {
                $('#url').val('');
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\opensid\resources\views/admin/web/gallery/form.blade.php ENDPATH**/ ?>