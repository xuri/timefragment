{{-- About Section --}}
	<section id="about" class="section-content">
		<div class="container">

			{{-- Section title --}}
			<div class="section-title text-center">
				<div>
					<span class="line big"></span>
					<span>我和世界爱着你</span>
					<span class="line big"></span>
				</div>
				<a href="{{ route('article.index') }}" target="_blank"><h1 class="item_right">关于我们</h1></a>
				<div>
					<span class="line"></span>
					<span>我们是时尚生活与创意设计的探索者</span>
					<span class="line"></span>
				</div>
				<p class="lead">
					这是哪里？——这里是时光碎片，是一个集创意分享，二手交易及兼职信息发布，聊天交友，经验分享等为一体的综合服务社区，旨在充分高效的利用业余时间，愿你在这里能够获得舒爽，充实的浏览体验
				</p>
			</div>
			{{-- Section title --}}

			<div class="row">
				{{-- item media --}}
				@foreach($articles as $article)
				@if($article->article_icon)
				<div class="col-md-6">
					<div class="element-line">
						<div class="item_left">
							<div class="media">
								<a class="pull-left rotate" href="{{ route('article.show', $article->slug) }}">
									<i class="hi-icon fa {{ $article->article_icon }} fa-4x" style="background:#0098f9; margin:0;"></i>
								</a>
								<div class="media-body">
									<h3 class="media-heading"><a href="{{ route('article.show', $article->slug) }}">{{ $article->title }}</a></h3>
									<p>
										{{ close_tags(Str::limit($article->excerpt, 93)) }}
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				@endif
				@endforeach
				{{-- item media --}}
			</div>
		</div>
	</section>
{{-- About Section --}}