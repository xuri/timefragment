<?php
session_start();

include_once( app_path('api/config.php') );
include_once( app_path('api/saetv2.ex.class.php') );

$o = new SaeTOAuthV2( WB_AKEY , WB_SKEY );

if (isset($_REQUEST['code'])) {
	$keys = array();
	$keys['code'] = $_REQUEST['code'];
	$keys['redirect_uri'] = WB_CALLBACK_URL;
	try {
		$token = $o->getAccessToken( 'code', $keys ) ;
	} catch (OAuthException $e) {
	}
}

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
        	<?php
			if ($token) {
				$_SESSION['token'] = $token;
				setcookie( 'weibojs_'.$o->client_id, http_build_query($token) );
			?>
            <h1>授权成功</h1>
            <fieldset id="message" class="message">
                <a href="{{ route('api-signupSuccess') }}"><p class="center">完成注册</p></a>
            </fieldset>
			<?php
			} else {
			?>
            <h1>授权失败</h1>
            <fieldset id="message" class="message">
                <p class="center">请重新登陆</p>
            </fieldset>
            <?php
			}
			?>
            <fieldset id="quotes">
                <p>&ldquo;时光不老，我们不散&rdquo;
                    <cite>&ndash; 时光碎片</cite>
                </p>
                <p>&ldquo;编织梦想，程就未来&rdquo;
                    <cite>&ndash; luxurioust</cite>
                </p>
            </fieldset>
        </form>

    </body>
</html>