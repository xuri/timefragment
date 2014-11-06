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
						<a href="{{ route('home') }}"><span>时光碎片</span></a>
						<span class="line big"></span>
					</div>
					<h1>搜索结果</h1>
				</div>
				{{-- Section title --}}

				<div class="row">
					<div class="col-md-9">
						@if ($articles->first())
							@foreach($articles as $article)
							<div class="element-line">
								<div class="post type-post status-publish format-standard">
									<div class="blog-text">
										<h2>
											<a href="{{ route('article.show', $article->slug) }}">{{ $article->title }}</a>
										</h2>
										@if($article->user->nickname)
										<span class="post-info">发布时间 <i class="fa fa-calendar"></i> {{ $article->friendly_created_at }} 用户 <a href="#" title="{{ $article->user->nickname }}" rel="author">{{ $article->user->nickname }}</a> 发布在 <ul class="post-categories"><li><a href="{{ route('article.category', $article->category_id) }}" title="查看{{ Category::where('id', $article->id)->first()->name }}下的所有文章" rel="category tag">{{ Category::where('id', $article->id)->first()->name }}</a></li></ul> {{ $article->comments_count }}评论</a> </span>
										@else
										<span class="post-info">发布时间 <i class="fa fa-calendar"></i> 一个未设定昵称的用户发布在 <ul class="post-categories"><li><a href="{{ route('article.category', $article->category_id) }}" title="查看{{ Category::where('id', $article->id)->first()->name }}下的所有文章" rel="category tag">{{ Category::where('id', $article->id)->first()->name }}</a></li></ul> {{ $article->comments_count }}评论</a> </span>
										@endif
										<p>{{ $article->excerpt }}</p>
									</div>

									<!-- <div class="post-tags">
										<div class="icon"><i class="fa fa-tags fa-lg"></i> 标签:</div>
										<a href="#" rel="tag">Tag1</a>
										<a href="#" rel="tag">Tag2</a>
										<a href="#" rel="tag">Tag3</a>
									</div> -->
								</div>
							</div>
							@endforeach
						@else
						 <div class="element-line">
							<div class="post type-post status-publish format-standard">
								<div class="blog-text">
									<h2>有点尴尬，没有找到相关内容。</h2>
									<span class="post-info">请您尝试使用其他关键词搜索。</span>
								</div>
							</div>
						</div>
						@endif
					</div>
					@include('article.sidebar')
					@yield('content')
				</div>

				<div class="row">
					<div class="col-md-12">
						<div class="element-line">
							{{ pagination($articles->appends(Input::except('page')), 'layout.home-paginator') }}
						</div>
					</div>
				</div>

			</div>
		</section>
		{{-- Blog Section --}}

		{{-- Parallax Container --}}
		@include('layout.footer')
		@yield('content')