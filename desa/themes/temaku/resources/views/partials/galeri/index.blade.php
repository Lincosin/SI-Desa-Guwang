@extends('theme::layouts.full-content')

@section('content')
<style>
    .gallery-bento-grid {
        display: grid;
        grid-template-columns: repeat(12, 1fr);
        gap: 20px;
    }
    .bento-item-1 { grid-column: span 12; }
    .bento-item-2 { grid-column: span 12; }
    .bento-item-3 { grid-column: span 12; }
    .bento-item-4 { grid-column: span 12; }
    .bento-item-5 { grid-column: span 12; }
    .bento-item-6 { grid-column: span 12; }

    @media (min-width: 768px) {
        .bento-item-1 { grid-column: span 4; }
        .bento-item-2 { grid-column: span 5; }
        .bento-item-3 { grid-column: span 3; }
        .bento-item-4 { grid-column: span 6; }
        .bento-item-5 { grid-column: span 4; }
        .bento-item-6 { grid-column: span 2; }
    }

    .gallery-card {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        background-color: #0f172a;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        transition: transform 0.4s ease, box-shadow 0.4s ease;
        height: 280px;
    }
    .gallery-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 30px -10px rgba(0, 0, 0, 0.2);
    }
    .gallery-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }
    .gallery-card:hover img {
        transform: scale(1.06);
    }
    .gallery-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(15, 23, 42, 0.85) 0%, rgba(15, 23, 42, 0.2) 60%, transparent 100%);
        display: flex;
        align-items: flex-end;
        padding: 24px;
    }
    .fade-in-slide {
        animation: fadeInSlideAnim 0.8s ease-in-out;
    }
    @keyframes fadeInSlideAnim {
        from { opacity: 0; transform: scale(1.02); }
        to { opacity: 1; transform: scale(1); }
    }
</style>

