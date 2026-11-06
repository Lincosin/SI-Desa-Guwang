<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Layanan Mandiri <?php echo e(ucwords(setting('sebutan_desa') . ' ' . ($desa['nama_desa'] ?? '')) . get_dynamic_title_page_from_path()); ?></title>
    
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta name="color-scheme" content="light dark">
    <link rel="shortcut icon" href="<?php echo e(favico_desa()); ?>" />

    
    <script>
        (function () {
            var r = document.documentElement, pilihan = 'auto';
            try {
                var t = localStorage.getItem('temaku-tema');
                if (t === 'gelap' || t === 'terang') { pilihan = t; }
                var a = JSON.parse(localStorage.getItem('temaku-a11y') || '{}') || {};
                var u = Math.max(-2, Math.min(5, parseInt(a.size, 10) || 0));
                if (u) { r.style.fontSize = (100 + u * 10) + '%'; }
                if (a.gray === true) { r.classList.add('a11y-gray'); }
                if (a.neg === true) { r.classList.add('a11y-neg'); }
                if (a.underline === true) { r.classList.add('a11y-underline'); }
            } catch (e) { /* localStorage diblokir: ikut pengaturan perangkat */ }
            var gelap = pilihan === 'gelap' || (pilihan === 'auto' && window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches);
            r.classList.toggle('dark', gelap);
            r.setAttribute('data-tema', pilihan);
        })();
    </script>

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo e(asset('bootstrap/css/bootstrap.min.css')); ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(asset('bootstrap/css/font-awesome.min.css')); ?>">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo e(asset('bootstrap/css/dataTables.bootstrap.min.css')); ?>">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?php echo e(asset('bootstrap/css/bootstrap3-wysihtml5.min.css')); ?>">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo e(asset('bootstrap/css/select2.min.css')); ?>">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="<?php echo e(asset('bootstrap/css/bootstrap-colorpicker.min.css')); ?>">
    <!-- Bootstrap Date time Picker -->
    <link rel="stylesheet" href="<?php echo e(asset('bootstrap/css/bootstrap-datetimepicker.min.css')); ?>">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="<?php echo e(asset('bootstrap/css/bootstrap-datepicker.min.css')); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo e(asset('css/AdminLTE.min.css')); ?>">
    <!-- AdminLTE Skins. -->
    <link rel="stylesheet" href="<?php echo e(asset('css/skins/_all-skins.min.css')); ?>">

    <?php if(cek_koneksi_internet()): ?>
        <!-- Form Wizard - smartWizard -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/smartwizard@5/dist/css/smart_wizard_all.min.css">
        <!-- TEMAKU: font Plus Jakarta Sans seperti tema utama (butuh internet; tanpa itu dipakai font cadangan) -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap">
    <?php endif; ?>

    <?php if($controller == 'lapak'): ?>
        <!-- Map -->
        <link rel="stylesheet" href="<?php echo e(asset('css/leaflet.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('css/mapbox-gl.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('css/peta.css')); ?>">
        
    <?php endif; ?>

    <!-- Style Mandiri Modification CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('css/mandiri-style.css')); ?>">

    <!-- Jquery Confirm -->
    <link rel="stylesheet" href="<?php echo e(asset('front/css/jquery-confirm.min.css')); ?>">
    <!-- Jquery UI -->
    <link rel="stylesheet" href="<?php echo e(asset('bootstrap/css/jquery-ui.min.css')); ?>">
    <?php if($cek_anjungan): ?>
        <!-- Keyboard Default (Ganti dengan keyboard-dark.min.css untuk tampilan lain)-->
        <link rel="stylesheet" href="<?php echo e(asset('css/keyboard.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('front/css/mandiri-keyboard.css')); ?>">
    <?php endif; ?>

    <!-- TEMAKU: tampilan selaras tema utama, mode gelap, alat aksesibilitas. Dimuat paling akhir agar menang atas CSS lain. -->
    <link rel="stylesheet" href="<?php echo e(asset('css/mandiri-temaku.css')); ?>">

    <?php echo $__env->yieldPushContent('css'); ?>
</head>


