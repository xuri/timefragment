@include('layout.account-header')
@yield('content')
{{ script('ckeditor') }}
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
								确认{{ $resourceName }}
						</span>
					</div>

					<div class="pull-right m-r-30 mail-nav">
						<a href="{{ route('myproduct.cart') }}" class="btn btn-bordered text-gray-alt">
							返回购物车
						</a>
					</div>

					<div class="p-lr-30 p-tb-10 pm-lr-10">
						@include('layout.notification')
					</div>

					<div class="p-lr-30 p-tb-10 pm-lr-10">

						<div class="panel panel-warning">
							<div class="panel-heading">
								<h3 class="panel-title">订单详情</h3>
							</div>
							<div class="panel-body">
								<p>商品名称：{{ $product }}</p>
								<p>商品单价：{{ $data->price }}</p>
								<p>购买数量：{{ $data->quantity }}</p>
								<p>费用总计：{{ $data->payment }}</p>
								<p>商家昵称：{{ $seller }}</p>
								@if(Auth::user()->username)
								<p>买家：{{ Auth::user()->username }}</p>
								@elseif(Auth::user()->nickname)
								<p>买家昵称：{{ Auth::user()->nickname }}</p>
								@else
								<p>买家E-mail：{{ Auth::user()->email }}</p>
								@endif
							</div>
						</div>

						<form class="form-horizontal" action="{{ route('order.payment') }}" method="post" autocomplete="off" target="_blank">
							{{-- CSRF Token --}}
							<input type="hidden" name="_token" value="{{ csrf_token() }}" />
							<input type="hidden" name="product_id" value="{{ $data->product_id }}" />
							{{-- Tabs Content --}}
							<div class="tab-content">
								{{-- General tab --}}
								<div class="tab-pane active" id="tab-general" style="margin:0 1em;">
									<div class="form-group">
										@if(Auth::user()->username==NULL)
										{{ $errors->first('customer_name', '<strong class="error" style="color: #cc0000">:message</strong>') }}
										<div class="input-group m-tb-10">
											<span class="input-group-addon">买家姓名</span>
											<input type="text" class="form-control" placeholder="请您在此处准确填写收货人姓名" name="customer_name" id="customer_name" value="{{ Input::old('customer_name') }}">
										</div>
										@else
										{{ $errors->first('customer_name', '<strong class="error" style="color: #cc0000">:message</strong>') }}
										<div class="input-group m-tb-10">
											<span class="input-group-addon">买家姓名</span>
											<input type="text" class="form-control" placeholder="请您在此处填写详细的收货地址" name="customer_name" id="customer_name" value="{{ Auth::user()->username }}">
										</div>
										@endif
										@if(Auth::user()->home_city == NULL)
										{{ $errors->first('customer_address', '<strong class="error" style="color: #cc0000">:message</strong>') }}
										<div class="input-group m-tb-10">
											<span class="input-group-addon">收货地址</span>
											<input type="text" class="form-control" placeholder="请您在此处填写详细的收货地址" name="customer_address" id="customer_address" value="{{ Input::old('customer_address') }}">
										</div>
										@else
										{{ $errors->first('customer_address', '<strong class="error" style="color: #cc0000">:message</strong>') }}
										<div class="input-group m-tb-10">
											<span class="input-group-addon">收货地址</span>
											<input type="text" class="form-control" placeholder="请您在此处填写详细的收货地址" name="customer_address" id="customer_address" value="{{ Auth::user()->home_province }} {{ Auth::user()->home_city }}市 {{ Auth::user()->home_address }}">
										</div>
										@endif
										@if(Auth::user()->phone==NULL)
										{{ $errors->first('customer_phone', '<strong class="error" style="color: #cc0000">:message</strong>') }}
										<div class="input-group m-tb-10">
											<span class="input-group-addon">手机号码</span>
											<input type="text" class="form-control" placeholder="请准确填写您常用的的手机号码" name="customer_phone" id="customer_phone" value="{{ Input::old('customer_phone') }}">
										</div>
										@else
										{{ $errors->first('customer_phone', '<strong class="error" style="color: #cc0000">:message</strong>') }}
										<div class="input-group m-tb-10">
											<span class="input-group-addon">手机号码</span>
											<input type="text" class="form-control" placeholder="请准确填写您常用的的手机号码" name="customer_phone" id="customer_phone" value="{{ Auth::user()->phone }}">
										</div>
										@endif
									</div>
								</div>
							</div>
							{{-- Form Actions --}}
							<div class="control-group p-b-30">
								<div class="controls">
									<button type="reset" class="btn btn-bordered text-gray-alt">清 空</button>
									<button type="submit" class="btn btn-success">确 认</button>
								</div>
							</div>
						</form>

					</div>

				</div>
			</div>
			{{-- /.col-lg-9 --}}

			@include('layout.account-slider')
			@yield('content')

		</div>
		{{-- /.row --}}

	</div>

	@include('layout.account-chat')
	@yield('content')

</body>

</html>