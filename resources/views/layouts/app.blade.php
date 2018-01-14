<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel') )</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('css/materialize.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/materialize-tags.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/simplemde.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/prism.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @include('feed::links')
</head>
<body>
    <div id="app">
        <div class="navbar-fixed">
            <nav class="black">
                <div class="container nav-wrapper">
                    <!-- Branding Image -->
                    <a class="brand-logo" href="{{ url('/') }}">
                        <span class="hide-on-small-only">Jesper </span><span>Jarlskov</span><span class="hide-on-med-and-down">'s techblog</span>
                    </a>

                    <!-- Right Side Of Navbar -->
                    <ul class="right hide-on-med-and-down">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li>
                                @if (Auth::user()->isAdmin())
                                    <a href="/admin">Admin</a>
                                @endif
                            </li>
                            <li>
                                <a href="#" class="dropdown-button" id="logout-button" data-activates="header-dropdown-menu" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <i class="material-icons right">arrow_drop_down</i>
                                </a>

                            </li>
                        @endguest
                    </ul>

                    <ul id="header-dropdown-menu" class="dropdown-content">
                        <li>
                            <a href="{{ route('logout') }}" class="black-text logout-button">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>

        <div class="container flow-text">
            @yield('content')
        </div>
    </div>

    <link href="{{ asset('css/materialize-tags.min.css') }}" />
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/materialize.min.js') }}"></script>
    <script src="{{ asset('js/typeahead.bundle.min.js') }}"></script>
    <script src="{{ asset('js/materialize-tags.min.js') }}"></script>
    <script src="{{ asset('js/simplemde.min.js') }}"></script>
    <script src="{{ asset('js/prism.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
