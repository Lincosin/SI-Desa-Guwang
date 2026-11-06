<?php echo $__env->make('admin.layouts.components.asset_validasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('title'); ?>
    <h1>
        <h1>Form Artikel <?php echo e($kategori['kategori']); ?></h1>
    </h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li><a href="<?php echo e(ci_route('web')); ?>">Daftar Artikel</a></li>
    <li class="active">Form Artikel</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.layouts.components.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo form_open_multipart($form_action, 'id="validasi"'); ?>

    <div class="row">
        <div class="col-md-8">
            <div class="box box-info">
                <div class="box-header with-border">
                    <?php if (isset($component)) { $__componentOriginalc11c7292aaa9235aebed7379ae351e6a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc11c7292aaa9235aebed7379ae351e6a = $attributes; } ?>
<?php $component = App\View\Components\KembaliButton::resolve(['judul' => 'Kembali Ke Daftar Artikel','url' => '/web/' . $cat] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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

                    <?php if($artikel['slug']): ?>
                        <?php if (isset($component)) { $__componentOriginal0fd673fce629071b3dc828d9abc34190 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0fd673fce629071b3dc828d9abc34190 = $attributes; } ?>
<?php $component = App\View\Components\BtnButton::resolve(['judul' => 'Lihat Artikel','icon' => 'fa fa-eye','slug' => 'true','blank' => 'true','type' => 'bg-green','file' => 'true','url' => $artikel['url_slug']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('btn-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\BtnButton::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0fd673fce629071b3dc828d9abc34190)): ?>
<?php $attributes = $__attributesOriginal0fd673fce629071b3dc828d9abc34190; ?>
<?php unset($__attributesOriginal0fd673fce629071b3dc828d9abc34190); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0fd673fce629071b3dc828d9abc34190)): ?>
<?php $component = $__componentOriginal0fd673fce629071b3dc828d9abc34190; ?>
<?php unset($__componentOriginal0fd673fce629071b3dc828d9abc34190); ?>
<?php endif; ?>
                    <?php endif; ?>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label class="control-label" for="judul">Judul Artikel</label>
                        <input
                            id="judul"
                            name="judul"
                            class="form-control input-sm required strip_tags judul"
                            type="text"
                            placeholder="Judul Artikel"
                            minlength="5"
                            maxlength="200"
                            value="<?php echo e($artikel['judul']); ?>"
                        ></input>
                        <span class="help-block"><code>Judul artikel minimal 5 karakter dan maksimal 200 karakter</code></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="kode_desa">Isi Artikel</label>
                        <textarea name="isi" data-filemanager='<?php echo json_encode(['external_filemanager_path' => base_url('rfm/'), 'filemanager_title' => 'Responsive Filemanager', 'filemanager_access_key' => $session->fm_key]); ?>' class="form-control input-sm required" style="height:350px;"><?php echo e($artikel['isi']); ?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-info collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title">Unggah Gambar</h3>
                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <?php if($artikel['gambar']): ?>
                                <img class="profile-user-img img-responsive img-circle" src="<?php echo e(AmbilFotoArtikel($artikel['gambar'], 'kecil')); ?>" alt="Gambar Utama">
                                <p class="text-center"><label class="control-label"><input type="checkbox" name="gambar_hapus" value="<?php echo e($artikel['gambar']); ?>" /> Hapus Gambar</label></p>
                            <?php else: ?>
                                <img class="profile-user-img img-responsive img-circle" src="<?php echo e(home_noimage()); ?>" alt="Tidak Ada Gambar">
                            <?php endif; ?>
                            <label class="control-label" for="gambar">Gambar Utama</label>
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" id="file_path">
                                <input type="file" class="hidden" id="file" name="gambar" accept=".gif,.jpg,.jpeg,.png,.webp">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-info" id="file_browser"><i class="fa fa-search"></i> Browse</button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <?php if($artikel['gambar1']): ?>
                                <img class="profile-user-img img-responsive img-circle" src="<?php echo e(AmbilFotoArtikel($artikel['gambar1'], 'kecil')); ?>" alt="Gambar Utama">
                                <p class="text-center"><label class="control-label"><input type="checkbox" name="gambar1_hapus" value="<?php echo e($artikel['gambar1']); ?>" /> Hapus Gambar</label></p>
                            <?php else: ?>
                                <img class="profile-user-img img-responsive img-circle" src="<?php echo e(home_noimage()); ?>" alt="Tidak Ada Gambar">
                            <?php endif; ?>
                            <label class="control-label" for="gambar1">Gambar Tambahan</label>
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" id="file_path1">
                                <input type="file" class="hidden" id="file1" name="gambar1" accept=".gif,.jpg,.jpeg,.png,.webp">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-info" id="file_browser1"><i class="fa fa-search"></i> Browse</button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <?php if($artikel['gambar2']): ?>
                                <img class="profile-user-img img-responsive img-circle" src="<?php echo e(AmbilFotoArtikel($artikel['gambar2'], 'kecil')); ?>" alt="Gambar Utama">
                                <p class="text-center"><label class="control-label"><input type="checkbox" name="gambar2_hapus" value="<?php echo e($artikel['gambar2']); ?>" /> Hapus Gambar</label></p>
                            <?php else: ?>
                                <img class="profile-user-img img-responsive img-circle" src="<?php echo e(home_noimage()); ?>" alt="Tidak Ada Gambar">
                            <?php endif; ?>
                            <label class="control-label" for="gambar2">Gambar Tambahan</label>
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" id="file_path2">
                                <input type="file" class="hidden" id="file2" name="gambar2" accept=".gif,.jpg,.jpeg,.png,.webp">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-info" id="file_browser2"><i class="fa fa-search"></i> Browse</button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <?php if($artikel['gambar3']): ?>
                                <img class="profile-user-img img-responsive img-circle" src="<?php echo e(AmbilFotoArtikel($artikel['gambar3'], 'kecil')); ?>" alt="Gambar Utama">
                                <p class="text-center"><label class="control-label"><input type="checkbox" name="gambar3_hapus" value="<?php echo e($artikel['gambar3']); ?>" /> Hapus Gambar</label></p>
                            <?php else: ?>
                                <img class="profile-user-img img-responsive img-circle" src="<?php echo e(home_noimage()); ?>" alt="Tidak Ada Gambar">
                            <?php endif; ?>
                            <label class="control-label" for="gambar3">Gambar Tambahan</label>
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" id="file_path3">
                                <input type="file" class="hidden" id="file3" name="gambar3" accept=".gif,.jpg,.jpeg,.png,.webp">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-info" id="file_browser3"><i class="fa fa-search"></i> Browse</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if($cat == 'agenda'): ?>
                <input type="hidden" name="id_agenda" value="<?php echo e($artikel['id']); ?>">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Pengaturan Agenda Desa</h3>
                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label" for="tgl_agenda">Tanggal Kegiatan</label>
                                <div class="input-group input-group-sm date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar-check-o"></i>
                                    </div>
                                    <input class="form-control input-sm pull-right tgl_jam" name="tgl_agenda" type="text" value="<?php echo e($artikel['agenda']['tgl_agenda']); ?>">
                                </div>
                                <span class="help-block"><code>(Isikan Tanggal Kegiatan)</code></span>
                                <label class="control-label" for="lokasi_kegiatan">Lokasi Kegiatan</label>
                                <div class="input-group input-group-sm">
                                    <div class="input-group-addon">
                                        <i class="fa fa-map-marker"></i>
                                    </div>
                                    <input class="form-control input-sm pull-right" name="lokasi_kegiatan" type="text" placeholder="Masukan lokasi tempat dilakukan kegiatan" value="<?php echo e($artikel['agenda']['lokasi_kegiatan']); ?>" maxlength="100">
                                </div>
                                <span class="help-block"><code>(Isikan Lokasi Tempat Dilakukan Kegiatan)</code></span>
                                <label class="control-label" for="koordinator_kegiatan">Koordinator Kegiatan</label>
                                <div class="input-group input-group-sm">
                                    <div class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <input class="form-control input-sm pull-right" name="koordinator_kegiatan" type="text" placeholder="Masukan nama koordinator" value="<?php echo e($artikel['agenda']['koordinator_kegiatan']); ?>" maxlength="50">
                                </div>
                                <span class="help-block"><code>(Isikan Koordinator Kegiatan)</code></span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Pengaturan Tampilan</h3>
                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body no-padding">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="control-label" for="tampilan">Posisi</label>
                            <select name="tampilan" class="form-control input-sm select2">
                                <?php $__currentLoopData = $list_tampilan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($key); ?>" <?php echo e(selected($key, $artikel['tampilan'])); ?>><?php echo e($value); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Pengaturan Lainnya</h3>
                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body no-padding">
                    <div class="col-sm-12">
                        <?php if($artikel['dokumen']): ?>
                            <div class="form-group">
                                <div class="mailbox-attachment-info bg-black">
                                    <a href="<?php echo e(base_url(LOKASI_DOKUMEN . $artikel['dokumen'])); ?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> Unduh Dokumen</a>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="form-group">
                            <label class="control-label" for="dokumen">Dokumen Lampiran</label>
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" id="file_path4">
                                <input type="file" class="hidden" id="file4" name="dokumen" accept=".pdf">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-info" id="file_browser4"><i class="fa fa-search"></i></button>
                                    <button type='button' class='btn btn-info btn-danger' id="hapus_file"><i class='fa fa-stop'></i></button>
                                    <?php if($artikel): ?>
                                        <input type="text" hidden="" name="hapus_lampiran" value="" id="hapus_lampiran" />
                                    <?php endif; ?>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="nama_dokumen">Nama Dokumen</label>
                            <input id="link_dokumen" name="link_dokumen" class="form-control input-sm strip_tags" type="text" value="<?php echo e(e($artikel['link_dokumen'])); ?>" maxlength="100">
                            <span class="help-block"><code>(Nantinya akan menjadi link unduh/download)</code></span>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="tgl_upload">Tanggal Posting</label>
                            <div class="input-group input-group-sm date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input class="form-control input-sm pull-right tgl_jam" name="tgl_upload" type="text" value="<?php echo e($artikel['tgl_upload']); ?>">
                            </div>
                            <span class="help-block"><code>(Kosongkan jika ingin langsung di post, bisa digunakan untuk artikel terjadwal)</code></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box box-info">
                <div class="box-body no-padding">
                    <div class='box-footer'>
                        <?php echo batal(); ?>

                        <button type='submit' class='btn btn-social btn-info btn-sm pull-right'><i class='fa fa-check'></i> Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.components.datetime_picker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->startPush('scripts'); ?>
    <script type="text/javascript" src="<?php echo e(asset('js/tinymce-72/tinymce.min.js')); ?>"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: 'textarea',
            height: 700,
            promotion: false,
            sandbox_iframes: false,
            theme: 'silver',
            formats: {
                menjorok: {
                    block: 'p',
                    styles: {
                        'text-indent': '30px'
                    }
                }
            },
            block_formats: 'Paragraph=p; Header 1=h1; Header 2=h2; Header 3=h3; Header 4=h4; Header 5=h5; Header 6=h6; Div=div; Preformatted=pre; Blockquote=blockquote; Menjorok=menjorok',
            style_formats_merge: true,
            plugins: [
                'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'print', 'preview', 'hr', 'anchor', 'pagebreak',
                'searchreplace', 'wordcount', 'visualblocks', 'visualchars', 'insertdatetime', 'media', 'nonbreaking',
                'table', 'contextmenu', 'directionality', 'emoticons', 'paste', 'textcolor', 'responsivefilemanager', 'code', 'laporan_keuangan', 'penerima_bantuan', 'sotk'
            ],
            toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | blocks",
            toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor | print preview code | fontfamily fontsizeinput",
            toolbar3: "| laporan_keuangan | penerima_bantuan | sotk",
            image_advtab: true,
            external_plugins: {
                "filemanager": "<?php echo e(base_url('rfm/plugin.min.js')); ?>"
            },
            templates: [{
                    title: 'Test template 1',
                    content: 'Test 1'
                },
                {
                    title: 'Test template 2',
                    content: 'Test 2'
                }
            ],
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tinymce.com/css/codepen.min.css'
            ],
            skin: 'tinymce-5',
            relative_urls: false,
            remove_script_host: false
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\opensid\resources\views/admin/web/artikel/form.blade.php ENDPATH**/ ?>