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
								时光碎片 · 尚品汇 商家平台
						</span>

                    </div>

                    <div class="pull-right m-r-30 mail-nav">
                        <a href="{{ route('order.seller') }}" class="btn btn-bordered text-gray-alt">
                            返回销售{{ $resourceName }}列表
                        </a>
                    </div>

                    <div class="p-lr-30 p-tb-10 pm-lr-10">
                        @include('layout.notification')
                    </div>

                    <div class="p-lr-30 p-tb-10 pm-lr-10">
                        @if($data->is_checkout == true)
                        <div class="panel panel-success">
                        @else
                        <div class="panel panel-info">
                        @endif
                            <div class="panel-heading">
                                <h3 class="panel-title">{{ $resourceName }}详情</h3>
                            </div>
                            <div class="panel-body">
                                <p>商品名称：{{ Product::where('id', $data->product_id)->first()->title }}</p>
                                <p>订单号：{{ $data->order_id }}</p>
                                <p>成交时间：{{ $data->created_at }}</p>
                                <p>商品单价：{{ $data->price }}</p>
                                <p>购买数量：{{ $data->quantity }}</p>
                                <p>费用总计：{{ $data->payment }}</p>
                                <p>商家昵称：{{ Auth::user()->nickname }}</p>
                                @if( User::where('id', $data->customer_id)->first()->username )
                                <p>买家：{{ User::where('id', $data->customer_id)->first()->username }}</p>
                                @elseif(User::where('id', $data->customer_id)->first()->nickname)
                                <p>买家昵称：{{ User::where('id', $data->customer_id)->first()->nickname }}</p>
                                @else
                                <p>买家E-mail：{{ User::where('id', $data->customer_id)->first()->email }}</p>
                                @endif
                                <p>收货地址：{{ $data->customer_address }}</p>
                                <p>订单状态：
                                    @if( $data->is_payment == false)
                                    买家未付款
                                    @elseif( $data->is_payment == true && $data->is_express == false)
                                    买家已付款，等待您发货
                                    @elseif( $data->is_express == true && $data->is_checkout == false)
                                    您已发货，等待买家确认收货
                                    @else
                                    买家以确认收货，交易关闭
                                    @endif
                                </p>
                            </div>
                        </div>
                        @if($data->is_express == false)
                        <form class="form-horizontal" action="{{ route('order.sendGoods') }}" method="post" autocomplete="off">
                            {{-- CSRF Token --}}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="id" value="{{ $data->id }}" />
                            {{-- Tabs Content --}}
                            <div class="tab-content">
                                {{-- General tab --}}
                                <div class="tab-pane active" id="tab-general" style="margin:0 1em;">
                                    <div class="form-group">
                                        {{ $errors->first('express_name', '<strong class="error" style="color: #cc0000">:message</strong>') }}
                                        <div class="col-m-12" style="padding-top:6px;">
                                            <label class="m-10">物流公司名称</label>
                                            <div class="i-block">
                                                <select id="express_name" name="express_name" class="selectpicker input-light brad" data-width="150" data-live-search="true" rel="{{ Input::old('express_name') }}">
                                                    <option value="">请选择物流公司</option>
                                                    <option value="EMS">EMS</option>
                                                    <option value="联邦快递">联邦快递</option>
                                                    <option value="百世物流">百世物流</option>
                                                    <option value="信丰物流">信丰物流</option>
                                                    <option value="顺丰速运">顺丰速运</option>
                                                    <option value="申通快递">申通快递</option>
                                                    <option value="龙邦速递">龙邦速递</option>
                                                    <option value="天地华宇">天地华宇</option>
                                                    <option value="快捷快递">快捷快递</option>
                                                    <option value="圆通速递">圆通速递</option>
                                                    <option value="中通快递">中通快递</option>
                                                    <option value="中铁快运">中铁快运</option>
                                                    <option value="中铁物流">中铁物流</option>
                                                    <option value="百世汇通">百世汇通</option>
                                                    <option value="宅急送">宅急送</option>
                                                    <option value="韵达快递">韵达快递</option>
                                                    <option value="天天快递">天天快递</option>
                                                    <option value="全峰快递">全峰快递</option>
                                                    <option value="城市100">城市100</option>
                                                    <option value="全一快递">全一快递</option>
                                                    <option value="德邦快递">德邦快递</option>
                                                    <option value="秀驿物流">秀驿物流</option>
                                                    <option value="中通">中通</option>
                                                    <option value="UCS合众速递">UCS合众速递</option>
                                                    <option value="凡宇速递">凡宇速递</option>
                                                    <option value="联昊通">联昊通</option>
                                                    <option value="广东EMS">广东EMS</option>
                                                    <option value="速尔">速尔</option>
                                                    <option value="EMS经济快递">EMS经济快递</option>
                                                    <option value="递四方厦门仓">递四方厦门仓</option>
                                                    <option value="燕文北京">燕文北京</option>
                                                    <option value="递四方上海仓">递四方上海仓</option>
                                                    <option value="秀驿深圳仓">秀驿深圳仓</option>
                                                    <option value="燕文广州">燕文广州</option>
                                                    <option value="递四方深圳仓">递四方深圳仓</option>
                                                    <option value="ZTOSH">ZTOSH</option>
                                                    <option value="递四方广州仓">递四方广州仓</option>
                                                    <option value="递四方新邮">递四方新邮</option>
                                                    <option value="ZTOGZ">ZTOGZ</option>
                                                    <option value="飞远(爱彼西)配送">飞远(爱彼西)配送</option>
                                                    <option value="赤湾东方">赤湾东方</option>
                                                    <option value="家装干线物流">家装干线物流</option>
                                                    <option value="佳吉快递">佳吉快递</option>
                                                    <option value="华强物流">华强物流</option>
                                                    <option value="邮政国内小包">邮政国内小包</option>
                                                    <option value="新邦物流">新邦物流</option>
                                                    <option value="黑猫宅急便">黑猫宅急便</option>
                                                    <option value="贝海国际速递">贝海国际速递</option>
                                                    <option value="E速宝冷链">E速宝冷链</option>
                                                    <option value="德邦物流">德邦物流</option>
                                                    <option value="国通快递">国通快递</option>
                                                    <option value="邮科院">邮科院</option>
                                                    <option value="递四方">递四方</option>
                                                    <option value="中通速递BJ">中通速递BJ</option>
                                                    <option value="上邮函件">上邮函件</option>
                                                    <option value="联邦快递陆运">联邦快递陆运</option>
                                                    <option value="能达速递">能达速递</option>
                                                    <option value="优速快递">优速快递</option>
                                                    <option value="增益速递">增益速递</option>
                                                    <option value="其他">其他</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-m-6">
                                            {{ $errors->first('invoice_no', '<strong class="error" style="color: #cc0000">:message</strong>') }}
                                            <div class="input-group m-tb-10">
                                                <span class="input-group-addon">物流发货单号</span>
                                                <input type="text" class="form-control" placeholder="请您在此处填写物流发货单号" name="invoice_no" id="invoice_no" value="{{ Input::old('invoice_no') }}">
                                            </div>
                                        </div>

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
                        @endif
                    </div>

                </div>
            </div>
            {{-- /.col-lg-9 --}}

            @include('layout.account-slider')
            @yield('content')

        </div>
        {{-- /.row --}}

    </div>

</body>

</html>