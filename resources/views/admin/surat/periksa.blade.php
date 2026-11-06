@include('admin.pengaturan_surat.asset_tinymce')
@include('admin.layouts.components.asset_datatables')

@extends('admin.layouts.index')

@section('title')
    <h1>
        Periksa Surat {{ ucwords($surat->formatSurat->nama) }}
    </h1>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ ci_route('surat') }}">Daftar Cetak Surat</a></li>
    <li class="active"> Surat {{ ucwords($surat->nama) }}</li>
    <li class="active"> Konsep Surat {{ ucwords($surat->nama) }}</li>
@endsection

@section('content')
    @include('admin.layouts.components.notifikasi')

    {!! form_open(null, 'class="form-horizontal"') !!}
    <input type="hidden" id="idsurat" value="{{ $surat->id }}">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Pemohon</h3>
        </div>

        <div class="box-body">
            <div class="form-group">
                <label class="control-label col-sm-3">NIK / Nama Penduduk</label>
                <div class="col-sm-9">
                    <input class="form-control input-sm" readonly="readonly" value="{{ $surat->penduduk->nik }} - {{ $surat->penduduk->nama }}">
                </div>
            </div>
            @include('admin.surat.konfirmasi_pemohon')

            <div class="form-group">
                <input type="hidden" name="id_surat" value="{{ $surat['id'] }}">
                <label class="col-sm-3 control-label">Nomor Surat</label>
                <div class="col-sm-4">
                    <input
                        id="nomor"
                        class="form-control input-sm digits required"
                        type="text"
                        placeholder="Nomor Surat"
                        name="nomor"
                        value="{{ $surat->Formatpenomoransurat }}"
                        disabled
                    >
                </div>
            </div>
        </div>
    </div>
    @if ($mandiri)
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
                            @if ($list_dokumen_syarat != null)
                                @foreach ($list_dokumen_syarat as $key => $syarat)
                                    <tr>
                                        <td class="padat"><?= $key + 1 ?></td>
                                        <td> {{ $syarat['nama'] }}</td>
                                        <td class="padat">
                                            @if ($syarat['id'] == '-1')
                                                <strong class="text-red"><i class="fa fa-exclamation-triangle text-red"></i>Bawa bukti fisik ke Kantor Desa</strong>
                                            @else
                                                <a href="{{ ci_route('permohonan_surat_admin.tampilkan', "{$syarat['id']}/{$syarat['id_pend']}") }}" class="btn btn-social btn-info btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block syarat"
                                                    title="Tampilkan"><i class="fa fa-eye"></i> Cek Dokumen</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center" colspan="9">Data Tidak Tersedia</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    @endif

    @if ($surat->verifikasi_operator == '-1')
        <div class="box box-danger">{{-- KUSTOM: dulu box-info --}}
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
                            @if ($surat->tolak)
                                @foreach ($surat->tolak as $key => $keterangan)
                                    <tr>
                                        <td class="padat"><?= $key + 1 ?></td>
                                        <td> {{ $keterangan->keterangan }}</td>
                                        <td class="padat">{{ $keterangan->created_at->format('d-m-Y') }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center" colspan="9">Data Tidak Tersedia</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif

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
                        @if ($surat->lampiran != null)
                            <tr>
                                <td class="padat">1</td>
                                <td>Lampiran {{ $surat->formatSurat->nama }}</td>
                                <td class="padat">
                                    <button type="button" class="btn btn-social btn-info btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block lampiran" title="Cek Dokumen"><i class="fa fa-eye"></i> Cek Dokumen</button>
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td class="text-center" colspan="9">Tidak Terdapat Lampiran</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="box-footer text-center">
            {{-- KUSTOM: pilihan untuk surat yang ditolak --}}
            @if ($surat->verifikasi_operator == -1 && ($operator || $kadus))
                <div class="callout callout-warning text-left">
                    <p>Surat ini ditolak. Pilih salah satu:</p>
                    <ul>
                        <li><b>Kirim Ulang</b>: kirim surat yang sama ke {{ $next ?: 'tahap berikutnya' }} tanpa perubahan.</li>
                        @if ($mandiri)
                            <li><b>Perbaiki Isi Surat</b>: buka lagi permohonan warga lalu buat ulang suratnya.</li>
                            <li><b>Kembalikan ke Warga</b>: warga melengkapi atau memperbaiki permohonannya sendiri.</li>
                        @endif
                    </ul>
                </div>
            @endif

            @include('admin.layouts.components.tombol_kembali', ['url' => $kembali, 'label' => $label_kembali, 'id' => 'back']){{-- KUSTOM: dulu ke keluar.masuk "Daftar Permohonan" --}}

            {{-- KUSTOM: PDF surat TinyMCE dibuat ulang dari isi surat bila berkasnya sudah dihapus, jadi tetap bisa dilihat sebelum disetujui --}}
            @if (is_file($surat->filesurat . '.pdf') || ($surat->status && $surat->isi_surat && $surat->nama_surat))
                <button type="button" class="btn btn-social btn-primary btn-sm preview"><i class="fa fa-file-pdf-o"></i>Lihat PDF</button>
            @elseif(is_file($surat->filesurat . '.rtf'))
                <a href="{{ ci_route('keluar.unduh.rtf', $surat->id) }}" class="btn bg-purple btn-sm" title="Unduh Surat RTF" target="_blank"><i class="fa fa-file-word-o"></i> Unduh File</a>
            @endif

            <button type="button" class="btn btn-social btn-success btn-sm verifikasi" data-ulang="{{ $surat->verifikasi_operator == -1 ? 'true' : 'false' }}"><i class="fa fa-check-circle"></i>{{ $surat->verifikasi_operator == -1 ? 'Kirim Ulang' : 'Setujui' }}</button>

            @if (!$operator && $surat->verifikasi_operator != -1){{-- KUSTOM: surat yang sudah ditolak tidak ditolak lagi --}}
                <button type="button" class="btn btn-social btn-danger btn-sm ditolak"><i class="fa fa-times"></i>Tolak</button>
            @endif

            @if ($surat->verifikasi_operator == -1 && ($operator || $kadus) && $mandiri){{-- KUSTOM: Kadus juga menangani surat yang ditolak --}}
                <button type="button" class="btn btn-social btn-warning btn-sm perbaiki-isi" data-url="{{ ci_route('permohonan_surat_admin.periksa', $mandiri->id) }}"><i class="fa fa-pencil"></i>Perbaiki Isi Surat</button>
                <button type="button" class="btn btn-social btn-danger btn-sm kembalikan"><i class="fa fa-undo"></i>Kembalikan ke Warga</button>
            @endif
        </div>
    </div>

    </form>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(function() {
            $('button.verifikasi').click(function(e) {
                e.preventDefault();
                var id = $('#idsurat').val();
                var next = `{{ $next ?? '' }}`;
                var tte = `{{ setting('tte') ?? '' }}`;
                var ulang = $(this).data('ulang')
                var pesan = `Apakah setuju surat ini di teruskan ke ${next}?`
                if (next != '' && ulang) {
                    pesan = `Kirim ulang surat ini ke ${next}?` // KUSTOM: dulu "untuk diperiksa?"
                } else if (next == '' && tte == '0') {
                    // KUSTOM: surat permohonan warga langsung siap diunduh warga setelah disetujui
                    pesan = {{ $mandiri ? 'true' : 'false' }} ? `Setujui surat ini? Setelah disetujui, warga dapat melihat dan mengunduh suratnya.` : `Apakah setuju surat ini di teruskan ke Arsip?`
                } else if (next == '' && tte == '1') {
                    pesan = 'Apakah setuju surat ini untuk ditandatangani secara elektronik?'
                }

                var ulr_ajax = {
                    'confirm': `{{ ci_route('keluar.verifikasi') }}`,
                }

                var redirect = {
                    'confirm': `{{ $kembali }}`, // KUSTOM: dulu keluar.masuk
                }
                var data = {
                    id: id
                };
                swal2_question(ulr_ajax, redirect, pesan, data, false);
            });

            $('button.ditolak').click(function(e) {
                e.preventDefault();
                var id = $('#idsurat').val();
                var ulr_ajax = `{{ ci_route('keluar.tolak') }}`;
                var redirect = `{{ $kembali }}`; // KUSTOM: dulu keluar.masuk
                ditolak(id, ulr_ajax, redirect, 'Konfirmasi Pengembalian Surat', 'Pesan singkat alasan pengembalian', 'Pesan singkat alasan permohonan surat dikembalikan');
            });

            $('button.kembalikan').click(function(e) {
                e.preventDefault();
                console.log(e)
                var id = $('#idsurat').val();
                var ulr_ajax = `{{ ci_route('keluar.kembalikan') }}`;
                var redirect = `{{ $kembali }}`; // KUSTOM: dulu keluar.masuk
                ditolak(id, ulr_ajax, redirect, 'Konfirmasi Pengembalian Permohonan', 'Pesan singkat alasan permohonan surat dikembalikan', 'Pesan singkat alasan permohonan surat dikembalikan');
            });

            // KUSTOM: surat ditolak diperbaiki dari data permohonan -> permohonan kembali ke Sedang Diperiksa,
            // surat yang ditolak dihapus, lalu langsung dibuka halaman pemeriksaan permohonan
            $('button.perbaiki-isi').click(function(e) {
                e.preventDefault();
                var tujuan = $(this).data('url');
                Swal.fire({
                    title: 'Perbaiki isi surat?',
                    text: 'Surat yang ditolak akan dihapus, lalu Anda membuat ulang suratnya dari data permohonan warga.',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, perbaiki',
                    cancelButtonText: 'Tutup',
                    showLoaderOnConfirm: true,
                    preConfirm: () => $.ajax({
                        url: `{{ ci_route('keluar.kembalikan') }}`,
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id: $('#idsurat').val(),
                            tujuan: 'periksa'
                        }
                    }).fail((error) => Swal.showValidationMessage(`Gagal: ${error.statusText}`)),
                }).then((result) => {
                    if (!result.isConfirmed) {
                        return;
                    }
                    if (result.value && result.value.status == true) {
                        window.location.replace(tujuan);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            text: (result.value && result.value.message) || 'Surat gagal dibuka untuk diperbaiki.'
                        });
                    }
                });
            });

            $('button.preview').click(function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                Swal.fire({
                    customClass: {
                        popup: 'swal-lg',
                    },
                    title: 'Lihat',
                    html: `<object data="{{ ci_route('keluar.unduh/tinymce', $surat->id . '/true') }}#toolbar=0" style="width: 100%;min-height: 400px;" type="application/pdf"></object>`,
                    showCancelButton: true,
                    cancelButtonText: 'tutup',
                    showConfirmButton: false,
                })
            });

            $('button.lampiran').click(function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                Swal.fire({
                    customClass: {
                        popup: 'swal-lg',
                    },
                    title: 'Lihat',
                    html: `<object data="{{ ci_route('keluar.unduh/lampiran', $surat->id . '/true') }}#toolbar=0" style="width: 100%;min-height: 400px;" type="application/pdf"></object>`,
                    showCancelButton: true,
                    cancelButtonText: 'tutup',
                    showConfirmButton: false,
                })
            });

            $('a.syarat').click(function(e) {
                e.preventDefault();
                var attr = $(this).attr('href');
                Swal.fire({
                    customClass: {
                        popup: 'swal-lg',
                    },
                    title: 'Lihat',
                    html: `<object data="${attr}#toolbar=0" style="width: 100%;min-height: 400px;" ></object>`,
                    showCancelButton: true,
                    cancelButtonText: 'tutup',
                    showConfirmButton: false,
                })
            });
        });
    </script>
@endpush
