<?php echo $__env->make('admin.layouts.components.asset_validasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('title'); ?>
<h1>
    Grup Pengguna
    <small><?php echo e($action); ?> Data</small>
</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li><a href="<?php echo e(ci_route('grup')); ?>">Grup Pengguna</a></li>
<li class="active"><?php echo e($action); ?> Data</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('admin.layouts.components.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<form id="validasi" action="<?php echo e($form_action); ?>" method="POST" enctype="multipart/form-data">
    <div class="box box-primary">
        <div class="box-header with-border">
            <?php if (isset($component)) { $__componentOriginalc11c7292aaa9235aebed7379ae351e6a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc11c7292aaa9235aebed7379ae351e6a = $attributes; } ?>
<?php $component = App\View\Components\KembaliButton::resolve(['judul' => 'Kembali Ke Daftar Pengaturan Grup Pengguna','url' => 'grup'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
                <label for="group">Nama Grup</label>
                <input name="nama" class="form-control input-sm required nama_terbatas" type="text" maxlength="20"
                    placeholder="Nama Grup" value="<?php echo e($grup['nama']); ?>"></input>
            </div>

            <div class="form-group">
                <label for="modul">Akses Modul</label>
                <div class="table-responsive">
                    <table class="table table-bordered dataTable table-striped table-hover tabel-daftar">
                        <thead class="bg-gray color-palette">
                            <tr>
                                <th><input type="checkbox" id="checkall" /></th>
                                <th colspan="2">No</th>
                                <th>Nama Modul</th>
                                <th>Hak Baca</th>
                                <th>Hak Ubah</th>
                                <th>Hak Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($moduls): ?>
                            <?php $__currentLoopData = $moduls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $modulActive): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                            $aksesParent = $grup_akses[$modulActive->id]->akses ?? 0;
                            $modulActive->children->each(function ($item) use (&$aksesParent, $grup_akses) {
                            $aksesParent += $grup_akses[$item->id]->akses ?? 0;
                            });
                            ?>
                            <tr class="bg-aqua">
                                <td class="padat"><input id="m<?php echo e($key + 1); ?>" type="checkbox" name="modul[id][]"
                                        value="<?php echo e($modulActive->id); ?>" <?= ($aksesParent) ? 'checked' : ''; ?> /></td>
                                <td class="padat" colspan="2"><?php echo e($key + 1); ?></td>
                                <td><?php echo e(SebutanDesa($modulActive->modul)); ?></td>
                                <?php if($modulActive->children->isEmpty()): ?>
                                <td class="padat">
                                    <input class="m<?php echo e($key + 1); ?>" type="checkbox"
                                        name="modul[akses_baca][<?php echo e($modulActive->id); ?>]" value="1"
                                        <?= (decbin($grup_akses[$modulActive->id]->akses ?? 0) & 1) ? 'checked' : ''; ?> />
                                </td>
                                <td class="padat">
                                    <input class="m<?php echo e($key + 1); ?>" type="checkbox"
                                        name="modul[akses_ubah][<?php echo e($modulActive->id); ?>]" value="1"
                                        <?= (decbin($grup_akses[$modulActive->id]->akses ?? 0) & 2) ? 'checked' : ''; ?> />
                                </td>
                                <td class="padat">
                                    <input class="m<?php echo e($key + 1); ?>" type="checkbox"
                                        name="modul[akses_hapus][<?php echo e($modulActive->id); ?>]" value="1"
                                        <?= (decbin($grup_akses[$modulActive->id]->akses ?? 0) & 4) ? 'checked' : ''; ?> />
                                </td>
                                <?php else: ?>
                                <td class="padat">
                                    <input type="checkbox" class="checkall-baca m<?php echo e($key + 1); ?>"
                                        data-group="m<?php echo e($key + 1); ?>" title="Centang semua hak baca" />
                                </td>
                                <td class="padat">
                                    <input type="checkbox" class="checkall-ubah m<?php echo e($key + 1); ?>"
                                        data-group="m<?php echo e($key + 1); ?>" title="Centang semua hak ubah" />
                                </td>
                                <td class="padat">
                                    <input type="checkbox" class="checkall-hapus m<?php echo e($key + 1); ?>"
                                        data-group="m<?php echo e($key + 1); ?>" title="Centang semua hak hapus" />
                                </td>
                                <?php endif; ?>
                            </tr>
                            <?php $__currentLoopData = $modulActive->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subkey => $submodul): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="padat">
                                    <input id="m<?php echo e($key + 1 . '.' . ($subkey + 1)); ?>" class="m<?php echo e($key + 1); ?>"
                                        type="checkbox" name="modul[id][]" value="<?php echo e($submodul->id); ?>"
                                        <?= ($grup_akses[$submodul->id]->akses ?? false) ? 'checked' : ''; ?> />
                                </td>
                                <td></td>
                                <td class="padat"><?php echo e($key + 1 . '.' . ($subkey + 1)); ?></td>
                                <td><?php echo e(SebutanDesa($submodul->modul)); ?></td>
                                <td class="padat">
                                    <input class="m<?php echo e($key + 1); ?>" type="checkbox"
                                        name="modul[akses_baca][<?php echo e($submodul->id); ?>]" value="1"
                                        <?= (decbin($grup_akses[$submodul->id]->akses ?? 0) & 1) ? 'checked' : ''; ?> />
                                </td>
                                <td class="padat">
                                    <input class="m<?php echo e($key + 1); ?>" type="checkbox"
                                        name="modul[akses_ubah][<?php echo e($submodul->id); ?>]" value="1"
                                        <?= (decbin($grup_akses[$submodul->id]->akses ?? 0) & 2) ? 'checked' : ''; ?> />
                                </td>
                                <td class="padat">
                                    <input class="m<?php echo e($key + 1); ?>" type="checkbox"
                                        name="modul[akses_hapus][<?php echo e($submodul->id); ?>]" value="1"
                                        <?= (decbin($grup_akses[$submodul->id]->akses ?? 0) & 4) ? 'checked' : ''; ?> />
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                            <tr>
                                <td class="padat" colspan="4">Data Tidak Tersedia</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <br>
                <div class="btn-group col-xs-12 col-sm-8" style="padding: 0" data-toggle="buttons">
                    <label class="btn btn-info btn-sm col-xs-6 col-sm-5 col-lg-3 form-check-label <?= ($status) ? 'active' : ''; ?>">
                        <input type="radio" name="status" class="form-check-input" value="1" <?= ($status) ? 'checked' : ''; ?>> Aktif
                    </label>
                    <label class="btn btn-info btn-sm col-xs-6 col-sm-5 col-lg-3 form-check-label <?= (!$status) ? 'active' : ''; ?>">
                        <input type="radio" name="status" class="form-check-input" value="0" <?= (!$status) ? 'checked' : ''; ?>> Tidak
                        Aktif
                    </label>
                </div>
            </div>
        </div>
        <?php if(!$view): ?>
        <div class='box-footer'>
            <button type="reset" class="btn btn-social btn-danger btn-sm"><i class="fa fa-times"></i> Batal</button>
            <button type="submit" class="btn btn-social btn-info btn-sm pull-right"><i class="fa fa-check"></i>
                Simpan</button>
        </div>
        <?php endif; ?>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script type="text/javascript">
    $(document).ready(function() {

            var viewOnly = "<?php echo e($view); ?>";

            if (viewOnly) {
                $('input').attr('disabled', true);
            } else {
                $("input[name*='modul[id]']").change(function() {
                    var val = $(this).val();
                    var id = $(this).attr('id');
                    console.log('id: ' + id + ', val: ' + val);
                    
                    $('input[type=checkbox][name*="[' + val + ']"]').prop('checked', $(this).is(':checked'));
                    // Ubah suhmodul sesuai modul
                    // Cara berikut karena trigger('change') tidak jalan (?)
                    // Submodul aktif tergantung modul
                    
                    if (this.checked) {
                        console.log('checked');
                        
                        $("input." + id).removeAttr("disabled");
                        $('input[type=checkbox][id^="' + id + '."]').prop('checked', !$(this).is(':checked'));
                        $('input[type=checkbox][id^="' + id + '."]').trigger('click');
                        // Jika modul utama di-check, check juga semua akses baca pada submodul

                        $(".checkall-baca." + id).prop('checked', true);
                        $(".checkall-ubah." + id).prop('checked', true);
                        $(".checkall-hapus." + id).prop('checked', true);

                    } else {
                        // Jika modul utama di-uncheck, uncheck juga semua akses baca pada submodul

                        $(".checkall-baca." + id).prop('checked', false);
                        $(".checkall-ubah." + id).prop('checked', false);
                        $(".checkall-hapus." + id).prop('checked', false);

                        $('input[type=checkbox][id^="' + id + '."]').prop('checked', !$(this).is(':checked'));
                        $('input[type=checkbox][id^="' + id + '."]').trigger('click');
                        $("input." + id).attr("disabled", true);
                    }
                });

                $("input[name*='akses']").change(function() {
                    var name = $(this).attr('name');
                    var modul = $(this).parent().parent().find(":checkbox")[0];
                    if ($(this).is(':checked')) {
                        $(modul).prop('checked', true);
                    }
                    if (name.indexOf('akses_baca') > 0) {
                        var ubah = name.replace("baca", "ubah")
                        var hapus = name.replace("baca", "hapus")
                        if (!$(this).is(':checked')) {
                            // Pastikan akses_ubah dan akses_hapus tidak checked
                            $("input[name='" + ubah + "']").prop('checked', false);
                            $("input[name='" + hapus + "']").prop('checked', false);
                        }
                    } else if (name.indexOf('akses_ubah') > 0) {
                        var baca = name.replace("ubah", "baca")
                        var hapus = name.replace("ubah", "hapus")
                        if ($(this).is(':checked')) {
                            // Pastikan akses_baca juga checked
                            $("input[name='" + baca + "']").prop('checked', true);
                        } else {
                            // Pastikan akses_hapus tidak checked
                            $("input[name='" + hapus + "']").prop('checked', false);
                        }
                    } else if (name.indexOf('akses_hapus') > 0) {
                        var baca = name.replace("hapus", "baca")
                        var ubah = name.replace("hapus", "ubah")
                        if ($(this).is(':checked')) {
                            // Pastikan akses_baca dan akses_ubah juga checked
                            $("input[name='" + baca + "']").prop('checked', true);
                            $("input[name='" + ubah + "']").prop('checked', true);
                        }
                    }
                });

                $("input[name*='modul[id]']").each(function(index) {
                    var id = $(this).attr('id');
                    if (this.checked) {
                        $("input." + id).removeAttr("disabled");
                        $('input[type=checkbox][id^="' + id + '."]').prop('checked', !$(this).is(':checked'));
                    } else {
                        $('input[type=checkbox][id^="' + id + '."]').prop('checked', $(this).is(':checked'));
                        $("input." + id).attr("disabled", true);
                    }
                });

                $("input[name*='akses']").each(function(index) {
                    var modul = $(this).parent().parent().find(":checkbox")[0];
                    if ($(this).is(':checked')) {
                        $(modul).prop('checked', true);
                    }
                });
            }

            // FUNGSI: Centang semua hak baca/ubah/hapus pada submodul dalam satu grup
            function updateCheckAll(group) {
                // Baca
                var baca = $("." + group + "[name^='modul[akses_baca]']");
                var checkallBaca = $(".checkall-baca." + group);
                checkallBaca.prop('checked', baca.length > 0 && baca.filter(':checked').length === baca.length);

                // Ubah
                var ubah = $("." + group + "[name^='modul[akses_ubah]']");
                var checkallUbah = $(".checkall-ubah." + group);
                checkallUbah.prop('checked', ubah.length > 0 && ubah.filter(':checked').length === ubah.length);

                // Hapus
                var hapus = $("." + group + "[name^='modul[akses_hapus]']");
                var checkallHapus = $(".checkall-hapus." + group);
                checkallHapus.prop('checked', hapus.length > 0 && hapus.filter(':checked').length === hapus.length);
            }

            $('.checkall-baca').on('change', function() {
                var group = $(this).data('group');
                var checked = $(this).is(':checked');
                $("." + group + "[name^='modul[akses_baca]']").prop('checked', checked);
                setTimeout(function() { updateCheckAll(group); }, 0);
            });
            $('.checkall-ubah').on('change', function() {
                var group = $(this).data('group');
                var checked = $(this).is(':checked');
                $("." + group + "[name^='modul[akses_ubah]']").prop('checked', checked);
                setTimeout(function() { updateCheckAll(group); }, 0);
            });
            $('.checkall-hapus').on('change', function() {
                var group = $(this).data('group');
                var checked = $(this).is(':checked');
                $("." + group + "[name^='modul[akses_hapus]']").prop('checked', checked);
                setTimeout(function() { updateCheckAll(group); }, 0);
            });

            // Update checkall jika ada perubahan pada akses submodul
            $("input[name*='modul[akses_baca]'], input[name*='modul[akses_ubah]'], input[name*='modul[akses_hapus]']").on('change', function() {
                var classes = $(this).attr('class');
                if (!classes) return;
                // Ambil kelas group, misal: m1, m2, dst
                var group = classes.split(' ').filter(function(c) { return /^m\d+$/.test(c); })[0];
                if (group) updateCheckAll(group);
            });

            // Inisialisasi checkall saat halaman dimuat
            <?php $__currentLoopData = $moduls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $modulActive): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(!$modulActive->children->isEmpty()): ?>
                    updateCheckAll('m<?php echo e($key + 1); ?>');
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\opensid\resources\views/admin/pengaturan/grup/form.blade.php ENDPATH**/ ?>