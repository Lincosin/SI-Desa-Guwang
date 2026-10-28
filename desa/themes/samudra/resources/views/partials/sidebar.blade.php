<aside class="smd-sidebar sidebar">
    <form action="{{ site_url('/') }}" method="get" role="search" class="smd-sidebar__search">
        <i class="fas fa-search" aria-hidden="true"></i>
        <input type="search" name="cari" class="form-input" placeholder="Cari artikel..." aria-label="Kata kunci pencarian">
    </form>
    {{-- Tampilkan Widget --}}
    @if ($widgetAktif)
        @foreach ($widgetAktif as $widget)
            @php
                $judul_widget = [
                    'judul_widget' => str_replace('Desa', ucwords(setting('sebutan_desa')), strip_tags($widget['judul'])),
                ];
            @endphp
            <section class="smd-widget">
                @includeIf("theme::widgets.{$widget['isi']}", $judul_widget)
            </section>
        @endforeach
    @endif
</aside>
