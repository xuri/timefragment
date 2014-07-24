 <nav class="navbar navbar-fixed-top not-collapse bg-g-ln-gray" role="navigation">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ route('account') }}" class="hover-white-shade-bg">
            仪表盘
            <small class="font-w-100 text-gray-alt hidden-xs hidden-sm">时光碎片 | TimeFragment</small>
        </a>
    </div>
    <div id="top-nav">
        <a href="{{ route('home') }}" type="button" class="btn btn-default navbar-btn navbar-right btn-primary m-r-30 mm-r-10">返回首页</a>
        <div class="navbar-dropdown navbar-right navbar-avatar">
            <a href="{{ route('account.changePortrait') }}" data-target="#topavatar-toggle" class="hover-no-underline dropdown-toggle m-lr-30 mm-lr-10" data-toggle="dropdown">
                <img class="img-circle" width="25" src="{{ Auth::user()->portrait_large }}" alt="Avatar Large">
                @if(Auth::user()->nickname)
                <span class="text-gray-light hidden-sm hidden-xs">{{ Auth::user()->nickname }}</span>
                @elseif(Auth::user()->email)
                <span class="text-gray-light hidden-sm hidden-xs">{{ Auth::user()->email }}</span>
                @endif
                <span class="caret text-white hidden-sm hidden-xs"></span>
            </a>
            <ul id="topavatar-toggle" class="dropdown-menu avatar-dropdown">
                @if(! Auth::user()->is_admin){{--普通登录用户--}}
                <li><a href="{{ route('account.settings') }}">偏好设置</a></li>
                <li><a href="{{ route('signout') }}">退出登录</a></li>
                @elseif(Auth::user()->is_admin){{--管理员--}}
                <li><a href="{{ route('account') }}">仪表盘</a></li>
                <li><a href="{{ route('admin') }}">控制面板</a></li>
                <li><a href="{{ route('signout') }}">退出登录</a></li>
                @endif
            </ul>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <!-- <li>
                <a href="messages.html">
                    <span class="glyphicon glyphicon-envelope"></span>
                    <span class="text-white circle-12px bg-orange text-small text-center icon-counter">4</span>
                    <span class="hidden-sm hidden-xs">系统通知</span>
                </a>
            </li> -->
            <li class="dropdown">
                <ul class="dropdown-menu">
                    <li><a href="{{ route('account') }}">仪表盘</a>
                    </li>
                    <li><a href="{{ route('account.messages') }}">信息中心</a>
                    </li>
                    <li><a href="{{ route('account.messages') }}">我的创意汇</a>
                    </li>
                    <li><a href="{{ route('account.album') }}">我的去旅行</a>
                    </li>
                    <li><a href="{{ route('account.messages') }}">兼职与招聘</a>
                    </li>
                    <li><a href="{{ route('account.settings') }}">偏好设置</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="{{ route('signout') }}">登出</a>
                    </li>
                    <li><a href="{{ route('signup') }}">注册</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>