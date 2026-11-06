@include('admin.layouts.components.asset_datatables')

@extends('admin.layouts.index')

@section('title')
    <h1>
        Daftar Permohonan Surat
    </h1>
@endsection

@section('breadcrumb')
    <li class="active">Daftar Permohonan Surat</li>
@endsection

@section('content')
    @include('admin.layouts.components.notifikasi')

    {{-- KUSTOM: ringkasan tugas Kades/Sekdes/Kepala Dusun. Pemeriksaan dan persetujuan surat dilakukan di menu ini --}}
    @if ($tugas)
        @php
            $sebutanKades = ucwords(setting('sebutan_kepala_desa') ?: 'Kepala Desa');
        @endphp
        <div class="callout callout-info tugas-permohonan">
            <h4><i class="fa fa-tasks"></i> Tugas Anda</h4>
            <ul>
                @if ($tugas['kadus'])
                    <li><b>{{ $tugas['diperiksa'] }}</b> permohonan perlu diperiksa (tombol <b>Sedang Diperiksa</b>), lalu suratnya dikirim ke {{ $sebutanKades }}.</li>
                    <li><b>{{ $tugas['disetujui'] }}</b> surat menunggu persetujuan Anda (tombol hijau <b>Periksa &amp; Setujui</b>).</li>
                    <li><b>{{ $tugas['diperbaiki'] }}</b> surat ditolak {{ $sebutanKades }} dan perlu ditindaklanjuti (tombol merah <b>Ditolak, Perbaiki</b>).</li>
                @else
                    <li><b>{{ $tugas['disetujui'] }}</b> surat menunggu persetujuan Anda (tombol hijau <b>Periksa &amp; Setujui</b>).</li>
                    <li>Kelengkapan permohonan diperiksa oleh Kepala Dusun pemohon sebelum suratnya sampai ke Anda.</li>
                @endif
                <li>Arsip Layanan hanya berisi arsip surat. Semua pemeriksaan dan persetujuan dilakukan di halaman ini.</li>
            </ul>
        </div>
    @endif

    @if ($surat_lain->isNotEmpty())
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Surat dari Cetak Surat yang perlu tindakan Anda</h3>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="padat">NO</th>
                                <th class="aksi">AKSI</th>
                                <th>JENIS SURAT</th>
                                <th>NAMA PENDUDUK</th>
                                <th class="padat">TANGGAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($surat_lain as $item)
                                <tr>
                                    <td class="padat">{{ $loop->iteration }}</td>
                                    <td class="aksi">
                                        @if ($item->verifikasi_operator == -1)
                                            <a href="{{ ci_route('keluar.periksa', $item->id) }}?kembali=permohonan" class="btn btn-social btn-danger btn-sm" title="Alasan ditolak: {{ $item->alasanTolakTerakhir() }}"><i class="fa fa-exclamation-circle"></i>Ditolak, Periksa</a>
                                        @else
                                            <a href="{{ ci_route('keluar.periksa', $item->id) }}?kembali=permohonan" class="btn btn-social bg-olive btn-sm" title="Lihat surat, lalu setujui atau tolak"><i class="fa fa-check-square-o"></i>Periksa &amp; Setujui</a>
                                        @endif
                                    </td>
                                    <td>{{ $item->formatSurat->nama ?? '' }}</td>
                                    <td>{{ $item->penduduk->nama ?? $item->nama_non_warga }}</td>
                                    <td class="padat">{{ tgl_indo2($item->tanggal) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif

    <div class="box box-info">
        {!! form_open(null, 'id="mainform" name="mainform"') !!}
        <div class="box-body">
            <div class="row mepet">
                <div class="col-sm-3">
                    <select class="form-control input-sm select2" id="status" name="status">
                        <option value="">Pilih Status</option>
                        @foreach ($list_status_permohonan as $id => $value)
                            <option value="{{ $id }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <hr class="batas">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="tabeldata">
                    <thead>
                        <tr>
                            <th class="padat">NO</th>
                            <th class="aksi">AKSI</th>
                            <th class="padat">NO ANTREAN</th>
                            <th class="padat">NIK</th>
                            <th class="padat">NAMA PENDUDUK</th>
                            <th class="padat">NO HP AKTIF</th>
                            <th>JENIS SURAT</th>
                            <th>KETERANGAN</th>
                            <th class="padat">TANGGAL KIRIM</th>
                        </tr>
                    </thead>
                </table>
            </div>
            </form>
        </div>
    </div>

    {{-- KUSTOM tanda tangan Kades: gambar tanda tangan untuk kode [ttd_kades], tampil setelah surat disetujui --}}
    @if ($ttd_kades)
        @php
            $sebutanKades = ucwords(setting('sebutan_kepala_desa') ?: 'Kepala Desa');
            $adaTtd       = (bool) $ttd_kades['gambar'];
        @endphp
        <div class="box box-default {{ $adaTtd ? 'collapsed-box' : '' }}">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-pencil-square-o"></i> Tanda Tangan {{ $sebutanKades }}</h3>
                <span class="label {{ $adaTtd ? 'label-success' : 'label-warning' }}">{{ $adaTtd ? 'Sudah diunggah' : 'Belum diunggah' }}</span>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa {{ $adaTtd ? 'fa-plus' : 'fa-minus' }}"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-4 text-center">
                        @if ($adaTtd)
                            <img src="{{ $ttd_kades['gambar'] }}" alt="Tanda tangan {{ $sebutanKades }}" style="max-width: 100%; max-height: 140px; background: #fff; border: 1px dashed #ccc; padding: 8px;">
                        @else
                            <p class="text-muted" style="padding: 30px 0;">Belum ada tanda tangan.</p>
                        @endif
                    </div>
                    <div class="col-sm-8">
                        {!! form_open_multipart(ci_route('permohonan_surat_admin.ttd_kades')) !!}
                        <div class="form-group">
                            <label for="ttd">Unggah gambar tanda tangan (PNG atau JPG, paling besar 2 MB)</label>
                            <input type="file" id="ttd" name="ttd" accept="image/png,image/jpeg" class="form-control input-sm" required>
                            <p class="help-block">
                                Latar putih otomatis dibuat transparan dan ruang kosong dipotong.
                                Tulis kode <code>[ttd_kades]</code> di template surat (Pengaturan Surat), di baris kosong di atas nama {{ $sebutanKades }}.
                                Tanda tangan hanya muncul pada surat yang sudah disetujui {{ $sebutanKades }}; sebelum itu tempatnya kosong.
                            </p>
                        </div>
                        <button type="submit" class="btn btn-social btn-primary btn-sm"><i class="fa fa-upload"></i> Simpan Tanda Tangan</button>
                        </form>
                        @if ($adaTtd)
                            {!! form_open(ci_route('permohonan_surat_admin.ttd_kades'), 'style="margin-top: 8px;"') !!}
                            <input type="hidden" name="hapus" value="1">
                            <button type="submit" class="btn btn-social btn-danger btn-sm" onclick="return confirm('Hapus tanda tangan {{ $sebutanKades }}?')"><i class="fa fa-trash"></i> Hapus Tanda Tangan</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

    @include('admin.layouts.components.konfirmasi_hapus')
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            var TableData = $('#tabeldata').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ ci_route('permohonan_surat_admin.datatables') }}",
                    data: function(req) {
                        req.status = $('#status').val();
                        console.log(req.status);
                        
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        class: 'padat',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'aksi',
                        class: 'aksi',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'no_antrian',
                        name: 'no_antrian',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'penduduk.nik',
                        name: 'penduduk.nik',
                        class: 'padat',
                        searchable: true,
                        orderable: true,
                        defaultContent: ''
                    },
                    {
                        data: 'penduduk.nama',
                        name: 'penduduk.nama',
                        searchable: true,
                        orderable: true,
                        defaultContent: ''
                    },
                    {
                        data: 'no_hp_aktif',
                        name: 'no_hp_aktif',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'surat.nama',
                        name: 'surat.nama',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        searchable: true,
                        orderable: true
                    },
                ],
                order: [
                    [8, 'desc']
                ],
                pageLength: 25
            });

            $('#status').on('select2:select', function(e) {
                TableData.draw();
            });

            if (ubah == 0) {
                TableData.column(1).visible(false);
            }
        });
    </script>
@endpush
