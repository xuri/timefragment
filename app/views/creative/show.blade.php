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
						<span><a href="{{ route('creative.getIndex') }}">时光碎片·创意汇</a></span>
						<span class="line big"></span>
					</div>
					<h1>{{ $creative->title }}</h1>
					<div>
						<span class="line"></span>
						<span>{{ $creative->category->name }}</span>
						<span class="line"></span>
					</div>

					@if($creative->user->nickname)
					<p class="lead">
						来自 {{ $creative->user->nickname }} 的创意，发布于{{ $creative->friendly_created_at }}
					</p>
					@else
					<p class="lead">
						发布于{{ $creative->friendly_created_at }}
					</p>
					@endif
				</div>
				{{-- Section title --}}

				<div class="row">
					@include('creative.content')
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