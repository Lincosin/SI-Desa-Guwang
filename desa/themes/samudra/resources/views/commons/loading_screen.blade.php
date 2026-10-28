@if (theme_config('layar_memuat', '0') == '1')
    <div class="smd-loader" id="smd-loader" aria-hidden="true">
        <div class="smd-loader__ring"></div>
        <img src="{{ gambar_desa($desa['logo']) }}" alt="" class="smd-loader__logo">
    </div>
@endif
