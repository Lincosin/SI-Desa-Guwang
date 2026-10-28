<section class="smd-slider sliderx group" aria-label="Galeri utama">
    <div class="owl-carousel">
        @foreach ($slider_gambar['gambar'] as $data)
            @php
                $img = $slider_gambar['lokasi'] . 'sedang_' . $data['gambar'];
            @endphp
            @if (is_file($img))
                <figure class="smd-slider__item">
                    <img src="{{ base_url($img) }}" alt="{{ $data['judul'] }}">
                    @if ($slider_gambar['sumber'] != 3)
                        <figcaption>
                            <a href="{{ site_url('artikel/' . buat_slug($data)) }}">{{ $data['judul'] }}</a>
                        </figcaption>
                    @endif
                </figure>
            @endif
        @endforeach
    </div>
    <div class="slider-nav">
        <button type="button" class="slider-nav-prev smd-slider__nav smd-slider__nav--prev" title="Sebelumnya" aria-label="Sebelumnya"><i class="fas fa-chevron-left" aria-hidden="true"></i></button>
        <button type="button" class="slider-nav-next smd-slider__nav smd-slider__nav--next" title="Selanjutnya" aria-label="Selanjutnya"><i class="fas fa-chevron-right" aria-hidden="true"></i></button>
    </div>
</section>
