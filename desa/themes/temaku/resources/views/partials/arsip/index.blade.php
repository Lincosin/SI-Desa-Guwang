@extends('theme::layouts.full-width')

@php
    $daftarKategori = [];
    $petaArtikelKategori = [];
    $idArtikelStatis = [];

    try {
        $daftarKategori = \App\Models\Kategori::where('enabled', 1)->orderBy('urut')->get()->toArray();
        $mapNamaKategori = collect($daftarKategori)->pluck('kategori', 'id')->toArray();

        // Tambahkan Agenda & Keuangan ke tombol filter utama
        $mapNamaKategori[1000] = 'Agenda';
        $mapNamaKategori[1001] = 'Keuangan';

        $daftarKategori[] = ['id' => 1000, 'kategori' => 'Agenda'];
        $daftarKategori[] = ['id' => 1001, 'kategori' => 'Keuangan'];

        $semuaArtikelDb = \App\Models\Artikel::select('id', 'id_kategori', 'judul')->get();
        $judulStatisList = ['profil desa', 'profil', 'pemerintah desa', 'sejarah desa', 'visi dan misi', 'visi misi', 'struktur organisasi', 'kondisi geografis', 'demografi'];

        foreach ($semuaArtikelDb as $art) {
            $idKat = (int) ($art->id_kategori ?? 0);
            $judulLower = strtolower(trim($art->judul ?? ''));

            // Deteksi Keuangan (berdasarkan id_kategori 1001 atau ada kata apbdes/anggaran/keuangan di judul)
            if ($idKat === 1001 || str_contains($judulLower, 'apbdes') || str_contains($judulLower, 'keuangan') || str_contains($judulLower, 'anggaran')) {
                $petaArtikelKategori[$art->id] = 'Keuangan';
            } 
            // Deteksi Agenda (id_kategori 1000 atau ada kata agenda)
            elseif ($idKat === 1000 || str_contains($judulLower, 'agenda')) {
                $petaArtikelKategori[$art->id] = 'Agenda';
            } 
            elseif (isset($mapNamaKategori[$idKat])) {
                $petaArtikelKategori[$art->id] = $mapNamaKategori[$idKat];
            } else {
                $petaArtikelKategori[$art->id] = 'Berita Desa';
            }

            // Halaman Statis murni (Profil, dll) dipisah ke tombol toggle kanan
            if ($idKat === 999 || in_array($judulLower, $judulStatisList)) {
                $idArtikelStatis[] = (int) $art->id;
            }
        }
    } catch (\Throwable $e) {
        $daftarKategori = [];
    }
@endphp

