<nav class="navbar sticky-top navbar-expand navbar-dark bg-dark navbar-custom">
    <div type="button" id="menu-toggle" class="burger ml-2">
        <span></span>
        <span></span>
        <span></span>
    </div>

    <a class="navbar-brand ml-n2" href="{{ url('/') }}">
        {{ config('app.name', 'Laravel') }}
    </a>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mr-auto">

        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false" v-pre>
                    <span class="mr-1 d-none d-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                    <img class="img-profile rounded-circle border border-light p-0 m-0" height="32px" width="35px"
                        src="{{ url('storage/public/images/user/steve.png') }}">
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a href="/" class="dropdown-item">Home</a>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>

@push('moreCustomJs')
@once
<script src="{{ asset('js/navbar/togglesidebar.js') }}"></script>
@endonce
@endpush