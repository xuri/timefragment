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
                            添加新{{ $resourceName }}
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
                        </ul>

                        <form class="form-horizontal" method="post" action="{{ route($resource.'.store') }}" autocomplete="off" style="padding:1em;border:1px solid #ddd;border-top:0;">
                            {{-- CSRF Token --}}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                            {{-- Tabs Content --}}
                            <div class="tab-content">

                                {{-- General tab --}}
                                <div class="tab-pane active fade p-30 in" id="tab-general" style="margin:0 1em;">

                                    <div class="form-group">
                                        <label for="name">名称</label>
                                        {{ $errors->first('name', '<span style="color:#c7254e;margin:0 1em;">:message</span>') }}
                                        <input class="form-control" type="text" name="name" id="name" value="{{ Input::old('name') }}" />
                                    </div>

                                    <div class="form-group">
                                        <label for="sort_order">简介</label>
                                        {{ $errors->first('content', '<span style="color:#c7254e;margin:0 1em;">:message</span>') }}
                                        <textarea class="form-control" type="text" name="content" id="content" placeholder="请在这里输入分类简介……" rows="9">{{ Input::old('content') }}</textarea>
                                        {{ $errors->first('content', '<span style="color:#c7254e;margin-top:1em;float:left;">:message</span>') }}
                                    </div>

                                    <div class="form-group">
                                        <label for="sort_order">排序</label>
                                        {{ $errors->first('sort_order', '<span style="color:#c7254e;margin:0 1em;">:message</span>') }}
                                        <input class="form-control" type="text" name="sort_order" id="sort_order" value="{{ Input::old('sort_order') }}" />
                                    </div>

                                </div>

                            </div>

                            {{-- Form actions --}}
                            <div class="control-group p-l-30 p-b-30">
                                <div class="controls">
                                    <button type="reset" class="btn btn-bordered text-gray-alt">清 空</button>
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
</body>

</html>