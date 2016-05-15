<?php
    header("Content-type:text/html;charset=utf-8");
    session_start();

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
        {{ Form::open(array('id' => 'loginForm')) }}
            <h1>登陆 时光碎片</h1>
            <fieldset class="error">{{ $errors->first('attempt') }}</fieldset>
            <!-- <fieldset class="message"></fieldset> -->
            <fieldset>
                <p>
                    <a href="<?php echo $code_url ?>">
                        <button type="button" id="facebookLoginButton" class="oauthLogin weiboLogin" style="color: #fff;">
                            <i class="fa fa-weibo fa-2x facebookSignupButton"></i>
                            使用新浪微博账号登陆
                        </button>
                    </a>
                    <a href="{{ route('home') }}/oauth-qq.php">
                        <button type="button" id="facebookSignupButton" class="oauthLogin qqLogin" style="color: #fff;">
                            <i class="fa fa-qq fa-2x facebookSignupButton"></i>使用腾讯QQ账号登陆
                        </button>
                    </a>
                </p>
                <p class="or">
                    或者
                </p>
                <input id="loginUsername" name="email" type="text" value="{{ Input::old('email') }}" placeholder="E-mail 或 用户名" required autofocus>
                <input id="loginPassword" name="password" type="password" placeholder="密码" required>
                <input type="submit" value="登陆"/>
            </fieldset>
            <fieldset class="forgotLink">
                <a id="{{-- forgot --}}" href="{{ route('forgotPassword') }}">
                    帮助我, 我忘记了密码 &rarr;
                </a>
            </fieldset>
        {{ Form::close() }}
        {{ Form::open(array('id' => 'forgotForm', 'class' => 'fade off')) }}
            <h1>
                重置您的密码
            </h1>
            <fieldset class="error">
            </fieldset>
            <fieldset>
                <label for="forgotEmail">
                    填写注册E-mail地址,重置您的密码
                </label>
                <input id="forgotEmail" name="email" type="text" placeholder="E-mail 地址"/>
                <input type="submit" value="重置我的密码" />
            </fieldset>
            <fieldset class="forgotLink">
                <a id="unForgot" href="#">
                    &larr; 哦,我知道密码了
                </a>
            </fieldset>
        {{ Form::close() }}
    </body>
</html>