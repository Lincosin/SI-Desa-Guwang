@extends('theme::template')

@section('layout')
    <div class="smd-container smd-layout smd-layout--left">
        {{-- Widget --}}
        <div class="smd-aside">
            @include('theme::partials.sidebar')
        </div>
        {{-- Konten --}}
        <main class="smd-main text-gray-600">
            @yield('content')
        </main>
    </div>
@endsection
