    <div class="sidebar bg-gray-dark text-white text-center pushy pushy-left">
        <header class="bg-g-ln-gray p-tb-30 pm-tb-10 p-lr-10 b-bot-2px-gray-dark hidden-xs">
            <a href="index.html#" data-target="#avatar-toggle" class="hover-no-underline dropdown-toggle" data-toggle="dropdown">
                <img class="img-circle" width="35" src="{{ Auth::user()->portrait_large }}">
                <span class="text-gray-alt">欢迎</span>
                <span class="text-gray-light">{{ Auth::user()->nickname }}</span>
                <span class="caret white"></span>
            </a>
        </header>
        <ul id="avatar-toggle" class="dropdown-sidebar-avatar" role="menu" aria-labelledby="dLabel">
            @if(! Auth::user()->is_admin){{--普通登录用户--}}
            <li><a href="{{ route('account.settings') }}">偏好设置</a></li>
            <li><a href="{{ route('signout') }}">退出登录</a></li>
            @elseif(Auth::user()->is_admin){{--管理员--}}
            <li><a href="{{ route('account.settings') }}">偏好设置</a></li>
            <li><a href="{{ route('admin') }}">控制面板</a></li>
            <li><a href="{{ route('signout') }}">退出登录</a></li>
            @endif
        </ul>

        <hr class="no-margin">

        <ul class="unstyled nav">
            <li>
                <a href="{{ route('admin') }}" class="text-left">控制面板</a>
            </li>
            <li>
                <a href="{{ route('users.index') }}" class="text-left">用户管理</a>
            </li>
            <li>
                <a href="{{ route('server.index') }}" class="text-left">网站配置</a>
            </li>
            <li>
                <a href="#" class="text-left dropdown-toggle" data-toggle="dropdown">
                        内容管理
                        <b class="caret"></b>
                    </a>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="{{ route('mycategories.index') }}" class="text-left">分类管理</a>
                    </li>
                    <li>
                        <a href="{{ route('myarticles.index') }}" class="text-left">文章管理</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#" class="text-left dropdown-toggle" data-toggle="dropdown">
                        创意汇
                        <b class="caret"></b>
                    </a>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="{{ route('creative_categories.index') }}" class="text-left">创意汇分类管理</a>
                    </li>
                    <li>
                        <a href="{{ route('creative.index') }}" class="text-left">创意汇管理</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#" class="text-left dropdown-toggle" data-toggle="dropdown">
                        去旅行
                        <b class="caret"></b>
                    </a>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="{{ route('travel_categories.index') }}" class="text-left">去旅行话题管理</a>
                    </li>
                    <li>
                        <a href="{{ route('travel.index') }}" class="text-left">去旅行管理</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#" class="text-left dropdown-toggle" data-toggle="dropdown">
                        酷工作
                        <b class="caret"></b>
                    </a>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="{{ route('jobs_categories.index') }}" class="text-left">酷工作分类管理</a>
                    </li>
                    <li>
                        <a href="{{ route('jobs.index') }}" class="text-left">招聘信息管理</a>
                    </li>
                </ul>
            </li>
        </ul>

        <div class="bg-gray-dark-shade text-left search">
            <i class="glyphicon glyphicon-search text-gray-alt"></i>
            <input type="text" placeholder="站内搜索" class="input-invisible">
        </div>

    </div>