{{-- Kategori artikel dalam bentuk "chip" yang bisa digeser di beranda --}}
@php
    $alt_slug = PREMIUM ? 'artikel' : 'first';
@endphp
@if (!empty($menu_kiri))
    <div class="smd-container">
        <nav class="smd-chips" aria-label="Kategori artikel">
            <span class="smd-chips__label"><i class="fas fa-tags" aria-hidden="true"></i> Kategori</span>
            <div class="smd-chips__list">
                @foreach ($menu_kiri as $menu)
                    <a href="{{ site_url("{$alt_slug}/kategori/{$menu['slug']}") }}" class="smd-chip">{{ $menu['kategori'] }}</a>
                    @foreach ($menu['submenu'] ?? [] as $submenu)
                        <a href="{{ site_url("{$alt_slug}/kategori/{$submenu['slug']}") }}" class="smd-chip">{{ $submenu['kategori'] }}</a>
                    @endforeach
                @endforeach
            </div>
        </nav>
    </div>
@endif
