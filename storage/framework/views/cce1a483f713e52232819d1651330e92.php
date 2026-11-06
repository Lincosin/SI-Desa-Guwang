<?php echo $__env->make('admin.pengaturan_surat.asset_tinymce', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('admin.layouts.components.asset_datatables', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



<?php $__env->startSection('title'); ?>
    <h1>
        Periksa Surat <?php echo e(ucwords($surat->formatSurat->nama)); ?>

    </h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(ci_route('surat')); ?>">Daftar Cetak Surat</a></li>
    <li class="active"> Surat <?php echo e(ucwords($surat->nama)); ?></li>
    <li class="active"> Konsep Surat <?php echo e(ucwords($surat->nama)); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <style>
        /* Styling Container Pratinjau PDF Canvas untuk Modal Admin */
        #pdf-preview-container-admin {
            width: 100%;
            height: 75vh;
            overflow-y: auto;
            background-color: #334155;
            padding: 20px 10px;
            text-align: center;
        }

        #pdf-preview-container-admin canvas {
            display: block;
            margin: 0 auto 16px auto;
            max-width: 100%;
            height: auto !important;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.4);
            border-radius: 4px;
            background-color: #ffffff;
        }

        .pdf-loading-state {
            color: #f8fafc;
            padding: 60px 20px;
            font-size: 15px;
        }
    </style>

    <?php echo $__env->make('admin.layouts.components.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo form_open(null, 'class="form-horizontal"'); ?>

    <input type="hidden" id="idsurat" value="<?php echo e($surat->id); ?>">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Pemohon</h3>
        </div>

        <div class="box-body">
            <div class="form-group">
                <label class="control-label col-sm-3">NIK / Nama Penduduk</label>
                <div class="col-sm-9">
                    <input class="form-control input-sm" readonly="readonly" value="<?php echo e($surat->penduduk->nik); ?> - <?php echo e($surat->penduduk->nama); ?>">
                </div>
            </div>
            <?php echo $__env->make('admin.surat.konfirmasi_pemohon', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="form-group">
                <input type="hidden" name="id_surat" value="<?php echo e($surat['id']); ?>">
                <label class="col-sm-3 control-label">Nomor Surat</label>
                <div class="col-sm-4">
                    <input
                        id="nomor"
                        class="form-control input-sm digits required"
                        type="text"
                        placeholder="Nomor Surat"
                        name="nomor"
                        value="<?php echo e($surat->Formatpenomoransurat); ?>"
                        disabled
                    >
                </div>
            </div>
        </div>
    </div>
    <?php if($mandiri): ?>
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Kelengkapan Dokumen</h3>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered dataTable table-striped table-hover tabel-daftar">
                        <thead class="bg-gray disabled color-palette">
                            <tr>
                                <th>No</th>
                                <th>Nama Dokumen</th>
                                <th>Kelengkapan Dokumen</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($list_dokumen_syarat != null): ?>
                                <?php $__currentLoopData = $list_dokumen_syarat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $syarat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="padat"><?= $key + 1 ?></td>
                                        <td> <?php echo e($syarat['nama']); ?></td>
                                        <td class="padat">
                                            <?php if($syarat['id'] == '-1'): ?>
                                                <strong class="text-red"><i class="fa fa-exclamation-triangle text-red"></i>Bawa bukti fisik ke Kantor Desa</strong>
                                            <?php else: ?>
                                                <a href="<?php echo e(ci_route('permohonan_surat_admin.tampilkan', "{$syarat['id']}/{$syarat['id_pend']}")); ?>" class="btn btn-social btn-info btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block syarat"
                                                    title="Tampilkan"><i class="fa fa-eye"></i> Cek Dokumen</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <tr>
                                    <td class="text-center" colspan="9">Data Tidak Tersedia</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    <?php endif; ?>

    <?php if($surat->verifikasi_operator == '-1'): ?>
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Alasan Ditolak</h3>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered dataTable table-striped table-hover tabel-daftar">
                        <thead class="bg-gray disabled color-palette">
                            <tr>
                                <th>No</th>
                                <th>Pesan</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($surat->tolak): ?>
                                <?php $__currentLoopData = $surat->tolak; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $keterangan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="padat"><?= $key + 1 ?></td>
                                        <td> <?php echo e($keterangan->keterangan); ?></td>
                                        <td class="padat"><?php echo e($keterangan->created_at->format('d-m-Y')); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <tr>
                                    <td class="text-center" colspan="9">Data Tidak Tersedia</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Lampiran</h3>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered dataTable table-striped table-hover tabel-daftar">
                    <thead class="bg-gray disabled color-palette">
                        <tr>
                            <th>No</th>
                            <th>Nama Dokumen</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($surat->lampiran != null): ?>
                            <tr>
                                <td class="padat">1</td>
                                <td>Lampiran <?php echo e($surat->formatSurat->nama); ?></td>
                                <td class="padat">
                                    <button type="button" class="btn btn-social btn-info btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block lampiran" title="Cek Dokumen"><i class="fa fa-eye"></i> Cek Dokumen</button>
                                </td>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td class="text-center" colspan="9">Tidak Terdapat Lampiran</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="box-footer text-center">
            <?php echo $__env->make('admin.layouts.components.tombol_kembali', ['url' => ci_route('keluar.masuk'), 'label' => 'Daftar Permohonan', 'id' => 'back'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php if(in_array($surat->formatSurat->jenis, \App\Models\FormatSurat::TINYMCE) || is_file($surat->filesurat . '.pdf')): ?>
                <button type="button" class="btn btn-social btn-primary btn-sm preview"><i class="fa fa-file-pdf-o"></i>Lihat PDF</button>
            <?php elseif(is_file($surat->filesurat . '.rtf')): ?>
                <a href="<?php echo e(ci_route('keluar.unduh.rtf', $surat->id)); ?>" class="btn bg-purple btn-sm" title="Unduh Surat RTF" target="_blank"><i class="fa fa-file-word-o"></i> Unduh File</a>
            <?php endif; ?>

            <button type="button" class="btn btn-social btn-success btn-sm verifikasi" data-ulang="<?php echo e($surat->verifikasi_operator == -1 ? 'true' : 'false'); ?>"><i class="fa fa-check-circle"></i><?php echo e($surat->verifikasi_operator == -1 ? 'Kirim Ulang' : 'Setujui'); ?></button>

            <?php if(!$operator): ?>
                <button type="button" class="btn btn-social btn-danger btn-sm ditolak"><i class="fa fa-times"></i>Tolak</button>
            <?php endif; ?>

            <?php if($surat->verifikasi_operator == -1 && $operator && $mandiri): ?>
                <button type="button" class="btn btn-social btn-danger btn-sm kembalikan"><i class="fa fa-times"></i>Kembalikan</button>
            <?php endif; ?>
        </div>
    </div>

    <?php echo form_close(); ?>


    
    <div class="modal fade" id="modal-preview-pdf" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document" style="width: 95%; max-width: 1000px;">
            <div class="modal-content">
                <div class="modal-header bg-green">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" style="color: #fff;">Pratinjau Dokumen Surat</h4>
                </div>
                <div class="modal-body" style="padding: 0;">
                    <div id="pdf-preview-container-admin">
                        <div class="pdf-loading-state">
                            <i class="fa fa-spinner fa-spin fa-2x"></i>
                            <p style="margin-top: 10px;">Memuat pratinjau dokumen...</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="<?php echo e(ci_route('keluar.unduh/tinymce', $surat->id)); ?>" class="btn btn-social bg-fuchsia btn-sm" target="_blank" download><i class="fa fa-download"></i>Unduh PDF</a>
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
    <script type="text/javascript">
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

        $(function() {
            // Pindahkan modal ke body agar tidak terhalang struktur CSS admin
            $('#modal-preview-pdf').appendTo('body');

            $('button.verifikasi').click(function(e) {
                e.preventDefault();
                var id = $('#idsurat').val();
                var next = `<?php echo e($next ?? ''); ?>`;
                var tte = `<?php echo e(setting('tte') ?? ''); ?>`;
                var ulang = $(this).data('ulang')
                var pesan = `Apakah setuju surat ini di teruskan ke ${next}?`
                if (next != '' && ulang) {
                    pesan = `Kirim ulang surat ini untuk diperiksa?`
                } else if (next == '' && tte == '0') {
                    pesan = `Apakah setuju surat ini di teruskan ke Arsip?`
                } else if (next == '' && tte == '1') {
                    pesan = 'Apakah setuju surat ini untuk ditandatangani secara elektronik?'
                }

                var ulr_ajax = {
                    'confirm': `<?php echo e(ci_route('keluar.verifikasi')); ?>`,
                }

                var redirect = {
                    'confirm': `<?php echo e(ci_route('keluar.masuk')); ?>`,
                }
                var data = {
                    id: id
                };
                swal2_question(ulr_ajax, redirect, pesan, data, false);
            });

            $('button.ditolak').click(function(e) {
                e.preventDefault();
                var id = $('#idsurat').val();
                var ulr_ajax = `<?php echo e(ci_route('keluar.tolak')); ?>`;
                var redirect = `<?php echo e(ci_route('keluar.masuk')); ?>`;
                ditolak(id, ulr_ajax, redirect, 'Konfirmasi Pengembalian Surat', 'Pesan singkat alasan pengembalian', 'Pesan singkat alasan permohonan surat dikembalikan');
            });

            $('button.kembalikan').click(function(e) {
                e.preventDefault();
                var id = $('#idsurat').val();
                var ulr_ajax = `<?php echo e(ci_route('keluar.kembalikan')); ?>`;
                var redirect = `<?php echo e(ci_route('keluar.masuk')); ?>`;
                ditolak(id, ulr_ajax, redirect, 'Konfirmasi Pengembalian Permohonan', 'Pesan singkat alasan permohonan surat dikembalikan', 'Pesan singkat alasan permohonan surat dikembalikan');
            });

            // Fungsi Render PDF ke Canvas menggunakan PDF.js
            function renderPdfToCanvas(url, container) {
                container.html('<div class="pdf-loading-state"><i class="fa fa-spinner fa-spin fa-2x"></i><p style="margin-top: 10px;">Memuat pratinjau dokumen...</p></div>');

                fetch(url, {
                    credentials: 'same-origin',
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(function(response) {
                    if (!response.ok) {
                        throw new Error('Gagal mengambil dokumen (Status: ' + response.status + ')');
                    }
                    return response.arrayBuffer();
                })
                .then(function(arrayBuffer) {
                    return pdfjsLib.getDocument({ data: arrayBuffer }).promise;
                })
                .then(function(pdf) {
                    container.empty();
                    for (let pageNum = 1; pageNum <= pdf.numPages; pageNum++) {
                        pdf.getPage(pageNum).then(function(page) {
                            var scale = 1.4;
                            var viewport = page.getViewport({ scale: scale });
                            var canvas = document.createElement('canvas');
                            var context = canvas.getContext('2d');
                            canvas.height = viewport.height;
                            canvas.width = viewport.width;
                            container.append(canvas);

                            page.render({
                                canvasContext: context,
                                viewport: viewport
                            });
                        });
                    }
                })
                .catch(function(error) {
                    console.error('PDF Preview Error:', error);
                    container.html(
                        '<div class="pdf-loading-state">' +
                        '<i class="fa fa-exclamation-circle fa-2x" style="color: #f87171;"></i>' +
                        '<p style="margin-top: 10px;">Pratinjau diblokir oleh ekstensi unduhan browser Anda.<br>Silakan klik tombol <b>Unduh PDF</b> di bawah untuk membuka surat.</p>' +
                        '</div>'
                    );
                });
            }

            $('button.preview').click(function(e) {
                e.preventDefault();
                var url = `<?php echo e(ci_route('keluar.unduh/tinymce', $surat->id . '/true')); ?>`;
                var modal = $('#modal-preview-pdf');
                var container = $('#pdf-preview-container-admin');

                modal.modal('show');
                renderPdfToCanvas(url, container);
            });

            $('#modal-preview-pdf').on('hidden.bs.modal', function() {
                $('#pdf-preview-container-admin').empty();
            });

            $('button.lampiran').click(function(e) {
                e.preventDefault();
                var url = `<?php echo e(ci_route('keluar.unduh/lampiran', $surat->id . '/true')); ?>`;
                var modal = $('#modal-preview-pdf');
                var container = $('#pdf-preview-container-admin');

                modal.modal('show');
                renderPdfToCanvas(url, container);
            });

            $('a.syarat').click(function(e) {
                e.preventDefault();
                var attr = $(this).attr('href');
                var modal = $('#modal-preview-pdf');
                var container = $('#pdf-preview-container-admin');

                modal.modal('show');
                renderPdfToCanvas(attr, container);
            });
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\opensid\resources\views/admin/surat/periksa.blade.php ENDPATH**/ ?>