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
                                时光碎片 · 尚品汇购物
                        </span>

                    </div>

                    <div class="pull-right m-r-30 mail-nav">
                        <a href="{{ route('order.index') }}" class="btn btn-bordered text-gray-alt">
                            返回尚品汇购物{{ $resourceName }}
                        </a>
                    </div>

                    <div class="p-lr-30 p-tb-10 pm-lr-10">
                        @include('layout.notification')
                    </div>

                    <div class="p-lr-30 p-tb-10 pm-lr-10">

                        <div class="panel panel-info">
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
                                <p>商家昵称：{{ User::where('id', $data->seller_id)->first()->nickname }}</p>
                                @if(Auth::user()->username)
                                <p>买家：{{ Auth::user()->username }}</p>
                                @elseif(Auth::user()->nickname)
                                <p>买家昵称：{{ Auth::user()->nickname }}</p>
                                @else
                                <p>买家E-mail：{{ Auth::user()->email }}</p>
                                @endif
                                <p>收货地址：{{ $data->customer_address }}</p>
                                <p>订单状态：
                                    @if( $data->is_payment == false)
                                    买家未付款
                                    @elseif( $data->is_payment == true && $data->is_express == false)
                                    您已付款，等待卖家发货
                                    @elseif( $data->is_express == true && $data->is_checkout == false)
                                    卖家已发货，等待买家确认收货
                                    @else
                                    您以确认收货，交易关闭
                                    @endif
                                </p>
                            </div>
                        </div>
                        @if( $data->is_express == true && $data->is_checkout == false)
                        <form class="form-horizontal" action="{{ route('order.checkout') }}" method="post" autocomplete="off">
                            {{-- CSRF Token --}}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="id" value="{{ $data->id }}" />
                            {{-- Form Actions --}}
                            <div class="control-group p-b-30">
                                <div class="controls">
                                    <a href="https://auth.alipay.com/" target="_blank" class="btn btn-bordered text-gray-alt">付 款</a>
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

    @include('layout.account-chat')
    @yield('content')

</body>

</html>