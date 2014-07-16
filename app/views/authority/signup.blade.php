@include('layout.authority-header')
@yield('content')
    <body class="dark">
        <div id="fb-root"></div>
        <header>
        @include('layout.navigation')
        @yield('content')
        </header>
        {{ Form::open(array('id' => 'signupForm', 'autocomplete' => 'off')) }}
            <h1>加入 时光碎片</h1>
            <fieldset id="message" class="message"></fieldset>
            <fieldset id="intro">
                <p>

                    <button type="button" id="facebookSignupButton" class="facebookLogin" style="color: #fff;">
                        <i class="fa fa-weibo fa-2x facebookSignupButton"></i>
                       连接新浪微博
                    </button>
                </p>
                <p class="or">
                    或者
                </p>
            </fieldset>
            <fieldset id="emailSignup">
                <input id="analyticsId" name="analyticsId" type="hidden" value="">
                <input id="accessToken" name="accessToken" type="hidden" value="">
                <input id="reservationToken" name="reservationToken" type="hidden" value="" disabled="disabled">
                <input id="authMode" name="authMode" type="hidden" value="email">
                <input id="fbToken" name="fbToken" type="hidden">
                <label for="email">
                    <span class="text">
                        E-mail
                    </span>
                    <input id="email" name="email" type="text" value="{{ Input::old('email') }}" autocomplete="off" placeholder="您的电子邮件地址" required autofocus>
                    {{ $errors->first('email', '<strong class="error">:message</strong>') }}
                </label>
                <label for="password">
                    <span class="text">
                        密码
                    </span>
                    <input id="password" name="password" type="password" value="" autocomplete="off" placeholder="密码" required>
                    {{ $errors->first('password', '<strong class="error">:message</strong>') }}
                </label>
                <label for="repassword">
                    <span class="text">
                        确认
                    </span>
                    <input id="repassword" name="password_confirmation" type="password" value="" autocomplete="off" placeholder="重复密码" required>
                </label>
                <input type="submit" value="注册">
            </fieldset>
            <fieldset id="quotes">
                <p>&ldquo;时光不老，我们不散&rdquo;
                    <cite>&ndash; 时光碎片</cite>
                </p>
                <p>&ldquo;编织梦想，程就未来&rdquo;
                    <cite>&ndash; luxurioust</cite>
                </p>
            </fieldset>
        {{ Form::close() }}

    </body>
</html>