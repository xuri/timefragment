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
                                尚品汇购物{{ $resourceName }}
                        </span>

                    </div>


                    <div class="pull-right m-r-30 mail-nav">

                        <a href="{{ route($resource.'.index') }}" class="btn btn-bordered text-gray-alt">
                            &laquo; 返回{{ $resourceName }}列表
                        </a>

                    </div>

                    <div class="p-lr-30 p-tb-10 pm-lr-10">
                        @include('layout.notification')
                    </div>

                    <div class="p-lr-30 p-tb-10 pm-lr-10">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#tab-trading-order" data-toggle="tab">
                                    <div class="text-small">Trading Order</div>
                                    <span class="text-uppercase">交易中订单</span>
                                </a>
                            </li>
                            <li>
                                <a href="#tab-checkout-order" data-toggle="tab">
                                    <div class="text-small">Checkout Order</div>
                                    <span class="text-uppercase">已售出商品</span>
                                </a>
                            </li>
                        </ul>

                        {{-- Tabs Content --}}
                        <div class="tab-content">

                            {{-- Trading order tab --}}
                            <div class="tab-pane active fade in p-30" id="tab-trading-order" style="border:1px solid #ddd;border-top:0;">
                                <div class="table-responsive">
                                    @if($trading_order->first())

                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th style="width: 28%;">商品 {{ order_by('id') }}</th>
                                                <th style="width: 12%;">单价 {{ order_by('price') }}</th>
                                                <th style="width: 12%;">数量 {{ order_by('quantity') }}</th>
                                                <th style="width: 12%;">已付 {{ order_by('payment') }}</th>
                                                <th style="width: 20%;">成交时间 {{ order_by('created_at', 'desc') }}</th>
                                                <th style="width: 14%; text-align:center;">操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($trading_order as $trading)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('product.show', Product::where('id', $trading->product_id)->first()->slug) }}" target="_blank">
                                                        <i class="glyphicon glyphicon-share" style="font-size:0.8em;"></i>
                                                    </a>
                                                    {{ Product::where('id', $trading->product_id)->first()->title }}
                                                </td>
                                                <td>￥{{ Product::where('id', $trading->product_id)->first()->price }}</td>
                                                <td>{{ $trading->quantity }}</td>
                                                <td>￥{{ $trading->payment }}</td>
                                                <td>{{ $trading->created_at }}（{{ $trading->friendly_created_at }}）</td>
                                                <td style="text-align:center;">
                                                    @if( $trading->is_express == false)
                                                    <a href="{{ route($resource.'.sellerOrderDetails', $trading->id) }}" class="btn btn-xs btn-danger">尚未发货</a>
                                                    @else
                                                    <a href="{{ route($resource.'.sellerOrderDetails', $trading->id) }}" class="btn btn-xs btn-primary">已经发货</a>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                    @else
                                    <div class="alert alert-info m-t-30" role="alert">
                                        暂无交易中{{ $resourceName }}。
                                    </div>
                                    @endif
                                </div>
                                <div class="btn-group">
                                    {{ pagination($trading_order->appends(Input::except('page')), 'layout.paginator') }}
                                </div>
                            </div>

                            {{-- Checkout order tab --}}
                            <div class="tab-pane fade p-30" id="tab-checkout-order" style="border:1px solid #ddd;border-top:0;">
                                <div class="table-responsive">
                                    @if($checkout_order->first())

                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th style="width: 28%;">商品 {{ order_by('id') }}</th>
                                                <th style="width: 12%;">单价 {{ order_by('price') }}</th>
                                                <th style="width: 12%;">数量 {{ order_by('quantity') }}</th>
                                                <th style="width: 12%;">费用 {{ order_by('payment') }}</th>
                                                <th style="width: 20%;">生成时间 {{ order_by('created_at', 'desc') }}</th>
                                                <th style="width: 14%; text-align:center;">订单详情</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($checkout_order as $checkout)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('product.show', Product::where('id', $checkout->product_id)->first()->slug) }}" target="_blank">
                                                        <i class="glyphicon glyphicon-share" style="font-size:0.8em;"></i>
                                                    </a>
                                                    {{ Product::where('id', $checkout->product_id)->first()->title }}
                                                </td>
                                                <td>￥{{ Product::where('id', $checkout->product_id)->first()->price }}</td>
                                                <td>{{ $checkout->quantity }}</td>
                                                <td>￥{{ $checkout->payment }}</td>
                                                <td>{{ $checkout->created_at }}</td>
                                                <td style="text-align:center;">
                                                    <a href="{{ route($resource.'.sellerOrderDetails', $checkout->id) }}" class="btn btn-xs btn-success">查看详情</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                    @else
                                    <div class="alert alert-info m-t-30" role="alert">
                                        暂无售出{{ $resourceName }}。
                                    </div>
                                    @endif
                                </div>
                                <div class="btn-group">
                                    {{ pagination($checkout_order->appends(Input::except('page')), 'layout.paginator') }}
                                </div>
                            </div>

                        </div>
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

    <?php
    $modalData['modal'] = array(
        'id'      => 'myModal',
        'title'   => '系统提示',
        'message' => '确认已经将商品邮寄给买家？',
        'footer'  =>
            Form::open(array('id' => 'real-delete', 'method' => 'delete')).'
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">取消</button>
                <button type="submit" class="btn btn-sm btn-success">确认发货</button>'.
            Form::close(),
    );
    ?>
    @include('layout.modal', $modalData)
    <script>
        function modal(href)
        {
            $('#real-delete').attr('action', href);
            $('#myModal').modal();
        }

        $("#location").val($("#location").attr("rel"));
    </script>

</body>
</html>