@section('content')
<style>
    .sby-container { max-width: 1140px; margin: 0 auto; padding: 32px 16px 60px; }
    .sby-badge-top { display: inline-block; background-color: #006496; color: #ffffff; font-size: 11px; font-weight: 800; padding: 5px 14px; border-radius: 9999px; letter-spacing: 0.06em; text-transform: uppercase; margin-bottom: 12px; }
    .sby-hero-card { position: relative; width: 100%; height: 400px; border-radius: 24px; overflow: hidden; background-color: #0f172a; margin-bottom: 20px; box-shadow: 0 12px 30px -8px rgba(0, 0, 0, 0.2); }
    @media (max-width: 640px) { .sby-hero-card { height: 300px; } }
    .sby-hero-img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease; }
    .sby-hero-card:hover .sby-hero-img { transform: scale(1.03); }
    .sby-hero-overlay { position: absolute; inset: 0; background: linear-gradient(to right, rgba(15, 23, 42, 0.92) 0%, rgba(15, 23, 42, 0.65) 55%, rgba(15, 23, 42, 0.15) 100%); display: flex; flex-direction: column; justify-content: center; padding: 28px 36px; }
    @media (max-width: 640px) { .sby-hero-overlay { padding: 20px; background: linear-gradient(to top, rgba(15, 23, 42, 0.95) 0%, rgba(15, 23, 42, 0.5) 100%); justify-content: flex-end; } }
    .sby-subgrid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 36px; }
    @media (max-width: 1024px) { .sby-subgrid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 640px) { .sby-subgrid { grid-template-columns: 1fr; } }
    .sby-subcard { background: #ffffff; border: 1px solid #e2e8f0; border-radius: 18px; overflow: hidden; display: flex; flex-direction: column; transition: transform 0.2s ease, box-shadow 0.2s ease; text-decoration: none !important; }
    html.dark .sby-subcard { background: #141d30; border-color: #1e293b; }
    .sby-subcard:hover { transform: translateY(-4px); box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.1); }
    .sby-list-wrap { display: flex; flex-direction: column; gap: 20px; }
    .sby-list-card { background: #ffffff; border: 1px solid #e2e8f0; border-radius: 22px; padding: 18px; display: flex; flex-direction: row; gap: 24px; align-items: center; box-shadow: 0 4px 15px -3px rgba(0, 0, 0, 0.04); transition: transform 0.2s ease, border-color 0.2s ease; text-decoration: none !important; }
    html.dark .sby-list-card { background: #141d30; border-color: #1e293b; }
    .sby-list-card:hover { transform: translateY(-2px); border-color: #006496; }
    @media (max-width: 640px) { .sby-list-card { flex-direction: column; align-items: stretch; gap: 14px; } }
    .sby-list-thumb { width: 250px; height: 155px; border-radius: 14px; overflow: hidden; flex-shrink: 0; background-color: #cbd5e1; }
    @media (max-width: 640px) { .sby-list-thumb { width: 100%; height: 190px; } }
    .sby-list-thumb img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease; }
    .sby-list-card:hover .sby-list-thumb img { transform: scale(1.05); }
    .sby-pill { padding: 7px 16px; border-radius: 9999px; font-size: 12px; font-weight: 700; border: 1px solid #cbd5e1; background: #ffffff; color: #475569; cursor: pointer; transition: all 0.2s ease; display: inline-flex; align-items: center; gap: 6px; }
    html.dark .sby-pill { background: #1e293b; border-color: #334155; color: #cbd5e1; }
    .sby-pill.active, .sby-pill:hover { background: #006496; border-color: #006496; color: #ffffff; }
    .dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_filter, .dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_paginate, #arsip-artikel { display: none !important; }
</style>

<div class="sby-container">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-6">
        <div>
            <span class="sby-badge-top">BERITA & INFORMASI</span>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-on-surface tracking-tight">
                Kabar Terkini {{ ucfirst(setting('sebutan_desa')) }} {{ $desa['nama_desa'] }}
            </h1>
        </div>

        <div class="flex items-center gap-2 bg-white dark:bg-[#141d30] px-3 py-1.5 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm w-full md:w-72">
            <span class="material-symbols-outlined text-[18px] text-slate-400">search</span>
            <input type="text" id="sby-search-input" placeholder="Cari judul berita..." class="w-full bg-transparent text-xs sm:text-sm text-on-surface focus:outline-none">
        </div>
    </div>

    {{-- Tombol Filter Kategori Utama & Toggle Halaman Statis --}}
    <div class="flex items-center justify-between flex-wrap gap-3 mb-8 pb-4 border-b border-slate-200/70 dark:border-slate-800" id="sby-kategori-bar">
        <div class="flex items-center flex-wrap gap-2">
            <button type="button" data-mode="berita" data-kat="" class="sby-pill active">Semua Berita</button>
            @foreach ($daftarKategori as $kat)
                <button type="button" data-mode="kategori" data-kat="{{ $kat['kategori'] }}" class="sby-pill">
                    {{ $kat['kategori'] }}
                </button>
            @endforeach
        </div>

        <button type="button" data-mode="statis" data-kat="" class="sby-pill">
            <span class="material-symbols-outlined text-[15px]">description</span>
            <span>Halaman Statis</span>
        </button>
    </div>

    <div id="sby-featured-area"></div>
    <div id="sby-list-area" class="sby-list-wrap">
        <div class="text-center py-12 text-sm text-slate-400">Memuat artikel desa...</div>
    </div>

    <div id="sby-pagination-bar" class="flex items-center justify-center gap-2 mt-10"></div>

    <table id="arsip-artikel">
        <thead><tr><th>No</th><th>Tanggal</th><th>Judul</th><th>Penulis</th><th>Dibaca</th></tr></thead>
        <tbody></tbody>
    </table>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
        var modeTampil = 'berita';
        var kategoriTerpilih = '';
        var baseUrlGambar = "{{ base_url('desa/upload/artikel/sedang_') }}";
        var fallbackGambar = "https://images.unsplash.com/photo-1544644181-1484b3fdfc62?auto=format&fit=crop&w=800&q=80";

        var petaKategori = @json($petaArtikelKategori);
        var daftarIdStatis = @json($idArtikelStatis);
        var cacheDataTerakhir = [];
        var cachePagingTerakhir = null;

        function ambilKategoriDariItem(item) {
            var idArt = parseInt(item.id || 0, 10);
            if (petaKategori && petaKategori[idArt]) {
                return petaKategori[idArt];
            }
            return 'Berita Desa';
        }

        function cekApakahHalamanStatis(item) {
            var idArt = parseInt(item.id || 0, 10);
            return daftarIdStatis.indexOf(idArt) !== -1;
        }

        var arsip = $('#arsip-artikel').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            ordering: true,
            pageLength: 50,
            ajax: {
                url: `{{ ci_route('internal_api.arsip') }}`,
                method: 'get',
                data: function(row) {
                    return {
                        "page[size]": row.length,
                        "page[number]": (row.start / row.length) + 1,
                        "filter[search]": row.search.value,
                        "sort": "-tgl_upload"
                    };
                },
                dataSrc: function(json) {
                    json.recordsTotal = json.meta.pagination.total;
                    json.recordsFiltered = json.meta.pagination.total;
                    cacheDataTerakhir = json.data || [];
                    cachePagingTerakhir = json.meta.pagination;
                    renderLayoutSurabaya(cacheDataTerakhir, cachePagingTerakhir);
                    return json.data;
                }
            },
            columns: [
                { data: null, orderable: false },
                { data: "attributes.tgl_upload_local", name: "tgl_upload" },
                { data: "attributes.judul", name: "judul" },
                { data: "attributes.author.nama", name: "id_user", defaultContent: '' },
                { data: "attributes.hit", name: "hit" }
            ]
        });

        function ambilGambar(attr) {
            if (attr.gambar) return baseUrlGambar + attr.gambar;
            return fallbackGambar;
        }

        function bersihkanTeks(html) {
            if (!html) return 'Klik untuk membaca informasi selengkapnya mengenai kegiatan dan kabar terbaru dari Pemerintah Desa Guwang...';
            var tmp = document.createElement("DIV");
            tmp.innerHTML = html;
            var teks = tmp.textContent || tmp.innerText || "";
            return teks.length > 180 ? teks.substring(0, 180) + "..." : teks;
        }

        function renderLayoutSurabaya(items, paging) {
            var featuredEl = document.getElementById('sby-featured-area');
            var listEl = document.getElementById('sby-list-area');
            var pagingEl = document.getElementById('sby-pagination-bar');

            featuredEl.innerHTML = '';
            listEl.innerHTML = '';

            var semuaData = items || [];

            var dataTampil = semuaData.filter(function(item) {
                var isStatis = cekApakahHalamanStatis(item);
                var namaKat = ambilKategoriDariItem(item);

                if (modeTampil === 'statis') {
                    return isStatis;
                }
                if (isStatis) {
                    return false;
                }
                if (modeTampil === 'kategori' && kategoriTerpilih !== '') {
                    return namaKat.toLowerCase() === kategoriTerpilih.toLowerCase();
                }
                return true;
            });

            if (dataTampil.length === 0) {
                var pesanKosong = modeTampil === 'statis'
                    ? 'Belum ada artikel Halaman Statis.'
                    : 'Tidak ditemukan artikel pada kategori "' + (kategoriTerpilih || 'ini') + '".';
                listEl.innerHTML = `
                    <div class="text-center py-14 bg-white dark:bg-[#141d30] rounded-2xl border border-slate-200 dark:border-slate-800">
                        <p class="font-bold text-base text-on-surface mb-1">Belum Ada Artikel</p>
                        <p class="text-xs text-slate-400">${pesanKosong}</p>
                    </div>`;
                pagingEl.innerHTML = '';
                return;
            }

            var tampilHero = (paging && paging.currentPage === 1 && modeTampil === 'berita' && !$('#sby-search-input').val() && dataTampil.length > 4);

            if (tampilHero) {
                var heroItem = dataTampil[0];
                var hero = heroItem.attributes;
                var heroImg = ambilGambar(hero);
                var heroRingkas = bersihkanTeks(hero.isi);
                var heroKat = ambilKategoriDariItem(heroItem);

                var heroHtml = `
                    <div class="sby-hero-card">
                        <img src="${heroImg}" alt="${hero.judul}" class="sby-hero-img" onerror="this.src='${fallbackGambar}'">
                        <div class="sby-hero-overlay">
                            <div style="max-width: 560px;">
                                <span style="display:inline-block; background:#c29d59; color:#fff; font-size:10px; font-weight:800; padding:3px 10px; border-radius:6px; text-transform:uppercase; margin-bottom:10px;">
                                    ${heroKat}
                                </span>
                                <h2 style="color:#ffffff; font-size:24px; font-weight:800; line-height:1.3; margin:0 0 10px 0; text-transform:uppercase;">
                                    ${hero.judul}
                                </h2>
                                <p style="color:#e2e8f0; font-size:13px; line-height:1.6; margin:0 0 18px 0;">
                                    ${heroRingkas}
                                </p>
                                <a href="${hero.url_slug}" style="display:inline-flex; align-items:center; gap:6px; background:#c29d59; color:#ffffff; font-size:12px; font-weight:700; padding:8px 18px; border-radius:9999px; text-decoration:none;">
                                    <span>Baca Selengkapnya</span>
                                    <span class="material-symbols-outlined text-[15px]">arrow_forward</span>
                                </a>
                            </div>
                        </div>
                    </div>
                `;

                var subItems = dataTampil.slice(1, 5);
                if (subItems.length > 0) {
                    heroHtml += `<div class="sby-subgrid">`;
                    subItems.forEach(function(sub) {
                        var a = sub.attributes;
                        var img = ambilGambar(a);
                        heroHtml += `
                            <a href="${a.url_slug}" class="sby-subcard">
                                <div style="height:130px; width:100%; overflow:hidden; background:#cbd5e1;">
                                    <img src="${img}" alt="${a.judul}" style="width:100%; height:100%; object-fit:cover;" onerror="this.src='${fallbackGambar}'">
                                </div>
                                <div style="padding:14px; display:flex; flex-direction:column; justify-content:space-between; flex:1;">
                                    <h3 class="text-on-surface" style="font-size:13px; font-weight:800; line-height:1.4; margin:0 0 8px 0; text-transform:uppercase; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">
                                        ${a.judul}
                                    </h3>
                                    <span style="font-size:11px; color:#94a3b8;">${a.tgl_upload_local || ''}</span>
                                </div>
                            </a>
                        `;
                    });
                    heroHtml += `</div>`;
                }

                featuredEl.innerHTML = heroHtml;
                var listItems = dataTampil.slice(5);
                renderBarisHorizontal(listItems, listEl);
            } else {
                renderBarisHorizontal(dataTampil, listEl);
            }

            if (paging && paging.totalPages > 1) {
                var pHtml = '';
                for (var p = 1; p <= paging.totalPages; p++) {
                    var activeCls = (p === paging.currentPage) ? 'bg-primary text-white' : 'bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300';
                    pHtml += `<button type="button" onclick="pindahHalamanArsip(${p})" class="w-9 h-9 rounded-full text-xs font-bold border border-slate-200 dark:border-slate-700 ${activeCls}">${p}</button>`;
                }
                pagingEl.innerHTML = pHtml;
            } else {
                pagingEl.innerHTML = '';
            }
        }

        function renderBarisHorizontal(arr, container) {
            var html = '';
            arr.forEach(function(item) {
                var a = item.attributes;
                var img = ambilGambar(a);
                var ringkas = bersihkanTeks(a.isi);
                var penulis = (a.author && a.author.nama) ? a.author.nama : 'Administrator';
                var labelKat = ambilKategoriDariItem(item);

                html += `
                    <a href="${a.url_slug}" class="sby-list-card">
                        <div class="sby-list-thumb">
                            <img src="${img}" alt="${a.judul}" onerror="this.src='${fallbackGambar}'">
                        </div>
                        <div style="flex:1; min-width:0;">
                            <div style="display:flex; align-items:center; gap:8px; margin-bottom:6px; flex-wrap:wrap;">
                                <span style="background:rgba(0,100,150,0.1); color:#006496; font-size:10px; font-weight:800; padding:2px 8px; border-radius:4px; text-transform:uppercase;">${labelKat}</span>
                                <span style="font-size:11px; color:#94a3b8;">${a.tgl_upload_local || ''} &bull; Oleh ${penulis} &bull; Dibaca ${a.hit || 0}x</span>
                            </div>
                            <h3 class="text-on-surface" style="font-size:16px; font-weight:800; line-height:1.4; margin:0 0 8px 0; text-transform:uppercase;">
                                ${a.judul}
                            </h3>
                            <p class="text-on-surface-variant" style="font-size:13px; line-height:1.6; margin:0; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">
                                ${ringkas}
                            </p>
                        </div>
                    </a>
                `;
            });
            container.innerHTML = html;
        }

        window.pindahHalamanArsip = function(pageNumber) {
            arsip.page(pageNumber - 1).draw('page');
            window.scrollTo({ top: 0, behavior: 'smooth' });
        };

        var delayTimer;
        document.getElementById('sby-search-input').addEventListener('input', function(e) {
            var val = e.target.value;
            clearTimeout(delayTimer);
            delayTimer = setTimeout(function() {
                arsip.search(val).draw();
            }, 350);
        });

        document.querySelectorAll('#sby-kategori-bar .sby-pill').forEach(function(btn) {
            btn.addEventListener('click', function() {
                document.querySelectorAll('#sby-kategori-bar .sby-pill').forEach(function(b) {
                    b.classList.remove('active');
                });
                this.classList.add('active');
                modeTampil = this.getAttribute('data-mode') || 'berita';
                kategoriTerpilih = this.getAttribute('data-kat') || '';

                renderLayoutSurabaya(cacheDataTerakhir, cachePagingTerakhir);
            });
        });
    });
</script>
@endpush