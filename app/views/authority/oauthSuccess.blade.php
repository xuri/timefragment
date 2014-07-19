<?php
header("Content-type:text/html;charset=utf-8");

include_once( app_path('api/weibo/config.php') );
include_once( app_path('api/weibo/saetv2.ex.class.php') );
$o = new SaeTOAuthV2( WB_AKEY , WB_SKEY );
$code_url = $o->getAuthorizeURL( WB_CALLBACK_URL );

?>
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
                <p class="center">授权成功，请使用您的新浪微博账号登陆。</p></fieldset>
                <p>
                    <a href="<?php echo $code_url ?>">
                        <button type="button" id="facebookLoginButton" class="oauthLogin weiboLogin" style="color: #fff;">
                            <i class="fa fa-weibo fa-2x facebookSignupButton"></i>
                            使用新浪微博账号登陆
                        </button>
                    </a>
                </p>
            <fieldset id="quotes">
                <p>&ldquo;时光不老，我们不散&rdquo;
                    <cite>&ndash; 时光碎片</cite>
                </p>
            </fieldset>
        </form>

    </body>
</html>