{{-- Footer temaku (desain Stitch). Tema dimodifikasi dari Esensi (GPL-3.0-or-later). --}}
{{-- APBDes di footer hanya ditampilkan di halaman selain beranda (di beranda sudah ada section tersendiri) --}}
<div class="container">
    @includeWhen($transparansi && empty($isBeranda), 'theme::partials.apbdesa', $transparansi)
</div>

@php
    $ikonSosmed = [
        'facebook' => 'fa-facebook-f',
        'twitter' => 'fa-twitter',
        'instagram' => 'fa-instagram',
        'telegram' => 'fa-telegram',
        'whatsapp' => 'fa-whatsapp',
        'youtube' => 'fa-youtube',
    ];
    $daftarSosmed = collect($sosmed ?? [])->filter(fn ($s) => !empty($s['link']) && isset($ikonSosmed[strtolower($s['nama'] ?? '')]));
    $namaDesaFooter = ucfirst(setting('sebutan_desa')) . ' ' . ucwords($desa['nama_desa']);
    $jamFooter = collect($jam_kerja ?? []);
@endphp

@include('theme::commons.back_to_top')

<footer class="w-full bg-inverse-surface text-inverse-on-surface pt-space-xl pb-space-lg mt-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-space-lg mb-space-xl">
            {{-- Kolom 1: identitas --}}
            <div class="flex flex-col gap-space-sm">
                <div class="flex items-center gap-space-sm">
                    <img src="{{ gambar_desa($desa['logo']) }}" alt="Logo {{ $namaDesaFooter }}" class="h-9 w-auto object-contain">
                    <div class="flex flex-col">
                        <span class="font-headline-sm text-headline-sm text-tertiary-fixed font-bold">{{ $namaDesaFooter }}</span>
                        <span class="font-caption text-caption text-inverse-on-surface/70">
                            {{ ucfirst(setting('sebutan_kecamatan_singkat')) }} {{ ucwords($desa['nama_kecamatan']) }}, {{ ucfirst(setting('sebutan_kabupaten_singkat')) }} {{ ucwords($desa['nama_kabupaten']) }}
                        </span>
                    </div>
                </div>
                <p class="font-body-md text-caption text-inverse-on-surface/80 leading-relaxed">
                    Portal resmi informasi, transparansi, dan layanan publik {{ $namaDesaFooter }}.
                </p>
                @if ($daftarSosmed->count() > 0)
                    <div class="flex items-center gap-2 mt-2">
                        @foreach ($daftarSosmed as $sm)
                            <a href="{{ $sm['link'] }}" target="_blank" rel="noopener" title="{{ $sm['nama'] }}" class="w-8 h-8 rounded-full bg-surface-container-highest/10 hover:bg-primary hover:text-on-primary flex items-center justify-center transition-colors">
                                <i class="fab {{ $ikonSosmed[strtolower($sm['nama'])] }}"></i>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Kolom 2: tautan cepat --}}
            <div class="flex flex-col gap-space-sm">
                <span class="font-headline-sm text-headline-sm text-surface-bright border-b border-surface-container-highest/10 pb-2">Tautan Cepat</span>
                <ul class="flex flex-col gap-2 font-body-md text-caption text-inverse-on-surface/80">
                    @if (setting('layanan_mandiri') == 1)
                        <li class="flex items-center gap-1.5 hover:text-tertiary-fixed transition-colors"><span class="material-symbols-outlined text-[16px] text-tertiary-fixed">chevron_right</span><a href="{{ site_url('layanan-mandiri') }}">Layanan Mandiri</a></li>
                    @endif
                    <li class="flex items-center gap-1.5 hover:text-tertiary-fixed transition-colors"><span class="material-symbols-outlined text-[16px] text-tertiary-fixed">chevron_right</span><a href="{{ site_url('pengaduan') }}">Pengaduan Warga</a></li>
                    <li class="flex items-center gap-1.5 hover:text-tertiary-fixed transition-colors"><span class="material-symbols-outlined text-[16px] text-tertiary-fixed">chevron_right</span><a href="{{ site_url('peraturan-desa') }}">Produk Hukum</a></li>
                    <li class="flex items-center gap-1.5 hover:text-tertiary-fixed transition-colors"><span class="material-symbols-outlined text-[16px] text-tertiary-fixed">chevron_right</span><a href="{{ site_url('informasi-publik') }}">Informasi Publik</a></li>
                    <li class="flex items-center gap-1.5 hover:text-tertiary-fixed transition-colors"><span class="material-symbols-outlined text-[16px] text-tertiary-fixed">chevron_right</span><a href="{{ site_url('pembangunan') }}">Pembangunan</a></li>
                    <li class="flex items-center gap-1.5 hover:text-tertiary-fixed transition-colors"><span class="material-symbols-outlined text-[16px] text-tertiary-fixed">chevron_right</span><a href="{{ site_url('data-statistik/jenis-kelamin') }}">Statistik</a></li>
                    <li class="flex items-center gap-1.5 hover:text-tertiary-fixed transition-colors"><span class="material-symbols-outlined text-[16px] text-tertiary-fixed">chevron_right</span><a href="{{ site_url('galeri') }}">Galeri</a></li>
                </ul>
            </div>

            {{-- Kolom 3: kontak --}}
            <div class="flex flex-col gap-space-sm">
                <span class="font-headline-sm text-headline-sm text-surface-bright border-b border-surface-container-highest/10 pb-2">Kontak &amp; Alamat</span>
                <div class="flex flex-col gap-3 font-body-md text-caption text-inverse-on-surface/80">
                    @if (!empty($desa['alamat_kantor']))
                        <div class="flex items-start gap-2">
                            <span class="material-symbols-outlined text-[18px] text-tertiary-fixed mt-0.5">location_on</span>
                            <span>{{ $desa['alamat_kantor'] }}@if (!empty($desa['kode_pos'])), Kode Pos {{ $desa['kode_pos'] }}@endif</span>
                        </div>
                    @endif
                    @if (!empty($desa['email_desa']))
                        <div class="flex items-center gap-2"><span class="material-symbols-outlined text-[18px] text-tertiary-fixed">mail</span><span>{{ $desa['email_desa'] }}</span></div>
                    @endif
                    @if (!empty($desa['telepon']))
                        <div class="flex items-center gap-2"><span class="material-symbols-outlined text-[18px] text-tertiary-fixed">call</span><span>{{ $desa['telepon'] }}</span></div>
                    @endif
                </div>
            </div>

            {{-- Kolom 4: jam pelayanan & pengunjung --}}
            <div class="flex flex-col gap-space-sm">
                <span class="font-headline-sm text-headline-sm text-surface-bright border-b border-surface-container-highest/10 pb-2">Jam Pelayanan</span>
                @if ($jamFooter->count() > 0)
                    <div class="p-3 rounded-xl bg-surface-container-highest/10 flex flex-col gap-2 font-caption text-caption text-inverse-on-surface/90">
                        @foreach ($jamFooter as $hari)
                            <div class="flex justify-between items-center">
                                <span class="text-inverse-on-surface/70">{{ $hari->nama_hari }}</span>
                                <span class="font-body-bold">{{ $hari->status ? substr((string) $hari->jam_masuk, 0, 5) . ' - ' . substr((string) $hari->jam_keluar, 0, 5) : 'Libur' }}</span>
                            </div>
                        @endforeach
                    </div>
                @endif
                <div class="flex items-center gap-4 font-caption text-caption text-inverse-on-surface/80">
                    <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px] text-tertiary-fixed">visibility</span> Hari ini: {{ $statistik_pengunjung['hari_ini'] ?? 0 }}</span>
                    <span>Total: {{ $statistik_pengunjung['total'] ?? 0 }}</span>
                </div>
            </div>
        </div>

        <div class="pt-6 border-t border-surface-container-highest/10 flex flex-col md:flex-row items-center justify-between gap-3 font-caption text-caption text-inverse-on-surface/70 text-center md:text-left">
            <span>&copy; {{ date('Y') }} Pemerintah {{ $namaDesaFooter }}. Hak cipta dilindungi.</span>
            <span>
                Tema dimodifikasi dari <a href="https://www.trivusi.web.id" class="underline" target="_blank" rel="noopener">Esensi {{ $themeVersion }}</a> &bull;
                <a href="https://opensid.my.id" class="underline" target="_blank" rel="noopener">OpenSID {{ ambilVersi() }}</a>
            </span>
            @if (setting('tte'))
                <img src="{{ asset('assets/images/bsre.png?v', false) }}" alt="Bsre" style="width: 150px;" />
            @endif
        </div>
    </div>
</footer>
