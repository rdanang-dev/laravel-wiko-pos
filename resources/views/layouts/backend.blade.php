@extends('layouts.base')

@section('stylePerPage')
<link href="{{ asset('css/backend.css') }}" rel="stylesheet">
@yield('moreCustomStyle')
@endsection

@section('jsPerPage')
<script src="{{ asset('js/backend.js') }}" defer></script>
@yield('moreCustomJs')
@endsection

@section('body')
<x-navbar />
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-3">
            <x-sidebar></x-sidebar>
        </div>
        <div class="col-md-9">
            @yield('content')
        </div>
    </div>
</div>
@endsection
