@php
    $smd_nama_desa = ucwords(setting('sebutan_desa')) . ' ' . ucwords($desa['nama_desa']);
    $smd_lokasi = ucfirst(setting('sebutan_kecamatan_singkat')) . ' ' . ucwords($desa['nama_kecamatan']) . ', ' . ucfirst(setting('sebutan_kabupaten_singkat')) . ' ' . ucwords($desa['nama_kabupaten']);
    $smd_beranda = !request()->segment(1) && empty($cari ?? null);
@endphp

{{-- Bilah atas: tanggal, kontak singkat, dan tautan masuk --}}
<div class="smd-topbar">
    <div class="smd-container smd-topbar__inner">
        <div class="smd-topbar__info">
            <span><i class="far fa-calendar-alt" aria-hidden="true"></i> {{ tgl_indo(date('Y-m-d')) }}</span>
            <span class="smd-clock" data-smd-clock hidden><i class="far fa-clock" aria-hidden="true"></i> <time></time></span>
            @if (!empty($desa['telepon']))
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $desa['telepon']) }}" class="smd-hide-sm"><i class="fas fa-phone-alt" aria-hidden="true"></i> {{ $desa['telepon'] }}</a>
            @endif
            @if (!empty($desa['email_desa']))
                <a href="mailto:{{ $desa['email_desa'] }}" class="smd-hide-sm"><i class="far fa-envelope" aria-hidden="true"></i> {{ $desa['email_desa'] }}</a>
            @endif
        </div>
        <div class="smd-topbar__links">
            @if (setting('layanan_mandiri') == 1)
                <a href="{{ site_url('layanan-mandiri') }}"><i class="fas fa-id-card" aria-hidden="true"></i> Layanan Mandiri</a>
            @endif
            <a href="{{ site_url('siteman') }}"><i class="fas fa-sign-in-alt" aria-hidden="true"></i> Login Admin</a>
        </div>
    </div>
</div>

{{-- Bilah navigasi utama (lengket di atas saat digulir) --}}
<header class="smd-navbar" id="smd-navbar">
    <div class="smd-container smd-navbar__inner">
        <a href="{{ site_url('/') }}" class="smd-brand" title="Beranda {{ $smd_nama_desa }}">
            <img src="{{ gambar_desa($desa['logo']) }}" alt="Logo {{ $smd_nama_desa }}" class="smd-brand__logo">
            <span class="smd-brand__text">
                <span class="smd-brand__name">{{ $smd_nama_desa }}</span>
                <span class="smd-brand__loc">{{ $smd_lokasi }}</span>
            </span>
        </a>

        @include('theme::commons.main_menu')

        <div class="smd-navbar__actions">
            <button type="button" class="smd-iconbtn" data-smd-toggle="search" aria-controls="smd-search" aria-expanded="false" aria-label="Cari">
                <i class="fas fa-search" aria-hidden="true"></i>
            </button>
            <button type="button" class="smd-iconbtn smd-burger" data-smd-toggle="drawer" aria-controls="smd-drawer" aria-expanded="false" aria-label="Buka menu">
                <i class="fas fa-bars" aria-hidden="true"></i>
            </button>
        </div>
    </div>

    <div class="smd-search" id="smd-search" hidden>
        <form action="{{ site_url('/') }}" method="get" role="search" class="smd-container smd-search__form">
            <i class="fas fa-search" aria-hidden="true"></i>
            <input type="search" name="cari" placeholder="Cari berita, pengumuman, informasi..." aria-label="Kata kunci pencarian" value="{{ $cari ?? '' }}">
            <button type="submit" class="smd-btn smd-btn--primary">Cari</button>
        </form>
    </div>
</header>

@include('theme::commons.mobile_menu')

