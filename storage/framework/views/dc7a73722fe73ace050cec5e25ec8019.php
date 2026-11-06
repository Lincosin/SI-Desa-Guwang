<?php echo $__env->make('admin.pengaturan_surat.asset_tinymce', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="tab-pane" id="template-surat">

    <?php echo $__env->make('admin.pengaturan_surat.kembali', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="box-body">
        <div class="form-group">
            <textarea name="template_desa" data-filemanager='<?= json_encode(['external_filemanager_path'=> base_url('rfm/'), 'filemanager_title' => 'Responsive Filemanager', 'filemanager_access_key' => $session->fm_key]) ?>' data-salintemplate="isi" class="form-control input-sm editor required"><?php echo e($suratMaster->template_desa ?? $suratMaster->template); ?></textarea>
        </div>
    </div>
</div>

<div class="tab-pane" id="form-isian">
    <?php echo $__env->make('admin.pengaturan_surat.kembali', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="box-body">
        <div class="row">
            <label for="penduduk_berulang" class="col-sm-3">Data Pelaku Digunakan Berulang</label>
            <div class="btn-group col-xs-12 col-sm-8" data-toggle="buttons" style="margin: 0 0 5px 0">
                <label class="tipe btn btn-info btn-sm col-xs-12 col-sm-6 col-lg-3 form-check-label <?= ($suratMaster->sumber_penduduk_berulang ?? 0) ? 'active' : ''; ?>">
                    <input type="radio" name="sumber_penduduk_berulang" class="form-check-input" value="1" <?= ($suratMaster->sumber_penduduk_berulang ?? 0) ? 'checked' : ''; ?> autocomplete="off">Ya
                </label>
                <label class="tipe btn btn-info btn-sm col-xs-12 col-sm-6 col-lg-3 form-check-label <?= (!($suratMaster->sumber_penduduk_berulang ?? 0)) ? 'active' : ''; ?>">
                    <input type="radio" name="sumber_penduduk_berulang" class="form-check-input" value="0" <?= (!($suratMaster->sumber_penduduk_berulang ?? 0)) ? 'checked' : ''; ?> autocomplete="off">Tidak
                </label>
            </div>
        </div>

        <hr>
        <a id="btn-new-tab" class="btn btn-social btn-primary btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"><i class="fa fa-plus"></i>Tambah Bagian Form</a>
        <hr>

        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs customized-tab" id="tabs">
                <li data-name="utama" class="active">
                    <a href="#form-utama" data-toggle="tab"><?php echo e($suratMaster->form_isian->individu->judul ?? 'Utama'); ?></a>
                </li>
                <?php $__empty_1 = true; $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php if($item == 'individu'): ?>
                        <?php continue; ?>
                    <?php endif; ?>
                    <li class="ui-list-tab" id="list-<?php echo e($item); ?>" data-name="<?php echo e($item); ?>">
                        <a id="nav-tab-<?php echo e($item); ?>" href="#tab-<?php echo e($item); ?>" data-toggle="tab"><?php echo e($value); ?></a>
                        <input type="hidden" name="kategori[]" value="<?php echo e($item); ?>">
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <?php endif; ?>
            </ul>
            <div class="tab-content custom">
                <div class="tab-pane active" id="form-utama">
                    <div class="box-body">
                        <button type="button" class="utama-delete btn btn-danger btn-sm pull-right hide" onclick="deleteTab(event)"><i class="fa fa-times-circle"></i> Hapus Bagian Form</button>
                        <div class="row">
                            <label for="isi-judul" class="col-sm-2">Judul Bagian</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control input-sm required judul isi-judul" name="judul" value="<?php echo e($suratMaster->form_isian->individu->judul ?: 'Utama'); ?>" minlength="3" maxlength="20">
                            </div>
                        </div>
                        <div class="row" style="margin-top: 5px">
                            <label for="isi-label" class="col-sm-2" title="Isi dengan karakter - untuk sembunyikan label">Label Bagian</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control input-sm required isi-label" name="label" value="<?php echo e($suratMaster->form_isian->individu->label ?? 'Keterangan Pemohon'); ?>" minlength="1" maxlength="30">
                            </div>
                        </div>
                        <div class="row" style="margin-top: 5px">
                            <label for="isi-label" class="col-sm-2">Info Bagian</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control input-sm isi-info" name="info" value="<?php echo e($suratMaster->form_isian->individu->info ?? ''); ?>" maxlength="100">
                            </div>
                        </div>
                        <div class="row" style="margin-top: 5px">
                            <label for="isi-prefix" class="col-sm-2">Prefix Bagian</label>
                            <div class="col-sm-8">
                                <input
                                    type="text"
                                    class="form-control input-sm required prefix_tinymce isi-prefix"
                                    name="prefix"
                                    value="<?php echo e(strtolower($suratMaster->form_isian->individu->prefix ?? 'individu')); ?>"
                                    minlength="3"
                                    maxlength="50"
                                    readonly
                                >
                            </div>
                        </div>
                        <div class="row" style="margin-top: 5px">
                            <label for="sebagai" class="col-sm-2">Sebagai</label>
                            <div class="col-sm-8">
                                <select id="utama_sebagai" class="form-control input-sm isi-sebagai-data" name="sebagai" disabled>
                                    <option value="0">Tidak Ada</option>
                                    <option value="1" selected>Terlapor</option>
                                    <option value="2">Pelapor</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <h5><b>Sumber Data Pelaku</b></h5>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped sumber-data">
                                <tbody>
                                    <tr style="font-weight: bold;">
                                        <td width="40%">Data Kategori</td>
                                        <td>Pilihan</td>
                                    </tr>

                                    <tr>
                                        <td>Tampil Sumber Data</td>
                                        <td>
                                            <select id="sumber_data" class="form-control input-sm isi-sumber-data" name="sumber" disabled>
                                                <option value="1" <?= ('1' == $suratMaster->form_isian->individu->sumber) ? 'selected' : ''; ?>>YA
                                                <option value="0" <?= ('0' == $suratMaster->form_isian->individu->sumber) ? 'selected' : ''; ?>>TIDAK
                                            </select>
                                        </td>
                                    </tr>

                                    <tr class="sumber_data">
                                        <td>Data Pelaku</td>
                                        <td>
                                            <?php $desa_pend = strtoupper(setting('sebutan_desa')) ?>
                                            <select id="data_utama" class="form-control input-sm select2 required" name="data_utama[]" multiple>
                                                <option value="1" <?= (in_array(1, $suratMaster->form_isian->individu->data ?? [])) ? 'selected' : ''; ?>><?php echo e(strtoupper('PENDUDUK ' . $desa_pend)); ?></option>
                                                <?php $__currentLoopData = $pendudukLuar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $penduduk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($index); ?>" <?= (in_array($index, $suratMaster->form_isian->individu->data ?? [])) ? 'selected' : ''; ?>><?php echo e(strtoupper(SebutanDesa($penduduk['title']))); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr id="orang-tua" class="sumber_data">
                                        <td>Data Orang Tua</td>
                                        <td>
                                            <select id="data_orang_tua" class="form-control input-sm" name="data_orang_tua">
                                                <option value="0" <?= (0 == $suratMaster->form_isian->individu->data_orang_tua) ? 'selected' : ''; ?>>TIDAK</option>
                                                <option value="1" <?= (1 == $suratMaster->form_isian->individu->data_orang_tua) ? 'selected' : ''; ?>>YA</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr id="data-pasangan" class="sumber_data">
                                        <td>Data Pasangan</td>
                                        <td>
                                            <select id="data_pasangan" class="form-control input-sm" name="data_pasangan">
                                                <option value="0" <?= (0 == $suratMaster->form_isian->individu->data_pasangan) ? 'selected' : ''; ?>>TIDAK</option>
                                                <option value="1" <?= (1 == $suratMaster->form_isian->individu->data_pasangan) ? 'selected' : ''; ?>>YA</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr class="sumber_data">
                                        <td>Jenis Kelamin</td>
                                        <td>
                                            <select class="form-control input-sm" name="individu_sex">
                                                <option value="">SEMUA</option>
                                                <?php $__currentLoopData = $form_isian['daftar_jenis_kelamin']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($key); ?>" <?= ($key == $suratMaster->form_isian->individu->sex) ? 'selected' : ''; ?>>
                                                        <?php echo e($data); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr class="sumber_data">
                                        <td>Jenis Peristiwa</td>
                                        <td>
                                            <select id="individu_status_dasar" class="form-control select2 input-sm" name="individu_status_dasar[]" multiple>
                                                <?php $__currentLoopData = $form_isian['daftar_status_dasar']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        $select = false;
                                                        if (in_array($key, is_array($suratMaster->form_isian->individu->status_dasar) ? $suratMaster->form_isian->individu->status_dasar : [$suratMaster->form_isian->individu->status_dasar])) {
                                                            $select = true;
                                                        }
                                                    ?>
                                                    <option value="<?php echo e($key); ?>" <?= ($select) ? 'selected' : ''; ?>>
                                                        <?php echo e($data); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr class="sumber_data">
                                        <td>Status Hubungan Dalam Keluarga (SHDK)</td>
                                        <td>
                                            <select id="individu_kk_level" class="form-control kk_level select2 input-sm" name="individu_kk_level[]" multiple>
                                                <?php $__currentLoopData = $form_isian['daftar_shdk']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        $select = false;
                                                        if (in_array($key, $suratMaster->form_isian->individu->kk_level ?? [])) {
                                                            $select = true;
                                                        }
                                                    ?>
                                                    <option value="<?php echo e($key); ?>" <?= ($select) ? 'selected' : ''; ?>>
                                                        <?php echo e($data); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr>

                        <?php echo $__env->make('admin.pengaturan_surat.kode_isian', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
                <?php $__empty_1 = true; $__currentLoopData = $kategori_nama; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php
                        $kategori = $kategori_isian[$item];
                        $tampil_sumber = $suratMaster->form_isian->{$item}->sumber == '1' ? '' : 'hide';
                    ?>
                    <div class="tab-pane" id="tab-<?php echo e($item); ?>">
                        <div class="box-body">
                            <button type="button" class="btn btn-danger btn-sm pull-right" data-kategori="<?php echo e($item); ?>" onclick="deleteTab(event)"><i class="fa  fa-times-circle"></i> Hapus Bagian Form</button>
                            <div class="row">
                                <label for="isi-judul" class="col-sm-2">Judul Bagian</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control input-sm required judul_tinymce isi-judul" name="kategori_judul[<?php echo e($item); ?>]" value="<?php echo e($suratMaster->form_isian->$item->judul ?? ucwords(str_replace('_', ' ', $item))); ?>" minlength="3" maxlength="20">
                                </div>
                            </div>
                            <div class="row" style="margin-top: 5px">
                                <label for="isi-label" class="col-sm-2" title="Isi dengan karakter - untuk sembunyikan label">Label Bagian</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control input-sm required judul isi-label" name="kategori_label[<?php echo e($item); ?>]" value="<?php echo e($suratMaster->form_isian->$item->label ?? ucwords(str_replace('_', ' ', $item))); ?>" minlength="1" maxlength="30">
                                </div>
                            </div>
                            <div class="row" style="margin-top: 5px">
                                <label for="isi-label" class="col-sm-2">Info Bagian</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control input-sm isi-info" name="kategori_info[<?php echo e($item); ?>]" value="<?php echo e($suratMaster->form_isian->$item->info ?? ''); ?>" maxlength="100">
                                </div>
                            </div>
                            <div class="row" style="margin-top: 5px">
                                <label for="isi-prefix" class="col-sm-2">Prefix Bagian</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control input-sm required prefix_tinymce isi-prefix" name="kategori_prefix[<?php echo e($item); ?>]" value="<?php echo e(strtolower($suratMaster->form_isian->$item->prefix ?? $item)); ?>" minlength="3" maxlength="50">
                                </div>
                            </div>
                            <div class="row" style="margin-top: 5px">
                                <label for="isi-sebagai" class="col-sm-2">Sebagai</label>
                                <div class="col-sm-8">
                                    <select id="<?php echo e($item); ?>_sebagai" class="form-control input-sm isi-sebagai-data" name="kategori_sebagai[<?php echo e($item); ?>]" onchange='ubah_sebagai_dinamis("#tab-<?php echo e($item); ?>", this.value)'>
                                        <option value="0" <?= ('0' == $suratMaster->form_isian->{$item}->sebagai) ? 'selected' : ''; ?>>Tidak Ada
                                        <option value="2" <?= ('2' == $suratMaster->form_isian->{$item}->sebagai) ? 'selected' : ''; ?>>Pemohon
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <h5 class="sumber-data-title"><b>Sumber Data Pelaku</b></h5>
                            <div class="table-responsive">
                                <table class="table table-hover table-striped sumber-data">
                                    <tbody>
                                        <tr style="font-weight: bold;">
                                            <td width="40%">Data Kategori</td>
                                            <td>Pilihan</td>
                                        </tr>

                                        <tr>
                                            <td>Tampil Sumber Data</td>
                                            <td>
                                                <select id="sumber_data_<?php echo e($item); ?>" class="form-control input-sm isi-sumber-data" name="kategori_sumber[<?php echo e($item); ?>]" onchange='tampil_sumber_dinamis("#tab-<?php echo e($item); ?>", this.value)'>
                                                    <option value="1" <?= ('1' == $suratMaster->form_isian->{$item}->sumber) ? 'selected' : ''; ?>>YA
                                                    <option value="0" <?= ('0' == $suratMaster->form_isian->{$item}->sumber) ? 'selected' : ''; ?>>TIDAK
                                                </select>
                                            </td>
                                        </tr>

                                        <tr class="sumber_data <?php echo e($tampil_sumber); ?>">
                                            <td>Sumber Data Wajib Diisi</td>
                                            <td>
                                                <select id="sumber_data_wajib_<?php echo e($item); ?>" class="form-control input-sm" name="sumber_data_wajib[<?php echo e($item); ?>]">
                                                    <option value="1" <?= (1 == $suratMaster->form_isian->{$item}->sumber_wajib) ? 'selected' : ''; ?>>YA
                                                    <option value="0" <?= (0 == $suratMaster->form_isian->{$item}->sumber_wajib) ? 'selected' : ''; ?>>TIDAK
                                                </select>
                                            </td>
                                        </tr>

                                        <tr class="sumber_data <?php echo e($tampil_sumber); ?>">
                                            <td>Data Individu</td>
                                            <td>
                                                <?php $desa_pend = strtoupper(setting('sebutan_desa')) ?>
                                                <select id="data_utama_<?php echo e($item); ?>" class="form-control input-sm kategori" name="kategori_data_utama[<?php echo e($item); ?>][]" multiple>
                                                    <option value="1" <?= (in_array(1, $suratMaster->form_isian->{$item}->data ?? [])) ? 'selected' : ''; ?>><?php echo e(strtoupper('PENDUDUK ' . $desa_pend)); ?></option>
                                                    <?php $__currentLoopData = $pendudukLuar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $penduduk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($index); ?>" <?= (in_array($index, $suratMaster->form_isian->{$item}->data ?? [])) ? 'selected' : ''; ?>><?php echo e(strtoupper(SebutanDesa($penduduk['title']))); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <?php $__env->startPush('scripts'); ?>
                                                    <script>
                                                        $("#data_utama_<?php echo e($item); ?>").select2();
                                                    </script>
                                                <?php $__env->stopPush(); ?>
                                            </td>
                                        </tr>

                                        <tr class="sumber_data <?php echo e($tampil_sumber); ?>">
                                            <td>Jenis Kelamin</td>
                                            <td>
                                                <select class="form-control input-sm kategori select2" name="kategori_individu_sex[<?php echo e($item); ?>]">
                                                    <option value="">SEMUA</option>
                                                    <?php $__currentLoopData = $form_isian['daftar_jenis_kelamin']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($key); ?>" <?= ($key == $suratMaster->form_isian->$item->sex) ? 'selected' : ''; ?>>
                                                            <?php echo e($data); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </td>
                                        </tr>

                                        <tr class="sumber_data <?php echo e($tampil_sumber); ?>">
                                            <td>Jenis Peristiwa</td>
                                            <td>
                                                <select id="kategori_individu_status_dasar_<?php echo e($item); ?>" class="form-control input-sm select2 kategori" name="kategori_individu_status_dasar[<?php echo e($item); ?>][]" multiple>
                                                    <option value="">SEMUA</option>
                                                    <?php $__currentLoopData = $form_isian['daftar_status_dasar']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php
                                                            $select = false;
                                                            if (in_array($key, $suratMaster->form_isian->$item->status_dasar ?? [])) {
                                                                $select = true;
                                                            }
                                                        ?>
                                                        <option value="<?php echo e($key); ?>" <?= ($select) ? 'selected' : ''; ?>>
                                                            <?php echo e($data); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </td>
                                        </tr>

                                        <tr class="sumber_data <?php echo e($tampil_sumber); ?>">
                                            <td>Status Hubungan Dalam Keluarga (SHDK)</td>
                                            <td>
                                                <select id="individu_kk_level_<?php echo e($item); ?>" class="form-control input-sm select2 kategori kk_level" name="kategori_individu_kk_level[<?php echo e($item); ?>][]" multiple>
                                                    <?php $__currentLoopData = $form_isian['daftar_shdk']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php
                                                            $select = false;
                                                            if (in_array($key, $suratMaster->form_isian->$item->kk_level ?? [])) {
                                                                $select = true;
                                                            }
                                                        ?>
                                                        <option value="<?php echo e($key); ?>" <?= ($select) ? 'selected' : ''; ?>>
                                                            <?php echo e($data); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr class="sumber_data <?php echo e($tampil_sumber); ?>">
                                            <td>Hubungan Data</td>
                                            <td>
                                                <select class="form-control input-sm select2 kategori" name="kategori_hubungan[<?php echo e($item); ?>]">
                                                    <option value="">Pilih hubungan</option>
                                                    <?php $__currentLoopData = $suratMaster->form_isian; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($key == $item): ?>
                                                            <?php continue; ?>
                                                        <?php endif; ?>
                                                        <option value="<?php echo e($key); ?>" <?= ($key == $suratMaster->form_isian->$item->hubungan) ? 'selected' : ''; ?>>
                                                            <?php echo e($data->judul ?: $key); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <hr>

                            <?php echo $__env->make('admin.pengaturan_surat.kategori_isian', ['key_kategori' => $item], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php echo $__env->make('admin.pengaturan_surat.pindah_kode_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('admin.pengaturan_surat.kaitkan_kode_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->startPush('scripts'); ?>
    <script type="text/javascript">
        $(document).ready(function() {

            var num = 0;

            $('#btn-new-tab').click(function(e) {
                var nama_kategori = Math.random().toString(36).replace(/[^a-z]+/g, '').substr(0, 5)
                num++
                e.preventDefault()
                var newTabId = 'tab-' + nama_kategori
                var oldname, newname
                // destroy select2 sebelum di clone
                $('#data_utama').select2('destroy')
                $('#data_utama').removeAttr('data-select2-id')
                $('#data_utama option').removeAttr('data-select2-id')

                $('#individu_kk_level').select2('destroy')
                $('#individu_kk_level').removeAttr('data-select2-id')
                $('#individu_kk_level option').removeAttr('data-select2-id')

                // konsepnya sama seperti kasus multi kk_level
                $('#individu_status_dasar').select2('destroy')
                $('#individu_status_dasar').removeAttr('data-select2-id')
                $('#individu_status_dasar option').removeAttr('data-select2-id')

                $("#form-utama").clone(true)
                    .map(function() {
                        editElm = $(this)
                            .attr('id', newTabId)
                            .attr('data-id', num)
                            .find('select')
                            .end()
                            .find("#dragable-form-utama")
                            .attr('id', `dragable-${nama_kategori}`)
                            .end()
                            .find('#utama_sebagai')
                            .attr('id', `${nama_kategori}_sebagai`)
                            .end();

                        var utama_isi_judul = editElm[0].querySelector('.isi-judul')
                        var utama_isi_label = editElm[0].querySelector('.isi-label')
                        var utama_isi_info = editElm[0].querySelector('.isi-info')
                        var utama_isi_prefix = editElm[0].querySelector('.isi-prefix')
                        var utama_sumber_data = editElm[0].querySelector('.isi-sumber-data')
                        var utama_sebagai_data = editElm[0].querySelector('.isi-sebagai-data')

                        utama_isi_judul.name = `kategori_judul[${nama_kategori}]`
                        utama_isi_prefix.name = `kategori_prefix[${nama_kategori}]`
                        utama_isi_info.name = `kategori_info[${nama_kategori}]`
                        utama_sebagai_data.name = `kategori_sebagai[${nama_kategori}]`

                        utama_isi_judul.value = nama_kategori
                        utama_isi_label.value = nama_kategori
                        utama_isi_info.value = ''
                        utama_isi_prefix.value = nama_kategori
                        utama_sebagai_data.value = 0

                        utama_sebagai_data.removeAttribute('disabled')
                        utama_sebagai_data.setAttribute('onchange', `ubah_sebagai_dinamis("#tab-${nama_kategori}", this.value)`)
                        utama_sebagai_data.value = 0
                        utama_sebagai_data.querySelector('option[value="1"]').remove()

                        // utama_isi_judul.removeAttribute('readonly')
                        utama_isi_prefix.removeAttribute('readonly')
                        utama_sumber_data.removeAttribute('disabled')
                        utama_sumber_data.setAttribute('onchange', `tampil_sumber_dinamis("#tab-${nama_kategori}", this.value)`)

                        // utama_isi_judul.setAttribute('onkeyup', `$('#tab-${nama_kategori} .isi-prefix').text(this.value.toLowerCase().replace(/ /g, '_'))`);

                        var utama_delete_btn = editElm[0].querySelector('.utama-delete')
                        utama_delete_btn.dataset.kategori = nama_kategori
                        utama_delete_btn.classList.remove('hide')

                        var tbodySumberData = editElm[0].querySelector('table.sumber-data').querySelector('tbody')
                        var lastTrSumberData = tbodySumberData.lastElementChild.cloneNode(true)
                        var dropdownOptionTr = lastTrSumberData.lastElementChild.lastElementChild
                        var tabs = $('#form-isian #tabs').find('li')

                        var elsumberData = editElm[0].querySelector('.sumber-data')
                        var elkodeIsian = editElm[0].querySelector('.kode-isian')
                        var elorangTua = editElm[0].querySelector('#orang-tua')
                        elorangTua.remove()
                        var elpasangan = editElm[0].querySelector('#data-pasangan')
                        elpasangan.remove()
                        var elLabel = editElm[0].querySelector('input.isi-label')
                        oldname = elLabel.getAttribute('name')
                        newname = `kategori_${oldname}[${nama_kategori}]`
                        elLabel.name = newname
                        elLabel.value = nama_kategori

                        if (elsumberData != null) {
                            var selects = editElm[0].querySelectorAll('.sumber-data select');
                            // Menghapus semua atribut dan kelas "select2" dari setiap elemen <select>
                            selects.forEach((elselect2) => {
                                oldname = elselect2.getAttribute('name')
                                newname = `kategori_${oldname}[${nama_kategori}]`
                                if (oldname == 'individu_kk_level[]') {
                                    newname = `kategori_individu_kk_level[${nama_kategori}][]`
                                }
                                if (oldname == 'individu_status_dasar[]') {
                                    newname = `kategori_individu_status_dasar[${nama_kategori}][]`
                                }
                                elselect2.name = newname
                                elselect2.id = elselect2.id + `-${nama_kategori}`
                            });

                            lastTrSumberData.firstElementChild.innerText = 'Hubungan Data'
                            dropdownOptionTr.innerHTML = ''
                            dropdownOptionTr.name = `kategori_hubungan[${nama_kategori}]`
                            dropdownOptionTr.removeAttribute('id')
                            dropdownOptionTr.removeAttribute('multiple')
                            dropdownOptionTr.className = 'form-control input-sm';
                            // tambahkan option dinamis berdasarkan bagian form
                            dropdownOptionTr.innerHTML += `<option value="">Pilih hubungan form</option>`
                            tabs.each(function() {
                                dropdownOptionTr.innerHTML += `<option value="${$(this).attr('data-name')}">${$(this).find('a').text()}</option>`
                            })

                            tbodySumberData.appendChild(lastTrSumberData)
                            $(`[name="kategori_hubungan[${nama_kategori}]"]`).select2();
                        }
                        if (elkodeIsian != null) {
                            var elganda = editElm[0].querySelector('#gandakan-0');

                            elganda.querySelector('.hapus-kode').setAttribute('title', 'Hapus Kode Isian')
                            elganda.querySelector('.pindah-kode').setAttribute('title', 'Pindah Kode Isian')
                            elganda.querySelector('.kaitkan-kode').setAttribute('title', 'Kaitkan Kode Isian')
                            // console.log(cek.attr)
                            elganda.classList.add('duplikasi-' + nama_kategori);
                            elganda.classList.add('kategori');
                            elganda.id = 'gandakan-' + nama_kategori + '-0';

                            // use foreach tr, jika itu tr pertama maka sesuaikan dengan tab data, jika bukan delete
                            var trkode = elkodeIsian.querySelectorAll('tr.duplikasi');
                            trkode.forEach((tr, index) => {
                                var kategori_isian = tr.querySelectorAll(
                                    '.kode-isian input, .kode-isian textarea, .kode-isian select, .kode-isian'
                                );
                                if (index == 0) {
                                    kategori_isian.forEach((elselect2) => {
                                        // elselect2.name = `pilihan_kode[${counter + 1}][]`
                                        var oldname = elselect2.getAttribute('name')
                                        // console.log(oldname);
                                        if (oldname != null) {
                                            var fixname = oldname.replace(/[\[\]0]/g,
                                                "");
                                            var fullname =
                                                `kategori_${fixname}[${nama_kategori}][]`
                                            // console.log(elselect2.classList)
                                            if (oldname == 'pilihan_kode[0][]') {
                                                fullname =
                                                    `kategori_${fixname}[${nama_kategori}][0][]`
                                                if (elselect2.classList.contains(
                                                        'select2')) {
                                                    // console.log(123);
                                                    elselect2.classList.remove(
                                                        'select2')
                                                    elselect2.classList.remove(
                                                        'select2-hidden-accessible')
                                                    elselect2.nextElementSibling
                                                        .remove()
                                                    elselect2.removeAttribute(
                                                        'data-select2-id')
                                                    elselect2.innerHTML = ''
                                                }
                                            }
                                            elselect2.name = fullname
                                            elselect2.value = ''
                                            elselect2.classList.add('kategori')
                                        }
                                    });
                                } else {
                                    tr.parentNode.removeChild(tr);
                                }
                            });
                        }
                        var elbutton = editElm[0].querySelector('.tambah-kode')
                        elbutton.dataset.type = 'gandakan-' + nama_kategori
                        elbutton.dataset.kategori = nama_kategori

                        editElm.find('input[name^=kategori_nama_kode]').on('change', function(e) {
                            $(this).closest('tr').find('input[name^=kategori_label_kode]').val($(this).val())
                        })

                        return editElm;
                    });

                var newNavItem = $(
                    `<li class="ui-list-tab" id="list-${nama_kategori}" data-name="${nama_kategori}">
                        <a id="nav-${newTabId}" href="#${newTabId}" data-toggle="tab">${nama_kategori.replace(/_/g, ' ')}</a>
                        <input type="hidden" name="kategori[]" value="${nama_kategori}">
                    </li>`
                );

                $('.nav-tabs.customized-tab').append(newNavItem);
                $('.tab-content .custom').append(editElm);
                /* buat lagi select2s*/
                $('#data_utama').select2()
                $('#data_utama-' + nama_kategori).select2()

                $('#individu_kk_level').select2()
                $('#individu_kk_level-' + nama_kategori).select2()
                $('#individu_status_dasar').select2()
                $('#individu_status_dasar-' + nama_kategori).select2()
                newNavItem.find('a').tab('show');
            });

            $(".customized-tab").sortable({
                cursor: 'row-resize',
                placeholder: 'ui-state-highlight',
                items: '.ui-list-tab'
            }).disableSelection();

            $('input.isi-judul').on('change', function() {
                let _idTab = $(this).closest('.tab-pane').attr('id')
                $(`#nav-${_idTab}`).text($(this).val())
            })

            $('input.isi-prefix').on('change', function() {
                let _tabContent = $(this).closest('.tab-pane')
                let _idTabAsli = _tabContent.attr('id').substr(4)
                let _prefix = $(this).val()
                _tabContent.attr('id', 'tab-' + _prefix)
                _tabContent.find('.box-body>button').attr('data-kategori', _prefix)
                $(this).attr('name', 'kategori_prefix[' + _prefix + ']')
                // rename semua element dalam tab tersebut
                _tabContent.find('.box-body').find('select, input, textarea').each(function() {
                    if (!$.isEmptyObject($(this).attr('name'))) {
                        $(this).attr('name', $(this).attr('name').replace(_idTabAsli, _prefix))
                    }
                })

                let _navTabElm = $('#form-isian #list-' + _idTabAsli)
                _navTabElm.find('a').attr('id', 'nav-tab-' + _prefix)
                _navTabElm.find('a').attr('href', '#tab-' + _prefix)
                _navTabElm.find('input').val(_prefix)
                _navTabElm.attr('data-name', _prefix)
                _navTabElm.attr('id', 'list-' + _prefix)
            })
        });

        function ubah_sebagai_dinamis(parent, tipe) {
            if (tipe == 2) {
                $('.isi-sebagai-data').val(0);
                $('#form-utama .isi-sebagai-data').val(1);
                $(parent + ' .isi-sebagai-data').val(tipe);
            }
        }

        function tampil_sumber_dinamis(parent, tipe) {
            if (tipe == 1) {
                $(parent + ' .sumber_data').show();
                $(parent + ' .sumber_data').removeClass('hide');
            } else {
                $(parent + ' .sumber_data').hide();
                $(parent + ' .sumber_data').addClass('hide');
            }
        }

        function loadSelect() {
            // console.log('load select');
            // $('.kategori').select2()
        }

        function judulTab(value, tab) {
            $('#nav-tab-'.tab).text();
        }

        function deleteTab(event) {
            var clicked = event.target;
            let tabContent = $(clicked).closest('.tab-pane')
            let id = tabContent.attr('id').substr(4)
            let navTabElm = $('#form-isian #list-' + id)

            tabContent.remove()
            navTabElm.prev('li').find('a').click()
            navTabElm.remove()
        }
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/pengaturan_surat/tinymce.blade.php ENDPATH**/ ?>