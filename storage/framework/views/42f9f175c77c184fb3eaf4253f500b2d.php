<?php echo $__env->make('admin.pengaturan_surat.asset_tinymce', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



<?php
    $label = 'Tinjau Surat';
    $urlDaftar = ci_route('surat');
    $cetak = 'Cetak';

    if ($urlSurat = old('url_surat')) {
        $cetak = 'Form Isian';
        $hash = $penduduk?->nik ? "#{$penduduk->id}#{$penduduk->nik}#{$penduduk->nama}" : '';
        $urlDaftar = site_url("surat/form/{$urlSurat}{$hash}");
    }
?>

<?php if(isset($ubah)): ?>
    <?php
        $label = 'Ubah Surat';
        $urlDaftar = ci_route('keluar');
        $cetak = 'Arsip Layanan';
    ?>
<?php endif; ?>

<?php $__env->startSection('title'); ?>
    <h1>
        <?php echo e($label); ?> <?php if(isset($ubah)): ?> <?php echo e(ucwords($surat->nama)); ?> <?php endif; ?>
    </h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e($urlDaftar); ?>">Daftar <?php echo e($cetak); ?> Surat</a></li>
    <li class="active"> Surat <?php echo e(ucwords($surat->nama)); ?></li>
    <li class="active"> <?php echo e($label); ?> <?php if(isset($ubah)): ?> <?php echo e(ucwords($surat->nama)); ?> <?php endif; ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.layouts.components.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="box">
        <?php echo form_open(null, 'id="validasi"'); ?>

        <div class="nav-tabs-custom">
            <!-- Tabs navigation -->
            <ul class="nav nav-tabs">
                <li class="active"><a href="#<?php echo e($surat->formatSurat->url_surat ?? $surat->url_surat); ?>" data-toggle="tab"><?php echo e($surat->formatSurat->judul_surat ?? $surat->judul_surat); ?></a></li>
                <?php $__currentLoopData = $lampiran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><a href="#<?php echo e($loop->index); ?>" data-toggle="tab"><?php echo e($key); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="<?php echo e($surat->formatSurat->url_surat ?? $surat->url_surat); ?>">
                    <div class="box-body">
                        <input type="hidden" id="id_surat" value="<?php echo e($id_surat); ?>">
                        <div class="form-group">
                            <textarea id="editor" name="isi_surat" data-filemanager='<?= json_encode(['external_filemanager_path'=> base_url('rfm/'), 'filemanager_title' => 'Responsive Filemanager', 'filemanager_access_key' => $session->fm_key]) ?>' data-salintemplate="isi" class="form-control input-sm editor required"><?php echo e($isi_surat); ?></textarea>
                        </div>
                    </div>
                </div>
                <?php $__currentLoopData = $lampiran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kode => $isiLampiran): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="tab-pane" id="<?php echo e($loop->index); ?>">
                        <div class="box-body">
                            <div class="form-group">
                                <textarea name="isi_lampiran[]" data-filemanager='<?= json_encode(['external_filemanager_path'=> base_url('rfm/'), 'filemanager_title' => 'Responsive Filemanager', 'filemanager_access_key' => $session->fm_key]) ?>'
                                    data-salintemplate="isi" 
                                    class="form-control input-sm lampiran required">
                                    <?php echo e($isiLampiran); ?>

                                </textarea>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <div class="box-footer text-center">
            <?php echo $__env->make('admin.layouts.components.tombol_kembali', ['url' => $urlDaftar, 'label' => $cetak . ' Surat', 'id' => 'back'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php if($tolak != '-1' && !$ubah): ?>
                <a onclick="formAction('validasi', '<?php echo e($aksi_konsep); ?>')" id="konsep" class="btn btn-social btn-warning btn-sm"><i class="fa fa-file-code-o"></i>
                    Konsep
                </a>
            <?php endif; ?>
            <button type="button" id="preview-pdf" class="btn btn-social btn-vk btn-success btn-sm"><i class="fa fa-eye"></i>Tinjau PDF</button>
            <button type="button" id="ubah-surat" title="Ubah Surat" data-toggle="modal" data-target="#modal-ubah-surat" class="btn btn-social btn-success btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block">
                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Ubah Surat
            </button>
            <button type="button" id="pengaturan" title="Pengaturan PDF" data-toggle="modal" data-target="#modal-pengaturan" class="btn btn-social bg-purple btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block">
                <i class="fa fa-gear"></i> Pengaturan
            </button>
            <?php if($tolak != '-1'): ?>
                <a href="<?php echo e(ci_route('keluar/masuk')); ?>" id="next" class="btn btn-social btn-info btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block hide">
                    ke Permohonan Surat <i class="fa fa-arrow-circle-right"></i>
                </a>
            <?php else: ?>
                <a href="<?php echo e(ci_route('keluar/ditolak')); ?>" id="next" style="display:none" class="btn btn-social btn-info btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block">
                    Ke Daftar Surat Ditolak <i class="fa fa-arrow-circle-right"></i>
                </a>
            <?php endif; ?>
        </div>
        </form>
    </div>

    <div id="modal-pengaturan" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <form id="form-pengaturan">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Pengaturan</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tinggi Header Surat</label>
                            <div class="input-group">
                                <input
                                    type="number"
                                    name="tinggi_header"
                                    class="form-control input-sm required"
                                    min="0"
                                    max="100"
                                    step="0.01"
                                    value="<?php echo e($ci->session->pengaturan_surat['tinggi_header'] ?? setting('tinggi_header')); ?>"
                                />
                                <span class="input-group-addon input-sm">cm</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tinggi Footer Surat</label>
                            <div class="input-group">
                                <input
                                    type="number"
                                    name="tinggi_footer"
                                    class="form-control input-sm required"
                                    min="0"
                                    max="100"
                                    step="0.01"
                                    value="<?php echo e($ci->session->pengaturan_surat['tinggi_footer'] ?? setting('tinggi_footer')); ?>"
                                />
                                <span class="input-group-addon input-sm">cm</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Jenis Font Bawaan </label>
                            <div class="row">
                                <div class="col-sm-12">
                                    <select class="select2 form-control" name="font_surat">
                                        <?php $__currentLoopData = $font_option; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $font): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($font); ?>" <?= ($font == ($ci->session->pengaturan_surat['font_surat'] ?? setting('font_surat'))) ? 'selected' : ''; ?>>
                                                <?php echo e($font); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
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
                                                value="<?php echo e(json_decode($ci->session->pengaturan_surat['surat_margin'])->{$key} ?? $value); ?>"
                                            >
                                            <span class="input-group-addon input-sm">cm</span>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <?php echo batal(); ?>

                        <button type="submit" class="btn btn-social btn-info btn-sm confirm"><i class="fa fa-check"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script type="text/javascript">
        var ubah = `<?php echo e($ubah ? '?ubah=1' : ''); ?>`;

        function cetak_pdf() {
            tinymce.triggerSave();
            Swal.fire({
                title: 'Membuat Surat..',
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading()
                },
                allowOutsideClick: () => false
            })
            $.ajax({
                    url: `<?php echo e($aksi_cetak); ?>` + ubah,
                    type: 'POST',
                    xhrFields: {
                        responseType: 'blob'
                    },
                    data: $("#validasi").serialize(),
                    success: function(response, status, xhr) {
                        // https://stackoverflow.com/questions/34586671/download-pdf-file-using-jquery-ajax
                        var filename = "";
                        var disposition = xhr.getResponseHeader('Content-Disposition');

                        if (disposition) {
                            var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                            var matches = filenameRegex.exec(disposition);
                            if (matches !== null && matches[1]) filename = matches[1].replace(
                                /['"]/g, '');
                        }
                        var linkelem = document.createElement('a');
                        try {
                            var blob = new Blob([response], {
                                type: 'application/octet-stream'
                            });
                            if (typeof window.navigator.msSaveBlob !== 'undefined') {
                                //   IE workaround for "HTML7007: One or more blob URLs were revoked by closing the blob for which they were created. These URLs will no longer resolve as the data backing the URL has been freed."
                                window.navigator.msSaveBlob(blob, filename);
                            } else {
                                var URL = window.URL || window.webkitURL;
                                var downloadUrl = URL.createObjectURL(blob);

                                if (filename) {
                                    // use HTML5 a[download] attribute to specify filename
                                    var a = document.createElement("a");

                                    // safari doesn't support this yet
                                    if (typeof a.download === 'undefined') {
                                        window.location = downloadUrl;
                                    } else {
                                        a.href = downloadUrl;
                                        a.download = filename;
                                        document.body.appendChild(a);
                                        a.target = "_blank";
                                        a.click();
                                    }
                                } else {
                                    window.location = downloadUrl;
                                }
                            }
                        } catch (ex) {
                            alert(ex); // This is an error
                        }
                    }
                })
                .done(function(response, textStatus, xhr) {
                    if (xhr.status == 200) {
                        $('#pengaturan').remove();
                        $('#ubah-surat').remove();
                        $('#draft-pdf').hide();
                        $('#preview-pdf').hide();
                        $('#konsep').hide();
                        $('#back').remove();
                        $('#next').show();
                        $('#next').removeClass('hide');
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Surat Selesai Dibuat',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                })
                .fail(function(response, status, xhr) {

                    Swal.fire({
                        title: xhr.statusText,
                        icon: 'error',
                        text: response.statusText,
                    })
                });
        }

        $(function() {
            // Disable Ubah Surat button on lampiran tabs
            const mainTabId = `<?php echo e($surat->formatSurat->url_surat ?? $surat->url_surat); ?>`;

            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                const targetId = $(e.target).attr('href');
                const isLampiranTab = targetId !== `#${mainTabId}`;

                $('#ubah-surat').prop('disabled', isLampiranTab);
            });

            $('#preview-pdf').click(function(e) {
                e.preventDefault();
                tinymce.triggerSave();

                Swal.fire({
                    title: 'Membuat pratinjau..',
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
                    },
                    allowOutsideClick: () => false
                });

                $.ajax({
                    url: `<?php echo e($aksi_cetak . '/true'); ?>` + ubah,
                    type: 'POST',
                    xhrFields: {
                        responseType: 'blob'
                    },
                    data: $("#validasi").serialize(),
                    success: function(response, status, xhr) {
                        // https://stackoverflow.com/questions/34586671/download-pdf-file-using-jquery-ajax
                        var filename = "";
                        var disposition = xhr.getResponseHeader('Content-Disposition');

                        if (disposition) {
                            var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                            var matches = filenameRegex.exec(disposition);
                            if (matches !== null && matches[1]) filename = matches[1].replace(
                                /['"]/g, '');
                        }
                        try {
                            var blob = new Blob([response], {
                                type: 'application/pdf'
                            });
                            if (typeof window.navigator.msSaveBlob !== 'undefined') {
                                //   IE workaround for "HTML7007: One or more blob URLs were revoked by closing the blob for which they were created. These URLs will no longer resolve as the data backing the URL has been freed."
                                window.navigator.msSaveBlob(blob, filename);
                            } else {
                                var URL = window.URL || window.webkitURL;
                                var downloadUrl = URL.createObjectURL(blob);
                                Swal.fire({
                                    customClass: {
                                        popup: 'swal-lg'
                                    },
                                    title: 'Pratinjau',
                                    html: `
                                        <object data="${downloadUrl}#toolbar=0" style="width: 100%;min-height: 400px;" type="application/pdf"></object>
                                    `,
                                    showCancelButton: false,
                                    showConfirmButton: false,
                                    footer: '<button onclick="Swal.close()" class="btn btn-social btn-danger btn-sm"><i class="fa fa-times"></i> Tutup</button>&ensp;<button onclick="cetak_pdf()" class="btn btn-social btn-success btn-sm"><i class="fa fa-print"></i> Cetak</button>',
                                    allowOutsideClick: () => false
                                });
                            }
                        } catch (ex) {
                            alert(ex); // This is an error
                        }
                    }
                }).fail(function(response, status, xhr) {

                    Swal.fire({
                        title: xhr.statusText,
                        icon: 'error',
                        text: response.statusText,
                    })
                })
            });

            $('#form-pengaturan').on('submit', function(e) {
                e.preventDefault(); // Prevent the form from submitting via the browser

                $.ajax({
                    type: 'POST',
                    url: '<?php echo e(ci_route('surat_master.pengaturan_sementara')); ?>',
                    data: $(this).serialize(), // Serialize form data
                    success: function(response) {
                        // Handle success response
                        $('#modal-pengaturan').modal('hide'); // Hide the modal
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Berhasil mengubah data',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    },
                    error: function(response, status, xhr) {
                        // Handle error response
                        Swal.fire({
                            title: xhr.statusText,
                            icon: 'error',
                            text: response.statusText,
                        });
                    }
                });
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/surat/konsep.blade.php ENDPATH**/ ?>