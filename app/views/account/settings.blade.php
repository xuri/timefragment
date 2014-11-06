@include('layout.account-header')
@yield('content')
</head>

<body class="bg-gray-light">

	@include('layout.account-navigation')
	@yield('content')

	@include('layout.account-sidebar')
	@yield('content')

	<div id="container" class="main-content p-30 tp-t-60 tp-lr-10">

		<button class="menu-btn btn btn-bordered text-gray-alt text-bold top-left-corner">&#9776; 菜单</button>


		<div class="row">
			<div class="col-sm-3 text-center">
				<div class="p-10 brad">
					<a href="{{ route('account.changePortrait') }}" class="center-on-hover">
						<img class="img-circle" width="115" height="115" src="{{ Auth::user()->portrait_large }}" alt="Avatar Large">
						<span class="btn btn-primary centered-element">更改</span>
					</a>

					<div>
						<div>
							<div class="editable i-block" contenteditable>
								<h3 class="m-b-0">{{ Auth::user()->nickname }}</h3>
							</div>
						</div>

						<?php
							$bound_type =  Auth::user()->bound_type;
							switch ($bound_type)
							{
								case "1":
									$user_bound_type = '<i class="fa fa-envelope-o"></i> '.Auth::user()->email;
								break;
								case "2":
									$user_bound_type = '<i class="fa fa-weibo"></i> 已连接新浪微博';
								break;
								case "3":
									$user_bound_type = '<i class="fa fa-qq"></i> 您已连接腾讯QQ账号';
								break;
								case "4":
									$user_bound_type = '<i class="fa fa-github"></i> 您已连接Github账号';
								break;
								default:
									$user_bound_type = '<i class="fa fa-info-circle"></i> 未知渠道注册';
							}
						?>

						<div>
							<div class="editable text-gray-alt i-block" contenteditable>
								<span class="m-t-10 d-block">{{ $user_bound_type }}</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-9">
				<div class="bg-white p-30 brad b-bot-2px-gray-light b-right-1px-gray-light">
					<div class="row">
						<div class="col-sm-5 text-center">
							<div class="circle-50-icon bg-green-dark m-t-10">
								<div class="iconmelon icon-white">
									<svg viewBox="0 0 32 32">
										<g filter="">
											<use xlink:href="#chaplin-hat-movie"></use>
										</g>
									</svg>
								</div>
							</div>
							<div class="text-large text-gray-alt">普通用户</div>
							<a href="#" class="btn btn-primary btn-lg m-t-10">注销账户</a>
						</div>
						<div class="col-sm-7">
							<h4>上次成功登陆时间</h4>
							<p class="text-gray-alt">{{ Auth::user()->signin_at }}</p>
							<hr>
							<h4 class="">加入时间</h4>
							<p class="text-gray-alt">{{ Auth::user()->created_at }}</p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="bg-white p-30 m-t-10 brad b-bot-2px-gray-light b-right-1px-gray-light">

			<h2 class="text-center p-b-30 m-t-0 page-header">基本资料</h2>
			<div class="col-12">
				<div class="col-m-12 m-30">
					@include('layout.notification')
				</div>
			</div>
			{{ Form::open(array('class' => 'form-horizontal', 'name' => 'form')) }}

				{{-- CSRF Token --}}
				<input type="hidden" name="_token" value="{{ csrf_token() }}" />
				<input type="hidden" name="_method" value="PUT" />
				<div class="col-sm-6">
					<label class="col-sm-12 m-t-10">昵称 {{ $errors->first('nickname', '<strong class="error" style="color: #cc0000">:message</strong>') }}</label>
					<div class="col-sm-12">
						<input type="text" name="nickname" value="{{ Auth::user()->nickname }}" class="input-large input-light brad col-sm-12">
					</div>

					<label class="col-sm-12 m-t-10">姓名 {{ $errors->first('username', '<strong class="error" style="color: #cc0000">:message</strong>') }}</label>
					<div class="col-sm-12">
						<input type="text" name="username" value="{{ Auth::user()->username }}" class="input-large input-light brad col-sm-12">
					</div>

					<label class="col-sm-12 m-t-10">签名 {{ $errors->first('bio', '<strong class="error" style="color: #cc0000">:message</strong>') }}</label>
					<div class="col-sm-12">
						<input type="text" name="bio" value="{{ Auth::user()->bio }}" class="input-large input-light brad col-sm-12">
					</div>

					<label class="col-sm-12 m-t-10">支付宝账户</label>
					<div class="col-sm-12">
						<input type="text" name="alipay" value="{{ Auth::user()->alipay }}" class="input-large input-light brad col-sm-12">
					</div>

					<label class="col-sm-12 m-t-10">手机号码 {{ $errors->first('phone', '<strong class="error" style="color: #cc0000">:message</strong>') }}</label>
					<div class="col-sm-12">
						<input type="text" name="phone" value="{{ Auth::user()->phone }}" class="input-large input-light brad col-sm-12">
					</div>
				</div>

				<div class="col-sm-6">
					<label class="col-sm-12 m-t-10">性别</label>
					<div class="col-sm-12 m-t-10 m-b-10">
						<div class="i-block">
							<select name="sex" id="sex" class="selectpicker input-light brad" data-width="100" data-live-search="true" rel="{{ Auth::user()->sex }}">
								<option value="">请选择</option>
								<option value="M">男</option>
								<option value="F">女</option>
								<option value="S">不告诉你</option>
							</select>
						</div>
					</div>

					<label class="col-sm-12 m-t-10">生日</label>
					<div class="col-sm-12 m-b-10">
						<select id="born_year" name="born_year" class="selectpicker input-light brad" data-live-search="true" data-width="100" rel="{{ Auth::user()->born_year }}">
							<option value="">请选择</option>
							<option value="2014">2014</option>
							<option value="2013">2013</option>
							<option value="2012">2012</option>
							<option value="2011">2011</option>
							<option value="2010">2010</option>
							<option value="2009">2009</option>
							<option value="2008">2008</option>
							<option value="2007">2007</option>
							<option value="2006">2006</option>
							<option value="2005">2005</option>
							<option value="2004">2004</option>
							<option value="2003">2003</option>
							<option value="2002">2002</option>
							<option value="2001">2001</option>
							<option value="2000">2000</option>
							<option value="1999">1999</option>
							<option value="1998">1998</option>
							<option value="1997">1997</option>
							<option value="1996">1996</option>
							<option value="1995">1995</option>
							<option value="1994">1994</option>
							<option value="1993">1993</option>
							<option value="1992">1992</option>
							<option value="1991">1991</option>
							<option value="1990">1990</option>
							<option value="1989">1989</option>
							<option value="1988">1988</option>
							<option value="1987">1987</option>
							<option value="1986">1986</option>
							<option value="1985">1985</option>
							<option value="1984">1984</option>
							<option value="1983">1983</option>
							<option value="1982">1982</option>
							<option value="1981">1981</option>
							<option value="1980">1980</option>
							<option value="1979">1979</option>
							<option value="1978">1978</option>
							<option value="1977">1977</option>
							<option value="1976">1976</option>
							<option value="1975">1975</option>
							<option value="1974">1974</option>
							<option value="1973">1973</option>
							<option value="1972">1972</option>
							<option value="1971">1971</option>
							<option value="1970">1970</option>
							<option value="1969">1969</option>
							<option value="1968">1968</option>
							<option value="1967">1967</option>
							<option value="1966">1966</option>
							<option value="1965">1965</option>
							<option value="1964">1964</option>
							<option value="1963">1963</option>
							<option value="1962">1962</option>
							<option value="1961">1961</option>
							<option value="1960">1960</option>
							<option value="1959">1959</option>
							<option value="1958">1958</option>
							<option value="1957">1957</option>
							<option value="1956">1956</option>
							<option value="1955">1955</option>
							<option value="1954">1954</option>
							<option value="1953">1953</option>
							<option value="1952">1952</option>
							<option value="1951">1951</option>
							<option value="1950">1950</option>
							<option value="1949">1949</option>
							<option value="1948">1948</option>
							<option value="1947">1947</option>
							<option value="1946">1946</option>
							<option value="1945">1945</option>
							<option value="1944">1944</option>
							<option value="1943">1943</option>
							<option value="1942">1942</option>
							<option value="1941">1941</option>
							<option value="1940">1940</option>
							<option value="1939">1939</option>
							<option value="1938">1938</option>
							<option value="1937">1937</option>
							<option value="1936">1936</option>
							<option value="1935">1935</option>
							<option value="1934">1934</option>
							<option value="1933">1933</option>
							<option value="1932">1932</option>
							<option value="1931">1931</option>
							<option value="1930">1930</option>
							<option value="1929">1929</option>
							<option value="1928">1928</option>
							<option value="1927">1927</option>
							<option value="1926">1926</option>
							<option value="1925">1925</option>
							<option value="1924">1924</option>
							<option value="1923">1923</option>
							<option value="1922">1922</option>
							<option value="1921">1921</option>
							<option value="1920">1920</option>
							<option value="1919">1919</option>
							<option value="1918">1918</option>
							<option value="1917">1917</option>
							<option value="1916">1916</option>
							<option value="1915">1915</option>
							<option value="1914">1914</option>
							<option value="1913">1913</option>
							<option value="1912">1912</option>
							<option value="1911">1911</option>
							<option value="1910">1910</option>
							<option value="1909">1909</option>
							<option value="1908">1908</option>
							<option value="1907">1907</option>
							<option value="1906">1906</option>
							<option value="1905">1905</option>
						</select> 年
						<div class="i-block">
							<select id="born_month" name="born_month" class="selectpicker input-light brad" data-width="100" data-live-search="true" rel="{{ Auth::user()->born_month }}">
								<option value="">请选择</option>
								<option value="1" >1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
								<option value="11">11</option>
								<option value="12">12</option>
							</select> 月
						</div>
						<div class="i-block">
							<select id="born_day" name="born_day" class="selectpicker input-light brad" data-width="100" data-live-search="true" rel="{{ Auth::user()->born_day }}">
								<option value="">请选择</option>
								<option value="1">01</option>
								<option value="2">02</option>
								<option value="3">03</option>
								<option value="4">04</option>
								<option value="5">05</option>
								<option value="6">06</option>
								<option value="7">07</option>
								<option value="8">08</option>
								<option value="9">09</option>
								<option value="10">10</option>
								<option value="11">11</option>
								<option value="12">12</option>
								<option value="13">13</option>
								<option value="14">14</option>
								<option value="15">15</option>
								<option value="16">16</option>
								<option value="17">17</option>
								<option value="18">18</option>
								<option value="19">19</option>
								<option value="20">20</option>
								<option value="21">21</option>
								<option value="22">22</option>
								<option value="23">23</option>
								<option value="24">24</option>
								<option value="25">25</option>
								<option value="26">26</option>
								<option value="27">27</option>
								<option value="28">28</option>
								<option value="29">29</option>
								<option value="30">30</option>
								<option value="31">31</option>
							</select> 日
						</div>
					</div>

					<label class="col-sm-12 m-t-10">我在</label>
					<div class="col-sm-12 m-t-10 m-b-10">
						<select id="province" class="input-light brad" data-live-search="false" name="province" onchange="setcity();" rel="{{ Auth::user()->home_province }}">
							<option value="">----请选择省份----</option>
							<option value="安徽">安徽</option>
							<option value="北京">北京</option>
							<option value="重庆">重庆</option>
							<option value="福建">福建</option>
							<option value="甘肃">甘肃</option>
							<option value="广东">广东</option>
							<option value="广西">广西</option>
							<option value="贵州">贵州</option>
							<option value="海南">海南</option>
							<option value="河北">河北</option>
							<option value="黑龙江">黑龙江</option>
							<option value="河南">河南</option>
							<option value="香港">香港</option>
							<option value="湖北">湖北</option>
							<option value="湖南">湖南</option>
							<option value="江苏">江苏</option>
							<option value="江西">江西</option>
							<option value="吉林">吉林</option>
							<option value="辽宁">辽宁</option>
							<option value="澳门">澳门</option>
							<option value="内蒙古">内蒙古</option>
							<option value="宁夏">宁夏</option>
							<option value="青海">青海</option>
							<option value="山东">山东</option>
							<option value="上海">上海</option>
							<option value="山西">山西</option>
							<option value="陕西">陕西</option>
							<option value="四川">四川</option>
							<option value="台湾">台湾</option>
							<option value="天津">天津</option>
							<option value="新疆">新疆</option>
							<option value="西藏">西藏</option>
							<option value="云南">云南</option>
							<option value="浙江">浙江</option>
							<option value="海外">海外</option>
						</select>
						<div class="i-block">
							@if(Auth::user()->home_city)
							<select name="city" id="city" class="input-light brad" rel="{{ Auth::user()->home_city }}" style="width: 140px">
								<option value="" id="select_city">----请选择城市----</option>
							</select>
							@else
							<select name="city" id="city" class="input-light brad" rel="{{ Auth::user()->home_city }}" style="width: 140px">
								<option value="">----请选择城市----</option>
							</select>
							@endif
						</div>
					</div>

					<label class="col-sm-12 m-t-10">详细地址</label>
					<div class="col-sm-12 m-b-10">
						<input type="text" name="address" value="{{ Auth::user()->home_address }}" class="input-large input-light brad col-sm-12">
					</div>
				</div>

				<div class="row">
					<div class="col-sm-12 m-l-30 m-t-10">
						<button class="btn btn-lg btn-primary">保存更改</button>
					</div>
				</div>
			{{ Form::close() }}
		</div>
	</div>
	<script>
		$("#sex").val($("#sex").attr("rel"));
		$("#born_year").val($("#born_year").attr("rel"));
		$("#born_month").val($("#born_month").attr("rel"));
		$("#born_day").val($("#born_day").attr("rel"));
		$("#province").val($("#province").attr("rel"));
		$('#select_city').each(function(){
			$(this).replaceWith('<option value="'+$("#city").attr("rel")+'">'+$("#city").attr("rel")+'</option>');
		});
	</script>
</body>
</html>