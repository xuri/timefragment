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
                                我的购物车
                        </span>

                    </div>


                    <input type="text" class="input-light input-large brad valign-top m-r-10 m-l-10 search-box" placeholder="搜索...">

                    <div class="pull-right m-r-30 mail-nav">
                        <a href="#" class="btn btn-bordered text-gray-alt">
                            清空{{ $resourceName }}
                        </a>
                    </div>

                    <div class="p-lr-30 p-tb-10 pm-lr-10">
                        @include('layout.notification')
                    </div>


                    <div class="table-responsive p-lr-30 p-tb-10 pm-lr-10">
                        @if($datas->first())
                        <div class="alert alert-warning" role="alert">
                            <strong>价格合计：{{ $payment }} 元</strong>
                            <a href="#" class="alert-link pull-right">合并付款 &rarr;</a>
                        </div>

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
                                @foreach ($datas as $data)
                                <tr>
                                    <td>
                                        <a href="{{ route('product.show', Product::where('id', $data->product_id)->first()->slug) }}" target="_blank">
                                            <i class="glyphicon glyphicon-share" style="font-size:0.8em;"></i>
                                        </a>
                                        {{ Product::where('id', $data->product_id)->first()->title }}
                                    </td>
                                    <td>￥{{ Product::where('id', $data->product_id)->first()->price }}</td>
                                    <td>{{ $data->quantity }}</td>
                                    <td>￥{{ $data->payment }}</td>
                                    <td>{{ $data->created_at }}</td>
                                    <td style="width: 14%; text-align:center;">
                                        <form action="{{ route('order.order') }}" method="post" autocomplete="off" >
                                            {{-- CSRF Token --}}
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                            <input type="hidden" name="product_id" value="{{ $data->product_id }}" />
                                            <a href="{{ route('order.order', $data->id) }}" class="btn btn-xs btn-warning">付款</a>
                                            <a href="javascript:void(0)" class="btn btn-xs btn-danger"
                                             onclick="modal('{{ route($resource.'.destroyGoods', $data->id) }}')">删除</a>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                        @else
                        <div class="alert alert-info" role="alert">
                            购物车里还没有商品哦，快去<a href="{{ route('product.getIndex') }}" class="alert-link">尚品汇</a>发现新宝贝吧。
                        </div>
                        @endif
                    </div>
                    <div class="btn-group m-l-30">
                        {{ pagination($datas->appends(Input::except('page')), 'layout.paginator') }}
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
        'message' => '确认将此商品从'.$resourceName.'中删除？',
        'footer'  =>
            Form::open(array('id' => 'real-delete', 'method' => 'delete')).'
                <button type="button" class="btn btn-sm btn-default btn-bordered" data-dismiss="modal">取消</button>
                <button type="submit" class="btn btn-sm btn-danger">确认删除</button>'.
            Form::close(),
    );
    ?>
    @include('layout.modal', $modalData)
    <script>
        function modal(href) {
            $('#real-delete').attr('action', href);
            $('#myModal').modal();
        }
    </script>
</body>

</html>