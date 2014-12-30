{{-- Navbar --}}
	<div id="navigation" class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="navbar-inner">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">导航菜单</span>
					<i class="fa fa-bars fa-2x"></i>
				</button>
				<a id="brand" href="{{ route('home') }}">
					{{HTML::image('assets/img/logo.png', '', array('width'=>'80', 'height'=>'40')); }}
				</a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">
					<li>
						<a href="{{ route('home') }}" class="int-collapse-menu" >首页 </a>
					</li>

					<li>
						<a href="{{ route('article.index') }}" class="int-collapse-menu">关于</a>
					</li>
					<li>
						<a href="{{ route('creative.getIndex') }}" class="int-collapse-menu">创意汇</a>
					</li>
					<li>
						<a href="{{ route('travel.getIndex') }}" class="int-collapse-menu">去旅行</a>
					</li>
					{{--
					<li>
						<a href="{{ route('portfolio') }}" class="int-collapse-menu">爱聊吧</a>
					</li>
					--}}
					<li>
						<a href="{{ route('product.getIndex') }}" class="int-collapse-menu">尚品汇</a>
					</li>
					<li>
						<a href="{{ route('job.getIndex') }}" class="int-collapse-menu">酷工作</a>
					</li>
					<li>
						<a href="{{ route('timeline') }}" class="int-collapse-menu">时间线</a>
					</li>
					<li>
						<a href="{{ route('home') }}#contact" class="int-collapse-menu">联系我们</a>
					</li>
					@if(Auth::guest()){{--游客--}}
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">登陆 / 注册 <i class="fa fa-angle-down"></i></a>
						<ul class="dropdown-menu">
							<li><a href="{{ route('signup') }}"><i class="fa fa-ellipsis-h"></i> &nbsp; 立即注册</a></li>
							<li><a href="{{ route('signin') }}"><i class="fa fa-sign-in"></i> &nbsp; 已有账号登陆</a></li>
						</ul>
					</li>
					@elseif(! Auth::user()->is_admin){{--普通登录用户--}}
					<li class="dropdown">
						@if (Auth::user()->nickname)
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"> {{ Auth::user()->nickname }} <i class="fa fa-angle-down"></i></a>
						@else
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"> {{ Auth::user()->email }} <i class="fa fa-angle-down"></i></a>
						@endif
						<ul class="dropdown-menu">
							<li><a href="{{ route('account') }}"><i class="fa fa-dashboard"></i> &nbsp; 仪表盘</a></li>
							<li><a href="{{ route('signout') }}"><i class="fa fa-sign-out"></i> &nbsp; 退出登录</a></li>
						</ul>
					</li>
					@elseif(Auth::user()->is_admin){{--管理员--}}
					<li class="dropdown">
						@if (Auth::user()->nickname)
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"> {{ Auth::user()->nickname }} <i class="fa fa-angle-down"></i></a>
						@else
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"> {{ Auth::user()->email }} <i class="fa fa-angle-down"></i></a>
						@endif
						<ul class="dropdown-menu">
							<li><a href="{{ route('account') }}"><i class="fa fa-dashboard"></i> &nbsp; 仪表盘</a></li>
							<li><a href="{{ route('admin') }}"><i class="fa fa-cogs"></i> &nbsp; 控制面板</a></li>
							<li><a href="{{ route('signout') }}"><i class="fa fa-sign-out"></i> &nbsp; 退出登录</a></li>
						</ul>
					</li>
					@endif
				</ul>
			</div>
		</div>
	</div>
{{-- Navbar --}}