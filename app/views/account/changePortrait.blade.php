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
		<div class="bg-white p-30 m-t-10 brad b-bot-2px-gray-light b-right-1px-gray-light">
			<h2 class="text-center p-b-30 m-t-0 page-header">更改您的头像</h2>
			<div class="form-group">
				<p>上传头像支持 JPEG、GIF、PNG 格式，大小不大于 1MB。</p>
				{{ Form::open(array('method' => 'PUT', 'files' => true, 'class' => 'form')) }}
					<div style="margin: 20px 0 20px 0">
						<img class="img-circle" width="220" height="220" src="{{ Auth::user()->portrait_large }}">
						<img class="img-circle" width="128" height="128" src="{{ Auth::user()->portrait_medium }}">
						<img class="img-circle" width="64" height="64" src="{{ Auth::user()->portrait_small }}">
					</div>
					{{ Form::file('portrait') }}
					@include('layout.notification')
					<button class="btn btn-lg btn-primary" type="submit" style="margin: 20px 0 0 0;">上传头像</button>
				{{ Form::close() }}
			</div>
		</div>
	</div>
</body>
</html>