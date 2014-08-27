@include('layout.header')
@yield('content')
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
						<h1>503<i>服务器维护中</i></h1>
						<p class="lead">
							您好，我们正在维护服务器，请稍后访问。
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