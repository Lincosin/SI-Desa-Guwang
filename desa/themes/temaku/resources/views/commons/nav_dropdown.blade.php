@php
    // Deteksi apakah menu ini memiliki anak menu berkategori (Mega Menu)
    $hasGrandChildren = collect($items)->contains(function($item) {
        return !empty($item['childrens']);
    });
@endphp

<div class="guwang-dropdown {{ $level > 1 ? 'guwang-dropdown-sub' : '' }} {{ $hasGrandChildren && $level === 1 ? 'guwang-mega-menu' : '' }}">
    @if ($hasGrandChildren && $level === 1)
        {{-- TAMPILAN MEGA MENU MULTI-KOLOM (Gaya Pemprov Bali) --}}
        <div class="guwang-mega-grid">
            @foreach ($items as $child)
                @php
                    $anak = $child['childrens'] ?? [];
                    $url = $child['link_url'] ?? $child['link'] ?? '#';
                @endphp
                <div class="guwang-mega-col">
                    {{-- Header Kategori Kolom (misal: Badan / Dinas / Lembaga) --}}
                    <span class="guwang-mega-header">{!! $child['nama'] !!}</span>
                    <div class="guwang-mega-links">
                        @if (!empty($anak))
                            @foreach ($anak as $subChild)
                                @php
                                    $subUrl = $subChild['link_url'] ?? $subChild['link'] ?? '#';
                                @endphp
                                <a href="{{ $subUrl }}" class="guwang-mega-item">{!! $subChild['nama'] !!}</a>
                            @endforeach
                        @else
                            <a href="{{ $url }}" class="guwang-mega-item">{!! $child['nama'] !!}</a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        {{-- TAMPILAN DROPDOWN BIASA (Jika satu kolom biasa atau sub-level berikutnya) --}}
        @foreach ($items as $child)
            @php
                $anak = $child['childrens'] ?? [];
                $url = $child['link_url'] ?? $child['link'] ?? '#';
            @endphp
            @if (! empty($anak))
                <div class="guwang-sub-item">
                    <a href="{{ $url }}" class="guwang-sub-link">
                        <span>{!! $child['nama'] !!}</span>
                        <span class="material-symbols-outlined text-[16px]" aria-hidden="true">chevron_right</span>
                    </a>
                    @include('theme::commons.nav_dropdown', ['items' => $anak, 'level' => $level + 1])
                </div>
            @else
                <a href="{{ $url }}" class="guwang-dropdown-link">{!! $child['nama'] !!}</a>
            @endif
        @endforeach
    @endif
</div>