@include('layout.authority-header')
@yield('content')
    <body class="dark">
        <div id="fb-root"></div>
        <header>
        @include('layout.navigation')
        @yield('content')
        </header>

        <form id="signupForm" method="post" action="/signup" class="" autocomplete="off" data-reservation-mode="" data-auto-submit="" data-user="" data-signup-redirect="" >
            <h1>欢迎加入时光碎片</h1>
            <fieldset id="message" class="message">
                <p class="center">授权成功，请使用您的QQ账号登陆。</p></fieldset>
                <p>
                    <a href="{{ route('home') }}/oauth-qq.php">
                        <button type="button" id="facebookLoginButton" class="oauthLogin qqLogin" style="color: #fff;">
                            <i class="fa fa-qq fa-2x facebookSignupButton"></i>
                            使用腾讯QQ账号登陆
                        </button>
                    </a>
                </p>
            <fieldset id="quotes">
                <p>时光不老，我们不散
                    <cite>&ndash; TimeFragment</cite>
                </p>
            </fieldset>
        </form>

    </body>
</html>