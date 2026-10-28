{{-- Menu laci (drawer) untuk ponsel dan tablet. Dibuka dari tombol garis tiga di header. --}}
@php
    $smd_menu = menu_tema();
    $smd_nama = ucwords(setting('sebutan_desa')) . ' ' . ucwords($desa['nama_desa']);
@endphp
<div class="smd-overlay" data-smd-close="drawer" hidden></div>
<aside class="smd-drawer" id="smd-drawer" aria-label="Menu" aria-hidden="true">
    <div class="smd-drawer__head">
        <a href="{{ site_url('/') }}" class="smd-brand smd-brand--sm">
            <img src="{{ gambar_desa($desa['logo']) }}" alt="Logo {{ $smd_nama }}" class="smd-brand__logo">
            <span class="smd-brand__name">{{ $smd_nama }}</span>
        </a>
        <button type="button" class="smd-iconbtn" data-smd-close="drawer" aria-label="Tutup menu">
            <i class="fas fa-times" aria-hidden="true"></i>
        </button>
    </div>

    <form action="{{ site_url('/') }}" method="get" role="search" class="smd-drawer__search">
        <i class="fas fa-search" aria-hidden="true"></i>
        <input type="search" name="cari" placeholder="Cari..." aria-label="Kata kunci pencarian">
    </form>

    <nav class="smd-drawer__nav" aria-label="Menu utama">
        <ul class="smd-acc">
            <li><a href="{{ site_url('/') }}" class="smd-acc__link"><i class="fas fa-home" aria-hidden="true"></i> Beranda</a></li>
            @if ($smd_menu)
                @foreach ($smd_menu as $menu)
                    @php $punya_anak = count($menu['childrens'] ?? []) > 0 @endphp
                    <li>
                        @if ($punya_anak)
                            <button type="button" class="smd-acc__link smd-acc__toggle" aria-expanded="false">
                                <span>{!! $menu['nama'] !!}</span>
                                <i class="fas fa-chevron-down" aria-hidden="true"></i>
                            </button>
                            <ul class="smd-acc__panel" hidden>
                                @foreach ($menu['childrens'] as $anak)
                                    @php $punya_cucu = count($anak['childrens'] ?? []) > 0 @endphp
                                    <li>
                                        @if ($punya_cucu)
                                            <button type="button" class="smd-acc__link smd-acc__toggle" aria-expanded="false">
                                                <span>{!! $anak['nama'] !!}</span>
                                                <i class="fas fa-chevron-down" aria-hidden="true"></i>
                                            </button>
                                            <ul class="smd-acc__panel" hidden>
                                                @foreach ($anak['childrens'] as $cucu)
                                                    @php $punya_cicit = count($cucu['childrens'] ?? []) > 0 @endphp
                                                    <li>
                                                        @if ($punya_cicit)
                                                            <button type="button" class="smd-acc__link smd-acc__toggle" aria-expanded="false">
                                                                <span>{!! $cucu['nama'] !!}</span>
                                                                <i class="fas fa-chevron-down" aria-hidden="true"></i>
                                                            </button>
                                                            <ul class="smd-acc__panel" hidden>
                                                                @foreach ($cucu['childrens'] as $cicit)
                                                                    <li><a href="{{ $cicit['link_url'] }}" class="smd-acc__link">{!! $cicit['nama'] !!}</a></li>
                                                                @endforeach
                                                            </ul>
                                                        @else
                                                            <a href="{{ $cucu['link_url'] }}" class="smd-acc__link">{!! $cucu['nama'] !!}</a>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <a href="{{ $anak['link_url'] }}" class="smd-acc__link">{!! $anak['nama'] !!}</a>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <a href="{{ $menu['link_url'] }}" class="smd-acc__link">{!! $menu['nama'] !!}</a>
                        @endif
                    </li>
                @endforeach
            @endif
        </ul>
    </nav>

    <div class="smd-drawer__foot">
        @if (setting('layanan_mandiri') == 1)
            <a href="{{ site_url('layanan-mandiri') }}" class="smd-btn smd-btn--primary smd-btn--block"><i class="fas fa-id-card" aria-hidden="true"></i> Layanan Mandiri</a>
        @endif
        <a href="{{ site_url('siteman') }}" class="smd-btn smd-btn--ghost smd-btn--block"><i class="fas fa-sign-in-alt" aria-hidden="true"></i> Login Admin</a>
    </div>
</aside>
