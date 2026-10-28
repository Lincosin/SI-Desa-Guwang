<?php echo $__env->make('admin.layouts.components.asset_validasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('admin.layouts.components.datetime_picker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



<?php $__env->startPush('css'); ?>
    <style>
        .batas {
            margin-right: -10px;
            margin-left: -10px;
            border-top: 1px solid #f4f4f4;
        }

        .form-horizontal .form-group {
            margin-right: -10px;
            margin-left: -10px;
        }

        .subtitle_head {
            margin-left: -10px;
            margin-right: -10px;
            /* background-color: #d81b60 !important; */
        }

        .subtitle_head label {
            padding-left: 10px;
            padding-right: 10px;
            padding-top: 5px;
            padding-bottom: 5px;
            margin-bottom: 0px;
            /* color: #ffffff !important; */
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('title'); ?>
    <h1>
        Surat <?php echo e(ucwords($surat['nama'])); ?>

    </h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(ci_route('surat')); ?>">Daftar Cetak Surat</a></li>
    <li class="active"> Surat <?php echo e(ucwords($surat['nama'])); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.layouts.components.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="box box-info">
        <div class="box-header with-border">
            <?php echo $__env->make('admin.layouts.components.tombol_kembali', ['url' => site_url('surat'), 'label' => 'Daftar Cetak Surat'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        </div>

        <div class="box-body">
            <?php echo form_open($form_action, 'id="validasi" method="POST" class="form-surat form-horizontal"'); ?>

            <input type="hidden" id="url_surat" name="url_surat" value="<?php echo e($url); ?>">
            <input type="hidden" id="url_remote" name="url_remote" value="<?php echo e(site_url('surat/nomor_surat_duplikat')); ?>">

            <?php echo $__env->make('admin.surat.nomor_surat', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php
                $sumberDataPenduduk = !is_array($surat->form_isian->individu->data) ? [$surat->form_isian->individu->data] : $surat->form_isian->individu->data ?? [];
            ?>

            <?php if($judul_kategori['individu'] != '-'): ?>
                <div class="form-group subtitle_head" data-json='<?php echo json_encode($sumberDataPenduduk); ?>'>
                    <label class="col-sm-3 control-label" for="status"><?php echo e(strtoupper(str_replace('_', ' ', $judul_kategori['individu'] ?? 'Keterangan Pemohon'))); ?></label>
                    <?php echo $__env->renderWhen(count($sumberDataPenduduk) > 1, 'admin.surat.opsi_sumber_penduduk', [
                        'opsiSumberPenduduk' => $surat->form_isian->individu->data,
                        'kategori' => 'individu',
                        'pendudukLuar' => $pendudukLuar,
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
                </div>
            <?php endif; ?>

            <?php if($surat->form_isian->individu->info): ?>
                <div class="callout callout-warning">
                    <b><?php echo e($surat->form_isian->individu->info); ?></b>
                </div>
            <?php endif; ?>

            <?php echo $__env->renderWhen(in_array(1, $sumberDataPenduduk), 'admin.surat.penduduk_desa', ['opsiSumberPenduduk' => $surat->form_isian->individu->data, 'kategori' => 'individu'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>

            <?php $__currentLoopData = $pendudukLuar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $penduduk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->renderWhen(in_array($index, $sumberDataPenduduk), 'admin.surat.penduduk_luar_desa', [
                    'index' => $index,
                    'opsiSumberPenduduk' => $surat->form_isian->individu->data,
                    'kategori' => 'individu',
                    'input' => explode(',', $penduduk['input']),
                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php echo $__env->make('admin.surat.kode_isian', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php echo $__env->renderWhen(isset($form_kategori), 'admin.surat.kategori_isian', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>

            <?php echo $__env->renderWhen((int) $surat->masa_berlaku > 0, 'admin.surat.form_tgl_berlaku', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>

            <?php echo $__env->renderWhen(count($lampiran ?? []) > 0 && !empty($lampiran[0]), 'admin.surat.lampiran', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>

            <?php echo $__env->make('admin.surat.form_pamong', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="box-footer">
                <button type="reset" class="btn btn-social btn-danger btn-sm" onclick="reset_form($(this).val());"><i class="fa fa-times"></i> Batal</button>
                <button type="submit" class="btn btn-social btn-info btn-sm pull-right"><i class="fa fa-check-square-o"></i> Lanjut</button>
            </div>
            <?php echo form_close(); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script type="text/javascript">
        function pilihAnggota(elm) {
            let _checked = $(elm).is(':checked')

            if (_checked) {
                $('table.kis tr[data-row=' + $(elm).val() + '] input').prop('disabled', 0)
                $('table.kis tr[data-row=' + $(elm).val() + '] input.datepicker').datepicker({
                    weekStart: 1,
                    language: 'id',
                    format: 'dd-mm-yyyy',
                    autoclose: true
                });
            } else {
                $('table.kis tr[data-row=' + $(elm).val() + '] input').prop('disabled', 1)
            }
        }

        function pilihAnggotaPiPertama(elm) {
            let _checked = $(elm).is(':checked')

            if (_checked) {
                $('table.pi tr[data-row=' + $(elm).val() + ']').find('input, select').prop('disabled', 0)
                $('table.pi tr[data-row=' + $(elm).val() + '] input.datepicker').datepicker({
                    weekStart: 1,
                    language: 'id',
                    format: 'dd-mm-yyyy',
                    autoclose: true
                });
            } else {
                $('table.pi tr[data-row=' + $(elm).val() + ']').find('input, select').prop('disabled', 1)
            }
        }

        function pilihAnggotaPiDua(elm) {
            let _checked = $(elm).is(':checked')

            if (_checked) {
                $('table.pi2 tr[data-row=' + $(elm).val() + '] input').prop('disabled', 0)
                $('table.pi2 tr[data-row=' + $(elm).val() + '] input.datepicker').datepicker({
                    weekStart: 1,
                    language: 'id',
                    format: 'dd-mm-yyyy',
                    autoclose: true
                });
            } else {
                $('table.pi2 tr[data-row=' + $(elm).val() + '] input').prop('disabled', 1)
            }
        }

        $('document').ready(function() {
            const hash = window.location.hash.substring(1)
            if (hash.length) {
                const dataPenduduk = hash.split('#')
                $('select[name="individu[nik]"]').append(`<option selected value="${dataPenduduk[0]}">NIK/Tag ID Card : ${dataPenduduk[1]} - ${decodeURIComponent(dataPenduduk[2])}</option>`)
                $('select[name="individu[nik]"]').trigger('change')
            }

            $('[data-visible-required=1]:visible').addClass('required')
            $('#nik').select2({
                ajax: {
                    url: SITE_URL + 'surat/apipenduduksurat',
                    dataType: 'json',
                    data: function(params) {
                        return {
                            q: params.term || '',
                            page: params.page || 1,
                            surat: $(this).data('surat'),
                        };
                    },
                    cache: true
                },
                placeholder: function() {
                    $(this).data('placeholder');
                },
                minimumInputLength: 1,
                allowClear: true,
                escapeMarkup: function(markup) {
                    return markup;
                },
            }).autofocus;

            $('.select2-nik-ajax').each(function() {
                let $select = $(this);

                $select.select2({
                    ajax: {
                        url: function() {
                            return $select.data('url');
                        },
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            let _kecuali = [];
                            // If not repeatable, exclude already selected values
                            if (! $select.data('sumber_penduduk_berulang')) {
                                $(`select.select2-nik-ajax.isi-penduduk-desa`)
                                    .not($select)
                                    .filter(function () {
                                        return $(this).val();
                                    })
                                    .filter(function () {
                                        return $(this).data('hubungan') !== 'individu';
                                    })
                                    .each(function(index, item) {
                                        _kecuali.push(item.value);
                                    });
                            }

                            return {
                                q: params.term || '',
                                page: params.page || 1,
                                filter_sex: $select.data('filter-sex'),
                                surat: $select.data('surat'),
                                kategori: $select.data('kategori'),
                                hubungan: $(`select[name="${$select.data('hubungan')}[nik]"]`).val(),
                                kecuali: _kecuali
                            };
                        },
                        processResults: function(data, params) {
                            return {
                                results: data.results,
                                pagination: data.pagination
                            };
                        },
                        cache: true
                    },
                    templateResult: function(penduduk) {
                        if (!penduduk.id) {
                            return penduduk.text;
                        }
                        var _tmpPenduduk = penduduk.text.split('\n');
                        var $penduduk = $(
                            '<div>' + _tmpPenduduk[0] + '</div><div>' + _tmpPenduduk[1] + '</div>'
                        );
                        return $penduduk;
                    },
                    placeholder: '--  Cari NIK / Tag ID Card / Nama Penduduk --',
                    minimumInputLength: 1
                });

                let oldValue = $select.data(`old_${$select.data('kategori')}_nik`);

                if (oldValue) {
                    $.ajax({
                        url: $select.data('url'),
                        dataType: 'json',
                        data: {
                            q: oldValue
                        },
                        success: function(data) {
                            if (data.results && data.results.length > 0) {
                                let result = data.results[0];
                                let option = new Option(result.text, result.id, true, true);
                                $select.append(option).trigger('change'); // Set the selected value
                            }
                        }
                    });
                }
            });

            // kaitkan data 
            $('select[data-kaitkan]').each(function() {
                let _kaitkan = $(this).data('kaitkan')
                let _kategori = $(this).closest('.form-group').data('kategori')

                _kaitkan.forEach(element => {
                    for (let i in element.kode_isian_terkait) {
                        let _namaElm = element.kode_isian_terkait[i].replaceAll(/\s+/g, '_').toLowerCase()
                        $(`[name=${_namaElm}]`).removeClass('required')
                        $(`[name=${_namaElm}]`).closest('.form-group').addClass('hide')
                    }

                    for (let i in element.kategori_terkait) {
                        let _namaKategori = element.kategori_terkait[i]
                        $(`#kategori-${_namaKategori}`).addClass('hide')
                    }
                });

                $(this).change(function() {
                    let _aktifkanElm = $(this).data('kaitkan')
                    let _namaElm, _kategori = $(this).closest('.form-group').data('kategori')
                    _aktifkanElm.forEach(element => {
                        for (let j in element.kode_isian_terkait) {
                            _namaElm = element.kode_isian_terkait[j].replaceAll(/\s+/g, '_').toLowerCase()
                            $(`[name=${_namaElm}]`).removeClass('required')
                            $(`[name=${_namaElm}]`).closest('.form-group').addClass('hide')
                        }
                        for (let j in element.kategori_terkait) {
                            _namaKategori = element.kategori_terkait[j]
                            $(`#kategori-${_namaKategori}`).addClass('hide')
                        }
                        for (let i in element.nilai_isian) {
                            if (element.nilai_isian[i].includes($(this).val())) {
                                for (let j in element.kode_isian_terkait) {
                                    _namaElm = element.kode_isian_terkait[j].replaceAll(/\s+/g, '_').toLowerCase()
                                    $(`[name=${_namaElm}]`).addClass('required')
                                    $(`[name=${_namaElm}]`).closest('.form-group').removeClass('hide')
                                }

                            }
                        }
                        for (let i in element.nilai_isian) {
                            if (element.nilai_isian[i].includes($(this).val())) {
                                for (let j in element.kategori_terkait) {
                                    _namaKategori = element.kategori_terkait[j]
                                    $(`#kategori-${_namaKategori}`).removeClass('hide')
                                }

                            }
                        }
                    });
                })
            })
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/surat/form_desa.blade.php ENDPATH**/ ?>