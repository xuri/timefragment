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
                                <a href="#tab-unpayment-billing" data-toggle="tab">
                                    <div class="text-small">Unpayment Billing</div>
                                    <span class="text-uppercase">未付款订单</span>
                                </a>
                            </li>
                            <li>
                                <a href="#tab-payment-billing" data-toggle="tab">
                                    <div class="text-small">Payment Billing</div>
                                    <span class="text-uppercase">已付款订单</span>
                                </a>
                            </li>
                            <li>
                                <a href="#tab-purchased-goods" data-toggle="tab">
                                    <div class="text-small">Purchased Goods</div>
                                    <span class="text-uppercase">已购买商品</span>
                                </a>
                            </li>
                        </ul>

                        {{-- Tabs Content --}}
                        <div class="tab-content">

                            {{-- Unpayment Billing tab --}}
                            <div class="tab-pane active fade in p-30" id="tab-unpayment-billing" style="border:1px solid #ddd;border-top:0;">
                                <div class="table-responsive">
                                    @if($unpayment_order->first())

                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th style="width: 28%;">商品 {{ order_by('id') }}</th>
                                                <th style="width: 12%;">单价 {{ order_by('price') }}</th>
                                                <th style="width: 12%;">数量 {{ order_by('quantity') }}</th>
                                                <th style="width: 12%;">费用 {{ order_by('payment') }}</th>
                                                <th style="width: 20%;">添加时间 {{ order_by('created_at', 'desc') }}</th>
                                                <th style="width: 14%; text-align:center;">操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($unpayment_order as $unpayment)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('product.show', Product::where('id', $unpayment->product_id)->first()->slug) }}" target="_blank">
                                                        <i class="glyphicon glyphicon-share" style="font-size:0.8em;"></i>
                                                    </a>
                                                    {{ Product::where('id', $unpayment->product_id)->first()->title }}
                                                </td>
                                                <td>￥{{ Product::where('id', $unpayment->product_id)->first()->price }}</td>
                                                <td>{{ $unpayment->quantity }}</td>
                                                <td>￥{{ $unpayment->payment }}</td>
                                                <td>{{ $unpayment->created_at }}</td>
                                                <td style="text-align:center;">
                                                    <form action="{{ route('order.rePayment') }}" method="post" autocomplete="off" target="_blank">
                                                        {{-- CSRF Token --}}
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                        <input type="hidden" name="order_id" value="{{ $unpayment->id }}" />
                                                        <button type="submit" class="btn btn-xs btn-warning">付款</button>
                                                        <a href="javascript:void(0)" class="btn btn-xs btn-danger"
                                                         onclick="modal('{{ route($resource.'.destroyOrder', $unpayment->id) }}')">删除</a>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                    @else
                                    <div class="alert alert-info m-t-30" role="alert">
                                        暂无未付款{{ $resourceName }}，快去<a href="{{ route('product.getIndex') }}" class="alert-link">尚品汇</a>发现新宝贝吧。
                                    </div>
                                    @endif
                                </div>
                                <div class="btn-group">
                                    {{ pagination($unpayment_order->appends(Input::except('page')), 'layout.paginator') }}
                                </div>
                            </div>

                            {{-- Payment Billing tab --}}
                            <div class="tab-pane fade p-30" id="tab-payment-billing" style="border:1px solid #ddd;border-top:0;">
                                <div class="table-responsive">
                                    @if($payment_order->first())

                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th style="width: 42%;">商品 {{ order_by('id') }}</th>
                                                <th style="width: 12%;">数量 {{ order_by('quantity') }}</th>
                                                <th style="width: 12%;">费用 {{ order_by('payment') }}</th>
                                                <th style="width: 20%;">生成时间 {{ order_by('created_at', 'desc') }}</th>
                                                <th style="width: 7%;">状态 {{ order_by('is_express', 'desc') }}</th>
                                                <th style="width: 7%; text-align:center;">操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($payment_order as $payment)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('product.show', Product::where('id', $payment->product_id)->first()->slug) }}" target="_blank">
                                                        <i class="glyphicon glyphicon-share" style="font-size:0.8em;"></i>
                                                    </a>
                                                    {{ Product::where('id', $payment->product_id)->first()->title }}
                                                </td>
                                                <td>{{ $payment->quantity }}</td>
                                                <td>￥{{ $payment->payment }}</td>
                                                <td>{{ $payment->created_at }}</td>
                                                <td>
                                                    @if( $payment->is_express == false)
                                                    <span class="btn btn-xs btn-warning">未发货</span>
                                                    @else
                                                    <span class="btn btn-xs btn-success">已发货</span>
                                                    @endif
                                                </td>
                                                <td style="text-align:center;">
                                                    @if( $payment->is_express == true)
                                                    <a href="{{ route($resource.'.customerOrderDetails', $payment->id) }}" class="btn btn-xs btn-info">确认收货</a>
                                                    @else
                                                    <a href="{{ route($resource.'.customerOrderDetails', $payment->id) }}" class="btn btn-xs btn-info">订单详情</a>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                    @else
                                    <div class="alert alert-info m-t-30" role="alert">
                                        暂无已付款{{ $resourceName }}，快去<a href="{{ route('product.getIndex') }}" class="alert-link">尚品汇</a>发现新宝贝吧。
                                    </div>
                                    @endif
                                </div>
                                <div class="btn-group">
                                    {{ pagination($payment_order->appends(Input::except('page')), 'layout.paginator') }}
                                </div>
                            </div>

                            {{-- Purchased Goods tab --}}
                            <div class="tab-pane fade p-30" id="tab-purchased-goods" style="border:1px solid #ddd;border-top:0;">

                                <div class="table-responsive">
                                    @if($checkout_order->first())

                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th style="width: 37%;">商品 {{ order_by('id') }}</th>
                                                <th style="width: 12%;">单价 {{ order_by('price') }}</th>
                                                <th style="width: 12%;">数量 {{ order_by('quantity') }}</th>
                                                <th style="width: 12%;">费用 {{ order_by('payment') }}</th>
                                                <th style="width: 20%;">生成时间 {{ order_by('created_at', 'desc') }}</th>
                                                <th style="width: 7%; text-align:center;">操作</th>
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
                                                    <a href="{{ route($resource.'.customerOrderDetails', $checkout->id) }}" class="btn btn-xs btn-info">查看详情</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                    @else
                                    <div class="alert alert-info m-t-30" role="alert">
                                        暂无已购买{{ $resourceName }}，快去<a href="{{ route('product.getIndex') }}" class="alert-link">尚品汇</a>发现新宝贝吧。
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
        'message' => '确认删除此订单？',
        'footer'  =>
            Form::open(array('id' => 'real-delete', 'method' => 'delete')).'
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">取消</button>
                <button type="submit" class="btn btn-sm btn-danger">确认删除</button>'.
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