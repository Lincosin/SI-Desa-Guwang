{{--
    Menu utama desktop (gaya mega-dropdown seperti portal pemerintah).
    Data dari menu_tema() (menu OpenSID: Admin Web > Menu), mendukung hingga 4 tingkat.
    - Menu tanpa anak              : tautan biasa
    - Anak yang semuanya tautan    : dropdown daftar sederhana
    - Ada cucu (sub-sub-menu)      : panel lebar berisi kolom; anak = judul kelompok, cucu = tautan
--}}
@php
    $menuAtas = menu_tema() ?: [];
@endphp
<nav class="relative hidden lg:block bg-primary text-on-primary" role="navigation" aria-label="Menu utama">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <ul class="flex items-stretch flex-wrap">
            <li>
                <a href="{{ site_url('/') }}" title="Beranda" aria-label="Beranda" class="flex items-center h-full px-4 py-3 hover:bg-primary-container transition-colors">
                    <span class="material-symbols-outlined text-[22px]">home</span>
                </a>
            </li>

            @foreach ($menuAtas as $menu)
                @php
                    $anak = $menu['childrens'] ?? [];
                    $adaAnak = count($anak) > 0;
                    $mega = collect($anak)->contains(fn ($c) => count($c['childrens'] ?? []) > 0);
                @endphp
                <li class="group {{ $adaAnak && !$mega ? 'relative' : '' }}">
                    @if ($adaAnak)
                        <button type="button" aria-haspopup="true" class="flex items-center gap-1 h-full px-4 py-3 font-label-lg text-label-lg hover:bg-primary-container group-hover:bg-primary-container group-focus-within:bg-primary-container transition-colors">
                            <span>{!! $menu['nama'] !!}</span>
                            <span class="material-symbols-outlined text-[18px] transition-transform group-hover:rotate-180">expand_more</span>
                        </button>
                    @else
                        <a href="{{ $menu['link_url'] }}" class="flex items-center h-full px-4 py-3 font-label-lg text-label-lg hover:bg-primary-container transition-colors">{!! $menu['nama'] !!}</a>
                    @endif

                    @if ($adaAnak && !$mega)
                        {{-- Dropdown sederhana --}}
                        <div class="absolute top-full {{ $loop->index >= 5 ? 'right-0' : 'left-0' }} z-50 min-w-[260px] bg-surface-container-lowest text-on-surface shadow-xl rounded-b-xl border-t-4 border-tertiary-fixed invisible opacity-0 group-hover:visible group-hover:opacity-100 group-focus-within:visible group-focus-within:opacity-100 transition-all duration-150">
                            <ul class="py-2">
                                @foreach ($anak as $child)
                                    <li>
                                        <a href="{{ $child['link_url'] }}" class="block px-5 py-2.5 font-body-md text-caption hover:bg-surface-container-low hover:text-primary transition-colors">{!! $child['nama'] !!}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @elseif ($adaAnak && $mega)
                        {{-- Panel lebar berkolom --}}
                        @php
                            $tautanLangsung = collect($anak)->filter(fn ($c) => count($c['childrens'] ?? []) === 0);
                        @endphp
                        <div class="absolute left-0 right-0 top-full z-50 bg-surface-container-lowest text-on-surface shadow-xl border-t-4 border-tertiary-fixed max-h-[70vh] overflow-y-auto invisible opacity-0 group-hover:visible group-hover:opacity-100 group-focus-within:visible group-focus-within:opacity-100 transition-all duration-150">
                            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                                <div class="grid grid-cols-2 xl:grid-cols-4 gap-x-8 gap-y-6">
                                    @if ($tautanLangsung->count() > 0)
                                        <div>
                                            <span class="block font-body-bold text-body-bold text-primary border-b border-outline-variant/40 pb-2 mb-3">{!! $menu['nama'] !!}</span>
                                            <ul class="space-y-1.5">
                                                @foreach ($tautanLangsung as $child)
                                                    <li><a href="{{ $child['link_url'] }}" class="block font-body-md text-caption text-on-surface-variant hover:text-primary transition-colors">{!! $child['nama'] !!}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    @foreach ($anak as $child)
                                        @if (count($child['childrens'] ?? []) > 0)
                                            <div>
                                                <span class="block font-body-bold text-body-bold text-primary border-b border-outline-variant/40 pb-2 mb-3">{!! $child['nama'] !!}</span>
                                                <ul class="space-y-1.5">
                                                    @foreach ($child['childrens'] as $cucu)
                                                        <li>
                                                            <a href="{{ $cucu['link_url'] }}" class="block font-body-md text-caption text-on-surface-variant hover:text-primary transition-colors">{!! $cucu['nama'] !!}</a>
                                                            @if (count($cucu['childrens'] ?? []) > 0)
                                                                <ul class="ml-3 mt-1 space-y-1 border-l border-outline-variant/40 pl-3">
                                                                    @foreach ($cucu['childrens'] as $cicit)
                                                                        <li><a href="{{ $cicit['link_url'] }}" class="block font-body-md text-caption text-on-surface-variant hover:text-primary transition-colors">{!! $cicit['nama'] !!}</a></li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</nav>
