@extends('layouts.base')

@section('stylePerPage')
<link href="{{ asset('css/backend.css') }}" rel="stylesheet">
<link href="{{ asset('css/backend_main.css') }}" rel="stylesheet">
<link href="{{ asset('css/navbar/burger.css') }}" rel="stylesheet">
<link href="{{ asset('css/sidebar/sidebar.css') }}" rel="stylesheet">
<link href="{{ asset('css/mdi_icons.css') }}" rel="stylesheet">
@yield('moreCustomStyle')
@endsection


@section('body')
<x-navbar />
<div class="wrapper">
    <x-sidebar />
    <div id="content">
        @yield('content')
    </div>
</div>
@endsection

@section('jsPerPage')
<script src="{{ asset('js/backend.js') }}"></script>
@stack('moreCustomJs')
@endsection
