@extends('theme::template')

@section('layout')
    {{-- Beranda: bagian-bagian penuh selebar layar, widget ditampilkan di dalam halaman --}}
    <div class="smd-landing">
        @yield('content')
    </div>
@endsection
