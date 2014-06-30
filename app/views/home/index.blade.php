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

			<a id="slider_left" class="fullscreen-slider-arrow">
				{{HTML::image('assets/img/arrow_left.png')}}
			</a>
			<a id="slider_right" class="fullscreen-slider-arrow">
				{{HTML::image('assets/img/arrow_right.png')}}
			</a>

			<div id="fullscreen-slider">
				{{-- Slider item --}}
				<div class="slider-item">
					{{HTML::image('images/slide1.jpg')}}
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
					{{HTML::image('images/slide2.jpg')}}
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
		</section>
		{{-- Home Section --}}


		@include('layout.home-navigation')
		@yield('content')

		@include('home.about')
		@yield('content')

		@include('home.creative')
		@yield('content')

		{{-- Team Section --}}
		<section id="travle" class="section-content">
			<div class="container">

				{{-- Section title --}}
				<div class="section-title text-center">
					<div>
						<span class="line big"></span>
						<span>读万卷书·行万里路</span>
						<span class="line big"></span>
					</div>
					<h1 class="item_left">去旅行</h1>
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

					{{-- Team item --}}
					<div class="col-md-3 col-sm-3 col-md-3 col-xs-12">
						<div class="element-line">
							<div class="item_top">
								<div class="img-rounded team-element zoom">
									<div class="team-inner">
										<div class="team-detail">
											<div class="team-content">
												<h3><strong>Marc Crow</strong></h3>
												<p>
													CEO Founder
												</p>
												<ul>
													<li>
														<a href=""><i class="fa fa-facebook fa-2x"></i></a>
													</li>
													<li>
														<a href=""><i class="fa fa-twitter fa-2x"></i></a>
													</li>
													<li>
														<a href=""><i class="fa fa-google-plus fa-2x"></i></a>
													</li>
													<li>
														<a href=""><i class="fa fa-youtube fa-2x"></i></a>
													</li>
												</ul>
											</div>
										</div>
									</div>
									<img src="images/team1.jpg" alt="" class="img-responsive">
								</div>
							</div>
						</div>
					</div>
					{{-- Team item --}}

					{{-- Team item --}}
					<div class="col-md-3 col-sm-3 col-md-3 col-xs-12">
						<div class="element-line">
							<div class="item_bottom">
								<div class="img-rounded team-element zoom">
									<div class="team-inner">
										<div class="team-detail">
											<div class="team-content">
												<h3><strong>Scott Sanchezh</strong></h3>
												<p>
													Public Relation
												</p>
												<ul>
													<li>
														<a href=""><i class="fa fa-facebook fa-2x"></i></a>
													</li>
													<li>
														<a href=""><i class="fa fa-twitter fa-2x"></i></a>
													</li>
													<li>
														<a href=""><i class="fa fa-google-plus fa-2x"></i></a>
													</li>
													<li>
														<a href=""><i class="fa fa-youtube fa-2x"></i></a>
													</li>
												</ul>
											</div>
										</div>
									</div>
									<img src="images/team4.jpg" alt="" class="img-responsive">
								</div>
							</div>
						</div>
					</div>
					{{-- Team item --}}

					{{-- Team item --}}
					<div class="col-md-3 col-sm-3 col-md-3 col-xs-12">
						<div class="element-line">
							<div class="item_top">
								<div class="img-rounded team-element zoom">
									<div class="team-inner">
										<div class="team-detail">
											<div class="team-content">
												<h3><strong>Henry kolms</strong></h3>
												<p>
													Creative Director
												</p>
												<ul>
													<li>
														<a href=""><i class="fa fa-facebook fa-2x"></i></a>
													</li>
													<li>
														<a href=""><i class="fa fa-twitter fa-2x"></i></a>
													</li>
													<li>
														<a href=""><i class="fa fa-google-plus fa-2x"></i></a>
													</li>
													<li>
														<a href=""><i class="fa fa-youtube fa-2x"></i></a>
													</li>
												</ul>
											</div>
										</div>
									</div>
									<img src="images/team2.jpg" alt="" class="img-responsive">
								</div>
							</div>
						</div>
					</div>
					{{-- Team item --}}

					{{-- Team item --}}
					<div class="col-md-3 col-sm-3 col-md-3 col-xs-12">
						<div class="element-line">
							<div class="item_bottom">
								<div class="img-rounded team-element zoom">
									<div class="team-inner">
										<div class="team-detail">
											<div class="team-content">
												<h3><strong>Michelle White</strong></h3>
												<p>
													Web Developer
												</p>
												<ul>
													<li>
														<a href=""><i class="fa fa-facebook fa-2x"></i></a>
													</li>
													<li>
														<a href=""><i class="fa fa-twitter fa-2x"></i></a>
													</li>
													<li>
														<a href=""><i class="fa fa-google-plus fa-2x"></i></a>
													</li>
													<li>
														<a href=""><i class="fa fa-youtube fa-2x"></i></a>
													</li>
												</ul>
											</div>
										</div>
									</div>
									<img src="images/team3.jpg" alt="" class="img-responsive">
								</div>
							</div>
						</div>
					</div>
					{{-- Team item --}}

				</div>
			</div>
		</section>
		{{-- Team Section --}}

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

		{{-- Portfolio Section --}}
		<section id="shop-exp" class="section-content">
			<div class="container">

				{{-- Section title --}}
				<div class="section-title text-center">
					<div>
						<span class="line big"></span>
						<span>全新的二手交易平台</span>
						<span class="line big"></span>
					</div>
					<h1 class="item_right">乐换购</h1>
					<div>
						<span class="line"></span>
						<span>低碳·环保·健康·绿色</span>
						<span class="line"></span>
					</div>
					<p class="lead">
						这里是进行二手物品交易的全新平台！
					</p>
				</div>
				{{-- Section title --}}
			</div>

			<div class="portfolio-top"></div>

			{{-- Portfolio filters --}}
			<div class="element-line">
				<div id="filters" class="mybutton small">
					<a href="#" data-filter="*"><span data-hover="Show all">显示所有</span></a>
					<a href="#" data-filter=".branding"><span data-hover="Branding">闲置转让</span></a>
					<a href="#" data-filter=".design"><span data-hover="Design">收购二手</span></a>
					<a href="#" data-filter=".photography"><span data-hover="Photography">换购体验场</span></a>
					{{-- <a href="#" data-filter=".videography"><span data-hover="Videography">Videography</span></a>
					<a href="#" data-filter=".web"><span data-hover="Web">Web</span></a> --}}
				</div>
			</div>
			{{-- Portfolio filters --}}

			<div id="portfolio-wrap">

				{{-- portfolio item --}}
				<div class="portfolio-item photography web">
					<div class="portfolio">
						<a href="#" class="zoom"> <img src="images/portfolio1.jpg" alt="">
						<div class="hover-items">
							<span> <i class="fa fa-bars fa-4x"></i> <em class="lead">Ducati Monster 620 Racer</em> <em>Photo slider</em> </span>
						</div> </a>
					</div>
				</div>
				{{-- portfolio item --}}

				{{-- portfolio item --}}
				<div class="portfolio-item branding photography">
					<div class="portfolio">
						<a href="#" class="zoom"> <img src="images/portfolio2.jpg" alt="">
						<div class="hover-items">
							<span> <i class="fa fa-youtube-play fa-4x"></i> <em class="lead">Hexter Photoshoot</em> <em>Video Project</em> </span>
						</div> </a>
					</div>
				</div>
				{{-- portfolio item --}}

				{{-- portfolio item --}}
				<div class="portfolio-item branding web">
					<div class="portfolio">
						<a href="#" class="zoom"> <img src="images/portfolio3.jpg" alt="">
						<div class="hover-items">
							<span> <i class="fa fa-plus fa-4x"></i> <em class="lead">Creative Laba</em> <em>Project Details</em> </span>
						</div> </a>
					</div>
				</div>
				{{-- portfolio item --}}

				{{-- portfolio item --}}
				<div class="portfolio-item branding videography web">
					<div class="portfolio">
						<a href="#" class="zoom"> <img src="images/portfolio12.jpg" alt="">
						<div class="hover-items">
							<span> <i class="fa fa-bars fa-4x"></i> <em class="lead">New Designers Show 2011</em> <em>Photo slider</em> </span>
						</div> </a>
					</div>
				</div>
				{{-- portfolio item --}}

				{{-- portfolio item --}}
				<div class="portfolio-item branding photography">
					<div class="portfolio">
						<a href="#" class="zoom"> <img src="images/portfolio5.jpg" alt="">
						<div class="hover-items">
							<span> <i class="fa fa-youtube-play fa-4x"></i> <em class="lead">Designing Green trophy</em> <em>Video Project</em> </span>
						</div> </a>
					</div>
				</div>
				{{-- portfolio item --}}

				{{-- portfolio item --}}
				<div class="portfolio-item design web">
					<div class="portfolio">
						<a href="#" class="zoom"> <img src="images/portfolio6.jpg" alt="">
						<div class="hover-items">
							<span> <i class="fa fa-plus fa-4x"></i> <em class="lead">Starbucks Cups</em> <em>Project Details</em> </span>
						</div> </a>
					</div>
				</div>
				{{-- portfolio item --}}

				{{-- portfolio item --}}
				<div class="portfolio-item branding photography videography">
					<div class="portfolio">
						<a href="#" class="zoom"> <img src="images/portfolio7.jpg" alt="">
						<div class="hover-items">
							<span> <i class="fa fa-bars fa-4x"></i> <em class="lead">Mercedes CLS Design</em> <em>Photo slider</em> </span>
						</div> </a>
					</div>
				</div>
				{{-- portfolio item --}}

				{{-- portfolio item --}}
				<div class="portfolio-item branding design web">
					<div class="portfolio">
						<a href="#" class="zoom"> <img src="images/portfolio4.jpg" alt="">
						<div class="hover-items">
							<span> <i class="fa fa-youtube-play fa-4x"></i> <em class="lead">DISK & COVER</em> <em>Music Mockup</em> </span>
						</div> </a>
					</div>
				</div>
				{{-- portfolio item --}}

				{{-- portfolio item --}}
				<div class="portfolio-item branding photography">
					<div class="portfolio">
						<a href="#" class="zoom"> <img src="images/portfolio9.jpg" alt="">
						<div class="hover-items">
							<span> <i class="fa fa-plus fa-4x"></i> <em class="lead">Creative Mornings</em> <em>Project Details</em> </span>
						</div> </a>
					</div>
				</div>
				{{-- portfolio item --}}

				{{-- portfolio item --}}
				<div class="portfolio-item design web">
					<div class="portfolio">
						<a href="#" class="zoom"> <img src="images/portfolio10.jpg" alt="">
						<div class="hover-items">
							<span> <i class="fa fa-bars fa-4x"></i> <em class="lead">iPod Headphones</em> <em>Photo slider</em> </span>
						</div> </a>
					</div>
				</div>
				{{-- portfolio item --}}

				{{-- portfolio item --}}
				<div class="portfolio-item web">
					<div class="portfolio">
						<a href="#" class="zoom"> <img src="images/portfolio11.jpg" alt="">
						<div class="hover-items">
							<span> <i class="fa fa-youtube-play fa-4x"></i> <em class="lead">Simpli Nota</em> <em>Dark Identity</em> </span>
						</div> </a>
					</div>
				</div>
				{{-- portfolio item --}}

				{{-- portfolio item --}}
				<div class="portfolio-item design videography web">
					<div class="portfolio">
						<a href="#" class="zoom"> <img src="images/portfolio8.jpg" alt="">
						<div class="hover-items">
							<span> <i class="fa fa-plus fa-4x"></i> <em class="lead">Yankees Logo</em> <em>Project Details</em> </span>
						</div> </a>
					</div>
				</div>
				{{-- portfolio item --}}

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
			<div class="clear"></div>
			{{-- Ajax content --}}

		</section>
		{{-- Portfolio Section --}}

		{{-- Service Section --}}
		<section id="jobs" class="section-content">
			<div class="container">

				{{-- Section title --}}
				<div class="section-title text-center">
					<div>
						<span class="line big"></span>
						<span>经历·分享·积累</span>
						<span class="line big"></span>
					</div>
					<h1 class="item_left">做兼职</h1>
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

									{{-- Item Slide --}}
									<li>
										<div class="slide-item">
											<div class="row">
												<div class="col-md-7">
													<img class="img-responsive img-center img-rounded" src="images/service1.jpg" alt=""/>
												</div>
												<div class="col-md-5">
													<h2>上海急招2014年应届生应聘iOS开发</h2>
													<p class="lead">
														招聘职位: iOS高级开发工程师（兼职，月薪2w起）
														职责描述: 在家上班（SOHO），参与团队项目开发，负责完成项目需求的开发和维护。
														职位要求：
														1. 两年以上工作经验，三年以上iOS开发经验，熟练掌握音视频相关framework
														2. 积极主动，善于沟通和合作，有强烈的责任心。
														3. 优先考虑: 有AppStore上线的好评作品（个人或公司作品都可），有大型互联网公司工作经验。
														注: 非外包项目。
													</p>
													<br />
													<div class="mybutton medium">
														<a href="http://themeforest.net/item/alpine-responsive-one-page-parallax-template/6480453?ref=creativeispiration"> <span data-hover="See Detail">查看详情</span> </a>
													</div>
												</div>
											</div>
										</div>
									</li>
									{{-- Item Slide --}}
									{{-- Item Slide --}}
									<li>
										<div class="slide-item">
											<div class="row">
												<div class="col-md-7">
													<img class="img-responsive img-center img-rounded" src="images/service2.jpg" alt=""/>
												</div>
												<div class="col-md-5">
													<h2>阿里集团共享业务中间件团队招聘架构师和资深工程师（内推）</h2>
													<p class="lead">
														岗位描述
														共享业务事业部是阿里巴巴集团生态系统的技术基石，为淘宝网、天猫、聚划算、1688、淘宝旅行、淘宝海外、零售O2O等业务群提供可靠、高效、易扩展的平台服务。
														共享业务事业部包含交易、商品、会员、店铺、推荐系统、营销、中间件、数据等电子商务操作系统核心平台，同时发力零售O2O、天猫国际、淘宝海外、菜鸟技术等面向未来的业务模式。
													</p>
													<br />
													<div class="mybutton medium">
														<a href="http://themeforest.net/item/alpine-responsive-one-page-parallax-template/6480453?ref=creativeispiration"> <span data-hover="See Detail">查看详情</span> </a>
													</div>
												</div>
											</div>
										</div>
									</li>
									{{-- Item Slide --}}

								</ul>
							</div>
						</div>
					</div>
				</div>

				<div class="service-items">
					<div class="row text-center">

						{{-- Service item --}}
						<div class="col-md-3 col-sm-3 col-xs-12">
							<div class="element-line">
								<div class="item_left">
									<a href="#"> <i class="fa fa-smile-o fa-5x"></i> <h3>找兼职</h3> </a>
									<p>
										给就就职者全面的兼职信息，愿您在这里找到合适的职位。
									</p>
								</div>
							</div>
						</div>
						{{-- Service item --}}

						{{-- Service item --}}
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
						{{-- Service item --}}

						{{-- Service item --}}
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
						{{-- Service item --}}

						{{-- Service item --}}
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
						{{-- Service item --}}

					</div>
				</div>
			</div>
		</section>
		{{-- Service Section --}}

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
			<br>
		<br />
		<br />
		{{-- Parallax Container --}}
		@include('layout.footer')
		@yield('content')