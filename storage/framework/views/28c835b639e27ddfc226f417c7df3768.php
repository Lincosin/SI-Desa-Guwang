<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/mandiri-animasi.css')); ?>">
    <style>
        #tabeldata td.aksi a.bg-blue,
        #tabeldata td.aksi a[title*="Unduh"],
        #tabeldata td.aksi a[title*="Cetak"],
        #tabeldata td.aksi a:has(.fa-download),
        #tabeldata td.aksi a:has(.fa-file-pdf-o) {
            display: none !important;
        }

        #pdf-preview-container {
            width: 100%;
            height: 75vh;
            overflow-y: auto;
            background-color: #334155;
            padding: 20px 10px;
            text-align: center;
        }

        #pdf-preview-container canvas {
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

    <div class="box box-solid">
        <div class="box-header with-border bg-green">
            <h4 class="box-title">Surat</h4>
        </div>
        <div class="box-body box-line">
            <a href="<?php echo e(ci_route('layanan-mandiri.surat.buat')); ?>" class="btn btn-social btn-success visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block">
                <i class="fa fa-pencil-square-o"></i>Buat Surat
            </a>
            <a href="<?php echo e(ci_route('layanan-mandiri.arsip-surat')); ?>" class="btn btn-social btn-primary visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block">
                <i class="fa fa-file-zip-o"></i>Arsip Surat
            </a>
            <a href="<?php echo e(ci_route('layanan-mandiri.permohonan-surat')); ?>" class="btn btn-social bg-purple visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block">
                <i class="fa fa-file-word-o"></i>Permohonan Surat
            </a>
        </div>
        <div class="box-body box-line">
            <h4><b>DAFTAR ARSIP SURAT</b></h4>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-data" id="tabeldata">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Aksi</th>
                            <th>Nomor Surat</th>
                            <th>Jenis Surat</th>
                            <th>Keterangan</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-lihat-surat" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document" style="width: 95%; max-width: 1000px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Lihat Surat</h4>
                </div>
                <div class="modal-body" style="padding: 0;">
                    <div id="pdf-preview-container">
                        <div class="pdf-loading-state">
                            <i class="fa fa-spinner fa-spin fa-2x"></i>
                            <p style="margin-top: 10px;">Memuat pratinjau dokumen...</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-social bg-blue btn-sm unduh-surat" download><i class="fa fa-download"></i>Unduh PDF</a>
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

        $(document).ready(function() {
            var isTte = "<?php echo e(setting('tte')); ?>";
            var tabelData = $('#tabeldata').DataTable({
                'processing': true,
                'serverSide': true,
                'ajax': '<?php echo e(base_url('layanan-mandiri/arsip-surat')); ?>',
                'order': [
                    [5, 'desc']
                ],
                'columnDefs': [{
                        'searchable': false,
                        'targets': [0, 1]
                    },
                    {
                        'orderable': false,
                        'targets': [0, 1]
                    }
                ],
                'columns': [
                    {
                        data: 'DT_RowIndex',
                        class: 'padat',
                    },
                    {
                        data: 'aksi',
                        class: 'aksi',
                    },
                    {
                        data: 'no_surat',
                        class: 'padat',
                        defaultContent: '-',
                    },
                    {
                        data: null,
                        render: function(data) {
                            return data?.format_surat?.nama ?? '-';
                        },
                        name: 'formatSurat.nama',
                    },
                    {
                        data: 'surat.nama',
                        name: 'surat.nama',
                        defaultContent: '-',
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan', // Wajib ada untuk server-side
                        defaultContent: '-', // Mencegah error pop-up DataTables
                    },
                    {
                        data: 'tanggal',
                        class: 'padat',
                    },
                ],
                'drawCallback': function() {
                    // Mengambil judul dari thead untuk dijadikan label di tampilan Mobile Card
                    var headers = [];
                    $(this).find('thead th').each(function() {
                        headers.push($(this).text().trim());
                    });

                    // Menyematkan judul tersebut ke dalam masing-masing sel (td)
                    $(this).find('tbody tr').each(function() {
                        $(this).find('td').each(function(index) {
                            if (headers[index]) {
                                $(this).attr('data-label', headers[index]);
                            }
                        });
                        
                        // Bersihkan tombol unduh seperti biasa agar tidak tumpang tindih
                        var $tdAksi = $(this).find('td.aksi');
                        var btnUnduhTabel = $tdAksi.find('.fa-download, .fa-file-pdf-o').closest('a, button');
                        var btnLihat = $tdAksi.find('a.lihat-surat');

                        if (btnUnduhTabel.length && btnLihat.length) {
                            btnLihat.attr('data-unduh', btnUnduhTabel.attr('href'));
                        }
                        btnUnduhTabel.remove();
                    });
                }
            });

            $('button.keterangan').click(function(event) {
                $(this).popover('show');
            });

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
                        '<p style="margin-top: 10px;">Pratinjau diblokir oleh ekstensi unduhan browser Anda.<br>Silakan klik tombol <b>Unduh PDF</b> di pojok kanan bawah untuk membuka surat.</p>' +
                        '</div>'
                    );
                });
            }

            $('#modal-lihat-surat').appendTo('body');
            $('#tabeldata').on('click', 'a.lihat-surat', function(e) {
                e.preventDefault();
                var urlPreview = $(this).attr('href');
                var urlUnduh = $(this).attr('data-unduh') || urlPreview;

                var modal = $('#modal-lihat-surat');
                var container = $('#pdf-preview-container');

                modal.find('.modal-title').text($(this).data('judul') || 'Lihat Surat');
                modal.find('.unduh-surat').attr('href', urlUnduh);
                modal.modal('show');

                renderPdfToCanvas(urlPreview, container);
            });

            $('#modal-lihat-surat').on('hidden.bs.modal', function() {
                $('#pdf-preview-container').empty();
            });
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layanan_mandiri.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\opensid\resources\views/layanan_mandiri/surat/arsip.blade.php ENDPATH**/ ?>