@extends('theme::template')

@section('layout')
    <div class="smd-container smd-layout">
        {{-- Konten --}}
        <main class="smd-main text-gray-600">
            @yield('content')
        </main>
        {{-- Widget --}}
        <div class="smd-aside">
            @include('theme::partials.sidebar')
        </div>
    </div>
@endsection
