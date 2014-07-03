<div class="col-md-9">
	<div class="element-line">
		<div class="flexslider">
			<ul class="slides">
				@foreach ($jobs->pictures as $picture)
				<li>
					<img class="img-responsive img-center img-rounded" src="{{
				 route('home')}}/uploads/jobs/{{ $picture->filename }}" alt="{{ $picture->jobs->title }}" title="{{ $picture->jobs->title }}" />
				</li>
				@endforeach
			</ul>
		</div>
		<div class="blog-text">
			<p>
				{{ $jobs->content }}
			</p>
		</div>

		<div class="blog-comments clearfix">

			<h3>大家的看法</h3>
			@foreach($jobs->resume as $resume)
			<div class="media comment-item">
				<a href="#" class="pull-left"> <img src="{{ $resume->user->portrait_large }}" class="thumb img-rounded" alt=""> </a>
				<div class="media-body">
					@if($resume->user->nickname)
					<h4 class="media-heading">{{ $resume->user->nickname }} <small>发表时间： <i class="fa fa-calendar"></i> {{ $resume->friendly_created_at }}</small></h4>
					@else
					<h4 class="media-heading">{{ $resume->user->email }} <small>发表时间： <i class="fa fa-calendar"></i> {{ $resume->friendly_created_at }}</small></h4>
					@endif
					{{ $resume->content }}
				</div>
			</div>
			@endforeach
		</div>

		<div class="comment-formular">
			<h3>评论</h3>
			{{-- form contact --}}
			@include('layout.notification')
           	@if(Auth::check())
			<form class="blog-comments" method="post" autocomplete="off" id="comment" class="validate" role="form">
                {{-- CSRF Token --}}
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
				<div class="row">
					<div class="col-md-12">
						{{-- Form group --}}
						<div class="form-group">
							<label for="message">在这里说点什么吧</label>
							<textarea name="content" id="message" class="form-control input-lg required" rows="9" placeholder="请在这里输入评论内容……">{{ Input::old('content') }}</textarea>
							{{ $errors->first('content', '<span style="color:#c7254e;margin-top:1em;float:left;">:message</span>') }}
						</div>
						{{-- Form group --}}
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="action form-button medium">

							<div class="mybutton medium">
								<button id="submit" type="submit">
									<span data-hover="发表评论">我写好了</span>
								</button>
							</div>

						</div>
					</div>
				</div>
			</form>
			@else
            <div class="row">
				<div class="col-md-12">
					<hr>
					登陆后才可以在这里发表您的看法哦。
					<div class="action form-button medium">
						<div class="mybutton medium">
							<a href="{{ route('signin') }}">
								<span data-hover="现在登录">已有账号</span>
							</a>
						</div>

						<div class="mybutton medium">
							<a href="{{ route('signup') }}">
								<span data-hover="注册一个">没有账号</span>
							</a>
						</div>
					</div>
				</div>
			</div>
            @endif
			{{-- form contact --}}

		</div>
	</div>
</div>