@include('layout.account-header')
@yield('content')
<body class="bg-gray-light">
    @include('layout.admin-navigation')
    @yield('content')

    @include('layout.admin-sidebar')
    @yield('content')
    <div class="preloader">
        <div class="timer"></div>
    </div>
    <div id="container" class="main-content p-30 tp-t-60 tp-lr-10">

        <button class="menu-btn btn btn-bordered text-gray-alt text-bold top-left-corner">&#9776; 菜单</button>
        <div class="row">
            <div class="col-sm-12">
                <div class="bg-white p-tb-30">

                    <div class="btn-group">
                        <div class="iconmelon m-r-10 m-l-30">
                            <svg viewBox="0 0 32 32">
                                <g filter="">
                                    <use xlink:href="#speech-talk-user"></use>
                                </g>
                            </svg>
                        </div>

                        <span class="text-gray-dark text-large align-with-button m-r-30">
                            编辑{{ $resourceName }}
                        </span>
                    </div>

                    <div class="pull-right m-r-30 mail-nav">
                        <a href="{{ route($resource.'.index') }}" class="btn btn-bordered text-gray-alt">
                            &laquo; 返回{{ $resourceName }}列表
                        </a>
                    </div>

                    <div class="p-lr-30 p-tb-10 pm-lr-10">
                        @include('layout.notification')
                    </div>

                    <div class="p-lr-30 p-tb-10 pm-lr-10">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#tab-general" data-toggle="tab">
                                    <div class="text-small">Main Content</div>
                                    <span class="text-uppercase">主要内容</span>
                                </a>
                            </li>
                            <li>
                                <a href="#tab-meta-data" data-toggle="tab">
                                    <div class="text-small">Permission Settings</div>
                                    <span class="text-uppercase">权限相关</span>
                                </a>
                            </li>
                        </ul>

                        <form class="form-horizontal" method="post" action="{{ route($resource.'.update', $data->id) }}" autocomplete="off" style="padding:1em;border:1px solid #ddd;border-top:0;">
                            {{-- CSRF Token --}}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="_method" value="PUT" />

                            {{-- Tabs Content --}}
                            <div class="tab-content">

                                {{-- General tab --}}
                                <div class="tab-pane active fade p-30 in" id="tab-general" style="margin:0 1em;">

                                    <div class="form-group">
                                        <label for="email">邮箱</label>
                                        {{ $errors->first('email', '<span style="color:#c7254e;margin:0 1em;">:message</span>') }}
                                        <input class="form-control" type="text" name="email" id="email" value="{{ Input::old('email', $data->email) }}" />
                                    </div>

                                    <div class="form-group">
                                        <label for="password">密码</label>
                                        {{ $errors->first('password', '<span style="color:#c7254e;margin:0 1em;">:message</span>') }}
                                        <input class="form-control" type="password" name="password" id="password" value="" />
                                    </div>

                                    <div class="form-group">
                                        <label for="password_confirmation">确认密码</label>
                                        <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" value="" />
                                    </div>

                                </div>

                                {{-- Meta Data tab --}}
                                <div class="tab-pane fade p-30" id="tab-meta-data" style="margin:0 1em;">

                                    <div class="form-group">
                                        <label for="meta_title">用户身份</label>
                                        {{ $errors->first('is_admin', '<span style="color:#c7254e;margin:0 1em;">:message</span>') }}
                                        <div>
                                            <input type="checkbox" name="is_admin" value="1"
                                                {{ Input::old('is_admin', $data->is_admin) ? 'checked': ''; }}
                                                data-on="danger" data-off="default" data-text-label="　　　　"
                                                data-on-label="管理员" data-off-label="普通用户">
                                        </div>
                                    </div>

                                </div>

                            </div>

                            {{-- Form actions --}}
                            <div class="control-group p-l-30 p-b-30">
                                <div class="controls">
                                    <a class="btn btn-bordered text-gray-alt" href="{{ route($resource.'.edit', $data->id) }}">重 置</a>
                                    <button type="submit" class="btn btn-success">提 交</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- /main content --}}
    {{ style('bootstrap-3-switch') }}
    {{ script('bootstrap-3-switch') }}
    <script>
         $('input[type="checkbox"],[type="radio"]').bootstrapSwitch();
    </script>
</body>

</html>
