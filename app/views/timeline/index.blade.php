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
		<section id="blog" class="section-content timeline-content bgdark">
			<div class="container">

				{{-- Section title --}}
				<div class="section-title text-center">
					<div>
						<span class="line big"></span>
						<span><a href="{{ route('home') }}">时光碎片</a></span>
						<span class="line big"></span>
					</div>
					<h1 class="item_right">时间线</h1>
					<div>
						<span class="line"></span>
						<span>记录生活点滴, 捕捉感动瞬间</span>
						<span class="line"></span>
					</div>
					<p class="lead">
						We're a close team of creatives, designers &amp; developers who work together to create beautiful, engaging digital experiences. We take pride in delivering only the best.
					</p>
				</div>
				{{-- Section title --}}

				<div class="element-line">
					<ol id="timeline">


						@foreach($timeline as $event)
						<?php
							$user_id = $event->user_id;
						    $slug    = $event->slug;
						    $model   = $event->model;
						    $event   = $model::where('slug', $slug)->first();

						    if($model = "Creative")
						    {
						        $show = 'creative.show';
						        $uploads = 'uploads/creative/';
						    }
						    elseif ($model = "Travel")
						    {
						        $show = 'travel.show';
						    }
						    elseif ($model = "Product")
						    {
						        $show = 'product.show';
						    }
						    elseif ($model = "Job")
						    {
						        $show = 'job.show';
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

			</div>
		</section>
		<br />
		<br />

		{{-- Blog Section --}}
		{{-- Parallax Container --}}
		@include('layout.footer')
		@yield('content')