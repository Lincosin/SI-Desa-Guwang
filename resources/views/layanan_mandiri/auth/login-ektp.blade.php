@extends('layanan_mandiri.auth.index')

@section('content')
    {{-- Panggil File CSS Custom yang sama --}}
    <link rel="stylesheet" href="{{ asset('css/login-guwang.css') }}">

    @include('admin.layouts.components.notifikasi')

    <div class="guwang-auth-header">
        <div class="guwang-auth-headerTop">
            <a href="{{ base_url('/') }}" class="btn-back-website">
                Beranda Desa <i class="fa fa-arrow-right"></i>
            </a>
        </div>
        <h2>Masuk dengan e-KTP</h2>
        <p>Tempelkan kartu e-KTP Anda pada perangkat <i>card reader</i> yang tersedia.</p>
    </div>

    <form id="validasi" autocomplete="off" action="{{ $form_action }}" method="post" class="login-form">
        <div class="login-footer-top" style="text-align: center; margin-bottom: 16px;">
            <div class="thumbnail" style="background: transparent; border: none; box-shadow: none;">
                <img src="{{ asset('images/camera-scan.gif') }}" alt="scanner" class="center" style="width: 28%; opacity: 0.85; filter: drop-shadow(0 4px 10px rgba(0,0,0,0.3));">
            </div>
        </div>

        <input type="hidden" name="anjungan_uuid" id="anjungan_uuid">

        <div class="form-group form-login" style="{{ jecho($cek_anjungan == 0 || ENVIRONMENT == 'development', false, 'width: 0; height: 0; overflow: hidden;') }}">
            <input
                name="tag_id_card"
                id="tag"
                autocomplete="off"
                placeholder="Tempelkan e-KTP Pada Card Reader"
                class="form-control required number"
                type="password"
                onkeypress="if (event.keyCode == 13){$('#'+'validasi').attr('action', '{{ $form_action }}');$('#'+'validasi').submit();}"
            >
        </div>

        @if (!$cek_anjungan)
            <div class="form-group form-login">
                <input type="password" class="form-control required number" name="password" placeholder="Masukan PIN" autocomplete="off" maxlength="6">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-submit-guwang">Masuk Sekarang</button>
            </div>
        @endif

        <div class="auth-divider">
            <span>Metode Lainnya</span>
        </div>

        <div class="secondary-actions-grid">
            <a href="{{ site_url('layanan-mandiri/masuk') }}" class="full-width-col">
                <button type="button" class="btn-outline-guwang">
                    <i class="fa fa-user"></i> Masuk dengan NIK & PIN
                </button>
            </a>

            <a href="{{ site_url('layanan-mandiri/lupa-pin') }}">
                <button type="button" class="btn-outline-guwang">
                    <i class="fa fa-key"></i> Lupa PIN
                </button>
            </a>

            @if (setting('tampilkan_pendaftaran'))
                <a href="{{ site_url('layanan-mandiri/daftar') }}">
                    <button type="button" class="btn-outline-guwang">
                        <i class="fa fa-user-plus"></i> Daftar Akun
                    </button>
                </a>
            @endif

            @if (in_array(\Modules\Anjungan\Models\Anjungan::ANJUNGAN, $cek_anjungan['tipe'] ?? []))
                <a href="<?= route('anjungan.index') ?>" class="full-width-col">
                    <button type="button" class="btn-outline-guwang">
                        <i class="fa fa-desktop"></i> Halaman Anjungan
                    </button>
                </a>
            @endif
        </div>
    </form>
@endsection

@push('script')
    <script type="text/javascript">
        $('document').ready(function() {
            const anjungan_uuid = localStorage.getItem('anjungan_uuid');
            if (anjungan_uuid) {
                $('#anjungan_uuid').val(anjungan_uuid);
            }
        });
    </script>
@endpush