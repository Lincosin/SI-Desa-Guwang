@extends('layanan_mandiri.layouts.index')

@section('content')
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
                            <th>Tanggal Kirim</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- KUSTOM lihat surat: pratinjau surat yang sudah jadi --}}
    <div class="modal fade" id="modal-lihat-surat" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document" style="width: 95%; max-width: 1000px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Lihat Surat</h4>
                </div>
                <div class="modal-body" style="padding: 0;">
                    <iframe src="about:blank" style="display: block; width: 100%; height: 75vh; border: 0;" title="Pratinjau surat"></iframe>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-social bg-fuchsia btn-sm unduh-surat" download><i class="fa fa-download"></i>Unduh PDF</a>
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            var tabelData = $('#tabeldata').DataTable({
                'processing': true,
                'serverSide': true,
                'ajax': '{{ base_url('layanan-mandiri/permohonan-surat') }}',
                'order': [
                    [4, 'desc']
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
                        data: 'created_at',
                        class: 'padat',
                    },
                ],
            });

            $('button.keterangan').click(function(event) {
                $(this).popover('show');
            });

            // KUSTOM lihat surat: tampilkan surat yang sudah jadi di jendela pratinjau; di layar kecil dibuka di tab baru.
            // Modal dipindah ke body agar tidak terkurung efek CSS (blur/transform) pembungkus konten tema.
            $('#modal-lihat-surat').appendTo('body');
            $('#tabeldata').on('click', 'a.lihat-surat', function(e) {
                if (window.innerWidth < 768) {
                    return;
                }
                e.preventDefault();
                var url = $(this).attr('href');
                var modal = $('#modal-lihat-surat');
                modal.find('.modal-title').text($(this).data('judul') || 'Lihat Surat');
                modal.find('iframe').attr('src', url);
                modal.find('.unduh-surat').attr('href', url);
                modal.modal('show');
            });

            $('#modal-lihat-surat').on('hidden.bs.modal', function() {
                $(this).find('iframe').attr('src', 'about:blank');
            });

        });
    </script>
@endpush
