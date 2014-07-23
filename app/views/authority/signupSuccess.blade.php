@include('layout.authority-header')
@yield('content')
    <body class="dark">
        <div id="fb-root"></div>
        <header>
        @include('layout.navigation')
        @yield('content')
        </header>

        <form id="signupForm" method="post" action="/signup" class="" autocomplete="off" data-reservation-mode="" data-auto-submit="" data-user="" data-signup-redirect="" >
            <h1>请激活您的账号</h1>
            <fieldset id="message" class="message">
                <p class="center">激活邮件已发送，请登录您的邮箱 {{ $email }} 激活账号。</p></fieldset>
            <fieldset id="quotes">
                <p>&ldquo;时光不老，我们不散&rdquo;
                    <cite>&ndash; 时光碎片</cite>
                </p>
            </fieldset>
        </form>

    </body>
</html>