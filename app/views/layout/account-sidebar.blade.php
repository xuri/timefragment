<div class="sidebar bg-gray-dark text-white text-center pushy pushy-left" style="left: 0; !important">
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
        <!-- <li>
            <a href="{{ route('account.messages') }}" class="text-left">
				信息中心
				<span class="badge bg-blue-light pull-right text-gray-dark brad-small">4</span>
			</a>
        </li> -->
        <li>
            <a href="#" class="text-left dropdown-toggle" data-toggle="dropdown">
                我的创意汇
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu" role="menu">
                <li>
                    <a href="{{ route('mycreative.create') }}">分享新创意</a>
                </li>
                <li>
                    <a href="{{ route('mycreative.index') }}">我的创意</a>
                </li>
                <li>
                    <a href="{{ route('mycreative.comments') }}">创意汇评论</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#" class="text-left dropdown-toggle" data-toggle="dropdown">
                我的去旅行
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu" role="menu">
                <li>
                    <a href="{{ route('mytravel.create') }}">撰写新文章</a>
                </li>
                <li>
                    <a href="{{ route('mytravel.index') }}">我的旅行记录</a>
                </li>
                <li>
                    <a href="{{ route('mytravel.comments') }}">去旅行评论</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#" class="text-left dropdown-toggle" data-toggle="dropdown">
                我的尚品汇
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu" role="menu">

                <li>
                    <a href="{{ route('myproduct.cart') }}">我的购物车</a>
                </li>
                <li>
                    <a href="{{ route('order.index') }}">尚品汇购物</a>
                </li>
                <li>
                    <a href="{{ route('myproduct.index') }}">出售的商品</a>
                </li>
                <li>
                    <a href="{{ route('order.seller') }}">商家订单库</a>
                </li>
                <li>
                    <a href="{{ route('myproduct.comments') }}">尚品汇评论</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#" class="text-left dropdown-toggle" data-toggle="dropdown">
                招聘信息管理
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu" role="menu">
                <li>
                    <a href="{{ route('myjob.create') }}">发布酷工作</a>
                </li>
                <li>
                    <a href="{{ route('myjob.index') }}">我的招聘</a>
                </li>
                <li>
                    <a href="{{ route('myjob.comments') }}">酷工作评论</a>
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

    <!-- <div class="bg-gray-dark-shade text-left search">
        <i class="glyphicon glyphicon-search text-gray-alt"></i>
        <input type="text" placeholder="站内搜索" class="input-invisible">
    </div> -->

</div>