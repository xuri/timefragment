@include('layout.account-header')
@yield('content')
</head>

<body class="bg-gray-light">

    @include('layout.account-navigation')
    @yield('content')

    @include('layout.account-sidebar')
    @yield('content')


    <div id="container" class="main-content p-30 tp-t-60 tp-lr-10">

        <button class="menu-btn btn btn-bordered text-gray-alt text-bold top-left-corner">&#9776; 菜单</button>


        <div class="row">
            <div class="col-sm-3 text-center">
                <div class="p-10 brad">
                    <a href="{{ route('account.changePortrait') }}" class="center-on-hover">
                        <img class="img-circle" width="115" height="115" src="{{ Auth::user()->portrait_large }}" alt="Avatar Large">
                        <span class="btn btn-primary centered-element">更改</span>
                    </a>

                    <div>
                        <div>
                            <div class="editable i-block" contenteditable>
                                <h3 class="m-b-0">{{ Auth::user()->nickname }}</h3>
                            </div>
                        </div>
                        <div>
                            <div class="editable text-gray-alt i-block" contenteditable>
                                <span class="m-t-10 d-block">{{ Auth::user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="bg-white p-30 brad b-bot-2px-gray-light b-right-1px-gray-light">
                    <div class="row">
                        <div class="col-sm-5 text-center">
                            <div class="circle-50-icon bg-green-dark m-t-10">
                                <div class="iconmelon icon-white">
                                    <svg viewBox="0 0 32 32">
                                        <g filter="">
                                            <use xlink:href="#chaplin-hat-movie"></use>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                            <div class="text-large text-gray-alt">在线</div>
                            <a href="pricing.html" class="btn btn-primary btn-lg m-t-10">测试按钮</a>
                        </div>
                        <div class="col-sm-7">
                            <h4>上次成功登陆时间</h4>
                            <p class="text-gray-alt">{{ Auth::user()->signin_at }}</p>
                            <hr>
                            <h4 class="">加入时间</h4>
                            <p class="text-gray-alt">{{ Auth::user()->created_at }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white p-30 m-t-10 brad b-bot-2px-gray-light b-right-1px-gray-light">
            <h2 class="text-center p-b-30 m-t-0 page-header">密码与安全</h2>
            {{-- Form::open(array('class' => 'form-horizontal')) --}}
                <!--
                <div class="form-group">
                    <label class="col-sm-2 control-label">更改邮箱</label>
                    <div class="col-sm-10 m-t-10">
                        <div class="m-b-10">
                            <div>您的登录密码</div>
                            <input type="text" class="input-large input-light brad">
                        </div>
                        <div class="m-b-10">
                            <div>新的邮箱地址</div>
                            <input type="text" class="input-large input-light brad">
                        </div>
                    </div>
                </div> -->
            {{-- Form::close() --}}
            {{ Form::open(array('class' => 'form-horizontal')) }}
                <div class="form-group">
                    <label class="col-sm-2 control-label">密码与安全</label>
                    <!-- CSRF Token -->
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <input type="hidden" name="_method" value="PUT" />
                    <div class="col-sm-10 m-t-10">
                        <div class="m-b-10">
                            <div>旧密码</div>
                            <input name="password_old" type="password" class="input-large input-light brad">
                        </div>
                        {{ $errors->first('password_old', '<strong class="error" style="color: #cc0000">:message</strong>') }}
                        <div class="m-b-10">
                            <div>新密码</div>
                            <input name="password" type="password" class="input-large input-light brad">
                        </div>
                        <div class="m-b-10">
                            <div>重复新密码</div>
                            <input name="password_confirmation" type="password" class="input-large input-light brad">
                        </div>
                        {{ $errors->first('password', '<strong class="error" style="color: #cc0000">:message</strong>') }}
                        @include('layout.notification')
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <button class="btn btn-lg btn-primary" type="submit">保存更改</button>
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
</body>
</html>