@extends('theme::template')

@section('layout')
    <div class="smd-container smd-layout smd-layout--full">
        {{-- Konten --}}
        <main class="smd-main space-y-1 text-gray-600">
            @yield('content')
        </main>
    </div>
@endsection
