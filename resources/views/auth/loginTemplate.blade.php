@extends('template')

@section('content')
<div class="container">
    <div class="card login-card">
        <div class="row no-gutters">
            @yield('loginManager')
        </div>
    </div>
</div>
@endsection
