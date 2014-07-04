{{-- Jobs Section --}}
		<section id="jobs" class="section-content">
			<div class="container">

				{{-- Section title --}}
				<div class="section-title text-center">
					<div>
						<span class="line big"></span>
						<span>经历·分享·积累</span>
						<span class="line big"></span>
					</div>
					<a href="{{ route('jobs.getIndex') }}"><h1 class="item_left">酷工作</h1></a>
					<div>
						<span class="line"></span>
						<span>全面的职位信息资源平台</span>
						<span class="line"></span>
					</div>
				</div>
				{{-- Section title --}}

				<div class="row">
					<div class="col-md-10 col-md-offset-1">
						<div class="element-line">

							<div class="flexslider">
								<ul class="slides">

									@foreach($jobs as $job)
										@if($job->thumbnails)
										{{-- Item Slide --}}
										<li>
											<div class="slide-item">
												<div class="row">
													<div class="col-md-7">
														<img class="img-responsive img-center img-rounded" src="uploads/jobs_thumbnails/{{ $job->thumbnails }}" alt="{{ $job->title }}" title="{{ $job->title }}" />
													</div>
													<div class="col-md-5">
														<h2>{{ close_tags(Str::limit($job->title, 28)) }}</h2>
														<p class="lead">
															{{ close_tags(Str::limit($job->content, 200)) }}
														</p>
														<br />
														<div class="mybutton medium">
															<a href="{{ route('jobs.show', $job->slug) }}"> <span data-hover="详细信息">查看详情</span> </a>
														</div>
													</div>
												</div>
											</div>
										</li>
										{{-- Item Slide --}}
										@else
										@endif
									@endforeach
								</ul>
							</div>
						</div>
					</div>
				</div>

				<div class="service-items">
					<div class="row text-center">

						{{-- Banner item --}}
						<div class="col-md-3 col-sm-3 col-xs-12">
							<div class="element-line">
								<div class="item_top">
									<a href="#"> <i class="fa fa-smile-o fa-5x"></i> <h3>找兼职</h3> </a>
									<p>
										给就就职者全面的兼职信息，愿您在这里找到合适的职位。
									</p>
								</div>
							</div>
						</div>
						{{-- Banner item --}}

						{{-- Banner item --}}
						<div class="col-md-3 col-sm-3 col-xs-12">
							<div class="element-line">
								<div class="item_top">
									<a href="#"> <i class="fa fa-bullhorn fa-5x"></i> <h3>招聘信息发布</h3> </a>
									<p>
										为企业提供人才招聘、人才网、猎头、培训、测评和人事外包在内的全方位的人力资源服务。
									</p>
								</div>
							</div>
						</div>
						{{-- Banner item --}}

						{{-- Banner item --}}
						<div class="col-md-3 col-sm-3 col-xs-12">
							<div class="element-line">
								<div class="item_bottom">
									<a href="#"> <i class="fa fa-thumbs-o-up fa-5x"></i> <h3>酷工作</h3> </a>
									<p>
										为您提供最全最新最准确的企业职位招聘信息。
									</p>
								</div>
							</div>
						</div>
						{{-- Banner item --}}

						{{-- Banner item --}}
						<div class="col-md-3 col-sm-3 col-xs-12">
							<div class="element-line">
								<div class="item_right">
									<a href="#"> <i class="fa fa-check-circle-o fa-5x"></i> <h3>全面保护</h3> </a>
									<p>
										无论是招聘方还是受聘者，无论是出售方还是买家都享有担保，让您更放心。
									</p>
								</div>
							</div>
						</div>
						{{-- Banner item --}}

					</div>
				</div>
			</div>
		</section>
		{{-- Jobs Section --}}