<div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 py-10">
    {{-- Breadcrumb Navigasi --}}
    <nav role="navigation" aria-label="navigation" class="mb-6">
        <ol class="flex items-center gap-2 text-xs sm:text-sm text-on-surface-variant font-medium">
            <li><a href="{{ ci_route() }}" class="hover:text-primary transition-colors flex items-center gap-1"><span class="material-symbols-outlined text-[15px]">home</span>Beranda</a></li>
            <li>/</li>
            @if (isset($parent))
                <li><a href="{{ ci_route('galeri') }}" class="hover:text-primary transition-colors">Galeri</a></li>
                <li>/</li>
                <li aria-current="page" class="text-on-surface font-bold">{{ $title }}</li>
            @else
                <li aria-current="page" class="text-on-surface font-bold">Galeri Desa</li>
            @endif
        </ol>
    </nav>

    {{-- Judul Halaman --}}
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
        <div>
            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md bg-surface-container-high text-primary font-medium text-xs uppercase mb-2">
                <span class="material-symbols-outlined text-[15px]">photo_library</span>
                <span>Dokumentasi Visual</span>
            </div>
            <h1 class="text-3xl sm:text-4xl font-semibold text-on-surface tracking-tight">
                @if (isset($parent)) Album @else Galeri & Album @endif {{ $title }}
            </h1>
        </div>
        <!-- <div class="text-xs text-on-surface-variant flex items-center gap-2 bg-surface-container-low px-3.5 py-2 rounded-xl">
            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
            <span>Slide Otomatis Aktif (Durasi 5 Detik)</span>
        </div> -->
    </div>

    {{-- Container Grid Bento Asimetris --}}
    <div class="gallery-bento-grid fade-in-slide" id="galeri-list">
        <div class="text-center py-16 col-span-12 text-on-surface-variant text-sm">Memuat galeri desa...</div>
    </div>

    <div class="mt-8">
        @include('theme::commons.pagination')
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ theme_asset('js/pagination.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var parent = `{{ $parent }}`;
            var routeGaleri = `{{ ci_route('internal_api.galeri') }}`;
            let pageSizes = 6;
            let dataMentahGaleri = [];
            let intervalSlideOtomatis = null;

            if (parent) {
                routeGaleri = `{{ ci_route('internal_api.galeri') }}/${parent}`;
                pageSizes = 10;
            }

            const loadGaleri = function(pageNumber) {
                $.ajax({
                    url: routeGaleri + `?sort=-tgl_upload&page[number]=${pageNumber}&page[size]=${pageSizes}`,
                    type: "GET",
                    dataType: 'json',
                    success: function(data) {
                        if (data && data.data) {
                            dataMentahGaleri = data.data;
                            renderBentoLayout(dataMentahGaleri);
                            initPagination(data);
                            mulaiSliderOtomatis();
                        }
                    }
                });
            };

            const renderBentoLayout = function(items) {
                const galeriList = document.getElementById('galeri-list');
                galeriList.innerHTML = '';

                if (!items.length) {
                    galeriList.innerHTML = `<div class="col-span-12 text-center py-16 bg-surface-container-lowest rounded-3xl border border-outline-variant/30 text-on-surface-variant">Maaf, album galeri belum tersedia atau belum aktif!</div>`;
                    return;
                }

                const polaGrid = ['bento-item-1', 'bento-item-2', 'bento-item-3', 'bento-item-4', 'bento-item-5', 'bento-item-6'];

                items.forEach((item, index) => {
                    const attr = item.attributes;
                    const imageUrl = attr.src_gambar ? attr.src_gambar : 'https://images.unsplash.com/photo-1524661135-423995f22d0b?auto=format&fit=crop&w=800&q=80';
                    const namaGaleri = attr.nama || 'Dokumentasi Desa';
                    const kelasGrid = polaGrid[index % polaGrid.length];

                    const card = document.createElement('div');
                    card.className = `${kelasGrid} gallery-card`;

                    // Jika berada di dalam album (parent ada), gunakan atribut Fancybox agar tampil sebagai pop-up
                    // Jika di halaman utama album, arahkan ke detail album (.url_detail)
                    if (parent) {
                        card.innerHTML = `
                            <a href="${imageUrl}" data-fancybox="galeri-desa" data-caption="${namaGaleri}" class="w-full h-full block relative">
                                <img src="${imageUrl}" alt="${namaGaleri}" title="${namaGaleri}"/>
                                <div class="gallery-overlay">
                                    <h3 class="text-white font-semibold text-base sm:text-lg tracking-wide uppercase drop-shadow-md">
                                        ${namaGaleri}
                                    </h3>
                                </div>
                            </a>
                        `;
                    } else {
                        const detailUrl = attr.url_detail || '#';
                        card.innerHTML = `
                            <a href="${detailUrl}" class="w-full h-full block relative">
                                <img src="${imageUrl}" alt="${namaGaleri}" title="${namaGaleri}"/>
                                <div class="gallery-overlay">
                                    <h3 class="text-white font-bold text-base sm:text-lg tracking-wide uppercase drop-shadow-md">
                                        ${namaGaleri}
                                    </h3>
                                </div>
                            </a>
                        `;
                    }

                    galeriList.appendChild(card);
                });
            };

            // Animasi Slide Otomatis Ganti Gambar Setiap 5 Detik
            const mulaiSliderOtomatis = function() {
                if (intervalSlideOtomatis) clearInterval(intervalSlideOtomatis);

                intervalSlideOtomatis = setInterval(function() {
                    if (dataMentahGaleri.length > 1 && !parent) { // Slide otomatis berjalan di halaman utama album
                        dataMentahGaleri.push(dataMentahGaleri.shift());
                        
                        const gridContainer = document.getElementById('galeri-list');
                        gridContainer.classList.remove('fade-in-slide');
                        void gridContainer.offsetWidth; 
                        gridContainer.classList.add('fade-in-slide');

                        renderBentoLayout(dataMentahGaleri);
                    }
                }, 5000);
            };

            $('.pagination').on('click', '.btn-page', function() {
                var page = $(this).data('page');
                loadGaleri(page);
            });

            loadGaleri(1);
        });
    </script>
@endpush