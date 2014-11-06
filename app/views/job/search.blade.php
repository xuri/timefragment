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
					<h1>酷工作搜索结果</h1>
				</div>
				{{-- Section title --}}

				<div class="row">
					<div class="col-md-9">
						@if ($datas->first())
							@foreach($datas as $data)
							<div class="element-line">
								<div class="post type-post status-publish format-standard">
									<div class="blog-text">
										<h2>
											<a href="{{ route('job.show', $data->slug) }}">{{ $data->title }}</a>
										</h2>
										@if($data->user->nickname)
										<span class="post-info">发布时间 <i class="fa fa-calendar"></i> {{ $data->friendly_created_at }} 用户 <a href="#" title="{{ $data->user->nickname }}" rel="author">{{ $data->user->nickname }}</a> 发布在 <ul class="post-categories"><li><a href="{{ route('job.category', $data->category_id) }}" title="查看{{ JobCategories::where('id', $data->id)->first()->name }}下的所有文章" rel="category tag">{{ JobCategories::where('id', $data->id)->first()->name }}</a></li></ul> {{ $data->comments_count }}评论</a> </span>
										@else
										<span class="post-info">发布时间 <i class="fa fa-calendar"></i> 一个未设定昵称的用户发布在 <ul class="post-categories"><li><a href="{{ route('job.category', $data->category_id) }}" title="查看{{ JobCategories::where('id', $data->id)->first()->name }}下的所有文章" rel="category tag">{{ JobCategories::where('id', $data->id)->first()->name }}</a></li></ul> {{ $data->comments_count }}评论</a> </span>
										@endif
										<p>{{ $data->excerpt }}</p>
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
					@include('job.sidebar')
					@yield('content')
				</div>

				<div class="row">
					<div class="col-md-12">
						<div class="element-line">
							{{ pagination($datas->appends(Input::except('page')), 'layout.home-paginator') }}
						</div>
					</div>
				</div>

			</div>
		</section>
		{{-- Blog Section --}}

		{{-- Parallax Container --}}
		@include('layout.footer')
		@yield('content')