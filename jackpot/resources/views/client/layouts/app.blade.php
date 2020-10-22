<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" CONTENT="">
    <meta name="google-site-verification" content=""/>
    <meta name="google" content="notranslate"/>
    <meta name="robots" content="noindex,nofollow">
    <title>E-Legend | eJackpot | @yield("title")</title>
    <base href="{{url()->to("/")}}/">
    <link rel="shortcut icon" type="image/x-icon" href="Archive/images/logo/icon-logo.png"/>
    <link rel="stylesheet" href="Archive/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="Archive/css/animations.css"/>
    <link rel="stylesheet" href="Archive/css/animate.css"/>
    <link rel="stylesheet" href="Archive/css/all.min.css">
    <link rel="stylesheet" href="Archive/slick/slick.css">
    <link rel="stylesheet" href="Archive/slick/slick-theme.css">
    <link rel="stylesheet" href="Archive/css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="Archive/css/main.css">
    <link rel="stylesheet" href="Archive/css/responsive.css">
    <link rel="stylesheet" href="Archive/css/fixfile.css">
    <script type="text/javascript" src="Archive/js/popper.min.js"></script>
    <script type="text/javascript" src="Archive/js/jquery-3.4.1.min.js"></script>
    <link rel="shortcut icon" href="{{ asset('assets/favicon.ico') }}" />
    @yield("CustomCSS")
</head>

<body>
<header class="header">
    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="wrap-line">
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
            </span>
    </button>
    <div class="header__inner">
        <div class="logo">
            <a href="{{route("client.home.index")}}" class="link">
                <img class="img-logo" src="https://elegend.io/wp-content/uploads/2020/06/logo-elegend.png" alt="">
            </a>
        </div>
        <div class="main-menu">
            <ul class="navbar-nav">
                <li class="nav-item {{Route::current()->getName()==="client.home.index"?"active":""}}">
                    <a class="nav-link" href="{{route("client.home.index")}}">HOME</a>
                </li>
                <li class="nav-item {{Route::current()->getName()==="client.home.token"?"active":""}}">
                    <a class="nav-link" href="{{route("client.home.token")}}">PROFIT</a>
                </li>
                <li class="nav-item {{Route::current()->getName()==="client.home.affiliate"?"active":""}}">
                    <a class="nav-link" href="{{route("client.home.affiliate")}}">AFFILIATE</a>
                </li>
                <li class="nav-item {{Route::current()->getName()==="client.home.how-to-play"?"active":""}}">
                    <a class="nav-link" href="{{route("client.home.how-to-play")}}">HOW TO PLAY</a>
                </li>
                <li class="nav-item {{Route::current()->getName()==="client.home.top"?"active":""}}">
                    <a class="nav-link" href="{{route("client.home.top")}}">TOP WINNER</a>
                </li>
                @if(session()->has('is_auth_client')&&session('is_auth_client'))
                    <li class="nav-item">
                        <a href="{{ route('client.dashboard.index') }}" class="nav-link" type="submit">DASHBOARD</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('client.user.logout') }}" method="post">
                            @csrf
                            <button type="submit" class="nav-link" type="submit" id="logout">LOGOUT</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <button class="nav-link" type="submit" id="signin">LOGIN</button>
                    </li>
                @endif
            </ul>
        </div>
    </div>
    <div class="mobile-menu">
        <div class="mobile-menu__overlay"></div>
        <div class="mobile-menu__box">
            <div class="mobile-menu__close-button">X</div>
            <div class="mobile-menu__inner">
                <div class="logo-main">
                    <a href="#">
                        <img src="https://elegend.io/wp-content/uploads/2020/06/logo-elegend.png" class="logo"
                             alt="logo">
                    </a>
                </div>
                <div class="main-menu-1">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.html">HOME</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="token.html">TOKEN</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="affliate.html">AFFILIATE</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="profit.html">PROFIT</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">TOP WINNER</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">TOP PLAYER</a>
                        </li>
                        @if(session()->has('is_auth_client')&&session('is_auth_client'))
                            <li class="nav-item">
                                <div class="dropdown">
                                    <button class="dropdown-toggle custom-drop nav-link" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        {{ __('label.hi')}}
                                    </button>
                                    <div class="dropdown-menu drop-menu" aria-labelledby="dropdownMenuButton">
                                        <a href="{{ route('client.dashboard.index') }}" class="" type="submit"><img
                                                class="img-login" src="Archive/images/examples/dashboard.png">Dashboard</a>
                                        <a href="{{ route('client.user.logout') }}" class="mt-4 ml-4" type="submit"
                                           id="logout"><img class="img-login" src="Archive/images/examples/logout.png">Log
                                            out</a>
                                    </div>
                                </div>
                            </li>
                        @else
                            <li class="nav-item">
                                <button class="nav-link" type="submit" id="signin-mobile"><img class="img-login"
                                                                                               src="Archive/images/examples/login.png">
                                </button>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="box-frame__image-full">
    <div class="popup-add">
        <div class="popup-inner check-link">
            <h4 class="text-center title-group">{{ __('label.welcome')}} <span
                    class="custom-title">{{ __('label.logo')}}</span></h4>
            <div class="text-center mt-3">
                <img src="Archive/images/examples/jackpot.png" alt="sorry">
            </div>
            <div class="row mt-4">
                <div class="col-12 col-xl-4 col-lg-4 col-md-4 m-auto">
                    <button class="anh-btn" type="submit" id="signin-popup"><i
                            class="flaticon-edit"></i>{{ __('label.login')}}</button>
                </div>
            </div>
            <a class="popup-close close-add-group" href="#">x</a>
        </div>
    </div>

    <main id="font-page" class="homepage">
        @yield("content")


    </main>
    <footer class="footer footer-mobile-fix"
            @if(isset($is_footer)) style="position: absolute;width: 100%;bottom: 0;" @endif>
        <div class="footer__inner">
            <div class="footer__inner-left">
                <ul class="footer__inner-list">
                    <li class="footer__inner-item footer-inner-mobile">
                        <h4 class="title title-mobile">
                            Find us on
                        </h4>
                        <ul class="list-social list-social-mobile">
                            <li class="li-list-socail">
                                <a href="#">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            </li>
                            <li class="li-list-socail">
                                <a href="#">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li>
                            <li class="li-list-socail">
                                <a href="#">
                                    <i class="fab fa-google-plus-g"></i>
                                </a>
                            </li>
                            <li class="li-list-socail">
                                <a href="#">
                                    <i class="far fa-paper-plane"></i>
                                </a>
                            </li>
                            <li class="li-list-socail">
                                <a href="#">
                                    <i class="fab fa-youtube"></i>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="footer__inner-item footer-inner-mobile">
                        <h4 class="title title-mobile">
                            Subscribe to our newsletter
                        </h4>
                        <div class="form__register form-margin-mobile">
                            <form action="{{route("client.dashboard.subscribe")}}" method="POST">
                                @csrf
                                <div class="wrap-form">
                                    <div class="form-group">
                                        <input type="email" name="email" class="input" placeholder="Enter your mail..."
                                               required>
                                    </div>
                                    <div class="wrap-submit">
                                        <button class="custom-btn-1 button" type="submit">Subscribe</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>
                    <li class="footer__inner-item footer-inner-mobile">
                        <h4 class="title title-mobile">
                            Information
                        </h4>
                        <ul class="list-page list-page-mobile">
                            <li>
                                <a href="{{route("client.home.roadmap")}}">
                                    Roadmap
                                </a>
                            </li>
                            /
                            <li>
                                <a href="{{route("client.home.term")}}">
                                    Term of Use
                                </a>
                            </li>
                            /
                            <li>
                                <a href="{{route("client.home.regulation")}}">
                                    Regulation
                                </a>
                            </li>
                            /
                            <li>
                                <a href="#">
                                    Whitepaper
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="footer__inner-right list-social-mobile">
                <div class="contact">
                    Contact us: <a href="#">support@ejackpot.elegend.io</a>
                </div>
                <div class="copy-right">
                    © 2020. All rights Reserved
                </div>
            </div>
        </div>
    </footer>
