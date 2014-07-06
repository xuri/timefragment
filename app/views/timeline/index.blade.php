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
						<a href="{{ route('home') }}"><span>时光碎片</span></a>
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


						@foreach($timeline as $timeline)




						{{-- Timeline item --}}
						<li class="timeline-item">
							<div class="item_left">
								<div class="well post">
									<div class="post-info bgdark text-center">
										<h5 class="info-date">{{ $event->created_at }}<small>10:45</small></h5>
										<a href="#" class="box-inner rotate">
											<img src="{{ $event->user->portrait_large }}" class="img-circle img-responsive" alt="{{ $event->user->nickname }}" title="{{ $event->user->nickname }}">
										</a>
										<h5>{{ $event->user->nickname }}</h5>
									</div>
									<div class="post-body clearfix">
										<div class="blog-title">
											<h1><a href="#">{{ $event->title }}</a></h1>
										</div>
										<a href="#" class="zoom">
											{{ HTML::image('images/portfolio4.jpg', '', array('class' => 'img-responsive')); }} </a>
										<div class="post-text">
											<p class="lead">
												Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
											</p>
										</div>
									</div>
									<div class="post-arrow"></div>
								</div>
							</div>
						</li>
						{{-- Timeline item --}}


						@endforeach

						{{-- Timeline item --}}
						<li class="timeline-item">
							<div class="item_right">
								<div class="well post">
									<div class="post-info bgdark text-center">
										<h5 class="info-date">April 15, 2013<small>08:30</small></h5>
										<a href="#" class="box-inner rotate"> {{ HTML::image('images/user2.jpg', '', array('class' => 'img-circle img-responsive'));}} </a>
										<h5>Ispiration</h5>
									</div>
									<div class="post-body clearfix">
										<div class="blog-title">
											<h1><a href="#">Post with a Carousel slider image</a></h1>
										</div>
										<div class="flexslider">
											<ul class="slides">

												{{-- Timeline item slide --}}
												<li>
													<a href="#" class="zoom"> {{ HTML::image('images/blog2.jpg', '', array('class' => 'img-responsive')); }} </a>
												</li>
												{{-- Timeline item slide --}}

												{{-- Timeline item slide --}}
												<li>
													<a href="#" class="zoom"> {{ HTML::image('images/blog3.jpg', '', array('class' => 'img-responsive')); }} </a>
												</li>
												{{-- Timeline item slide --}}

												{{-- Timeline item slide --}}
												<li>
													<a href="#" class="zoom"> {{ HTML::image('images/blog4.jpg', '', array('class' => 'img-responsive')); }} </a>
												</li>
												{{-- Timeline item slide --}}

											</ul>
										</div>
										<div class="post-text">
											<p>
												Ut non velit tortor. Aliquam dictum mattis leo, vel <strong>laoreet</strong> turpis viverra sit amet. Integer fermentum augue at risus pretium id porttitor nisi pulvinar. Aliquam imperdiet quam ligula. Nulla facilisi. Duis eu arcu magna. Etiam neque leo, sodales eget ornare mollis, posuere a felis.
											</p>
										</div>
									</div>
									<div class="post-arrow"></div>
								</div>
							</div>
						</li>
						{{-- Timeline item --}}

						{{-- Timeline item --}}
						<li class="timeline-item">
							<div class="item_left">
								<div class="well post">
									<div class="post-info bgdark text-center">
										<h5 class="info-date">April 17, 2013<small>22:06</small></h5>
										<a href="#" class="box-inner rotate"> {{ HTML::image('images/user3.jpg', '', array('class' => 'img-circle img-responsive')); }} </a>
										<h5>Squirrels LLC</h5>
									</div>
									<div class="post-body clearfix">
										<div class="blog-title">
											<h1><a href="#">Post blog text only</a></h1>
										</div>
										<div class="post-text">
											<p class="lead">
												Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
											</p>
											<p>
												Ut non velit tortor. Aliquam dictum mattis leo, vel <strong>laoreet</strong> turpis viverra sit amet. Integer fermentum augue at risus pretium id porttitor nisi pulvinar. Aliquam imperdiet quam ligula. Nulla facilisi. Duis eu arcu magna. Etiam neque leo, sodales eget ornare mollis, posuere a felis.
											</p>
										</div>
									</div>
									<div class="post-arrow"></div>
								</div>
							</div>
						</li>
						{{-- Timeline item --}}

						{{-- Timeline item --}}
						<li class="timeline-item">
							<div class="item_right">
								<div class="well post">
									<div class="post-info bgdark text-center">
										<h5 class="info-date">April 23, 2013<small>00:57</small></h5>
										<a href="#" class="box-inner rotate"> {{ HTML::image('images/user4.jpg', '', array('class' => 'img-circle img-responsive')); }} </a>
										<h5>Juwan Lim</h5>
									</div>
									<div class="post-body clearfix">
										<div class="blog-title">
											<h1><a href="#">Post with Featured Image</a></h1>
										</div>
										<a href="#" class="zoom"> {{ HTML::image('images/portfolio11.jpg', '', array('class' => 'img-responsive')); }} </a>
										<div class="post-text">
											<p class="lead">
												Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
											</p>
										</div>
									</div>
									<div class="post-arrow"></div>
								</div>
							</div>
						</li>
						{{-- Timeline item --}}

						{{-- Timeline item --}}
						<li class="timeline-item">
							<div class="item_left">
								<div class="well post">
									<div class="post-info bgdark text-center">
										<h5 class="info-date">April 27, 2013<small>06:17</small></h5>
										<a href="#" class="box-inner rotate"> {{ HTML::image('images/user5.jpg', '', array('class' => 'img-circle img-responsive')); }} </a>
										<h5>Joonmo Kang</h5>
									</div>
									<div class="post-body clearfix">
										<div class="blog-title">
											<h1><a href="#">Post with Featured Image</a></h1>
										</div>
										<a href="#" class="zoom">
											{{ HTML::image('images/blog5.jpg', '', array('class' => 'img-responsive')); }} </a>
										<div class="post-text">
											<p class="lead">
												Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
											</p>
										</div>
									</div>
									<div class="post-arrow"></div>
								</div>
							</div>
						</li>
						{{-- Timeline item --}}
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