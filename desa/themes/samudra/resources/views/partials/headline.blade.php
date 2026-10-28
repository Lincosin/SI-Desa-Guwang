@if ($headline)
    @php
        $abstrak_headline = potong_teks(strip_tags($headline['isi']), 200);
        $punya_gambar = $headline['gambar'] && is_file(LOKASI_FOTO_ARTIKEL . 'sedang_' . $headline['gambar']);
        $image = $punya_gambar ? AmbilFotoArtikel($headline['gambar'], 'sedang') : gambar_desa($desa['logo']);
    @endphp
    <a href="{{ $headline->url_slug }}" class="smd-headline">
        <img src="{{ $image }}" alt="{{ $headline['judul'] }}" class="smd-headline__img {{ $punya_gambar ? '' : 'smd-headline__img--logo' }}">
        <span class="smd-headline__overlay">
            <span class="smd-badge smd-badge--light"><i class="fas fa-star" aria-hidden="true"></i> Berita Utama</span>
            <span class="smd-headline__title">{{ $headline['judul'] }}</span>
            <span class="smd-headline__excerpt">{!! $abstrak_headline !!}{{ strlen(strip_tags($headline['isi'])) > 200 ? '...' : '' }}</span>
        </span>
    </a>
@endif
