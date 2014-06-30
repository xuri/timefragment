<div class="portfolio-top"></div>
	{{-- Portfolio filters --}}
	<div class="element-line">
		<div id="filters" class="mybutton small">
			<a href="#" data-filter="*"><span data-hover="全部分类">显示所有</span></a>
			@foreach($categories as $category)
			<a href="#" data-filter=".{{ $category->name }}"><span data-hover="筛选">{{ $category->name }}</span></a>
			@endforeach
		</div>
	</div>
	{{-- Portfolio filters --}}

	<div id="portfolio-wrap">

		@foreach($creative as $single_creative)

		{{-- portfolio item --}}
		<div class="portfolio-item {{ $single_creative->category->name }} web">
			<div class="portfolio">
				<a href="{{ route('creative.show', $single_creative->slug) }}" target="_blank" class="zoom">
					@if($single_creative->thumbnails)
					<img src="{{ route('home') }}/uploads/creative_thumbnails/{{ $single_creative->thumbnails }}" alt="{{ $single_creative->title }}" title="{{ $single_creative->title }}">
					@else
					<img src="{{ route('home') }}/images/thumbnails/creative.jpg" alt="{{ $single_creative->title }}" title="{{ $single_creative->title }}">
					@endif
					<div class="hover-items">
						<span>
							@if($single_creative->user->nickname)
								<i class="fa fa-bars fa-4x"></i> <em class="lead">{{ $single_creative->title }}</em> <em>作者：{{ $single_creative->user->nickname }}</em>
							@else
								<i class="fa fa-bars fa-4x"></i> <em class="lead">{{ $single_creative->title }}</em> <em>创意分类：{{ $single_creative->category->name }}</em>
							@endif
						</span>
					</div>
				</a>
			</div>
		</div>
		{{-- portfolio item --}}
		@endforeach
	</div>

	{{-- Ajax Portfolio content --}}
	<div id="ajax-section">
		<div class="container clearfix">
			<div id="project-navigation" class="text-center">
				<ul>
					<li id="prevProject">
						<a href="#"><i class="fa fa-chevron-circle-left fa-2x"></i></a>
					</li>
					<li id="closeProject">
						<a href="#loader"><i class="fa fa-times-circle fa-2x"></i></a>
					</li>
					<li id="nextProject">
						<a href="#"><i class="fa fa-chevron-circle-right fa-2x"></i></a>
					</li>
				</ul>
			</div>

			{{-- Ajax loader --}}
			<div id="loader"></div>
			{{-- Ajax loader --}}

			<div id="ajax-content-outer">
				<div id="ajax-content-inner"></div>
			</div>
		</div>
	</div>

	<div class="col-md-12">
		<div class="element-line">
			{{ pagination($creative->appends(Input::except('page')), 'layout.home-paginator') }}
		</div>
	</div>

	<div class="clear"></div>
	{{-- Ajax content --}}