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

			{{-- Section title --}}
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
					每个人都可以拥有设计，在这里秀出你的创意，创意改变生活，汇聚智慧与灵感
				</p>
			</div>
			{{-- Section title --}}

			<div class="row">
				@include('home.content')
				@yield('content')
				@include('layout.sidebar')
				@yield('content')
			</div>

			<div class="row">
				<div class="col-md-12">
					<div class="element-line">
						<div class="pager">

						</div>
					</div>
				</div>
			</div>

		</div>
	</section>
{{-- Blog Section --}}

{{-- Parallax Container --}}
@include('layout.footer')
@yield('content')