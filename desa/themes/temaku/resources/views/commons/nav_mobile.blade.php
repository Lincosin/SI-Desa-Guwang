{{-- Daftar submenu bertingkat untuk drawer mobile (rekursif). $items = anak menu OpenSID ('childrens'). --}}
@foreach ($items as $child)
    @php
        $anak = $child['childrens'] ?? [];
        $url = $child['link_url'] ?? $child['link'] ?? '#';
    @endphp
    <a href="{{ $url }}" class="block py-1.5 text-sm">{!! $child['nama'] !!}</a>
    @if (! empty($anak))
        <div class="pl-4 border-l border-gray-200 ml-2">
            @include('theme::commons.nav_mobile', ['items' => $anak])
        </div>
    @endif
@endforeach
