{{-- Layout lebar penuh tanpa sidebar (desain Stitch). Dipakai beranda dan detail artikel. --}}
@extends('theme::template')

@section('layout')
    <div class="w-full bg-background text-on-surface font-body-md text-body-md">
        @yield('content')
    </div>
@endsection
