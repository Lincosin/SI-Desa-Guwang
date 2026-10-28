@if (($transparansi ?? null) && !($smd_landing ?? false))
    <div class="smd-container smd-apbdes">
        @include('theme::partials.apbdesa', $transparansi)
    </div>
@endif

@php
    $smd_nama_desa = ucwords(setting('sebutan_desa')) . ' ' . ucwords($desa['nama_desa']);
    $alt_slug = PREMIUM ? 'artikel' : 'first';
    $smd_ikon_sosmed = [
        'facebook' => 'fa-facebook-f',
        'twitter' => 'fa-twitter',
        'x' => 'fa-twitter',
        'instagram' => 'fa-instagram',
        'telegram' => 'fa-telegram-plane',
        'whatsapp' => 'fa-whatsapp',
        'youtube' => 'fa-youtube',
        'tiktok' => 'fa-tiktok',
    ];
@endphp

@include('theme::commons.back_to_top')

<footer class="smd-footer footer">
    <svg class="smd-footer__wave" viewBox="0 0 1440 80" preserveAspectRatio="none" aria-hidden="true">
        <path d="M0,48 C240,88 480,8 720,40 C960,72 1200,24 1440,44 L1440,80 L0,80 Z" />
    </svg>
    <div class="smd-container smd-footer__grid">
        <div class="smd-footer__col smd-footer__about">
            <a href="{{ site_url('/') }}" class="smd-brand smd-brand--light">
                <img src="{{ gambar_desa($desa['logo']) }}" alt="Logo {{ $smd_nama_desa }}" class="smd-brand__logo">
                <span class="smd-brand__text">
                    <span class="smd-brand__name">{{ $smd_nama_desa }}</span>
                    <span class="smd-brand__loc">{{ ucfirst(setting('sebutan_kabupaten')) }} {{ ucwords($desa['nama_kabupaten']) }}</span>
                </span>
            </a>
            <p>Website resmi Pemerintah {{ $smd_nama_desa }}. Media informasi, transparansi, dan pelayanan publik bagi seluruh warga.</p>
            @if (!empty($sosmed))
                <ul class="smd-social" aria-label="Media sosial">
                    @foreach ($sosmed as $sm)
                        @if (!empty($sm['link']))
                            @php $kunci = strtolower(trim($sm['nama'])) @endphp
                            <li>
                                <a href="{{ $sm['link'] }}" target="_blank" rel="noopener" title="{{ $sm['nama'] }}" aria-label="{{ $sm['nama'] }}">
                                    @if (isset($smd_ikon_sosmed[$kunci]))
                                        <i class="fab {{ $smd_ikon_sosmed[$kunci] }}" aria-hidden="true"></i>
                                    @else
                                        <img src="{{ $sm['icon'] }}" alt="">
                                    @endif
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="smd-footer__col">
            <h2 class="smd-footer__title">Kontak</h2>
            <ul class="smd-footer__contact">
                @if (!empty($desa['alamat_kantor']))
                    <li><i class="fas fa-map-marker-alt" aria-hidden="true"></i><span>{{ $desa['alamat_kantor'] }}@if (!empty($desa['kode_pos'])), {{ $desa['kode_pos'] }}@endif</span></li>
                @endif
                @if (!empty($desa['telepon']))
                    <li><i class="fas fa-phone-alt" aria-hidden="true"></i><a href="tel:{{ preg_replace('/[^0-9+]/', '', $desa['telepon']) }}">{{ $desa['telepon'] }}</a></li>
                @endif
                @if (!empty($desa['email_desa']))
                    <li><i class="far fa-envelope" aria-hidden="true"></i><a href="mailto:{{ $desa['email_desa'] }}">{{ $desa['email_desa'] }}</a></li>
                @endif
                <li><i class="fas fa-globe-asia" aria-hidden="true"></i><span>{{ ucfirst(setting('sebutan_kecamatan')) }} {{ ucwords($desa['nama_kecamatan']) }}, Provinsi {{ ucwords($desa['nama_propinsi']) }}</span></li>
            </ul>
        </div>

        <div class="smd-footer__col">
            <h2 class="smd-footer__title">Tautan</h2>
            <ul class="smd-footer__links">
                <li><a href="{{ site_url('/') }}">Beranda</a></li>
                <li><a href="{{ site_url('arsip') }}">Arsip Berita</a></li>
                <li><a href="{{ site_url('galeri') }}">Galeri</a></li>
                @if (setting('layanan_mandiri') == 1)
                    <li><a href="{{ site_url('layanan-mandiri') }}">Layanan Mandiri</a></li>
                @endif
                <li><a href="{{ site_url('siteman') }}">Login Admin</a></li>
            </ul>
        </div>

        @if (!empty($menu_kiri))
            <div class="smd-footer__col">
                <h2 class="smd-footer__title">Kategori</h2>
                <ul class="smd-footer__links">
                    @foreach (array_slice(is_array($menu_kiri) ? $menu_kiri : collect($menu_kiri)->all(), 0, 6) as $menu)
                        <li><a href="{{ site_url("{$alt_slug}/kategori/{$menu['slug']}") }}">{{ $menu['kategori'] }}</a></li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <div class="smd-footer__bottom">
        <div class="smd-container smd-footer__bottom-inner">
            <p>&copy; {{ date('Y') }} {{ $smd_nama_desa }}. Hak cipta dilindungi.</p>
            <p class="smd-footer__credit">
                Tema Samudra {{ $themeVersion }} &middot;
                <a href="https://opensid.my.id" target="_blank" rel="noopener">OpenSID {{ ambilVersi() }}</a>
                @if (file_exists('mitra'))
                    &middot; Hosting didukung
                    <a href="https://my.idcloudhost.com/aff.php?aff=3172" rel="noopener noreferrer" target="_blank">
                        <img src="{{ base_url('/assets/images/Logo-IDcloudhost.png') }}" class="smd-footer__mitra" alt="Logo IDCloudHost" title="Logo IDCloudHost">
                    </a>
                @endif
            </p>
            @if (setting('tte'))
                <img src="{{ asset('assets/images/bsre.png?v', false) }}" alt="Didukung BSrE" class="smd-footer__bsre" />
            @endif
        </div>
    </div>
</footer>