</div>
<div id="popup-to-win">
    <div class="box">

    </div>
</div>
{{--<a href="{{route("client.home.index")}}">{{__("client.home.title")}}</a>--}}
{{--<a href="{{route("client.home.token")}}">TOKEN</a>--}}
{{--<a href="{{route("client.home.affiliate")}}">affiliate</a>--}}
{{--<a href="{{route("client.home.how-to-play")}}">how to play</a>--}}
{{--<a href="{{route("client.home.top")}}">top</a>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>
<script type="text/javascript" src="Archive/js/bootstrap.min.js"></script>
<script type="text/javascript" src="Archive/slick/slick.min.js"></script>
<script type="text/javascript" src="Archive/js/easings.min.js"></script>
<script type="text/javascript" src="Archive/js/css3-animate-it.js"></script>
<script type="text/javascript" src="Archive/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="Archive/js/jquery.fancybox.min.js"></script>
<script type="text/javascript" src="Archive/js/Chart.min.js"></script>
<script type="text/javascript" src="Archive/js/script.js"></script>
<script src="{{ asset('js/oidc-client.min.js') }}"></script>
<script>
    document.getElementById('signin').addEventListener("click", signin, false);
    document.getElementById('signin-popup').addEventListener("click", signin, false);
    document.getElementById('signin-mobile').addEventListener("click", signin, false);
    Oidc.Log.logger = console;
    Oidc.Log.level = Oidc.Log.INFO;

    var settings = {
        authority: 'https://id.elegend.io',
        client_id: 'jackpot.elegend.io',
        redirect_uri: window.location.origin + '/callback',
        silent_redirect_uri: window.location.origin + '/silentcallback',
        response_type: 'code',
        scope: 'openid profile offline_access',
        post_logout_redirect_uri: window.location.origin + '/logout',
        loadUserInfo: true
    };
    var client = new Oidc.OidcClient(settings);

    function signin() {
        client.createSigninRequest().then(function (req) {
            window.location.replace(req.url);
        }).catch(function (err) {
            log(err);
        });
    }
</script>
@yield("CustomJS")
</body>

</html>
