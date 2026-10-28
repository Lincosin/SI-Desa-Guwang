{{-- Menu utama untuk layar lebar (desktop). Mendukung hingga 4 tingkat. --}}
@php $smd_menu = menu_tema() @endphp
<nav class="smd-nav" aria-label="Menu utama">
    <ul class="smd-nav__list">
        <li class="smd-nav__item">
            <a href="{{ site_url('/') }}" class="smd-nav__link">Beranda</a>
        </li>
        @if ($smd_menu)
            @foreach ($smd_menu as $menu)
                @php $punya_anak = count($menu['childrens'] ?? []) > 0 @endphp
                <li class="smd-nav__item {{ $punya_anak ? 'smd-has-sub' : '' }}">
                    <a href="{{ $punya_anak ? '#!' : $menu['link_url'] }}" class="smd-nav__link" @if ($punya_anak) aria-haspopup="true" @endif>
                        {!! $menu['nama'] !!}
                        @if ($punya_anak)
                            <i class="fas fa-chevron-down smd-caret" aria-hidden="true"></i>
                        @endif
                    </a>
                    @if ($punya_anak)
                        <ul class="smd-sub">
                            @foreach ($menu['childrens'] as $anak)
                                @php $punya_cucu = count($anak['childrens'] ?? []) > 0 @endphp
                                <li class="{{ $punya_cucu ? 'smd-has-sub' : '' }}">
                                    <a href="{{ $punya_cucu ? '#!' : $anak['link_url'] }}" @if ($punya_cucu) aria-haspopup="true" @endif>
                                        <span>{!! $anak['nama'] !!}</span>
                                        @if ($punya_cucu)
                                            <i class="fas fa-chevron-right" aria-hidden="true"></i>
                                        @endif
                                    </a>
                                    @if ($punya_cucu)
                                        <ul class="smd-sub smd-sub--side">
                                            @foreach ($anak['childrens'] as $cucu)
                                                @php $punya_cicit = count($cucu['childrens'] ?? []) > 0 @endphp
                                                <li class="{{ $punya_cicit ? 'smd-has-sub' : '' }}">
                                                    <a href="{{ $punya_cicit ? '#!' : $cucu['link_url'] }}" @if ($punya_cicit) aria-haspopup="true" @endif>
                                                        <span>{!! $cucu['nama'] !!}</span>
                                                        @if ($punya_cicit)
                                                            <i class="fas fa-chevron-right" aria-hidden="true"></i>
                                                        @endif
                                                    </a>
                                                    @if ($punya_cicit)
                                                        <ul class="smd-sub smd-sub--side">
                                                            @foreach ($cucu['childrens'] as $cicit)
                                                                <li><a href="{{ $cicit['link_url'] }}"><span>{!! $cicit['nama'] !!}</span></a></li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        @endif
    </ul>
</nav>
