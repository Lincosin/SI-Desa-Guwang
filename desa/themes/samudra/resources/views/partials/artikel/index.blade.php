@php
    $title = !empty($judul_kategori) ? $judul_kategori : 'Artikel Terkini';
    $slug = 'terkini';
    if (is_array($title)) {
        $slug = $title['slug'];
        $title = $title['kategori'];
    }
    $smd_halaman_awal = empty($cari) && request()->segment(2) != 'kategori' && request()->segment(2) !== 'index' && request()->segment(1) !== 'index';
    // Beranda (halaman pertama tanpa pencarian) memakai tata letak landing penuh bergaya kaca
    $smd_landing = $smd_halaman_awal && !request()->segment(1);
@endphp
@extends($smd_landing ? 'theme::layouts.landing' : 'theme::layouts.right-sidebar')
@section('content')
    @if ($smd_landing)
        @include('theme::partials.beranda')
    @else
    {{-- Slider hanya tampil di halaman awal (bukan kategori, halaman berikutnya, atau hasil pencarian) --}}
    @if ($smd_halaman_awal && count($slider_gambar['gambar'] ?? []) > 0)
        @include('theme::partials.slider')
    @endif

    @if ($smd_halaman_awal && count($slider_gambar ?? []) > 0)
        @include('theme::partials.headline')
    @endif

    <div class="smd-section-head">
        <div>
            <span class="smd-section-head__eyebrow">{{ !empty($cari) ? 'Hasil pencarian' : 'Kabar ' . ucwords(setting('sebutan_desa')) }}</span>
            <h2 class="smd-section-head__title">{{ !empty($cari) ? '“' . $cari . '”' : $title }}</h2>
        </div>
        <a href="{{ site_url('arsip') }}" class="smd-link-more">Indeks berita <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
    </div>

    @if ($artikel->count() > 0)
        <div class="smd-post-grid">
            @foreach ($artikel as $post)
                @include('theme::partials.artikel.list', ['post' => $post])
            @endforeach
        </div>
        <div class="pagination smd-pagination">
            @include('theme::commons.paging', ['paging_page' => $paging_page])
        </div>
    @else
        @include('theme::partials.artikel.empty', ['title' => $title])
    @endif
    @endif
@endsection
