@include('layout.header')
@yield('content')
	<meta content="20; {{ route('home') }}" http-equiv="refresh">
	<body data-spy="scroll" data-target=".navbar" data-offset="75">

		{{-- Intro loader --}}
		<div class="mask">
			<div id="intro-loader"></div>
		</div>
		{{-- Intro loader --}}


		{{-- Home Section --}}
		<section id="home" class="intro-pattern">
			<div class="text-home">
				<div class="intro-item">
					<div class="section-title text-center">
						<h1>404<i>找不到页面</i></h1>
						<p class="lead">
							很遗憾，您要访问的页面不存在了。可能是由于您访问了一个错误的地址，或者这是一个过时的链接。
						</p>
					</div>
					<div class="mybutton ultra">
						<a class="start-button" href="{{ route('home') }}"> <span data-hover="时光碎片">回到首页</span> </a>
					</div>
				</div>
			</div>
		</section>
		<br />
		<br />
		{{-- Home Section --}}

		@include('layout.footer')
		@yield('content')