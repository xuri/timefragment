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
        <li><a href="{{ route('account') }}" class="text-left">仪表盘</a>
        </li>
        <li>
            <a href="{{ route('account.messages') }}" class="text-left">
				信息中心
				<span class="badge bg-blue-light pull-right text-gray-dark brad-small">4</span>
			</a>
        </li>
        <li><a href="{{ route('mycreative.index') }}" class="text-left">我的创意汇</a>
        </li>
        <li><a href="{{ route('mytravel.index') }}" class="text-left">我的去旅行</a>
        </li>
        <li><a href="{{ route('myproduct.create') }}" class="text-left">我要卖东西</a>
        </li>
        <li><a href="{{ route('myjob.create') }}" class="text-left">发布酷工作</a>
        </li>
        <li>
            <a href="#" class="text-left dropdown-toggle" data-toggle="dropdown">
                    我的评论
                    <b class="caret"></b>
                </a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="{{ route('mycreative.comments') }}">创意汇评论</a>
                </li>
                <li><a href="{{ route('mytravel.comments') }}">去旅行评论</a>
                </li>
                <li><a href="{{ route('myproduct.comments') }}">乐换购评论</a>
                </li>
                <li><a href="{{ route('myjob.comments') }}">酷工作评论</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#" class="text-left dropdown-toggle" data-toggle="dropdown">
                    偏好设置
                    <b class="caret"></b>
                </a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="{{ route('account.settings') }}">基本信息</a></li>
                <li><a href="{{ route('account.changePortrait') }}">更改头像</a></li>
                <li><a href="{{ route('account.changePassword') }}">密码安全</a></li>
            </ul>
        </li>
    </ul>

    <div class="bg-gray-dark-shade text-left search">
        <i class="glyphicon glyphicon-search text-gray-alt"></i>
        <input type="text" placeholder="站内搜索" class="input-invisible">
    </div>

</div>