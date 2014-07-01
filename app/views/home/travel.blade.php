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
												<a href="{{ route('travel.show', $travel->slug) }}"><h3><strong>{{ $travel->title }}</strong></h3></a>

												<p>
													来自：{{ $travel->user->nickname }}
												</p>
												<ul>
													<li>
														<a href="" title="{{ $travel->user->nickname }}的Facebook" alt="{{ $travel->user->nickname }}的Facebook"><i class="fa fa-facebook fa-2x"></i></a>
													</li>
													<li>
														<a href="" title="{{ $travel->user->nickname }}的Twitter" alt="{{ $travel->user->nickname }}的Twitter"><i class="fa fa-twitter fa-2x"></i></a>
													</li>
													<li>
														<a href="" title="{{ $travel->user->nickname }}的Google+" alt="{{ $travel->user->nickname }}的Google+"><i class="fa fa-google-plus fa-2x"></i></a>
													</li>
													<li>
														<a href="" title="{{ $travel->user->nickname }}的新浪微博" alt="{{ $travel->user->nickname }}的新浪微博"><i class="fa fa-weibo fa-2x"></i></a>
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
		{{-- Team Section --}}