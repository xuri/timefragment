{{-- Job Section --}}
		<section id="job" class="section-content">
			<div class="container">

				{{-- Section title --}}
				<div class="section-title text-center">
					<div>
						<span class="line big"></span>
						<span>经历·分享·积累</span>
						<span class="line big"></span>
					</div>
					<a href="{{ route('job.getIndex') }}"><h1 class="item_left">酷工作</h1></a>
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

									@foreach($job as $job)
										@if($job->thumbnails)
										{{-- Item Slide --}}
										<li>
											<div class="slide-item">
												<div class="row">
													<div class="col-md-7">
														<img class="img-responsive img-center img-rounded" src="uploads/job_thumbnails/{{ $job->thumbnails }}" alt="{{ $job->title }}" title="{{ $job->title }}" />
													</div>
													<div class="col-md-5">
														<h2>{{ close_tags(Str::limit($job->title, 28)) }}</h2>
														<p class="lead">
															{{ close_tags(Str::limit($job->content, 200)) }}
														</p>
														<br />
														<div class="mybutton medium">
															<a href="{{ route('job.show', $job->slug) }}"> <span data-hover="详细信息">查看详情</span> </a>
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
									<a href="#"> <i class="fa fa-thumbs-o-up fa-5x"></i> <h3>全职招聘信息</h3> </a>
									<p>
										这里有海量的全职招聘信息，是专门为求职者服务的平台，总有一个职位属于你。
									</p>
								</div>
							</div>
						</div>
						{{-- Banner item --}}

						{{-- Banner item --}}
						<div class="col-md-3 col-sm-3 col-xs-12">
							<div class="element-line">
								<div class="item_top">
									<a href="#"> <i class="fa fa-puzzle-piece fa-5x"></i> <h3>兼职招聘信息</h3> </a>
									<p>
										每天更新大量最新兼职招聘信息，为企业及个人免费提供兼职招聘信息搜索服务。
									</p>
								</div>
							</div>
						</div>
						{{-- Banner item --}}

						{{-- Banner item --}}
						<div class="col-md-3 col-sm-3 col-xs-12">
							<div class="element-line">
								<div class="item_bottom">
									<a href="#"> <i class="fa fa-smile-o fa-5x"></i> <h3>实习工作机会</h3> </a>
									<p>
										为正在寻找实习机会的在校学生提供方便、实用、高效的实习机会查询平台。
									</p>
								</div>
							</div>
						</div>
						{{-- Banner item --}}

						{{-- Banner item --}}
						<div class="col-md-3 col-sm-3 col-xs-12">
							<div class="element-line">
								<div class="item_right">
									<a href="#"> <i class="fa fa-bullhorn fa-5x"></i> <h3>发布职位信息</h3> </a>
									<p>
										为您提供人才招聘、猎头、培训、测评和人事外包在内的全方位的人力资源服务。
									</p>
								</div>
							</div>
						</div>
						{{-- Banner item --}}

					</div>
				</div>
			</div>
		</section>
		{{-- Job Section --}}