@extends('layanan_mandiri.auth.index')

@section('content')
    {{-- Panggil File CSS Custom Desa Guwang --}}
    <link rel="stylesheet" href="{{ asset('css/login-guwang.css') }}">

    @include('admin.layouts.components.notifikasi')

    <div class="guwang-auth-header">
        <div class="guwang-auth-headerTop">
            <a href="{{ base_url('/') }}" class="btn-back-website">
                Beranda Desa <i class="fa fa-arrow-right"></i>
            </a>
        </div>
        <h2>Masuk Layanan</h2>
        <p>
            @if (setting('tampilkan_pendaftaran'))
                Belum memiliki akun warga? <a href="{{ site_url('layanan-mandiri/daftar') }}">Daftar di sini</a>
            @else
                Masukkan NIK dan 6 digit kode PIN Layanan Mandiri Anda.
            @endif
        </p>
    </div>

    <form id="validasi" autocomplete="off" action="{{ $form_action }}" method="post" class="login-form">
        <div class="form-group form-login">
            <input
                type="text"
                autocomplete="off"
                class="form-control angka required {!! jecho($cek_anjungan['keyboard'] == 1, true, 'kbvnumber') !!}"
                name="nik"
                maxlength="16"
                placeholder="Nomor Induk Kependudukan (NIK)"
            >
        </div>

        {{-- Hidden input for UUID from local storage --}}
        <input type="hidden" name="anjungan_uuid" id="anjungan_uuid">

        <div class="form-group form-login password-wrapper">
            <input
                type="password"
                autocomplete="off"
                class="form-control angka required {!! jecho($cek_anjungan['keyboard'] == 1, true, 'kbvnumber') !!}"
                name="password"
                placeholder="Masukkan 6 Digit PIN"
                id="pin"
                maxlength="6"
            >
            <button type="button" id="togglePinBtn" class="toggle-password-btn" title="Tampilkan/Sembunyikan PIN">
                <i class="fa fa-eye" id="eyeIcon"></i>
            </button>
        </div>

        <div class="form-helper-row">
            <label class="custom-check-label" for="checkbox">
                <input type="checkbox" id="checkbox" style="display: initial;">
                <span>Tampilkan kode PIN</span>
            </label>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-submit-guwang">Masuk Sekarang</button>
        </div>

        <div class="auth-divider">
            <span>Atau akses melalui</span>
        </div>

        <div class="secondary-actions-grid">
            <a href="{{ site_url('layanan-mandiri/masuk-ektp') }}">
                <button type="button" class="btn-outline-guwang">
                    <i class="fa fa-id-card-o"></i> E-KTP
                </button>
            </a>

            <a href="{{ site_url('layanan-mandiri/lupa-pin') }}">
                <button type="button" class="btn-outline-guwang">
                    <i class="fa fa-key"></i> Lupa PIN
                </button>
            </a>

            @if (setting('tampilkan_pendaftaran'))
                <a href="{{ site_url('layanan-mandiri/daftar') }}" class="full-width-col">
                    <button type="button" class="btn-outline-guwang">
                        <i class="fa fa-user-plus"></i> Daftar Akun Baru
                    </button>
                </a>
            @endif

            @if (in_array(\Modules\Anjungan\Models\Anjungan::ANJUNGAN, $cek_anjungan['tipe'] ?? []))
                <a href="<?= route('anjungan.index') ?>" class="full-width-col">
                    <button type="button" class="btn-outline-guwang">
                        <i class="fa fa-desktop"></i> Anjungan Mandiri
                    </button>
                </a>
            @endif
        </div>
    </form>
@endsection

@push('script')
    {{-- Panggil File JS Custom Desa Guwang --}}
    <script src="{{ asset('js/login-guwang.js') }}"></script>
@endpush