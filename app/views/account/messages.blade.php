@include('layout.account-header')
@yield('content')

<body id="inbox-page" class="bg-gray-light">


	@include('layout.account-navigation')
	@yield('content')

	@include('layout.account-sidebar')
	@yield('content')

	<div class="preloader">
		<div class="timer"></div>
	</div>


	<div id="container" class="main-content tp-t-60">

		<button class="menu-btn btn btn-bordered text-gray-alt text-bold top-left-corner tm-l-30 pull-left">&#9776; 菜单</button>

		<div class="row">

			<div class="col-sm-9">
				<div class="bg-white p-tb-30">

					<div class="btn-group">
						<div class="iconmelon m-r-10 m-l-30">
							<svg viewBox="0 0 32 32">
								<g filter="">
									<use xlink:href="#speech-talk-user"></use>
								</g>
							</svg>
						</div>

						<span class="text-gray-dark text-large align-with-button m-r-30">
								站内信
							</span>

					</div>


					<input type="text" class="input-light input-large brad valign-top m-r-10 m-l-10 search-box" placeholder="搜索...">

					<div class="pull-right m-r-30 mail-nav">

						<span class="text-gray">
								1-20 总共 1248
							</span>

						<div class="btn-group" data-toggle="buttons">
							<label class="btn btn-no-bg text-gray">
								<span class="glyphicon glyphicon-chevron-left"></span>
							</label>
							<label class="btn btn-no-bg text-gray">
								<span class="glyphicon glyphicon-chevron-right"></span>
							</label>
						</div>
					</div>

					<hr>

					<a href="" class="btn btn-circle btn-bordered m-r-10 m-l-30 mm-l-10">
						<span class="glyphicon glyphicon-remove"></span>
					</a>

					<a href="" class="btn btn-circle btn-bordered m-r-10">
						<span class="glyphicon glyphicon-refresh"></span>
					</a>

					<a href="" class="btn btn-circle btn-bordered m-r-10">
						<span class="glyphicon glyphicon-share-alt"></span>
					</a>

					<a href="" class="btn btn-circle btn-bordered m-r-10">
						<span class="glyphicon glyphicon-star"></span>
					</a>

					<div class="btn-group pull-right m-r-30 mm-r-0 sort-buttons" data-toggle="buttons">
						<a href="messages.html#" class="text-gray p-lr-10">按字母排序</a>
						<a href="messages.html#" class="text-gray p-lr-10 m-r-10 active">最近</a>
					</div>

					<hr class="m-b-0">

					<ul class="unstyled messages messages-selectable">

						<li>
							<a href="messages.html#" class="p-lr-30 p-tb-10 pm-lr-10">
								<span class="avatar">
										{{ HTML::image('images/avatars/1.jpg', '', array('class' => 'img-circle retina')); }}
									</span>
								<span class="author hidden-xs text-bold">Garry Cross</span>
								<span class="subject text-bold">
										<i class="glyphicon glyphicon-star m-r-10 text-gray-light"></i>
										<span class="label label-success">Work</span>
								Perhaps a re-engineering of your current world view will re-energize your online nomenclature to enable a new holistic interactive enterprise internet communication solution.
								</span>
								<span class="date"><span class="text-gray-dark">23</span> minutes ago</span>
							</a>
						</li>

						<li>
							<a href="messages.html#" class="p-lr-30 p-tb-10 pm-lr-10">
								<span class="avatar">
										{{ HTML::image('images/avatars/2.jpg', '', array('class' => 'img-circle retina')); }}
									</span>
								<span class="author hidden-xs text-bold">Ronnie Warner</span>
								<span class="subject text-bold">
										<i class="glyphicon glyphicon-star m-r-10 text-orange"></i>
										Lorem ipsum dolor sir amet non omnis moriar. Lorem ipsum dolor sir amet non omnis moriar.
									</span>
								<span class="date">Today <span class="text-gray-dark">1:05pm</span></span>
							</a>
						</li>

						<li>
							<a href="messages.html#" class="p-lr-30 p-tb-10 pm-lr-10">
								<span class="avatar">
										{{ HTML::image('images/avatars/3.jpg', '', array('class' => 'img-circle retina')); }}
									</span>
								<span class="author hidden-xs ">Bill Mathis</span>
								<span class="subject">
										<i class="glyphicon glyphicon-star m-r-10 text-gray-light"></i>
										<span class="label label-warning">Marketing</span>
								Fundamentally transforming well designed actionable information whose semantic content is virtually null.
								</span>
								<span class="date">Today <span class="text-gray-dark">2:15pm</span></span>
							</a>
						</li>

						<li>
							<a href="messages.html#" class="p-lr-30 p-tb-10 pm-lr-10">
								<span class="avatar">
										{{ HTML::image('images/avatars/4.jpg', '', array('class' => 'img-circle retina')); }}
									</span>
								<span class="author hidden-xs text-bold">Eddie Mcgee</span>
								<span class="subject text-bold">
										<i class="glyphicon glyphicon-star m-r-10 text-orange"></i>
										This product is meant for educational purposes only. Any resemblance to real persons, living or dead is purely coincidental.
									</span>
								<span class="date"><span class="text-gray-dark">2</span> days ago</span>
							</a>
						</li>

						<li>
							<a href="messages.html#" class="p-lr-30 p-tb-10 pm-lr-10">
								<span class="avatar">
										{{ HTML::image('images/avatars/5.jpg', '', array('class' => 'img-circle retina')); }}
									</span>
								<span class="author hidden-xs text-bold">Erik Dean</span>
								<span class="subject text-bold">
										<i class="glyphicon glyphicon-star m-r-10 text-orange"></i>
										Do not disturb!!!!!11111oneone
									</span>
								<span class="date">Last <span class="text-gray-dark">Monday</span></span>
							</a>
						</li>

						<li>
							<a href="messages.html#" class="p-lr-30 p-tb-10 pm-lr-10">
								<span class="avatar">
										{{ HTML::image('images/avatars/6.jpg', '', array('class' => 'img-circle retina')); }}
									</span>
								<span class="author hidden-xs">Timmy Osborne</span>
								<span class="subject">
										<i class="glyphicon glyphicon-star m-r-10 text-gray-light"></i>
										Own yo' eget tortizzle. Sizzle erizzle.
									</span>
								<span class="date">21 January</span>
							</a>
						</li>

						<li>
							<a href="messages.html#" class="p-lr-30 p-tb-10 pm-lr-10">
								<span class="avatar">
										{{ HTML::image('images/avatars/7.jpg', '', array('class' => 'img-circle retina')); }}
									</span>
								<span class="author hidden-xs">Doug Ross</span>
								<span class="subject">
										<i class="glyphicon glyphicon-star m-r-10 text-gray-light"></i>
										Children of the sun, see your time has just begun, searching for your ways, through adventures every day.
									</span>
								<span class="date">6 January</span>
							</a>
						</li>

						<li>
							<a href="messages.html#" class="p-lr-30 p-tb-10 pm-lr-10">
								<span class="avatar">
										{{ HTML::image('images/avatars/8.jpg', '', array('class' => 'img-circle retina')); }}
									</span>
								<span class="author hidden-xs">Victor Benson</span>
								<span class="subject">
										<i class="glyphicon glyphicon-star m-r-10 text-gray-light"></i>
										And I was getting a tattoo during the death from above.
									</span>
								<span class="date">24 Dec 2013</span>
							</a>
						</li>

						<li>
							<a href="messages.html#" class="p-lr-30 p-tb-10 pm-lr-10">
								<span class="avatar">
										{{ HTML::image('images/avatars/9.jpg', '', array('class' => 'img-circle retina')); }}
									</span>
								<span class="author hidden-xs">Henry Mccormick</span>
								<span class="subject">
										<i class="glyphicon glyphicon-star m-r-10 text-gray-light"></i>
										Lorem ipsum dolor sir amet non omnis moriar. Lorem ipsum dolor sir amet non omnis moriar.
									</span>
								<span class="date">20 Dec 2013</span>
							</a>
						</li>

						<li>
							<a href="messages.html#" class="p-lr-30 p-tb-10 pm-lr-10">
								<span class="avatar">
										{{ HTML::image('images/avatars/10.jpg', '', array('class' => 'img-circle retina')); }}
									</span>
								<span class="author hidden-xs">Ricky Greene</span>
								<span class="subject">
										<i class="glyphicon glyphicon-star m-r-10 text-gray-light"></i>
										Meh. We'll go deliver this crate like professionals, and then we'll go home. So I really am important?
									</span>
								<span class="date">20 Dec 2013</span>
							</a>
						</li>

						<li>
							<a href="messages.html#" class="p-lr-30 p-tb-10 pm-lr-10">
								<span class="avatar">
										{{ HTML::image('images/avatars/11.jpg', '', array('class' => 'img-circle retina')); }}
									</span>
								<span class="author hidden-xs">Clint Mills</span>
								<span class="subject">
										<i class="glyphicon glyphicon-star m-r-10 text-gray-light"></i>
										<span class="label label-info">Code</span>
								Pushed new feature to master branch. Please, check it out!
								</span>
								<span class="date">27 Nov 2013</span>
							</a>
						</li>

						<li>
							<a href="messages.html#" class="p-lr-30 p-tb-10 pm-lr-10">
								<span class="avatar">
										{{ HTML::image('images/avatars/12.jpg', '', array('class' => 'img-circle retina')); }}
									</span>
								<span class="author hidden-xs">Theodore Jordan</span>
								<span class="subject">
										<i class="glyphicon glyphicon-star m-r-10 text-orange"></i>
										Would you censor the Venus de Venus just because you can see her spewers?
									</span>
								<span class="date">26 Nov 2013</span>
							</a>
						</li>

						<li>
							<a href="messages.html#" class="p-lr-30 p-tb-10 pm-lr-10">
								<span class="avatar">
										{{ HTML::image('images/avatars/13.jpg', '', array('class' => 'img-circle retina')); }}
									</span>
								<span class="author hidden-xs">Virgin Barnett</span>
								<span class="subject">
										<i class="glyphicon glyphicon-star m-r-10 text-gray-light"></i>
										We get some in our lungs, we drown. However unreal it may seem, we are connected, you and I. We're on the same curve, just on opposite ends.
									</span>
								<span class="date">24 Nov 2013</span>
							</a>
						</li>

						<li>
							<a href="messages.html#" class="p-lr-30 p-tb-10 pm-lr-10">
								<span class="avatar">
										{{ HTML::image('images/avatars/14.jpg', '', array('class' => 'img-circle retina')); }}
									</span>
								<span class="author hidden-xs">Edgar Ryan</span>
								<span class="subject">
										<i class="glyphicon glyphicon-star m-r-10 text-gray-light"></i>
										Brain freeze. look at that, it's exactly three seconds before i honk your nose and pull your underwear over your head.
									</span>
								<span class="date">23 Nov 2013</span>
							</a>
						</li>

						<li>
							<a href="messages.html#" class="p-lr-30 p-tb-10 pm-lr-10">
								<span class="avatar">
										{{ HTML::image('images/avatars/15.jpg', '', array('class' => 'img-circle retina')); }}
									</span>
								<span class="author hidden-xs">Marcus Hill</span>
								<span class="subject">
										<i class="glyphicon glyphicon-star m-r-10 text-gray-light"></i>
										I took a viagra, got stuck in me throat, i've had a stiff neck for hours. i want to shoot the pigeons... off my roof.
									</span>
								<span class="date">6 Nov 2013</span>
							</a>
						</li>

						<li>
							<a href="messages.html#" class="p-lr-30 p-tb-10 pm-lr-10">
								<span class="avatar">
										{{ HTML::image('images/avatars/16.jpg', '', array('class' => 'img-circle retina')); }}
									</span>
								<span class="author hidden-xs">Forrest Barber</span>
								<span class="subject">
										<i class="glyphicon glyphicon-star m-r-10 text-gray-light"></i>
										Lorem ipsum dolor sir amet non omnis moriar. Lorem ipsum dolor sir amet non omnis moriar.
									</span>
								<span class="date">28 Oct 2013</span>
							</a>
						</li>

						<li>
							<a href="messages.html#" class="p-lr-30 p-tb-10 pm-lr-10">
								<span class="avatar">
										{{ HTML::image('images/avatars/17.jpg', '', array('class' => 'img-circle retina')); }}
									</span>
								<span class="author hidden-xs">Maria Curie</span>
								<span class="subject">
										<i class="glyphicon glyphicon-star m-r-10 text-gray-light"></i>
										Pul my finger! when i get back, remind to tell you about the time i took 100 nuns to nairobi!
									</span>
								<span class="date"><span class="text-gray-dark">22</span> Oct 2013</span>
							</a>
						</li>

						<li>
							<a href="messages.html#" class="p-lr-30 p-tb-10 pm-lr-10">
								<span class="avatar">
										{{ HTML::image('images/avatars/18.jpg', '', array('class' => 'img-circle retina')); }}
									</span>
								<span class="author hidden-xs">Levi Owen</span>
								<span class="subject">
										<i class="glyphicon glyphicon-star m-r-10 text-gray-light"></i>
										I did the same thing to gandhi, he didn't eat for three weeks. let me tell you something my friend.
									</span>
								<span class="date">19 Oct 2013</span>
							</a>
						</li>

						<li>
							<a href="messages.html#" class="p-lr-30 p-tb-10 pm-lr-10">
								<span class="avatar">
										{{ HTML::image('images/avatars/19.jpg', '', array('class' => 'img-circle retina')); }}
									</span>
								<span class="author hidden-xs">Bill Harmon</span>
								<span class="subject">
										<i class="glyphicon glyphicon-star m-r-10 text-gray-light"></i>
										Multiply your anger by about a hundred, kate, that's how much he thinks he loves you.
									</span>
								<span class="date">18 Oct 2013</span>
							</a>
						</li>

						<li>
							<a href="messages.html#" class="p-lr-30 p-tb-10 pm-lr-10">
								<span class="avatar">
										{{ HTML::image('images/avatars/20.jpg', '', array('class' => 'img-circle retina')); }}
									</span>
								<span class="author hidden-xs">Ervin Freedman</span>
								<span class="subject">
										<i class="glyphicon glyphicon-star m-r-10 text-gray-light"></i>
										Ever notice how sometimes you come across somebody you shouldn't have f**ked with?
									</span>
								<span class="date"><span class="text-gray-dark">3 years</span> ago</span>
							</a>
						</li>

					</ul>


				</div>
			</div>
			{{-- /.col-lg-9 --}}


			<div class="col-sm-3">

				<div class="bg-white p-t-30 m-b-10 b-bot-2px-gray-light">

					<div class="iconmelon m-r-10 m-l-30">
						<svg viewBox="0 0 32 32">
							<g filter="">
								<use xlink:href="#speech-talk-user"></use>
							</g>
						</svg>
					</div>

					<span class="text-gray-dark text-large align-with-button">
							收件箱
						</span>

					<hr class="m-b-0">

					<div class="p-lr-30">
						<button class="btn btn-primary btn-lg btn-block compose-btn">发消息</button>
					</div>

					<hr class="m-t-0 m-b-0">

					<ul class="nav nav-pills nav-stacked">
						<li class="active"><a href="messages.html#">收件箱</a>
						</li>
						<li><a href="messages.html#">已发送</a>
						</li>
						<li><a href="messages.html#">草稿箱</a>
						</li>
						<li><a href="messages.html#">收藏夹</a>
						</li>
						<li><a href="messages.html#">回收站</a>
						</li>
						<li><a href="messages.html#">垃圾信息</a>
						</li>
					</ul>
				</div>

				<div id="chat" class="bg-white p-t-30 p-b-10 chat-wrapper b-bot-2px-gray-light">

					<div class="btn-group chat-toggle">
						<a href="messages.html#" class="p-lr-30 hover-no-underline" data-toggle="dropdown">
							<img class="img-circle chat-avatar available m-r-10" width="35" src="{{ Auth::user()->portrait_large }}">
							<span class="hover-no-underline hover-gray-dark text-gray">
									<span class="text-gray-dark text-large align-with-button">
										{{ Auth::user()->nickname }}
									</span>
							<span class="caret"></span>
							</span>
						</a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="messages.html#"><span class="circle-green m-r-10"></span>在线</a>
							</li>
							<li><a href="messages.html#"><span class="circle-yellow m-r-10"></span>忙碌</a>
							</li>
							<li><a href="messages.html#"><span class="circle-gray m-r-10"></span>隐身</a>
							</li>
							<li class="divider"></li>
							<li><a href="messages.html#"><span class="circle-red m-r-10"></span>离线</a>
							</li>
						</ul>
					</div>

					<hr class="m-b-0">

					<div class="p-lr-30">
						<input type="text" class="input-light input-large brad chat-search" placeholder="查找好友...">
					</div>

					<hr class="m-t-0">

					<ul class="unstyled people">
						<li>
							<a href="messages.html#" class="p-lr-30 p-tb-10 pm-lr-10 d-block">
								{{ HTML::image('images/avatars/5.jpg', '', array('class' => 'label label-success m-l-10')); }}
								<span class="author">Erik Dean</span>
								<span class="label label-success m-l-10">3</span>
							</a>
						</li>

						<li>
							<a href="messages.html#" class="p-lr-30 p-tb-10 pm-lr-10 d-block">
								{{ HTML::image('images/avatars/7.jpg', '', array('class' => 'img-circle chat-avatar available m-r-10')); }}
								<span class="author">Doug Ross</span>
							</a>
						</li>

						<li>
							<a href="messages.html#" class="p-lr-30 p-tb-10 d-block">
								{{ HTML::image('images/avatars/8.jpg', '', array('class' => 'img-circle chat-avatar busy m-r-10')); }}
								<span class="author">Victor Benson</span>
							</a>
						</li>

						<li>
							<a href="messages.html#" class="p-lr-30 p-tb-10 d-block">
								{{ HTML::image('images/avatars/9.jpg', '', array('class' => 'img-circle chat-avatar signedoff m-r-10')); }}
								<span class="author">Henry Mccormick</span>
							</a>
						</li>
					</ul>
				</div>
			</div>

		</div>
	{{-- /.row --}}


	</div>
</body>

</html>