@if ($smd_beranda && theme_config('tampilkan_banner', '1') == '1')
    @php
        // Angka ringkas untuk bilah statistik: penduduk (dari statistik jenis kelamin) & pengunjung
        $smd_baris = collect($stat_widget ?? [])->map(static fn ($r) => is_array($r) ? $r : (method_exists($r, 'toArray') ? $r->toArray() : (array) $r));
        $smd_cari_baris = static fn ($kata) => $smd_baris->first(static fn ($r) => str_contains(strtoupper($r['nama'] ?? ''), $kata));
        $smd_total = $smd_cari_baris('TOTAL') ?? $smd_cari_baris('JUMLAH');
        $smd_angka = [];
        if ($smd_total || $smd_baris->isNotEmpty()) {
            $smd_angka[] = ['nilai' => (int) ($smd_total['jumlah'] ?? $smd_baris->sum('jumlah')), 'label' => 'Penduduk', 'ikon' => 'fa-users'];
        }
        if ($smd_lk = $smd_cari_baris('LAKI')) {
            $smd_angka[] = ['nilai' => (int) $smd_lk['jumlah'], 'label' => 'Laki-laki', 'ikon' => 'fa-male'];
        }
        if ($smd_pr = $smd_cari_baris('PEREMPUAN')) {
            $smd_angka[] = ['nilai' => (int) $smd_pr['jumlah'], 'label' => 'Perempuan', 'ikon' => 'fa-female'];
        }
        if (isset($statistik_pengunjung['total'])) {
            $smd_angka[] = ['nilai' => (int) $statistik_pengunjung['total'], 'label' => 'Pengunjung', 'ikon' => 'fa-globe-asia'];
        }
        $smd_kata = array_values(array_filter(array_map('trim', explode(',', (string) theme_config('kata_berganti', 'Melayani, Transparan, Inovatif, Berdaya')))));

        // Latar banner: gambar latar website, disusul gambar slider (berganti otomatis)
        $smd_latar = array_filter([$latar_website ?? null]);
        foreach (array_slice($slider_gambar['gambar'] ?? [], 0, 4) as $smd_slide) {
            $smd_img = ($slider_gambar['lokasi'] ?? '') . 'sedang_' . $smd_slide['gambar'];
            if (is_file($smd_img)) {
                $smd_latar[] = base_url($smd_img);
            }
        }
        $smd_latar = array_values($smd_latar);

        // Kartu kaca: status pelayanan kantor hari ini dari Jam Kerja
        $smd_hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'][(int) date('w')];
        $smd_normal = static fn ($t) => strtolower(preg_replace('/[^a-z]/i', '', (string) $t));
        $smd_jam = collect($jam_kerja ?? [])->first(static fn ($j) => $smd_normal(data_get($j, 'nama_hari')) === $smd_normal($smd_hari));
        $smd_buka = $smd_jam && data_get($smd_jam, 'status');
        $smd_jam_masuk = $smd_buka ? substr((string) data_get($smd_jam, 'jam_masuk'), 0, 5) : null;
        $smd_jam_keluar = $smd_buka ? substr((string) data_get($smd_jam, 'jam_keluar'), 0, 5) : null;

        // Foto perangkat desa untuk deretan avatar
        $smd_perangkat = array_slice(array_values(array_filter($aparatur_desa['daftar_perangkat'] ?? [], static fn ($a) => !empty($a['foto']))), 0, 4);
        $smd_jumlah_perangkat = count($aparatur_desa['daftar_perangkat'] ?? []);
    @endphp
    <section class="smd-hero smd-hero--glass" aria-label="Sambutan">
        <div class="smd-hero__media" aria-hidden="true">
            <div class="smd-hero__bg">
                @forelse ($smd_latar as $smd_i => $smd_src)
                    <div class="smd-hero__slide {{ $smd_i === 0 ? 'is-active is-zoom' : '' }}" style="background-image: url('{{ $smd_src }}');"></div>
                @empty
                    <div class="smd-hero__slide is-active is-zoom"></div>
                @endforelse
            </div>
            <div class="smd-hero__shade"></div>
            {{-- Peralihan foto ke halaman: gradasi biru ke putih --}}
            <div class="smd-hero__veil"></div>
        </div>

        <div class="smd-container smd-hero__inner">
            <div class="smd-hero__text">
                <span class="smd-hero__eyebrow smd-enter" style="--d: 0ms"><span class="smd-dot" aria-hidden="true"></span>{{ theme_config('teks_sambutan', 'Selamat Datang di Website Resmi') }}</span>
                <h1 class="smd-hero__title smd-enter" style="--d: 120ms">{{ $smd_nama_desa }}</h1>
                @if (count($smd_kata) > 0)
                    <p class="smd-hero__tagline smd-enter" style="--d: 220ms">
                        Bersama membangun {{ setting('sebutan_desa') }} yang
                        <span class="smd-rotator" data-words="{{ implode('|', $smd_kata) }}"><span class="smd-rotator__word">{{ $smd_kata[0] }}</span></span>
                    </p>
                @endif
                <p class="smd-hero__loc smd-enter" style="--d: 300ms">
                    <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                    {{ $smd_lokasi }}, Provinsi {{ ucwords($desa['nama_propinsi']) }}
                </p>
                <div class="smd-hero__cta smd-enter" style="--d: 400ms">
                    <a href="#smd-kabar" class="smd-btn smd-btn--primary smd-btn--lg">Jelajahi Kabar {{ ucwords(setting('sebutan_desa')) }}</a>
                    <a href="{{ site_url('data-statistik/jenis-kelamin') }}" class="smd-btn smd-btn--glass smd-btn--lg">Lihat Data <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
                </div>
                @if (count($smd_perangkat) > 0)
                    <div class="smd-hero__proof smd-enter" style="--d: 500ms">
                        <span class="smd-avatars">
                            @foreach ($smd_perangkat as $smd_p)
                                <img src="{{ $smd_p['foto'] }}" alt="{{ $smd_p['nama'] }}" title="{{ $smd_p['nama'] }}">
                            @endforeach
                        </span>
                        <span><strong>{{ $smd_jumlah_perangkat }} perangkat {{ setting('sebutan_desa') }}</strong><br>siap melayani Anda</span>
                    </div>
                @elseif (isset($statistik_pengunjung['hari_ini']))
                    <div class="smd-hero__proof smd-enter" style="--d: 500ms">
                        <span class="smd-hero__proof-icon"><i class="fas fa-signal" aria-hidden="true"></i></span>
                        <span><strong>{{ number_format((int) $statistik_pengunjung['hari_ini'], 0, ',', '.') }} kunjungan</strong><br>ke website hari ini</span>
                    </div>
                @endif
            </div>

            {{-- Kartu kaca: pelayanan kantor hari ini --}}
            <div class="smd-hero__cardwrap smd-enter" style="--d: 300ms">
                <aside class="smd-glass smd-hero__card" aria-label="Pelayanan kantor hari ini">
                    <div class="smd-hero__card-top">
                        <span><i class="fas fa-landmark" aria-hidden="true"></i> Kantor {{ ucwords(setting('sebutan_desa')) }}</span>
                        <i class="fas fa-chevron-down" aria-hidden="true"></i>
                    </div>
                    @if ($smd_buka)
                        <p class="smd-hero__card-title" data-smd-office data-buka="{{ $smd_jam_masuk }}" data-tutup="{{ $smd_jam_keluar }}">
                            <span class="smd-status smd-status--open"></span><span data-smd-office-text>Buka Hari Ini</span>
                        </p>
                        <p class="smd-hero__card-sub">{{ $smd_hari }}, {{ tgl_indo(date('Y-m-d')) }}</p>
                        <div class="smd-hero__card-line"></div>
                        <p class="smd-hero__card-label">Jam pelayanan</p>
                        <p class="smd-hero__card-big">{{ str_replace(':', '.', $smd_jam_masuk) }}<small>&ndash;{{ str_replace(':', '.', $smd_jam_keluar) }}</small></p>
                    @elseif ($smd_jam)
                        <p class="smd-hero__card-title"><span class="smd-status smd-status--closed"></span>Libur Hari Ini</p>
                        <p class="smd-hero__card-sub">{{ $smd_hari }}, {{ tgl_indo(date('Y-m-d')) }}</p>
                        <div class="smd-hero__card-line"></div>
                        <p class="smd-hero__card-label">Layanan online tetap tersedia</p>
                        <p class="smd-hero__card-big">24<small>/7</small></p>
                    @else
                        <p class="smd-hero__card-title">Layanan Publik</p>
                        <p class="smd-hero__card-sub">{{ $desa['alamat_kantor'] ?? $smd_lokasi }}</p>
                        <div class="smd-hero__card-line"></div>
                        <p class="smd-hero__card-label">Layanan online</p>
                        <p class="smd-hero__card-big">24<small>/7</small></p>
                    @endif
                    @if (setting('layanan_mandiri') == 1)
                        <a href="{{ site_url('layanan-mandiri') }}" class="smd-btn smd-btn--white smd-btn--block">Ajukan Surat Online</a>
                    @elseif (!empty($desa['telepon']))
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $desa['telepon']) }}" class="smd-btn smd-btn--white smd-btn--block">Hubungi Kantor</a>
                    @endif
                </aside>
            </div>
        </div>

        @if (theme_config('tampilkan_statistik', '1') == '1' && count($smd_angka) > 0)
            <div class="smd-container smd-hero__bar">
                <div class="smd-glass smd-statbar smd-enter" style="--d: 600ms" role="list" aria-label="Angka {{ setting('sebutan_desa') }}">
                    @foreach ($smd_angka as $angka)
                        <div class="smd-statbar__item" role="listitem">
                            <span class="smd-statbar__icon"><i class="fas {{ $angka['ikon'] }}" aria-hidden="true"></i></span>
                            <div>
                                <strong class="smd-statbar__num" data-count="{{ $angka['nilai'] }}">{{ number_format($angka['nilai'], 0, ',', '.') }}</strong>
                                <span class="smd-statbar__label">{{ $angka['label'] }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </section>
@endif

@if ($teks_berjalan)
    <div class="smd-container">
        <div class="smd-ticker" role="region" aria-label="Info terkini">
            <span class="smd-ticker__label"><i class="fas fa-bullhorn" aria-hidden="true"></i> Info</span>
            <div class="smd-ticker__viewport">
                <div class="smd-ticker__track">
                    @for ($smd_ulang = 0; $smd_ulang < 2; $smd_ulang++)
                        @foreach ($teks_berjalan as $marquee)
                            <span class="smd-ticker__item" @if ($smd_ulang) aria-hidden="true" @endif>
                                {{ $marquee['teks'] }}
                                @if (trim($marquee['tautan']) && $marquee['judul_tautan'])
                                    <a href="{{ $marquee['tautan'] }}" @if ($smd_ulang) tabindex="-1" @endif>{{ $marquee['judul_tautan'] }}</a>
                                @endif
                            </span>
                        @endforeach
                    @endfor
                </div>
            </div>
        </div>
    </div>
@endif

