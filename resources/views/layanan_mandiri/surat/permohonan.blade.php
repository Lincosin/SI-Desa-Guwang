@extends('layanan_mandiri.layouts.index')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/mandiri-style.css') }}">
    <style>
        /* Sembunyikan tombol unduh (pink/ikon download) HANYA di dalam kolom Aksi tabel */
        #tabeldata td.aksi a.bg-blue,
        #tabeldata td.aksi a[title*="Unduh"],
        #tabeldata td.aksi a:has(.fa-download) {
            display: none !important;
        }

        /* Styling Container Pratinjau PDF Canvas */
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
            <a href="{{ ci_route('layanan-mandiri.surat.buat') }}" class="btn btn-social btn-success visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block">
                <i class="fa fa-pencil-square-o"></i>Buat Surat
            </a>
            <a href="{{ ci_route('layanan-mandiri.arsip-surat') }}" class="btn btn-social btn-primary visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block">
                <i class="fa fa-file-zip-o"></i>Arsip Surat
            </a>
            <a href="{{ ci_route('layanan-mandiri.permohonan-surat') }}" class="btn btn-social bg-purple visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block">
                <i class="fa fa-file-word-o"></i>Permohonan Surat
            </a>
        </div>
        <div class="box-body box-line">
            <h4><b>DAFTAR PERMOHONAN SURAT</b></h4>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-data" id="tabeldata">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Aksi</th>
                            <th>No Antrean</th>
                            <th>Jenis Surat</th>
                            <th>Status Permohonan</th>
                            <th>Tanggal Kirim</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- KUSTOM lihat surat: pratinjau surat menggunakan Canvas PDF.js agar tidak putih / dicegat IDM --}}
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
@endsection

@push('scripts')
    {{-- Panggil Library PDF.js dari CDN --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

        $(document).ready(function() {
            var tabelData = $('#tabeldata').DataTable({
                'processing': true,
                'serverSide': true,
                'ajax': '{{ base_url('layanan-mandiri/permohonan-surat') }}',
                'order': [
                    [5, 'desc'] // Sesuaikan urutan kolom Tanggal Kirim (karena bertambah 1 kolom di indeks ke-5)
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
                'columns': [{
                        data: 'DT_RowIndex',
                        class: 'padat',
                    },
                    {
                        data: 'aksi',
                        class: 'aksi',
                    },
                    {
                        data: 'no_antrian',
                        class: 'padat',
                    },
                    {
                        data: 'surat.nama',
                        name: 'surat.nama',
                    },
                    {
                        // Menangkap elemen status dari kolom aksi untuk dipindah ke kolom Status tabel desktop
                        data: null,
                        name: 'status',
                        className: 'padat text-center',
                        render: function(data, type, row) {
                            // Mencari label/status dari data aksi yang dikirim backend OpenSID
                            var tempDiv = $('<div>').html(row.aksi);
                            var $statusEl = tempDiv.find('.btn-proses, span.label, .badge, button.keterangan').first();
                            if ($statusEl.length) {
                                return $statusEl.prop('outerHTML');
                            }
                            return '-';
                        }
                    },
                    {
                        data: 'created_at',
                        class: 'padat',
                    },
                ],
                'drawCallback': function() {
                    var headers = [];
                    $('#tabeldata thead th').each(function() {
                        headers.push($(this).text().trim());
                    });

                    $('#tabeldata tbody tr').each(function() {
                        var $tr = $(this);

                        // 1. Sematkan atribut data-label pada tiap <td> asli
                        $tr.find('td').each(function(index) {
                            if (headers[index]) {
                                $(this).attr('data-label', headers[index]);
                            }
                        });

                        var $tdAksi = $tr.find('td.aksi');

                        // 2. Ambil URL tombol unduh sebelum dihapus
                        var btnUnduhTabel = $tdAksi.find('.fa-download, .fa-file-pdf-o').closest('a, button');
                        var btnLihat = $tdAksi.find('a.lihat-surat');

                        if (btnUnduhTabel.length && btnLihat.length) {
                            btnLihat.attr('data-unduh', btnUnduhTabel.attr('href'));
                        }
                        btnUnduhTabel.remove();

                        // 3. Ambil teks status dari elemen proses/label di td.aksi
                        var $elemenStatus = $tdAksi.find('.btn-proses, span.label, .badge, button.keterangan, a:not(.lihat-surat)').first();
                        
                        if ($elemenStatus.length && $tr.find('td.status-mobile-row').length === 0) {
                            var teksStatus = $elemenStatus.text().trim();
                            
                            if (teksStatus && !teksStatus.includes('Lihat Surat')) {
                                var classWarna = 'status-badge-warning';
                                if ($elemenStatus.hasClass('bg-green') || $elemenStatus.hasClass('btn-success') || $elemenStatus.hasClass('btn-info') || teksStatus.includes('Disetujui')) {
                                    classWarna = 'status-badge-success';
                                } else if ($elemenStatus.hasClass('bg-red') || $elemenStatus.hasClass('btn-danger')) {
                                    classWarna = 'status-badge-danger';
                                }

                                var $barisStatus = $(
                                    '<td class="status-mobile-row" data-label="Status">' +
                                        '<span class="badge-status-card ' + classWarna + '">' + teksStatus + '</span>' +
                                    '</td>'
                                );
                                $tr.append($barisStatus);
                            }
                        }

                        // Hapus elemen status duplikat dan tag <br> di dalam td.aksi agar bersih
                        $tdAksi.find('.btn-proses, span.label:not(.lihat-surat), .badge:not(.lihat-surat), button.keterangan').remove();
                        $tdAksi.find('br').remove();
                    });
                }
            });

            $('button.keterangan').click(function(event) {
                $(this).popover('show');
            });

            // Fungsi Render PDF ke Canvas (Anti Layar Putih & Anti Cegat IDM)
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
@endpush