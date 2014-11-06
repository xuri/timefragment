@include('layout.account-header')
@yield('content')
<body id="dashboard-page" class="bg-gray-light">
	@include('layout.admin-navigation')
	@yield('content')

	@include('layout.admin-sidebar')
	@yield('content')
	<div class="preloader">
		<div class="timer"></div>
	</div>

	<div id="container" class="main-content p-30 tp-t-60 tp-lr-10">

		<button class="menu-btn btn btn-bordered text-gray-alt text-bold top-left-corner">&#9776; 菜单</button>
		{{-- Dashboard Tab --}}
		<div class="bg-white b-1px-gray-light b-top-none brad-bottom brad-tr b-bot-2px-gray-light">

			<div class="tab-content">

				<div class="tab-pane active fade in p-30" id="dashboard">

					<h1 class="text-center font-w-100">欢迎回来 <span class="text-blue">管理员</span></h1>
					<div class="row">
						<p class="m-b-30 p-b-30 text-gray-alt text-uppercase text-center col-lg-8 col-lg-offset-2">这里是网站系统的管理员控制面板，负责整个系统的资源管理。</p>
					</div>

					<div class="col-sm-7">

						<div class="col-sm-6">
							<div class="pricing-table">
								<div class="bg-gray-dark table-top-wrapper"></div>
								<div class="bg-white p-30">
									<div class="text-large text-center">创意汇</div>
									<hr class="m-t-0 m-b-10">
									<a href="{{ route('mycreative.create') }}" class="btn btn-primary btn-block btn-lg">分享新创意</a>
								</div>
							</div>
						</div>

						<div class="col-sm-6">
							<div class="pricing-table">
								<div class="bg-gray-dark table-top-wrapper"></div>
								<div class="bg-white p-30">
									<div class="text-large text-center">去旅行</div>
									<hr class="m-t-0 m-b-10">
									<a href="{{ route('mytravel.create') }}" class="btn btn-primary btn-block btn-lg">撰写新文章</a>
								</div>
							</div>
						</div>

						<div class="col-sm-6">
							<div class="pricing-table">
								<div class="bg-gray-dark table-top-wrapper"></div>
								<div class="bg-white p-30">
									<div class="text-large text-center">尚品汇</div>
									<hr class="m-t-0 m-b-10">
									<a href="{{ route('myproduct.create') }}" class="btn btn-primary btn-block btn-lg">发布商品信息</a>
								</div>
							</div>
						</div>

						<div class="col-sm-6">
							<div class="pricing-table">
								<div class="bg-gray-dark table-top-wrapper"></div>
								<div class="bg-white p-30">
									<div class="text-large text-center">酷工作</div>
									<hr class="m-t-0 m-b-10">
									<a href="{{ route('myjob.create') }}" class="btn btn-primary btn-block btn-lg">发布招聘信息</a>
								</div>
							</div>
						</div>

					</div>

					<div class="row">

						<div class="col-sm-5">
							{{-- Events Calendar --}}
							<div class="iconmelon m-r-10">
								<svg viewBox="0 0 32 32">
									<g filter="">
										<use xlink:href="#clock-time"></use>
									</g>
								</svg>
							</div>

							<span class="text-gray-dark text-large align-with-button hidden-xs">
									日历
								</span>
							<span class="hidden-lg hidden-md hidden-sm text-gray-dark text-large align-with-button">
									日历
								</span>
							<hr>

							<div class="cal1" id="events-calendar"></div>
						</div>

					</div>
				</div>

				{{-- Statistics Tab --}}
				<div class="tab-pane fade p-30" id="statistics">

					<div class="row m-b-30">
						<div class="col-sm-4">
							<h1 class="font-w-100"><span class="text-blue">12</span> new followers</h1>
						</div>
						<div class="col-sm-8 m-t-30">

							<div class="row">
								<div class="col-sm-4 text-center">
									<span class="twitter-sparkline">Loading..</span>
									<div class="text-uppercase text-small text-gray-alt m-t-10">TWITTER</div>
								</div>

								<div class="col-sm-4 text-center">
									<span class="facebook-sparkline">Loading..</span>
									<div class="text-uppercase text-small text-gray-alt m-t-10">FACEBOOK</div>
								</div>

								<div class="col-sm-4 text-center">
									<span class="google-sparkline">Loading..</span>
									<div class="text-uppercase text-small text-gray-alt m-t-10">GOOGLE+</div>
								</div>
							</div>

						</div>
					</div>

					<hr class="m-b-30">

					{{-- Visiotrs Chart --}}
					<div class="iconmelon m-r-10">
						<svg viewBox="0 0 32 32">
							<g filter="">
								<use xlink:href="#man-people-user"></use>
							</g>
						</svg>
					</div>

					<span class="text-gray-dark text-large align-with-button pos-abs">
							Visitors
						</span>

					<div class="btn-group pull-right" data-toggle="buttons">
						<label class="btn btn-primary active">
							<input type="radio" name="visitors" id="option1">Week
						</label>
						<label class="btn btn-primary">
							<input type="radio" name="visitors" id="option2">Month
						</label>
						<label class="btn btn-primary">
							<input type="radio" name="visitors" id="option3">Year
						</label>
					</div>

					<div id="visitors-chart" style="height: 315px;" class="m-b-30"></div>

					<hr>

					<div class="row">
						<div class="col-sm-7">
							<div class="iconmelon m-r-10">
								<svg viewBox="0 0 32 32">
									<g filter="">
										<use xlink:href="#earth-globe"></use>
									</g>
								</svg>
							</div>

							<span class="text-gray-dark text-large align-with-button pos-abs">
									Source
								</span>

							<div id="source-chart" class="m-b-30" style="height: 320px;"></div>
						</div>

						<div class="col-sm-5">

							<div class="iconmelon m-r-10">
								<svg viewBox="0 0 32 32">
									<g filter="">
										<use xlink:href="#macintosh"></use>
									</g>
								</svg>
							</div>

							<span class="text-gray-dark text-large align-with-button pos-abs">
									Devices
								</span>

							<div id="device-chart" class="m-tb-30" style="height: 300px;"></div>
						</div>
					</div>

				</div>

			</div>

		</div>

	</div>
	{{-- /main content --}}
</body>

</html>