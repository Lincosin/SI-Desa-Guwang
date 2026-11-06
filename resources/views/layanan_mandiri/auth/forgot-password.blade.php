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
        <h2>Pemulihan PIN</h2>
        <p>Masukkan NIK terdaftar Anda untuk mendapatkan kembali akses Layanan Mandiri.</p>
    </div>

    <form id="validasi" action="<?= ci_route('layanan-mandiri.cek-pin') ?>" method="post" class="login-form">
        <div class="form-group form-login">
            <input
                type="text"
                autocomplete="off"
                value=""
                class="form-control required nik <?= jecho($cek_anjungan['keyboard'] == 1, true, 'kbvnumber') ?>"
                name="nik"
                placeholder="Masukkan 16 Digit NIK"
                maxlength="16"
            >
        </div>

        <div class="auth-divider">
            <span>Kirim Instruksi Melalui</span>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-submit-guwang" name="via" value="telegram">
                <i class="fa fa-telegram" style="margin-right: 6px;"></i> Kirim via Telegram
            </button>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-submit-guwang" name="via" value="email" style="background: linear-gradient(135deg, #0369a1 100%, #0c4a6e 0%) !important;">
                <i class="fa fa-envelope" style="margin-right: 6px;"></i> Kirim via Email
            </button>
        </div>

        <div class="auth-divider">
            <span>Kembali ke Menu</span>
        </div>

        <div class="secondary-actions-grid">
            <a href="<?= site_url('layanan-mandiri/masuk') ?>">
                <button type="button" class="btn-outline-guwang">
                    <i class="fa fa-sign-in"></i> Masuk NIK
                </button>
            </a>
            <a href="<?= site_url('layanan-mandiri/masuk-ektp') ?>">
                <button type="button" class="btn-outline-guwang">
                    <i class="fa fa-id-card-o"></i> Masuk e-KTP
                </button>
            </a>
        </div>
    </form>
@endsection