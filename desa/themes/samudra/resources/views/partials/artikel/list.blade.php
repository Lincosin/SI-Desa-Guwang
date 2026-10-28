@php
    $url = $post->url_slug;
    $abstract = potong_teks(strip_tags($post['isi']), 300);
    $punya_gambar = !empty($post['gambar']);
    $image = $punya_gambar ? AmbilFotoArtikel($post['gambar'], 'sedang') : gambar_desa($desa['logo']);
@endphp

<article class="smd-post smd-spotlight">
    <a href="{{ $url }}" class="smd-post__media {{ $punya_gambar ? '' : 'smd-post__media--logo' }}" tabindex="-1" aria-hidden="true">
        <img src="{{ $image }}" alt="" loading="lazy">
        @if ($post['kategori'])
            <span class="smd-badge">{{ $post['category']['kategori'] ?? $post['kategori'] }}</span>
        @endif
    </a>
    <div class="smd-post__body">
        <ul class="smd-meta">
            <li><i class="far fa-calendar-alt" aria-hidden="true"></i> {{ tgl_indo($post['tgl_upload']) }}</li>
            <li><i class="far fa-user" aria-hidden="true"></i> {{ $post['owner'] }}</li>
        </ul>
        <h3 class="smd-post__title">
            <a href="{{ $url }}">{{ potong_teks($post['judul'], 90) }}{{ strlen($post['judul']) > 90 ? '...' : '' }}</a>
        </h3>
        <p class="smd-post__excerpt">{!! potong_teks(html_entity_decode($abstract), 140) !!}{{ strlen($abstract) > 140 ? '...' : '' }}</p>
        <a href="{{ $url }}" class="smd-post__more">Baca selengkapnya <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
    </div>
</article>
