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
						<span><a href="{{ route('product.getIndex') }}">时光碎片 · 尚品汇</a></span>
						<span class="line big"></span>
					</div>
					<h1>{{ $product->title }}</h1>
					<div>
						<span class="line"></span>
						<span>{{ $product->category->name }}</span>
						<span class="line"></span>
					</div>

					@if($product->user->nickname)
					<p class="lead">
						卖家 {{ $product->user->nickname }} 出售的商品，发布于{{ $product->friendly_created_at }}
					</p>
					@else
					<p class="lead">
						发布于{{ $product->friendly_created_at }}
					</p>
					@endif
				</div>
				{{-- Section title --}}

				<div class="p-lr-30 p-tb-10 pm-lr-10">
                    @include('layout.notification')
                </div>

				<div class="row">
					@include('product.content')
					@yield('content')
					@include('product.sidebar')
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