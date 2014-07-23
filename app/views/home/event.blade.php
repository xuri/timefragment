{{-- Blog Section --}}
		<section id="timeline" class="section-content timeline-content bgdark">
			<div class="container">

				{{-- Section title --}}
				<div class="section-title text-center">
					<div>
						<span class="line big"></span>
						<span>记录·分享·回忆</span>
						<span class="line big"></span>
					</div>
					<a href="{{ route('timeline') }}" target="_blank"><h1 class="item_right">时间线</h1></a>
					<div>
						<span class="line"></span>
						<span>记录生活点滴, 捕捉感动瞬间</span>
						<span class="line"></span>
					</div>
					<p class="lead">
						时光不老，我们不散
					</p>
				</div>
				{{-- Section title --}}
				@if(Auth::user())
				<div class="element-line">
					<ol id="timeline">
						@foreach($timeline as $event)
						<?php
							$user_id = $event->user_id;
						    $slug    = $event->slug;
						    $model   = $event->model;
						    $event   = $model::where('slug', $slug)->first();

							switch ($model)
							{
								case "Creative":
									$show = 'creative.show';
									$uploads = 'uploads/creative/';
								break;
								case "Travel":
									$show = 'travel.show';
									$uploads = 'uploads/travel/';
								break;
								case "Product":
									$show = 'product.show';
							        $uploads = 'uploads/products/';
								break;
								case "Job":
									$show = 'job.show';
							        $uploads = 'uploads/jobs/';
								break;
								default:
									$show = 'none';
									$uploads = 'none';
							}
						?>
						{{-- Timeline item --}}
						<li class="timeline-item">
							<div>
								<div class="well post">
									<div class="post-info bgdark text-center">
										<h5 class="info-date">{{ date("M d, Y",strtotime($event->created_at)) }}<small>{{ date("H:m",strtotime($event->created_at)) }}</small></h5>
										<a href="#" class="box-inner rotate">
											<img src="
											 {{ $event->user->portrait_large }}" class="img-circle img-responsive" alt="{{ $event->user->nickname }}" title="{{ $event->user->nickname }}">
										</a>
										<h5>{{ $event->user->nickname }}</h5>
									</div>
									<div class="post-body clearfix">
										<div class="blog-title">
											<h1><a href="{{ route($show, $event->slug) }}" target="_blank">{{ $event->title }}</a></h1>
										</div>
										@if($event->thumbnails)
										<a href="#" class="zoom">
											{{ HTML::image($uploads.$event->thumbnails, '', array('class' => 'img-responsive')); }}
										</a>
										@else
										@endif
										<div class="post-text" style="text-align: left;">
											<p class="lead">
												{{ close_tags(Str::limit($event->content, 200)) }}
											</p>
										</div>
									</div>
									<div class="post-arrow"></div>
								</div>
							</div>
						</li>
						{{-- Timeline item --}}
						@endforeach
					</ol>
				</div>
				@else
				@endif

			</div>
		</section>
		{{-- Blog Section --}}