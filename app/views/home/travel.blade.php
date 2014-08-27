{{-- Travel Section --}}
	<section id="travle" class="section-content">
		<div class="container">

			{{-- Section title --}}
			<div class="section-title text-center">
				<div>
					<span class="line big"></span>
					<span>读万卷书·行万里路</span>
					<span class="line big"></span>
				</div>
				<a href="{{ route('travel.getIndex') }}"><h1 class="item_left">去旅行</h1></a>
				<div>
					<span class="line"></span>
					<span>旅行的意义</span>
					<span class="line"></span>
				</div>
				<p class="lead">
					在这里畅谈那些我们去过的和想去的地方，欣赏美丽的海岸，清新的海风……
				</p>
			</div>
			{{-- Section title --}}

			<div class="row">
				@foreach($travel as $travel)
				{{-- Team item --}}
				@if($travel->thumbnails)
				<div class="col-md-3 col-sm-3 col-md-3 col-xs-12">
					<div class="element-line">
						<div class="item_top">
							<div class="img-rounded team-element zoom">
								<div class="team-inner">
									<div class="team-detail">
										<div class="team-content">
											<a href="{{ route('travel.show', $travel->slug) }}"><h3><strong>{{ close_tags(Str::limit($travel->title, 14)) }}</strong></h3></a>

											<p>
												来自：{{ $travel->user->nickname }}
											</p>
											<ul>
												<li>
													<a href="http://www.linkedin.com/shareArticle?mini=true&url={{ route('travel.show', $travel->slug) }}" title="分享到Linkedin" alt="分享到Linkedin" target="_blank"><i class="fa fa-linkedin fa-2x"></i></a>
												</li>
												<li>
													<a href="http://widget.weibo.com/dialog/PublishWeb.php?default_text=分享内容：{{ route('travel.show', $travel->slug) }}（来自 @时光碎片网）&refer=y&language=zh_cn&app_src=2ohpjs&button=pubilish" target="_blank" title="分享到新浪微博" alt="分享到新浪微博"><i class="fa fa-weibo fa-2x"></i></a>
												</li>
												<li>
													<a href="http://v.t.qq.com/share/share.php?url={{ route('travel.show', $travel->slug) }}" title="分享到腾讯微博" alt="分享到腾讯微博" target="_blank"><i class="fa fa-tencent-weibo fa-2x"></i></a>
												</li>
												<li>
													<a href="http://share.renren.com/share/buttonshare.do?link={{ route('travel.show', $travel->slug) }}" title="分享到人人网" alt="分享到人人网" target="_blank"><i class="fa fa-renren fa-2x"></i></a>
												</li>
											</ul>

										</div>
									</div>
								</div>

								<img src="uploads/travel_large_thumbnails/{{ $travel->thumbnails }}" alt="{{ $travel->title }}" title="{{ $travel->title }}" class="img-responsive">

							</div>
						</div>
					</div>
				</div>
				@else
				@endif
				{{-- Team item --}}
				@endforeach
			</div>
		</div>
	</section>
{{-- Travel Section --}}