<body class="hold-transition skin-blue layout-top-nav">
    <a href="#konten-utama" class="tk-skip">Langsung ke isi halaman</a>
    <div class="wrapper">
        <header class="main-header">
            
            <div class="tk-strip">
                <div class="container">
                    <div class="tk-strip-kiri">
                        <span class="hidden-xs">Tampilan:</span>
                        <button type="button" id="tema-toggle" class="tk-strip-btn" aria-pressed="false" title="Ganti mode gelap / terang" aria-label="Ganti mode gelap atau terang">
                            <i class="fa fa-moon-o" data-tema-ikon aria-hidden="true"></i>
                            <span data-tema-label>Mode Gelap</span>
                        </button>
                    </div>
                    <a class="tk-strip-link" href="<?php echo e(site_url()); ?>"><i class="fa fa-home" aria-hidden="true"></i> Beranda Website</a>
                </div>
            </div>

            <nav class="navbar navbar-static-top" aria-label="Menu utama layanan mandiri">
                <div class="container">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="<?php echo e(site_url()); ?>">
                            <img src="<?php echo e(gambar_desa($desa['logo'])); ?>" class="logo-brand" alt="<?php echo e($desa['nama_desa']); ?>" />
                        </a>
                        <div class="navbar-brand">
                            <?php echo e(ucwords(setting('sebutan_desa') . ' ' . $desa['nama_desa'])); ?>

                        </div>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false" aria-controls="navbar-collapse" aria-label="Buka menu">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>

                    <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                            
                            <li class="dropdown-header text-bold visible-xs" style="padding: 12px 15px 4px 15px; font-size: 10px; letter-spacing: 0.08em; text-transform: uppercase; color: #94a3b8;">Navigasi Utama</li>
                            <!-- <li><a href="<?php echo e(site_url('layanan-mandiri/profil')); ?>"><i class="fa fa-user-circle-o"></i> Beranda / Profil</a></li> -->
                            <li><a href="<?php echo e(site_url('layanan-mandiri/permohonan-surat')); ?>"><i class="fa fa-file-word-o"></i> Surat</a></li>
                            <li><a href="<?php echo e(site_url('layanan-mandiri/pesan-masuk')); ?>"><i class="fa fa-envelope-o"></i> Pesan</a></li>
                            <li><a href="<?php echo e(site_url('layanan-mandiri/lapak')); ?>"><i class="fa fa-cart-plus"></i> Lapak</a></li>
                            <!-- <li><a href="<?php echo e(site_url('layanan-mandiri/bantuan')); ?>"><i class="fa fa-handshake-o"></i> Bantuan</a></li> -->
                            <li><a href="<?php echo e(site_url('layanan-mandiri/kehadiran')); ?>"><i class="fa fa-users"></i> Perangkat</a></li>

                            
                            <li class="dropdown-header text-bold visible-xs" style="padding: 16px 15px 4px 15px; font-size: 10px; letter-spacing: 0.08em; text-transform: uppercase; color: #94a3b8; border-top: 1px solid rgba(0,0,0,0.06); margin-top: 6px;">Menu Akun & Layanan</li>
                            <li class="visible-xs"><a href="<?php echo e(ci_route('layanan-mandiri/profil')); ?>"><i class="fa fa-user-o"></i> Profil Warga</a></li>
                            <li class="visible-xs"><a href="<?php echo e(ci_route('layanan-mandiri/produk')); ?>"><i class="fa fa-shopping-bag"></i> Produk Desa</a></li>
                            <li class="visible-xs"><a href="<?php echo e(ci_route('layanan-mandiri/dokumen')); ?>"><i class="fa fa-file-text-o"></i> Dokumen Penduduk</a></li>
                            <li class="visible-xs"><a href="<?php echo e(ci_route('layanan-mandiri/bantuan')); ?>"><i class="fa fa-life-ring"></i> Bantuan Sosial</a></li>
                            <li class="visible-xs"><a href="<?php echo e(ci_route('layanan-mandiri/cetak-biodata')); ?>"><i class="fa fa-print"></i> Cetak Biodata</a></li>
                            <?php if($ci->is_login->id_kk != null): ?>
                                <li class="visible-xs"><a href="<?php echo e(ci_route('layanan-mandiri/cetak-kk')); ?>"><i class="fa fa-print"></i> Cetak Salinan KK</a></li>
                            <?php endif; ?>
                            <li class="visible-xs"><a href="<?php echo e(ci_route('layanan-mandiri/ganti-pin')); ?>"><i class="fa fa-key"></i> Ganti PIN</a></li>
                            <li class="visible-xs"><a href="<?php echo e(ci_route('layanan-mandiri/verifikasi')); ?>"><i class="fa fa-check-square-o"></i> Verifikasi Akun</a></li>
                            <li class="visible-xs tk-mobile-logout-wrap">
                                <a href="<?php echo e(site_url('layanan-mandiri/keluar')); ?>" class="tk-mobile-logout-btn">
                                    <i class="fa fa-sign-out"></i>
                                    <span>Keluar dari Layanan</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- <li>
                                <a href="<?php echo e(site_url('layanan-mandiri/permohonan-surat')); ?>" title="Permohonan Surat">
                                    <i class="fa fa-file-word-o"></i>
                                    <span class="label label-danger" id="b_surat" title="Surat perlu perhatian" style="display: none;"></span>
                                </a>
                            </li>

                            <li>
                                <a href="<?php echo e(site_url('layanan-mandiri/pesan-masuk')); ?>" title="Pesan Masuk">
                                    <i class="fa fa-envelope-o"></i>
                                    <span class="label label-danger" id="b_pesan" style="display: none;"></span>
                                </a>
                            </li> -->

                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img class="user-image" src="<?php echo e(AmbilFoto($ci->is_login->foto, '', $ci->is_login->sex)); ?>" alt="Foto Penduduk">
                                    <span class="hidden-xs"><?php echo e($ci->is_login->nama); ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="user-header">
                                        <img class="img-circle" src="<?php echo e(AmbilFoto($ci->is_login->foto, '', $ci->is_login->sex)); ?>" alt="Foto Penduduk">
                                        <p><?php echo e($ci->is_login->nama); ?>

                                            <small><b>NIK : <?php echo e($ci->is_login->nik); ?></b></small>
                                    </li>
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="<?php echo e(site_url('layanan-mandiri/profil')); ?>" class="btn btn-default">Profil</a>
                                        </div>
                                        <div class="pull-right">
                                            <button type="button" class="btn btn-block btn-social bg-red" data-toggle="modal" data-target="#pendapat"><i class="fa fa-sign-out"></i>Keluar</button>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        
        <div class="content-wrapper">
            <div class="container">
                <!-- <section class="content-header fixed">
                    <div class="row hidden-xs">
                        <a href="<?php echo e(site_url('layanan-mandiri/permohonan-surat')); ?>">
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box bg-green">
                                    <span class="info-box-icon"><i class="fa fa-file-word-o"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text-widget">Surat</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="<?php echo e(site_url('layanan-mandiri/pesan-masuk')); ?>">
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box bg-yellow">
                                    <span class="info-box-icon"><i class="fa fa-envelope-o"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text-widget">Pesan</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="<?php echo e(site_url('layanan-mandiri/lapak')); ?>">
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box bg-aqua">
                                    <span class="info-box-icon"><i class="fa fa-cart-plus"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text-widget">Lapak</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="<?php echo e(site_url('layanan-mandiri/kehadiran')); ?>">
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box bg-red">
                                    <span class="info-box-icon"><i class="fa fa-users"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text-widget">Perangkat</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </section> -->

                <section class="content" id="konten-utama" tabindex="-1">
                    <div class="row">
                        <div class="col-md-3">
                            
                            <div class="box box-solid tk-menu" role="navigation" aria-label="Menu layanan mandiri">
                                <div class="box-body box-line tk-menu-profil">
                                    <img class="img-circle tk-menu-foto" src="<?php echo e(AmbilFoto($ci->is_login->foto, '', $ci->is_login->sex)); ?>" alt="Foto <?php echo e($ci->is_login->nama); ?>">
                                    <div class="tk-menu-info">
                                        <div class="tk-menu-nama"><?php echo e($ci->is_login->nama); ?></div>
                                        <div class="tk-menu-nik">NIK: <?php echo e($ci->is_login->nik); ?></div>
                                    </div>
                                </div>
                                <div class="box-body tk-menu-isi">
                                    <div class="tk-menu-grup">
                                        <div class="tk-menu-judul">Layanan</div>
                                        <?php if(cek_anjungan()): ?>
                                            <?php echo $__env->make('admin.layouts.components.tombol_kembali_layanan_mandiri', ['url' => $ci->is_login->ganti_pin === '1' ? '#' : site_url('layanan-mandiri'), 'label' => 'Anjungan'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <?php endif; ?>
                                        <a href="<?php echo e($ci->is_login->ganti_pin === '1' ? '#' : site_url('layanan-mandiri/profil')); ?>" class="btn btn-block btn-social bg-blue">
                                            <i class="fa fa-user-o"></i> Profil
                                        </a>
                                        <a href="<?php echo e($ci->is_login->ganti_pin === '1' ? '#' : site_url('layanan-mandiri/produk')); ?>" class="btn btn-block btn-social bg-blue">
                                            <i class="fa fa-cart-plus"></i> Produk
                                        </a>
                                        <a href="<?php echo e($ci->is_login->ganti_pin === '1' ? '#' : site_url('layanan-mandiri/dokumen')); ?>" class="btn btn-block btn-social bg-aqua">
                                            <i class="fa fa-file"></i> Dokumen
                                        </a>
                                        <a href="<?php echo e($ci->is_login->ganti_pin === '1' ? '#' : site_url('layanan-mandiri/bantuan')); ?>" class="btn btn-block btn-social bg-aqua">
                                            <i class="fa fa-handshake-o"></i> Bantuan
                                        </a>
                                    </div>

                                    <div class="tk-menu-grup">
                                        <div class="tk-menu-judul">Cetak</div>
                                        <a href="<?php echo e($ci->is_login->ganti_pin === '1' ? '#' : site_url('layanan-mandiri/cetak-biodata')); ?>" class="btn btn-block btn-social bg-green" target="_blank" rel="noopener noreferrer">
                                            <i class="fa fa-print"></i> Cetak Biodata
                                        </a>
                                        <?php if($ci->is_login->id_kk != null): ?>
                                            <a href="<?php echo e($ci->is_login->ganti_pin === '1' ? '#' : site_url('layanan-mandiri/cetak-kk')); ?>" class="btn btn-block btn-social bg-green" target="_blank" rel="noopener noreferrer">
                                                <i class="fa fa-print"></i> Cetak Salinan KK
                                            </a>
                                        <?php endif; ?>
                                    </div>

                                    <div class="tk-menu-grup">
                                        <div class="tk-menu-judul">Akun</div>
                                        <a href="<?php echo e(site_url('layanan-mandiri/ganti-pin')); ?>" class="btn btn-block btn-social bg-navy">
                                            <i class="fa fa-key"></i> Ganti PIN
                                        </a>
                                        <a href="<?php echo e($ci->is_login->ganti_pin === '1' ? '#' : site_url('layanan-mandiri/verifikasi')); ?>" class="btn btn-block btn-social bg-purple">
                                            <i class="fa fa-key"></i> Verifikasi
                                        </a>
                                        <button type="button" class="btn btn-block btn-social bg-red" data-toggle="modal" data-target="#pendapat">
                                            <i class="fa fa-sign-out"></i>Keluar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-9">
                            <?php echo $__env->yieldContent('content'); ?>

                            <?php echo $__env->renderWhen($ci->is_login->ganti_pin === '1' && $ci->uri->segment(2) != 'ganti-pin', 'layanan_mandiri.layouts.components.notif', [
                                'pesan' => 'Selamat datang pengguna layanan mandiri <b> ' . ucwords(setting('sebutan_desa') . ' ' . $desa['nama_desa']) . ' </b>, <br>Untuk keamanan akun anda, silakan ganti <b>PIN</b> Anda terlebih dahulu sebelum melanjutkan menggunakan layanan mandiri.',
                                'aksi' => site_url('layanan-mandiri/ganti-pin'),
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>

                            <?php echo $__env->renderWhen($data['status'] == 1, 'layanan_mandiri.layouts.components.notif', $ci->session->flashdata('notif'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
                        </div>
                    </div>
                </section>
                <?php echo $__env->make('layanan_mandiri.layouts.components.pendapat', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>

        <footer class="main-footer">
            <div class="container">
                <div class="pull-right hidden-xs">
                    <b>Versi</b> <?php echo e(AmbilVersi()); ?>

                </div>
                <strong>Aplikasi <a href="https://github.com/OpenSID/OpenSID" target="_blank"> <?php echo e(config_item('nama_aplikasi')); ?></a>, dikembangkan oleh <a href="<?php echo e(config_item('fb_opendesa')); ?>" target="_blank">Komunitas <?php echo e(config_item('nama_aplikasi')); ?></a>.</strong>
            </div>
        </footer>
    </div>

    
    <div id="a11y-widget" class="a11y-widget">
        <button type="button" id="a11y-fab" class="a11y-fab" aria-expanded="false" aria-controls="a11y-panel" aria-label="Buka Alat Aksesibilitas" title="Alat Aksesibilitas">
            <svg viewBox="0 0 24 24" width="26" height="26" fill="currentColor" aria-hidden="true" focusable="false">
                <path d="M12 2a2 2 0 1 1 0 4 2 2 0 0 1 0-4zm8 6.5v1.8c0 .5-.4.9-.9.9-2.2.1-4.1.4-5.1.7V22h-2v-5h-2v5H8V12c-1-.3-2.9-.6-5.1-.7-.5 0-.9-.4-.9-.9V8.5c0-.6.5-1 1.1-.9 2.7.3 5.2.5 8.9.5s6.2-.2 8.9-.5c.6-.1 1.1.3 1.1.9z" />
            </svg>
        </button>

        <div id="a11y-panel" class="a11y-panel" role="dialog" aria-label="Alat Aksesibilitas" hidden>
            <div class="a11y-head">
                <strong>Alat Aksesibilitas</strong>
                <button type="button" class="a11y-close" data-a11y="tutup" aria-label="Tutup Alat Aksesibilitas">&times;</button>
            </div>
            <ul class="a11y-list">
                <!-- <li>
                    <button type="button" class="a11y-item" data-a11y="plus">
                        <span class="a11y-ico" aria-hidden="true">A+</span>
                        <span class="a11y-txt">Perbesar Teks</span>
                        <span class="a11y-val" data-a11y-ukuran>100%</span>
                    </button>
                </li>
                <li>
                    <button type="button" class="a11y-item" data-a11y="minus">
                        <span class="a11y-ico" aria-hidden="true">A&minus;</span>
                        <span class="a11y-txt">Perkecil Teks</span>
                    </button>
                </li> -->
                <li>
                    <button type="button" class="a11y-item" data-a11y="gray" aria-pressed="false">
                        <span class="a11y-ico" aria-hidden="true"><svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9" /><path d="M12 3a9 9 0 0 1 0 18z" fill="currentColor" stroke="none" /></svg></span>
                        <span class="a11y-txt">Skala Abu-abu</span>
                        <span class="a11y-sw" aria-hidden="true"></span>
                    </button>
                </li>
                <li>
                    <button type="button" class="a11y-item" data-a11y="neg" aria-pressed="false">
                        <span class="a11y-ico" aria-hidden="true"><svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="3" /><path d="M3 3h18v18z" fill="currentColor" stroke="none" /></svg></span>
                        <span class="a11y-txt">Kontras Negatif</span>
                        <span class="a11y-sw" aria-hidden="true"></span>
                    </button>
                </li>
                <li>
                    <button type="button" class="a11y-item" data-a11y="underline" aria-pressed="false">
                        <span class="a11y-ico" aria-hidden="true"><span style="text-decoration:underline">U</span></span>
                        <span class="a11y-txt">Garis Bawah Tautan</span>
                        <span class="a11y-sw" aria-hidden="true"></span>
                    </button>
                </li>
                <li>
                    <button type="button" class="a11y-item" data-a11y="tts" aria-pressed="false">
                        <span class="a11y-ico" aria-hidden="true"><svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M3 9v6h4l5 4V5L7 9H3zm13.5 3a4.5 4.5 0 0 0-2.5-4.03v8.06A4.5 4.5 0 0 0 16.5 12zM14 3.23v2.06a7 7 0 0 1 0 13.42v2.06a9 9 0 0 0 0-17.54z" /></svg></span>
                        <span class="a11y-txt">Teks ke Suara</span>
                        <span class="a11y-sw" aria-hidden="true"></span>
                    </button>
                    <p class="a11y-help" data-a11y-tts-bantuan hidden>Blok teks, atau klik paragraf atau judul, untuk mendengarkan.</p>
                </li>
                <li>
                    <button type="button" class="a11y-item a11y-reset" data-a11y="reset">
                        <span class="a11y-ico" aria-hidden="true"><svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M12 5V2L7 6l5 4V7a5 5 0 1 1-5 5H5a7 7 0 1 0 7-7z" /></svg></span>
                        <span class="a11y-txt">Atur Ulang</span>
                    </button>
                </li>
            </ul>
        </div>
        <div id="a11y-live" class="a11y-sr" aria-live="polite" role="status"></div>
    </div>

    <!-- Diperlukan untuk global automatic base_url oleh external js file -->
    <script type="text/javascript">
        const BASE_URL = "<?php echo e(base_url()); ?>";
        const SITE_URL = "<?php echo e(site_url()); ?>";
    </script>
    <!-- jQuery 3 -->
    <script src="<?php echo e(asset('bootstrap/js/jquery.min.js')); ?>"></script>

    <?php echo $__env->make('admin.layouts.components.token', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Jquery UI -->
    <script src="<?php echo e(asset('bootstrap/js/jquery-ui.min.js')); ?>"></script>
    <script src="<?php echo e(asset('bootstrap/js/jquery.ui.autocomplete.scroll.min.js')); ?>"></script>

    <script src="<?php echo e(asset('bootstrap/js/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('bootstrap/js/moment-timezone.js')); ?>"></script>
    <script src="<?php echo e(asset('bootstrap/js/moment-timezone-with-data.js')); ?>"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?php echo e(asset('bootstrap/js/bootstrap.min.js')); ?>"></script>
    <!-- Select2 -->
    <script src="<?php echo e(asset('bootstrap/js/select2.full.min.js')); ?>"></script>
    <!-- DataTables -->
    <script src="<?php echo e(asset('bootstrap/js/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('bootstrap/js/dataTables.bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('bootstrap/js/dataTables.rowsgroup.min.js')); ?>"></script>
    <!-- bootstrap color picker -->
    <script src="<?php echo e(asset('bootstrap/js/bootstrap-colorpicker.min.js')); ?>"></script>
    <!-- bootstrap Date time picker -->
    <script src="<?php echo e(asset('bootstrap/js/bootstrap-datetimepicker.min.js')); ?>"></script>
    <script src="<?php echo e(asset('bootstrap/js/id.js')); ?>"></script>
    <!-- bootstrap Date picker -->
    <script src="<?php echo e(asset('bootstrap/js/bootstrap-datepicker.min.js')); ?>"></script>
    <script src="<?php echo e(asset('bootstrap/js/bootstrap-datepicker.id.min.js')); ?>"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?php echo e(asset('bootstrap/js/bootstrap3-wysihtml5.all.min.js')); ?>"></script>
    <!-- Slimscroll -->
    <script src="<?php echo e(asset('bootstrap/js/jquery.slimscroll.min.js')); ?>"></script>
    <!-- FastClick -->
    <script src="<?php echo e(asset('bootstrap/js/fastclick.js')); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo e(asset('js/adminlte.min.js')); ?>"></script>
    <script src="<?php echo e(asset('front/js/jquery.overlay.min.js')); ?>"></script>
    <script src="<?php echo e(asset('front/js/jquery-confirm.min.js')); ?>"></script>
    <!-- Validasi js -->
    <?php echo $__env->make('admin.layouts.components.validasi_form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Numeral js -->
    <script src="<?php echo e(asset('js/numeral.min.js')); ?>"></script>
    <!-- Khusus modul layanan mandiri -->
    <script src="<?php echo e(asset('front/js/mandiri.js')); ?>"></script>

    <?php if($cek_anjungan): ?>
        <!-- keyboard widget script -->
        <script src="<?php echo e(asset('js/jquery.keyboard.min.js')); ?>"></script>
        <script src="<?php echo e(asset('js/jquery.mousewheel.min.js')); ?>"></script>
        <script src="<?php echo e(asset('js/jquery.keyboard.extension-all.min.js')); ?>"></script>
        <script src="<?php echo e(asset('front/js/mandiri-keyboard.js')); ?>"></script>
    <?php endif; ?>

    <!-- TEMAKU: mode gelap/terang + alat aksesibilitas -->
    <script src="<?php echo e(asset('js/mandiri-temaku.js')); ?>"></script>

    <script type="text/javascript">
        $(window).on('load', function() {
            $('#notif').modal('show');
        });

        $('document').ready(function() {

            window.setTimeout(function() {
                $("#notifikasi").fadeTo(500, 0).slideUp(500, function() {
                    $(this).remove();
                });
            }, 1000);

            setTimeout(function() {
                refresh_badge($("#b_pesan"), "<?php echo e(site_url('notif_web/inbox')); ?>");
                refresh_badge($("#b_surat"), "<?php echo e(site_url('notif_web/surat_perlu_perhatian')); ?>");
            }, 500);

            $.extend($.fn.dataTable.defaults, {
                responsive: true,
                processing: true,
                serverSide: true,
                autoWidth: false,
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "Semua"]
                ],
                pageLength: 10,
                language: {
                    url: "<?php echo e(asset('bootstrap/js/dataTables.indonesian.lang')); ?>",
                }
            });
        });
    </script>

    <?php if(cek_koneksi_internet()): ?>
        <!-- Form Wizard - jquery.smartWizard -->
        <script src="https://cdn.jsdelivr.net/npm/smartwizard@5/dist/js/jquery.smartWizard.min.js"></script>
    <?php endif; ?>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>

</html><?php /**PATH D:\laragon\www\opensid\resources\views/layanan_mandiri/layouts/index.blade.php ENDPATH**/ ?>