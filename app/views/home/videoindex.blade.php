@include('layout.header')
@yield('content')

	<body data-spy="scroll" data-target=".navbar" data-offset="75">

		{{-- Intro loader --}}
		<div class="mask">
			<div id="intro-loader">
				<div class="container">
   					<div class="box">
						<div class="clock"></div>
							<p>时光碎片</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		{{-- Intro loader --}}


		{{-- Home Section --}}
		<section id="home">
			<div>
				<a id="video-volume" onclick="jQuery('#bgndVideo').toggleVolume()">
					<i class="fa fa-volume-down"></i>
				</a>

				<div id="div" style="width:100%; height:100%; position:absolute; overflow:hidden;">
					<video id="video" style="position:absolute; width:100%;">
						<source src="{{ route('home') }}/video/media.webm" />
						<source src="{{ route('home') }}/video/media.mp4" />
						<source src="{{ route('home') }}/video/media.ogg" />
						<source src="{{ route('home') }}/video/media.mpeg4" />
						{{-- IE Support--}}
					</video>
				</div>

				<div style="width:100%; height:100%; position:absolute; top:0px; background:rgba(0,0,0,0)" id="fullscreen-slider">

					{{-- Slider item --}}
					<div class="slider-item">
						{{HTML::image('images/header_bg3.png')}}
						<div class="pattern">
							<div class="slide-content">

								{{-- Section title --}}
								<div class="section-title text-center">
									<div>
										<span class="line big"></span>
										<span>欢迎来到</span>
										<span class="line big"></span>
									</div>
									<h1>时光碎片<i>时光不老，我们不散</i></h1>
									<div class="hidden-xs">
					                  <span class="line"></span>
					                  <span>有关琐碎时间的高效利用</span>
					                  <span class="line"></span>
					                </div>
									<p class="lead">
										一场关于新奇与创意的探险
									</p>
									<div class="mybutton ultra">
										<a class="start-button" href="#about"> <span data-hover="从这里开始!">你，准备好了吗?</span> </a>
									</div>
								</div>
								{{-- Section title --}}

							</div>
						</div>
					</div>
					{{-- Slider item --}}

					{{-- Slider item --}}
					<div class="slider-item">
						{{HTML::image('images/header_bg3.png')}}
						<div class="pattern">
							<div class="slide-content">

								{{-- Section title --}}
								<div class="section-title text-center">
									<div>
										<span class="line big"></span>
										<span>Welcome to</span>
										<span class="line big"></span>
									</div>
									<h1>Time Fragment<i>Time not old, We not leave</i></h1>
					                <div class="hidden-xs">
					                  <span class="line"></span>
					                  <span>Efficient use of time about the trivial</span>
					                  <span class="line"></span>
					                </div>
									<p class="lead">
										Adventure on a novel and creative.
									</p>
									<div class="mybutton ultra">
										<a class="start-button" href="#about"> <span data-hover="Discover!">Are you ready?</span> </a>
									</div>
								</div>
								{{-- Section title --}}

							</div>
						</div>
					</div>
					{{-- Slider item --}}
				</div>

			</div>
		</section>
		{{-- Home Section --}}

		@include('layout.home-navigation')
		@yield('content')

		@include('home.about')
		@yield('content')

		@include('home.creative')
		@yield('content')

		@include('home.travel')
		@yield('content')

		{{-- Parallax Container --}}
		<div id="ichat" class="parallax" style="background-image: url('images/separator2.jpg');" data-stellar-background-ratio="0.6" data-stellar-vertical-offset="20">
			<div class="parallax-overlay">
				<div class="section-content">
					<div class="container text-center">

						{{-- Parallax title --}}
						<h1>爱聊吧</h1>
						<p class="lead">
							结识新朋友，遇见新自己
						</p>
						{{-- Parallax title --}}

						{{-- Parallax content --}}
						<div class="parallax-content social-link">
							<div class="row">

								{{-- Link item --}}
								<div class="col-md-3 col-sm-3 col-xs-6">
									<div class="element-line">
										<div class="item_top">
											<div class="hi-icon-effect-1">
												<a href="#" class=""> <i class="hi-icon fa fa-heart-o fa-4x"></i> </a>
											</div>
											<span>兴趣相投</span>
											<p class="lead hidden-xs">
												我们兴趣相投
											</p>
										</div>
									</div>
								</div>
								{{-- Link item --}}

								{{-- Link item --}}
								<div class="col-md-3 col-sm-3 col-xs-6">
									<div class="element-line">
										<div class="item_bottom">
											<div class="hi-icon-effect-1">
												<a href="#" class=""> <i class="hi-icon fa fa-stack-exchange fa-4x"></i> </a>
											</div>
											<span>经验交流</span>
											<p class="lead hidden-xs">
												分享经验·共同进步
											</p>
										</div>
									</div>
								</div>
								{{-- Link item --}}

								{{-- Link item --}}
								<div class="col-md-3 col-sm-3 col-xs-6">
									<div class="element-line">
										<div class="item_top">
											<div class="hi-icon-effect-1">
												<a href="#" class=""> <i class="hi-icon fa fa-users fa-4x"></i> </a>
											</div>
											<span>老朋友啦</span>
											<p class="lead hidden-xs">
												叙叙旧，谈谈那些年的往事
											</p>
										</div>
									</div>
								</div>
								{{-- Link item --}}

								{{-- Link item --}}
								<div class="col-md-3 col-sm-3 col-xs-6">
									<div class="element-line">
										<div class="item_bottom">
											<div class="hi-icon-effect-1">
												<a href="#" class=""> <i class="hi-icon fa fa-search fa-4x"></i> </a>
											</div>
											<span>发现TA</span>
											<p class="lead hidden-xs">
												结识新朋友
											</p>
										</div>
									</div>
								</div>
								{{-- Link item --}}

							</div>
						</div>
						{{-- Parallax content --}}

					</div>
				</div>
			</div>
		</div>
		{{-- Parallax Container --}}

		@include('home.product')
		@yield('content')

		@include('home.job')
		@yield('content')

		{{-- Blog Section --}}
		<section id="timeline" class="section-content timeline-content bgdark">
			<div class="container">

				{{-- Section title --}}
				<div class="section-title text-center">
					<div>
						<span class="line big"></span>
						<span>Latest from our blog</span>
						<span class="line big"></span>
					</div>
					<h1 class="item_right">时间线</h1>
					<div>
						<span class="line"></span>
						<span>Timeline post news</span>
						<span class="line"></span>
					</div>
					<p class="lead">
						We're a close team of creatives, designers &amp; developers who work together to create beautiful, engaging digital experiences. We take pride in delivering only the best.
					</p>
				</div>
				{{-- Section title --}}

				<div class="element-line">
					<ol id="timeline">

						{{-- Timeline item --}}
						<li class="timeline-item">
							<div class="item_left">
								<div class="well post">
									<div class="post-info bgdark text-center">
										<h5 class="info-date">April 9, 2013<small>10:45</small></h5>
										<a href="blog-details.html" class="box-inner rotate"> <img class="img-circle img-responsive" src="images/user1.jpg" alt=""> </a>
										<h5>Henry Moon</h5>
									</div>
									<div class="post-body clearfix">
										<div class="blog-title">
											<h1><a href="blog-details.html">Post with Featured Image</a></h1>
										</div>
										<a href="blog-details.html" class="zoom"> <img src="images/portfolio4.jpg" class="img-responsive" alt=""> </a>
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
							<div class="item_right">
								<div class="well post">
									<div class="post-info bgdark text-center">
										<h5 class="info-date">April 15, 2013<small>08:30</small></h5>
										<a href="blog-details.html" class="box-inner rotate"> <img class="img-circle img-responsive" src="images/user2.jpg" alt=""> </a>
										<h5>Ispiration</h5>
									</div>
									<div class="post-body clearfix">
										<div class="blog-title">
											<h1><a href="blog-details.html">Post with a Carousel slider image</a></h1>
										</div>
										<div class="flexslider">
											<ul class="slides">

												{{-- Timeline item slide --}}
												<li>
													<a href="blog-details.html" class="zoom"> <img class="img-center img-responsive" src="images/blog2.jpg" alt=""/> </a>
												</li>
												{{-- Timeline item slide --}}

												{{-- Timeline item slide --}}
												<li>
													<a href="blog-details.html" class="zoom"> <img class="img-center img-responsive" src="images/blog3.jpg" alt=""/> </a>
												</li>
												{{-- Timeline item slide --}}

												{{-- Timeline item slide --}}
												<li>
													<a href="blog-details.html" class="zoom"> <img class="img-center img-responsive" src="images/blog4.jpg" alt=""/> </a>
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
										<a href="blog-details.html" class="box-inner rotate"> <img class="img-circle img-responsive" src="images/user3.jpg" alt=""> </a>
										<h5>Squirrels LLC</h5>
									</div>
									<div class="post-body clearfix">
										<div class="blog-title">
											<h1><a href="blog-details.html">Post blog text only</a></h1>
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
										<a href="blog-details.html" class="box-inner rotate"> <img class="img-circle img-responsive" src="images/user4.jpg" alt=""> </a>
										<h5>Juwan Lim</h5>
									</div>
									<div class="post-body clearfix">
										<div class="blog-title">
											<h1><a href="blog-details.html">Post with Featured Image</a></h1>
										</div>
										<a href="blog-details.html" class="zoom"> <img src="images/portfolio11.jpg" class="img-responsive" alt=""> </a>
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
										<a href="blog-details.html" class="box-inner rotate"> <img class="img-circle img-responsive" src="images/user5.jpg" alt=""> </a>
										<h5>Joonmo Kang</h5>
									</div>
									<div class="post-body clearfix">
										<div class="blog-title">
											<h1><a href="blog-details.html">Post with Featured Image</a></h1>
										</div>
										<a href="blog-details.html" class="zoom"> <img src="images/blog5.jpg" class="img-responsive" alt=""> </a>
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
		{{-- Blog Section --}}

		{{-- Contact Section --}}
		<section id="contact" class="section-content">
			<div class="container">

				{{-- Section title --}}
				<div class="section-title text-center">
					<div>
						<span class="line big"></span>
						<span>And now</span>
						<span class="line big"></span>
					</div>
					<h1 class="item_left">联系我们</h1>
					<div>
						<span class="line"></span>
						<span>Is time to do it</span>
						<span class="line"></span>
					</div>
					<p class="lead">
						中国 黑龙江省 哈尔滨市 松北区 浦源路2468号
						<br>
						<br />
						<br />
						{{-- <a target="_blank" href="https://maps.google.it/maps?q=Level+13,+2+Elizabeth+St,+Melbourne,+Victoria+3000,+Australia+&hl=it&ll=-37.819446,144.971595&spn=0.03407,0.066047&geocode=+&hnear=13/2+Elizabeth+St,+Melbourne+Victoria+3000,+Australia&t=m&z=15&iwloc=A">View on Google Map</a>--}}
					</p>
				</div>
				{{-- Section title --}}

			</div>

			{{-- Google maps print --}}
			{{-- <div id="map_canvas" class="element-line"></div> --}}
			{{-- Google maps print --}}

			{{-- Contact Selction --}}
		{{-- Parallax Container --}}
		<div id="seven-parallax" class="parallax" style="background-image: url('images/separator7.jpg');" data-stellar-background-ratio="0.6" data-stellar-vertical-offset="20">
			<div class="parallax-overlay parallax-background-color">
				<div class="section-content">
					<div class="container text-center">
						<div class="item_right">

							{{-- Parallax title --}}
							<h1><i class="fa fa-envelope-o fa-5x"></i></h1>
							<span class="call-number">xuri.me@gmail.com</span>
							<p class="lead">
								发送 E-mail 联系我们 您将在一个工作日内收到回复
							</p>
							{{-- Parallax title --}}

						</div>
					</div>
				</div>
			</div>
		</div>
		<br />
		<br />
		<br />
		{{-- Parallax Container --}}
		@include('layout.footer')
		@yield('content')
		<script type="text/javascript">
			var oDiv=document.getElementById('div');
			var oV=document.getElementById('video');
			var oW=document.getElementById('video-volume');
			oW.onclick=function(){
				if(oV.muted==false){
					oV.muted=true;
				}else{
					oV.muted=false;
				}
			}
			oV.muted=true;
				if(oV.offsetHeight<oDiv.offsetHeight){
					oV.style.height='100%';
					oV.style.width='';
					oV.style.top=0;

				}else if(oV.offsetWidth<oDiv.offsetWidth){
					oV.style.width='100%';
					oV.style.height='';
					oV.style.left=0;
				}
				oV.style.top=(oDiv.offsetHeight-oV.offsetHeight)/2+'px';
				oV.style.left=(oDiv.offsetWidth-oV.offsetWidth)/2+'px';
			window.onresize=function(){
				if(oV.offsetHeight<oDiv.offsetHeight){
					oV.style.height='100%';
					oV.style.width='';
					oV.style.top=0;

				}else if(oV.offsetWidth<oDiv.offsetWidth){
					oV.style.width='100%';
					oV.style.height='';
					oV.style.left=0;
				}
				oV.style.top=(oDiv.offsetHeight-oV.offsetHeight)/2+'px';
				oV.style.left=(oDiv.offsetWidth-oV.offsetWidth)/2+'px';
			}
			var oI=document.getElementById('intro-loader');
			setInterval(function(){
				if(oI.style.display=='none'){
					oV.play();
				}
			},1);
		</script>