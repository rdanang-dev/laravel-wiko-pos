@extends('layouts.base')

@section('stylePerPage')
<link href="{{ asset('css/login.css') }}" rel="stylesheet">
@yield('moreCustomStyle')
@endsection

@section('body')
<div id="app">
    <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
        <div class="container">
            <div class="card login-card">
                <div class="row no-gutters">
                    @yield('content')
                </div>
            </div>
        </div>
    </main>
</div>
@endsection

@section('jsPerPage')
<script src="{{ asset('js/login.js') }}" defer></script>
@yield('moreCustomJs')
@endsection
