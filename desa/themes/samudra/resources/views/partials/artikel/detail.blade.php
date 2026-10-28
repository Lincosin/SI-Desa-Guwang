@extends('theme::layouts.' . $layout)
@php
    $post = $single_artikel;
    $alt_slug = PREMIUM ? 'artikel' : 'first';
@endphp
@include('theme::commons.asset_highcharts')
@section('content')
    @if ($post)
        <nav role="navigation" aria-label="navigation" class="breadcrumb">
            <ol>
                <li><a href="{{ ci_route() }}">Beranda</a></li>
                <li>
                    @if ($post['kategori'])
                        <a href="{{ ci_route("{$alt_slug}.kategori.{$post['kat_slug']}") }}">
                            {{ $post['kategori'] }}
                        </a>
                    @else
                        Artikel
                    @endif
                </li>
            </ol>
        </nav>

        <article class="smd-article-head">
            <h1 class="text-h2">
                {{ $post['judul'] }}
            </h1>

            <ul class="smd-meta smd-meta--article">
                <li><i class="far fa-user-circle" aria-hidden="true"></i> {{ $post['owner'] }} <i class="fas fa-check-circle smd-verified" title="Terverifikasi" aria-hidden="true"></i></li>
                <li><i class="far fa-calendar-alt" aria-hidden="true"></i> {{ $post['tgl_upload_local'] }}</li>
                <li><i class="far fa-eye" aria-hidden="true"></i> Dibaca {{ hit($post['hit']) }}</li>
                <li><i class="far fa-clock" aria-hidden="true"></i> {{ max(1, (int) ceil(str_word_count(strip_tags($post['isi'] ?? '')) / 200)) }} menit baca</li>
            </ul>
        </article>

        <div class="content space-y-2 py-4">
            @if ($post['gambar'])
                <a href="{{ AmbilFotoArtikel($post['gambar'], 'sedang') }}" class="h-auto block pb-3" data-fancybox="images">
                    <figure>
                        <img src="{{ AmbilFotoArtikel($post['gambar'], 'sedang') }}" alt="{{ $post['judul'] }}" class="w-full h-auto">
                    </figure>
                </a>
            @endif
            {!! $post['isi'] !!}
        </div>

        @for ($i = 1; $i <= 3; $i++)
            @if ($post['gambar' . $i])
                <a href="{{ AmbilFotoArtikel($post['gambar' . $i], 'sedang') }}" class="block" data-fancybox="images">
                    <figure>
                        <img src="{{ AmbilFotoArtikel($post['gambar' . $i], 'sedang') }}" alt="{{ $post['nama'] }}" class="w-full">
                    </figure>
                </a>
            @endif
        @endfor
        @if ($post['dokumen'])
            <div class="alert alert-info">
                <h4 class="text-h6">Dokumen Lampiran</h4>
                <a href="{{ ci_route('first.unduh_dokumen_artikel', $post['id']) }}" class="text-primary-200 text-sm flex space-x-3 pt-2">
                    <span class="fas fa-download text-secondary inline-block"></span>
                    <span class="hover:text-link">{{ $post['dokumen'] }}</span>
                </a>
            </div>
        @endif

        @include('theme::commons.share')
        @include('theme::partials.artikel.comment')
    @else
        @include('theme::commons.404')
    @endif
@endsection
