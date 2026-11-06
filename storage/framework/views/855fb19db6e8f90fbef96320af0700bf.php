<div class="tab-pane active" id="pengaturan-umum">

    <?php echo $__env->make('admin.pengaturan_surat.kembali', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="box-body form-horizontal">
        <div class="form-group">
            <label class="col-sm-3 control-label" for="kode_surat">Kode/Klasifikasi Surat</label>
            <div class="col-sm-7">
                <select class="form-control input-sm required" id="kode_surat" name="kode_surat" data-placeholder="-- Pilih Kode/Klasifikasi Surat --">
                    <?php if($klasifikasiSurat): ?>
                        <option value="<?php echo e($klasifikasiSurat->kode); ?>">
                            <?php echo e($klasifikasiSurat->kode . ' - ' . $klasifikasiSurat->nama); ?></option>
                    <?php elseif($suratMaster->kode_surat): ?>
                        <option value="<?php echo e($suratMaster->kode_surat); ?>">
                            <?php echo e($suratMaster->kode_surat); ?></option>
                    <?php endif; ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Nama Layanan</label>
            <div class="col-sm-7">
                <div class="input-group">
                    <span class="input-group-addon input-sm">Surat</span>
                    <input type="text" class="form-control input-sm nama_terbatas required" id="nama" name="nama" placeholder="Nama Layanan" value="<?php echo e($suratMaster->nama); ?>" />
                </div>
            </div>
        </div>
        <?php if(strpos($form_action, 'insert') !== false && is_null($suratMaster->template)): ?>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="nama">Pemohon Surat</label>
                <div class="col-sm-3">
                    <select class="form-control input-sm" id="pemohon_surat" name="pemohon_surat">
                        <option value="warga" selected>Warga</option>
                        <option value="non_warga">Bukan Warga</option>
                    </select>
                </div>
            </div>
        <?php endif; ?>

        <div class="form-group">
            <label class="col-sm-3 control-label" for="nama">Masa Berlaku Default</label>
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-2">
                        <input type="number" class="form-control input-sm" id="masa_berlaku" name="masa_berlaku" onchange="masaBerlaku()" value="<?php echo e($suratMaster->masa_berlaku ?? 0); ?>">
                    </div>
                    <div class="col-sm-3">
                        <select class="form-control input-sm" id="satuan_masa_berlaku" name="satuan_masa_berlaku">
                            <?php $__currentLoopData = $masaBerlaku; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kode_masa => $judul_masa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($kode_masa); ?>" <?= ($suratMaster->satuan_masa_berlaku === $kode_masa) ? 'selected' : ''; ?>><?php echo e($judul_masa); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <label class="text-muted text-red">Isi 0 jika tidak digunakan dan maksimal 31.</label>
            </div>
        </div>

        <?php if($orientations): ?>
            <div class="form-group">
                <label class="col-sm-3 control-label">Orientasi Kertas</label>
                <div class="col-sm-7">
                    <select class="form-control input-sm select2 required" name="orientasi">
                        <?php $__currentLoopData = $orientations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($value); ?>" <?= (($suratMaster->orientasi ?? $default_orientations) === $value) ? 'selected' : ''; ?>>
                                <?php echo e($value); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
        <?php endif; ?>

        <?php if($orientations): ?>
            <div class="form-group">
                <label class="col-sm-3 control-label">Ukuran Kertas</label>
                <div class="col-sm-7">
                    <select class="form-control input-sm select2 required" name="ukuran">
                        <?php $__currentLoopData = $sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($value); ?>" <?= (($suratMaster->ukuran ?? $default_sizes) === $value) ? 'selected' : ''; ?>>
                                <?php echo e($value); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
        <?php endif; ?>

        <div class="form-group">
            <label class="col-sm-3 control-label">Gunakan Margin Kertas Global</label>
            <div class="btn-group col-xs-12 col-sm-8" data-toggle="buttons" style="margin: 0 0 5px 0">
                <label id="lmg1" class="tipe btn btn-info btn-sm col-xs-12 col-sm-6 col-lg-3 form-check-label <?= ($margin_global) ? 'active' : ''; ?>">
                    <input
                        id="img1"
                        type="radio"
                        name="margin_global"
                        <?= ($margin_global) ? 'checked' : ''; ?>
                        class="form-check-input"
                        type="radio"
                        value="1"
                        autocomplete="off"
                    >Ya
                </label>
                <label id="lmg2" class="tipe btn btn-info btn-sm col-xs-12 col-sm-6 col-lg-3 form-check-label <?= (!$margin_global) ? 'active' : ''; ?>">
                    <input
                        id="img2"
                        type="radio"
                        name="margin_global"
                        class="form-check-input"
                        <?= (!$margin_global) ? 'checked' : ''; ?>
                        type="radio"
                        value="0"
                        autocomplete="off"
                    >Tidak
                </label>
            </div>
            <div id="manual_margin" style="display: none;">
                <div class="col-sm-7 col-sm-offset-3">
                    <div class="row">
                        <?php $__currentLoopData = $margins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-sm-6">
                                <div class="input-group" style="margin-top: 3px; margin-bottom: 3px">
                                    <span class="input-group-addon input-sm"><?php echo e(ucwords($key)); ?></span>
                                    <input
                                        type="number"
                                        class="form-control input-sm required"
                                        min="0"
                                        name="<?php echo e($key); ?>"
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
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Gunakan Penomoran Surat Global</label>
            <div class="btn-group col-xs-12 col-sm-8" data-toggle="buttons" style="margin: 0 0 5px 0">
                <label id="lmg11" class="tipe btn btn-info btn-sm col-xs-12 col-sm-6 col-lg-3 form-check-label <?= ($format_nomor_global) ? 'active' : ''; ?>">
                    <input
                        id="img11"
                        type="radio"
                        name="format_nomor_global"
                        <?= ($format_nomor_global) ? 'checked' : ''; ?>
                        class="form-check-input"
                        type="radio"
                        value="1"
                        autocomplete="off"
                    >Ya
                </label>
                <label id="lmg21" class="tipe btn btn-info btn-sm col-xs-12 col-sm-6 col-lg-3 form-check-label <?= (!$format_nomor_global) ? 'active' : ''; ?>">
                    <input
                        id="img21"
                        type="radio"
                        name="format_nomor_global"
                        class="form-check-input"
                        <?= (!$format_nomor_global) ? 'checked' : ''; ?>
                        type="radio"
                        value="0"
                        autocomplete="off"
                    >Tidak
                </label>
            </div>
            <div id="manual_nomor_surat" style="display: none;">
                <div class="col-sm-7 col-sm-offset-3">
                    <input type="text" class="form-control input-sm" name="format_nomor" placeholder="[nomor_surat, 3]/PK-TBT/[bulan_romawi]/[tahun]" value="<?php echo e($format_nomor); ?>">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Lampiran</label>
            <div class="col-sm-7">
                <?php if($viewOnly): ?>
                    <?php $__currentLoopData = explode(',', $suratMaster->lampiran); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <input type="hidden" name="lampiran[]" value="<?php echo e($item); ?>">
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                <select class="form-control input-sm select2" name="lampiran[]" multiple="multiple" data-placeholder="Pilih Lampiran">
                    <?php $__currentLoopData = $daftar_lampiran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($value); ?>" <?= (in_array($value, explode(',', $suratMaster->lampiran))) ? 'selected' : ''; ?>><?php echo e($value); ?> </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Tampilkan QR Code</label>
            <div class="btn-group col-xs-12 col-sm-8" data-toggle="buttons">
                <label id="lq1" class="tipe btn btn-info btn-sm col-xs-12 col-sm-6 col-lg-3 form-check-label <?= ($suratMaster->qr_code) ? 'active' : ''; ?>">
                    <input
                        id="iq1"
                        type="radio"
                        name="qr_code"
                        class="form-check-input"
                        type="radio"
                        value="1"
                        <?= ($suratMaster->qr_code) ? 'checked' : ''; ?>
                        autocomplete="off"
                    >Ya
                </label>
                <label id="lq2" class="tipe btn btn-info btn-sm col-xs-12 col-sm-6 col-lg-3 form-check-label <?= (!$suratMaster->qr_code) ? 'active' : ''; ?>">
                    <input
                        id="iq2"
                        type="radio"
                        name="qr_code"
                        class="form-check-input"
                        type="radio"
                        value="0"
                        <?= (!$suratMaster->qr_code) ? 'checked' : ''; ?>
                        autocomplete="off"
                    >Tidak
                </label>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Tampilkan QR Code TTE</label>
            <div class="btn-group col-xs-12 col-sm-8" data-toggle="buttons">
                <label id="lq1" class="tipe btn btn-info btn-sm col-xs-12 col-sm-6 col-lg-3 form-check-label <?= ($suratMaster->qr_code_tte) ? 'active' : ''; ?>">
                    <input
                        id="iq1"
                        type="radio"
                        name="qr_code_tte"
                        class="form-check-input"
                        type="radio"
                        value="1"
                        <?= ($suratMaster->qr_code_tte) ? 'checked' : ''; ?>
                        autocomplete="off"
                    >Ya
                </label>
                <label id="lq2" class="tipe btn btn-info btn-sm col-xs-12 col-sm-6 col-lg-3 form-check-label <?= (!$suratMaster->qr_code_tte) ? 'active' : ''; ?>">
                    <input
                        id="iq2"
                        type="radio"
                        name="qr_code_tte"
                        class="form-check-input"
                        type="radio"
                        value="0"
                        <?= (!$suratMaster->qr_code_tte) ? 'checked' : ''; ?>
                        autocomplete="off"
                    >Tidak
                </label>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Tampilkan Header</label>
            <div class="btn-group col-xs-12 col-sm-8" data-toggle="buttons">
                <label id="lh1" for="ih1" class="tipe btn btn-info btn-sm col-xs-12 col-sm-6 col-lg-3 form-check-label <?= ($header == 1) ? 'active' : ''; ?>">
                    <input
                        id="ih1"
                        type="radio"
                        name="header"
                        class="form-check-input"
                        type="radio"
                        value="1"
                        <?= ($header == 1) ? 'checked' : ''; ?>
                        autocomplete="off"
                    >Semua Halaman
                </label>
                <label id="lh2" for="lh2" class="tipe btn btn-info btn-sm col-xs-12 col-sm-6 col-lg-3 form-check-label <?= ($header == 2) ? 'active' : ''; ?>">
                    <input
                        id="ih2"
                        type="radio"
                        name="header"
                        class="form-check-input"
                        type="radio"
                        value="2"
                        <?= ($header == 2) ? 'checked' : ''; ?>
                        autocomplete="off"
                    >Hanya Halaman Awal
                </label>
                <label id="lh3" for="lh3" class="tipe btn btn-info btn-sm col-xs-12 col-sm-6 col-lg-3 form-check-label <?= ($header == 0) ? 'active' : ''; ?>">
                    <input
                        id="ih3"
                        type="radio"
                        name="header"
                        class="form-check-input"
                        type="radio"
                        value="0"
                        <?= ($header == 0) ? 'checked' : ''; ?>
                        autocomplete="off"
                    >Tidak
                </label>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Tampilkan Footer</label>
            <div class="btn-group col-xs-12 col-sm-8" data-toggle="buttons">
                <label id="lf1" class="tipe btn btn-info btn-sm col-xs-12 col-sm-6 col-lg-3 form-check-label <?= ($footer) ? 'active' : ''; ?>">
                    <input
                        id="if1"
                        type="radio"
                        name="footer"
                        class="form-check-input"
                        type="radio"
                        value="1"
                        <?= ($footer) ? 'checked' : ''; ?>
                        autocomplete="off"
                    >Ya
                </label>
                <label id="lf2" class="tipe btn btn-info btn-sm col-xs-12 col-sm-6 col-lg-3 form-check-label <?= (!$footer) ? 'active' : ''; ?>">
                    <input
                        id="if2"
                        type="radio"
                        name="footer"
                        class="form-check-input"
                        type="radio"
                        value="0"
                        <?= (!$footer) ? 'checked' : ''; ?>
                        autocomplete="off"
                    >Tidak
                </label>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label" for="logo_garuda">Logo Burung Garuda</label>
            <div class="btn-group col-xs-12 col-sm-8" data-toggle="buttons">
                <label id="lbg1" class="tipe btn btn-info btn-sm col-xs-12 col-sm-6 col-lg-3 form-check-label <?= ($suratMaster->logo_garuda) ? 'active' : ''; ?>">
                    <input
                        id="ibg1"
                        type="radio"
                        name="logo_garuda"
                        class="form-check-input"
                        type="radio"
                        value="1"
                        <?= ($suratMaster->logo_garuda) ? 'checked' : ''; ?>
                        autocomplete="off"
                    >Ya
                </label>
                <label id="lbg2" class="tipe btn btn-info btn-sm col-xs-12 col-sm-6 col-lg-3 form-check-label <?= (!$suratMaster->logo_garuda) ? 'active' : ''; ?>">
                    <input
                        id="ibg2"
                        type="radio"
                        name="logo_garuda"
                        class="form-check-input"
                        type="radio"
                        value="0"
                        <?= (!$suratMaster->logo_garuda) ? 'checked' : ''; ?>
                        autocomplete="off"
                    >Tidak
                </label>
            </div>
        </div>

        <?php if(setting('tte')): ?>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="kecamatan">Kirim ke Kecamatan</label>
                <div class="btn-group col-xs-12 col-sm-8" data-toggle="buttons">
                    <label id="lk1" class="tipe btn btn-info btn-sm col-xs-12 col-sm-6 col-lg-3 form-check-label <?= ($suratMaster->kecamatan) ? 'active' : ''; ?>">
                        <input
                            id="ik1"
                            type="radio"
                            name="kecamatan"
                            class="form-check-input"
                            type="radio"
                            value="1"
                            <?= ($suratMaster->kecamatan) ? 'checked' : ''; ?>
                            autocomplete="off"
                        >Ya
                    </label>
                    <label id="lk2" class="tipe btn btn-info btn-sm col-xs-12 col-sm-6 col-lg-3 form-check-label <?= (!$suratMaster->kecamatan) ? 'active' : ''; ?>">
                        <input
                            id="ik2"
                            type="radio"
                            name="kecamatan"
                            class="form-check-input"
                            type="radio"
                            value="0"
                            <?= (!$suratMaster->kecamatan) ? 'checked' : ''; ?>
                            autocomplete="off"
                        >Tidak
                    </label>
                </div>
            </div>
        <?php endif; ?>

        <div class="form-group">
            <label class="col-sm-3 control-label">Sediakan di Layanan Mandiri</label>
            <div class="btn-group col-xs-12 col-sm-8" data-toggle="buttons">
                <label id="lm1" class="tipe btn btn-info btn-sm col-xs-12 col-sm-6 col-lg-3 form-check-label <?= ($suratMaster->mandiri) ? 'active' : ''; ?>">
                    <input
                        id="im1"
                        type="radio"
                        name="mandiri"
                        class="form-check-input"
                        type="radio"
                        value="1"
                        <?= ($suratMaster->mandiri) ? 'checked' : ''; ?>
                        autocomplete="off"
                    >Ya
                </label>
                <label id="lm2" class="tipe btn btn-info btn-sm col-xs-12 col-sm-6 col-lg-3 form-check-label <?= (!$suratMaster->mandiri) ? 'active' : ''; ?>">
                    <input
                        id="im2"
                        type="radio"
                        name="mandiri"
                        class="form-check-input"
                        type="radio"
                        value="0"
                        <?= (!$suratMaster->mandiri) ? 'checked' : ''; ?>
                        autocomplete="off"
                    >Tidak
                </label>
            </div>
        </div>

        <div class="form-group" id="syarat" <?php echo e(jecho($suratMaster->mandiri, false, 'style="display:none;"')); ?>>
            <label class="col-sm-3 control-label">Syarat Surat</label>
            <div class="col-sm-7">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="tabeldata" style="width: 100%;">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="checkall" /></th>
                                <th>NO</th>
                                <th>NAMA DOKUMEN</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function() {
            var margin_global = $("[name='margin_global']:checked").val()
            if (margin_global == 0) {
                $('#manual_margin').show()
            }

            format_nomor_surat($("[name='format_nomor_global']:checked").val())
        })

        function format_nomor_surat(params) {
            if (params == 0) {
                $('#manual_nomor_surat').show()
                $('input[name="format_nomor"]').addClass('required')
            } else {
                $('#manual_nomor_surat').hide()
                $('input[name="format_nomor"]').removeClass('required')
            }
        }

        $("[name='margin_global']").change(function() {
            var val = $(this).val()
            if (val == 0) {
                $('#manual_margin').show()
            } else {
                $('#manual_margin').hide()
            }
        })

        $("[name='format_nomor_global']").change(function() {
            format_nomor_surat($(this).val())
        })

        $('#kode_surat').select2({
            tags: true,
            ajax: {
                url: SITE_URL + 'surat_master/apisurat',
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
                return $(this).data('placeholder');
            },
            minimumInputLength: 1,
            allowClear: true,
            escapeMarkup: function(markup) {
                return markup;
            },
            createTag: function(params) {
                // batasi hanya 10 karakter
                var term = params.term.substring(0, 10);
                return {
                    id: term,
                    text: term,
                    newOption: true
                };
            },
            templateResult: function(data) {
                var $result = $("<span></span>").text(data.text);
                if (data.newOption) {
                    $result.append(" <em>(Buat Baru, maksimal 10 karakter)</em>");
                }
                return $result;
            },
            insertTag: function(data, tag) {
                data.push(tag);
            }
        });

        var TableData = $('#tabeldata').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            bPaginate: false,
            ajax: "<?php echo e(ci_route('surat_master.syaratSuratDatatables', $suratMaster->id)); ?>",
            drawCallback: function(settings) {
                // Disable all checkbox inputs after the DataTable is rendered
                $('input[type="checkbox"]').prop('disabled', <?php echo e($viewOnly); ?>);
            },
            columns: [{
                    data: 'ceklist',
                    class: 'padat',
                    searchable: false,
                    orderable: false
                },
                {
                    data: 'DT_RowIndex',
                    class: 'padat',
                    searchable: false,
                    orderable: false
                },
                {
                    data: 'ref_syarat_nama',
                    name: 'ref_syarat_nama',
                    searchable: true,
                    orderable: true
                },
            ],
            order: [
                [2, 'asc']
            ]
        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH D:\laragon\www\opensid\resources\views/admin/pengaturan_surat/umum.blade.php ENDPATH**/ ?>