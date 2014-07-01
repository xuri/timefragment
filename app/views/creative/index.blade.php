@include('layout.header')
@yield('content')

	<body data-spy="scroll" data-target=".navbar" data-offset="75">

		{{-- Intro loader --}}
		<div class="mask">
			<div id="intro-loader"></div>
		</div>
		{{-- Intro loader --}}


		@include('layout.navigation')
		@yield('content')

		{{-- Blog Section --}}
		<section class="section-content blog-content">
			<div class="container">

				{{-- Section Title --}}
				<div class="section-title text-center">
					<div>
						<span class="line big"></span>
						<span><a href="{{ route('home') }}">时光碎片</a></span>
						<span class="line big"></span>
					</div>
					<h1>创意汇</h1>
					<div>
						<span class="line"></span>
						<span>每个人都可以拥有的设计</span>
						<span class="line"></span>
					</div>
					<p class="lead">
						<a href="{{ route('mycreative.create') }}" target="_blank"><i class="fa fa-lightbulb-o"></i> 分享创意</a>，在这里秀出你的创意，创意改变生活，汇聚智慧与灵感。
					</p>
				</div>
				{{-- Section Title --}}
			</div>

				@include('creative.gallery')
				@yield('content')
		</section>
		{{-- Blog Section --}}

		{{-- Parallax Container --}}
		@include('layout.footer')
		@yield('content')