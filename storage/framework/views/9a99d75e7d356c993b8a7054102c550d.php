<?php echo $__env->make('admin.layouts.components.datetime_picker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('admin.layouts.components.asset_validasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $pemerintah = 'Staf ' . ucwords(setting('sebutan_pemerintah_desa')) ?>
<?php $__env->startSection('title'); ?>
    <h1>
        <?php echo e($pemerintah); ?>

        <small><?php echo e($aksi); ?> Data</small>
    </h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(ci_route('pengurus')); ?>"><?php echo e($pemerintah); ?></a></li>
    <li class="active"><?php echo e($aksi); ?> Data</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.layouts.components.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="box box-info">
        <div class="box-header with-border">
            <?php if (isset($component)) { $__componentOriginalc11c7292aaa9235aebed7379ae351e6a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc11c7292aaa9235aebed7379ae351e6a = $attributes; } ?>
<?php $component = App\View\Components\KembaliButton::resolve(['judul' => 'Kembali Ke Daftar '.e($pemerintah).'','url' => 'pengurus'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
            <div class="row">
                <div class="col-sm-12 form-horizontal">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-4 col-lg-2 control-label" for="pengurus">Data Staf</label>
                        <div class="btn-group col-xs-12 col-sm-8" data-toggle="buttons">
                            <label for="pengurus_1" class="btn btn-info btn-sm col-xs-6 col-sm-5 col-lg-3 form-check-label <?php if (empty($pamong) || !empty($individu)) : ?>active<?php endif ?>">
                                <input
                                    id="pengurus_1"
                                    type="radio"
                                    name="pengurus"
                                    class="form-check-input"
                                    type="radio"
                                    value="1"
                                    <?php if(empty($pamong) || !empty($individu)): ?> checked <?php endif; ?>
                                    autocomplete="off"
                                    onchange="pengurus_asal(this.value);"
                                > Dari Database Penduduk
                            </label>
                            <label for="pengurus_2" class="btn btn-info btn-sm col-xs-6 col-sm-5 col-lg-3 form-check-label <?php if (!empty($pamong) && empty($individu)) : ?>active<?php endif; ?>">
                                <input
                                    id="pengurus_2"
                                    type="radio"
                                    name="pengurus"
                                    class="form-check-input"
                                    type="radio"
                                    value="2"
                                    <?php if(!empty($pamong) && empty($individu)): ?> checked <?php endif; ?>
                                    autocomplete="off"
                                    onchange="pengurus_asal(this.value);"
                                > Tidak Terdata
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <form id="main" name="main" method="POST" class="form-horizontal">
                        <label class="col-xs-12 col-sm-4 col-lg-2 control-label" for="id_pend">NIK / Nama Penduduk </label>
                        <div class="col-xs-12 col-sm-8">
                            <select id="id_pend" name="id_pend" class="form-control input-sm" data-placeholder="-- Silakan Masukan NIK / Nama --" onchange="formAction('main')">
                                <option value="<?php echo e($individu['id']); ?>" selected>NIK :
                                    <?php echo e($individu['nik'] . ' - ' . $individu['nama'] . ' - ' . $individu['dusun']); ?>

                                </option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <?= form_open_multipart($form_action, 'id="validasi-proses" class="form-horizontal"') ?>
        <input type="hidden" name="id_pend" value="<?php echo e($individu['id']); ?>">
        <div class="col-md-3">
            <?php echo $__env->make('admin.layouts.components.ambil_foto', [
                'id_sex' => $individu ? $individu['sex'] : $pamong['id_sex'],
                'foto' => $pamong['foto_staff'],
                'show_dimensi' => [
                    'width' => $imageInfo['width'],
                    'height' => $imageInfo['height'],
                ],
            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php if(count($media_sosial) > 0): ?>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Media Sosial</h3>
                    </div>

                    <div class="box-body">
                        <?php $__currentLoopData = $media_sosial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <strong><i class="fa fa-<?php echo e($value['id']); ?>"></i> <?php echo e($value['nama']); ?></strong>
                            <input class="form-control input-sm" type="text" name="media_sosial[<?php echo e($value['id']); ?>]" style="margin-bottom: 10px;" value="<?php echo e($pamong['media_sosial'][$value['id']]); ?>" placeholder="<?php echo e($value['url']); ?>">
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="pamong_nama">Nama Pegawai
                            <?= ucwords(setting('sebutan_desa')) ?></label>
                        <div class="col-sm-7">
                            <input type="hidden" name="nik" value="<?php echo e($individu['nik']); ?>">
                            <input id="nama_penduduk" class="form-control input-sm pengurus-desa" type="text" placeholder="Nama" value="<?php echo e($individu['nama']); ?>" disabled="disabled" />
                            <input
                                id="pamong_nama"
                                name="pamong_nama"
                                class="form-control input-sm pengurus-luar-desa <?php echo e(!empty($individu) ?: 'required'); ?>"
                                type="text"
                                placeholder="Nama"
                                value="<?php echo e($pamong['nama']); ?>"
                                style="display: none;"
                            />
                        </div>
                    </div>
                    <div class="form-group gelar">
                        <label class="col-sm-4 control-label"></label>
                        <div class="col-sm-3"></div>
                        <div class="col-sm-7">
                            <input id="nama_dengan_gelar" class="form-control input-sm" type="text" placeholder="Nama dengan gelar" disabled />
                        </div>
                    </div>
                    <div class="form-group gelar">
                        <label class="col-sm-4 control-label" for="gelar">Gelar</label>
                        <div class="col-sm-2">
                            <input id="gelar_depan" name="gelar_depan" class="form-control input-sm input-gelar" type="text" placeholder="Gelar Depan" value="<?php echo e($pamong['gelar_depan']); ?>" />
                        </div>
                        <div class="col-sm-2">
                            <input id="gelar_belakang" name="gelar_belakang" class="form-control input-sm input-gelar" type="text" placeholder="Gelar Belakang" value="<?php echo e($pamong['gelar_belakang']); ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="pamong_nik">Nomor Induk Kependudukan</label>
                        <div class="col-sm-7">
                            <input class="form-control input-sm pengurus-desa" type="text" placeholder="Nomor Induk Kependudukan" value="<?php echo e($individu['nik']); ?>" disabled="disabled" />
                            <input
                                id="pamong_nik"
                                name="pamong_nik"
                                class="form-control input-sm pengurus-luar-desa nik"
                                type="text"
                                maxlength="16"
                                placeholder="Nomor Induk Kependudukan"
                                value="<?php echo e($pamong['pamong_nik']); ?>"
                                style="display: none;"
                            />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="pamong_niap"><?= setting('sebutan_nip_desa') ?></label>
                        <div class="col-sm-7">
                            <input
                                id="pamong_niap"
                                name="pamong_niap"
                                class="form-control input-sm digits"
                                type="text"
                                maxlength="25"
                                placeholder="<?= setting('sebutan_nip_desa') ?>"
                                value="<?php echo e($pamong['pamong_niap']); ?>"
                            />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="pamong_nip">NIP</label>
                        <div class="col-sm-7">
                            <input
                                id="pamong_nip"
                                name="pamong_nip"
                                class="form-control input-sm digits"
                                type="text"
                                maxlength="20"
                                placeholder="NIP"
                                value="<?php echo e($pamong['pamong_nip']); ?>"
                            />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="pamong_tag_id_card">Tag ID Card</label>
                        <div class="col-sm-7">
                            <input class="form-control input-sm pengurus-desa" type="text" placeholder="Tag ID Card" value="<?php echo e($individu['tag_id_card']); ?>" disabled="disabled" />
                            <input
                                id="pamong_tag_id_card"
                                name="pamong_tag_id_card"
                                class="form-control input-sm pengurus-luar-desa tag_id_card"
                                type="text"
                                maxlength="17"
                                placeholder="Tag ID Card"
                                value="<?php echo e($pamong['pamong_tag_id_card']); ?>"
                                style="display: none;"
                            />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="pamong_tempatlahir">Tempat Lahir</label>
                        <div class="col-sm-7">
                            <input class="form-control input-sm pengurus-desa" type="text" placeholder="Tempat Lahir" value="<?php echo e(strtoupper($individu['tempatlahir'])); ?>" disabled="disabled" />
                            <input name="pamong_tempatlahir" class="form-control input-sm pengurus-luar-desa" type="text" placeholder="Tempat Lahir" value="<?php echo e(strtoupper($pamong['pamong_tempatlahir'])); ?>" style="display: none;" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="pamong_tanggallahir">Tanggal Lahir</label>
                        <div class="col-sm-7">
                            <input class="form-control input-sm pengurus-desa" type="text" placeholder="Tanggal Lahir" value="<?php echo e(strtoupper($individu['tanggallahir'])); ?>" disabled="disabled" />
                            <div class="input-group input-group-sm date pengurus-luar-desa" style="display: none;">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input class="form-control input-sm pull-right tgl_1" name="pamong_tanggallahir" type="text" value="<?php echo e($pamong['pamong_tanggallahir'] ? tgl_indo_out($pamong['pamong_tanggallahir']) : ''); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="pamong_sex">Jenis Kelamin</label>
                        <div class="col-sm-7">
                            <input class="form-control input-sm pengurus-desa" type="text" placeholder="Jenis Kelamin" value="<?php echo e($individu['jenis_kelamin']); ?>" disabled="disabled" />
                            <select class="form-control input-sm pengurus-luar-desa" name="pamong_sex" style="display: none;">
                                <option value="">Jenis Kelamin</option>
                                <?php $__currentLoopData = App\Enums\JenisKelaminEnum::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($key); ?>" <?php echo e(selected($pamong['pamong_sex_id'], (string) $key)); ?>><?php echo e($value); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="pamong_pendidikan">Pendidikan</label>
                        <div class="col-sm-7">
                            <input class="form-control input-sm pengurus-desa" type="text" placeholder="Pendidikan" value="<?php echo e($individu['pendidikan_kk']); ?>" disabled="disabled" />
                            <select class="form-control input-sm pengurus-luar-desa" name="pamong_pendidikan" style="display: none;">
                                <option value="">Pilih Pendidikan (Dalam KK) </option>
                                <?php $__currentLoopData = \App\Enums\PendidikanKKEnum::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($key); ?>" <?php echo e(selected($pamong['pamong_pendidikan'], $key)); ?>>
                                        <?php echo e(strtoupper($value)); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="pamong_agama">Agama</label>
                        <div class="col-sm-7">
                            <input class="form-control input-sm pengurus-desa" type="text" placeholder="Agama" value="<?php echo e($individu['agama']); ?>" disabled="disabled" />
                            <select class="form-control input-sm pengurus-luar-desa" name="pamong_agama" style="display: none;">
                                <option value="">Pilih Agama</option>
                                <?php $__currentLoopData = \App\Enums\AgamaEnum::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($key); ?>" <?= ($pamong['pamong_agama_id'] == $key) ? 'selected' : ''; ?>>
                                        <?php echo e($value); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="pamong_pangkat">Pangkat / Golongan</label>
                        <div class="col-sm-7">
                            <input name="pamong_pangkat" class="form-control input-sm" type="text" maxlength="20" placeholder="Pangkat / Golongan" value="<?php echo e($pamong['pamong_pangkat']); ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="pamong_nosk">Nomor Keputusan Pengangkatan</label>
                        <div class="col-sm-7">
                            <input name="pamong_nosk" class="form-control input-sm" type="text" maxlength="30" placeholder="Nomor Keputusan Pengangkatan" value="<?php echo e($pamong['pamong_nosk']); ?>" />
                        </div>
                    </div>
                    <div class='form-group'>
                        <label class="col-sm-4 control-label" for="pamong_tglsk">Tanggal Keputusan Pengangkatan</label>
                        <div class="col-sm-7">
                            <div class="input-group input-group-sm date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input class="form-control input-sm pull-right tgl_1" name="pamong_tglsk" type="text" value="<?php echo e($pamong['pamong_tglsk'] ? tgl_indo_out($pamong['pamong_tglsk']) : ''); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="pamong_nohenti">Nomor Keputusan Pemberhentian</label>
                        <div class="col-sm-7">
                            <input name="pamong_nohenti" class="form-control input-sm" type="text" placeholder="Nomor Keputusan Pemberhentian" value="<?php echo e($pamong['pamong_nohenti']); ?>" />
                        </div>
                    </div>
                    <div class='form-group'>
                        <label class="col-sm-4 control-label" for="pamong_tglhenti">Tanggal Keputusan
                            Pemberhentian</label>
                        <div class="col-sm-7">
                            <div class="input-group input-group-sm date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input class="form-control input-sm pull-right tgl_1" name="pamong_tglhenti" type="text" value="<?php echo e($pamong['pamong_tglhenti'] ? tgl_indo_out($pamong['pamong_tglhenti']) : ''); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="pamong_masajab">Masa Jabatan (Usia/Periode)</label>
                        <div class="col-sm-7">
                            <input name="pamong_masajab" class="form-control input-sm" type="text" placeholder="Contoh: 6 Tahun Periode Pertama (2015 s/d 2021)" value="<?php echo e($pamong['pamong_masajab']); ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="jabatan">Jabatan</label>
                        <div class="col-sm-7">
                            <select class="form-control select2 input-sm required" id="jabatan" name="jabatan_id">
                                <option value="">Pilih Jabatan</option>
                                <?php $__currentLoopData = $jabatan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($key); ?>" <?php echo e(selected($pamong['jabatan_id'], $key)); ?>><?php echo e($value); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="status_pejabat" style="display: none;">
                        <label class="col-xs-12 col-sm-4 col-lg-4 control-label" for="status">Status Pejabat</label>
                        <div class="btn-group col-xs-12 col-sm-8" data-toggle="buttons">
                            <label id="sx3" class="btn btn-info btn-sm col-xs-6 col-sm-5 col-lg-3 form-check-label <?php if($pamong['status_pejabat'] == 1): ?> active <?php endif; ?>">
                                <input
                                    id="group1"
                                    type="radio"
                                    name="status_pejabat"
                                    class="form-check-input"
                                    type="radio"
                                    value="1"
                                    <?php if($pamong['status_pejabat'] == 1): ?> checked <?php endif; ?>
                                    autocomplete="off"
                                > Aktif
                            </label>
                            <label id="sx4" class="btn btn-info btn-sm col-xs-6 col-sm-5 col-lg-3 form-check-label <?php if($pamong['status_pejabat'] == 0): ?> active <?php endif; ?>">
                                <input
                                    id="group2"
                                    type="radio"
                                    name="status_pejabat"
                                    class="form-check-input"
                                    type="radio"
                                    value="0"
                                    <?php if($pamong['status_pejabat'] == 0): ?> checked <?php endif; ?>
                                    autocomplete="off"
                                > Tidak Aktif
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label text-red" for="atasan">Atasan</label>
                        <div class="col-sm-7">
                            <select class="form-control select2 input-sm" name="atasan">
                                <option value="">Pilih Atasan</option>
                                <?php $__currentLoopData = $atasan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($data->id); ?>" <?php echo e(selected($pamong['atasan'], $data->id)); ?>>
                                        <?php echo e($data->nama); ?> (<?php echo e($data->jabatan); ?>)</option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label text-red" for="jabatan">Bagan - Tingkat</label>
                        <div class="col-sm-7">
                            <input name="bagan_tingkat" class="form-control input-sm number" type="text" placeholder="Angka menunjukkan tingkat di bagan organisasi. Contoh: 2" value="<?php echo e($pamong['bagan_tingkat']); ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label text-red" for="jabatan">Bagan - Offset</label>
                        <div class="col-sm-7">
                            <input name="bagan_offset" class="form-control input-sm number" type="text" placeholder="Angka menunjukkan persentase geser (-n) atau kanan (+n). Contoh: 75%" value="<?php echo e($pamong['bagan_offset']); ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label text-red" for="jabatan">Bagan - Layout</label>
                        <div class="col-sm-7">
                            <select class="form-control input-sm" name="bagan_layout">
                                <option value="">Tidak Ada Layout</option>
                                <option value="hanging" <?php echo e(selected($pamong['bagan_layout'], 'hanging')); ?>>Hanging
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4 text-red">Bagan - Warna</label>
                        <div class="col-sm-7">
                            <div class="input-group my-colorpicker2">
                                <input type="text" name="bagan_warna" class="form-control input-sm warna" placeholder="#FFFFFF" value="<?php echo e($pamong['bagan_warna']); ?>">
                                <div class="input-group-addon input-sm">
                                    <i></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-4 col-lg-4 control-label" for="status">Status Pegawai
                            Desa</label>
                        <div class="btn-group col-xs-12 col-sm-8" data-toggle="buttons">
                            <label id="sx3" class="btn btn-info btn-sm col-xs-6 col-sm-5 col-lg-3 form-check-label <?php if($pamong['pamong_status'] == '1' || $pamong['pamong_status'] == null): ?> active <?php endif; ?>">
                                <input
                                    id="group1"
                                    type="radio"
                                    name="pamong_status"
                                    class="form-check-input"
                                    type="radio"
                                    value="1"
                                    <?php if($pamong['pamong_status'] == '1' || $pamong['pamong_status'] == null): ?> checked <?php endif; ?>
                                    autocomplete="off"
                                > Aktif
                            </label>
                            <label id="sx4" class="btn btn-info btn-sm col-xs-6 col-sm-5 col-lg-3 form-check-label <?php if($pamong['pamong_status'] == '2'): ?> active <?php endif; ?>">
                                <input
                                    id="group2"
                                    type="radio"
                                    name="pamong_status"
                                    class="form-check-input"
                                    type="radio"
                                    value="2"
                                    <?php if($pamong['pamong_status'] == '2'): ?> checked <?php endif; ?>
                                    autocomplete="off"
                                > Tidak Aktif
                            </label>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type='reset' class='btn btn-social btn-danger btn-sm btn-reset'><i class='fa fa-times'></i> Batal</button>
                    <button type='submit' class='btn btn-social btn-info btn-sm pull-right confirm'><i class='fa fa-check'></i> Simpan</button>
                </div>
            </div>
        </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('bootstrap/css/bootstrap-colorpicker.min.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('bootstrap/js/bootstrap-colorpicker.min.js')); ?>"></script>
    <script>
        $('document').ready(function() {
            $('#id_pend').select2({
                ajax: {
                    url: SITE_URL + 'pengurus/apidaftarpenduduk',
                    dataType: 'json',
                    data: function(params) {
                        return {
                            q: params.term || '',
                            page: params.page || 1,
                        };
                    },
                    cache: true
                },
                placeholder: function() {
                    $(this).data('placeholder');
                },
                minimumInputLength: 0,
                allowClear: true,
                escapeMarkup: function(markup) {
                    return markup;
                },
            });

            gelar();

            $("input[name='pengurus']:checked").change();
            if ($("input[name='id_pend']").val() != '') {
                $('#pamong_nama').removeClass('required');
            }

            $(".input-gelar").keyup(function() {
                gelar();
            });


            $('#jabatan').on('change', function() {
                const kades = "<?php echo e($kades_id); ?>";
                if (this.value == 1) {
                    $('#status_pejabat').show();
                } else {
                    $('#status_pejabat').hide();
                }
            });

            $('#jabatan').trigger('change');
        });

        function gelar() {
            var nama = $("input[name='id_pend']").val() != '' ?
                $("#nama_penduduk").val() :
                $("#pamong_nama").val();

            var depan = $("#gelar_depan").val();
            var belakang = $("#gelar_belakang").val();

            if (depan) {
                nama = depan + ' ' + nama;
            }

            if (belakang) {
                nama = nama + ', ' + belakang;
            }

            $("#nama_dengan_gelar").val(nama);
        }

        function pengurus_asal(asal) {
            if (asal == 1) {
                $('#main').show();
                $('.pengurus-luar-desa').hide();
                $('.pengurus-desa').show();
                $('#pamong_nama').val('');
                $('#pamong_nama').removeClass('required');
            } else {
                $('#main').hide();
                $("input[name='id_pend']").val('');
                $('.pengurus-luar-desa').show();
                $('.pengurus-desa').hide();
                $('#pamong_nama').addClass('required');
            }
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/pengurus/form.blade.php ENDPATH**/ ?>