@extends('layouts.base')

@section('stylePerPage')
<link href="{{ asset('css/backend.css') }}" rel="stylesheet">
<link href="{{ asset('css/navbar/navbarBurger.css') }}" rel="stylesheet">
{{-- <link href="{{ asset('css/sidebar/sidebar.css') }}" rel="stylesheet"> --}}
@yield('moreCustomStyle')
@endsection


@section('body')
<x-navbar />
<div class="wrapper">
    <x-sidebar />
    <div class="content">
        @yield('content')
    </div>
</div>
@endsection

@section('jsPerPage')
<script src="{{ asset('js/backend.js') }}"></script>
@stack('moreCustomJs')
@endsection
