<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ URL::asset('vendor/ionicons/ionicons.min.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('vendor/niftymodal/component.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
    </head>
    <body>
        <div id="modal" class="md-modal md-effect-1">
            <div id="modal-content" class="md-content"></div>
        </div>
        <div id="modal-overlay" class="md-overlay"></div>
        @if (!Auth::check())
            <div id="login-signup">
                <div id="inner">
                    <form action="login" method="POST">
                        {{ csrf_field() }}
                        <span>Användarnamn: </span>
                        <input type="text" name="username" autofocus>
                        <span>Lösenord: </span>
                        <input type="password" name="password">
                        <input type="submit" name="login" value="Logga in" style="margin-right: 10px;">
                    </form>
                    <a href="signup">Registrera</a>
                </div>
            </div>    
        @endif
        <div class="wrapper">
    <header>
        <div id="logo-area">
            <a href="/" id="logo"><img src="{{ URL::asset('images/logo.png') }}" style="width:35px;" alt=""></a>
            @if (Auth::check())
                <a href="profile" id="profile-link">{{ Auth::user()->username }}</a>
            @endif
        </div>
        <div id="header-icons">
            <?php /*
            <div class="top-nav-shortcut-item">
                <span id="toggle-read">
                    <span>Läs</span>
                    <img src="{{ URL::asset('images/book.png') }}" id="book" alt="">
                                        <div id="nr-read" class="nr-hide"></div>
                                    </span>
                <ul id="header-read" class="news">
                                    </ul>
            </div>
            <div class="top-nav-shortcut-item">
                <span id="toggle-write">
                    <span>Skriv</span>
                    <img src="{{ URL::asset('images/pen-black.png') }}" alt="">
                                        <div id="nr-write" class="nr-hide"></div>
                                    </span>
                <ul id="header-write" class="news">
                                    </ul>
            </div>
            <div class="top-nav-shortcut-item">
                <span id="toggle-news">
                    <span>Nyheter</span>
                    <img src="{{ URL::asset('images/alert-big.png') }}" id="alert" alt="">
                                        <div id="nr-news" class="nr-hide"></div>
                                    </span>
                <ul id="header-news" class="news">
                                    </ul>
            </div>
            <div id="toggle-menu" class="top-nav-shortcut-item">
                <span>Meny</span>
                <img src="{{ URL::asset('images/menu.png') }}" alt="">
            </div>
            */ ?>
        </div>
    </header>
    <nav id="nav" style="display: none;">
        <ul style="float: left; margin-left: 20px; margin-right: 100px;">
            <li><a href="logout">Logga ut</a></li>
        </ul>
        <ul style="float: left; margin-left: 20px; margin-right: 100px;">
            <li><a href="login">Logga in</a></li>
            <li><a href="signup">Registrera</a></li>
        </ul>
        <ul>
            <li><a href="">Om Great nonsens</a></li>
            <li><a href="">Användning av cookies</a></li>
        </ul>
    </nav>
    @yield('content')
</div>
        <script src="{{ URL::asset('vendor/momentjs/moment.min.js') }}"></script>
        <script src="{{ URL::asset('vendor/momentjs/locale/sv.js') }}"></script>
        <script src="{{ URL::asset('node_modules/socket.io/node_modules/socket.io-client/dist/socket.io.js') }}"></script>
        <script src="{{ URL::asset('vendor/niftymodal/modalEffects.js') }}"></script>
        <script src="{{ URL::asset('vendor/niftymodal/classie.js') }}"></script>
        <!-- // <script src="{{ URL::asset('vendor/requirejs/require.min.js') }}"></script> -->
        <script src="{{ URL::asset('vendor/fetch/fetch.js') }}"></script>
        <script src="{{ URL::asset('vendor/promise/promise.min.js') }}"></script>
        <script src="{{ URL::asset('js/bundle.js') }}"></script>
    </body>
</html>
