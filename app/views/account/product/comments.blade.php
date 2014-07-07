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
                            我评论过的商品信息
                        </span>

                    </div>

                    <hr>

                    <div class="p-lr-30 p-tb-10 pm-lr-10">
                        @include('layout.notification')
                    </div>

                    <div class="table-responsive p-lr-30 p-tb-10 pm-lr-10">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>标题</th>
                                    <th>评论内容</th>
                                    <th style="width:35%;">创建时间</th>
                                    <th style="width:8%;text-align:center;">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($comments as $comment)
                                <tr>
                                    <td>
                                        @if($comment->product)
                                        <a href="{{ route('product.show', $comment->product->slug) }}" target="_blank">
                                            <i class="glyphicon glyphicon-share" style="font-size:0.8em;"></i>
                                        </a> [{{ $comment->product->province }}·{{ $comment->product->city }}] {{ $comment->product->title }}
                                        @else
                                        此商品已下架
                                        @endif
                                    </td>
                                    <td>{{ $comment->content }}</td>
                                    <td>{{ $comment->created_at }}（{{ $comment->friendly_created_at }}）</td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-xs btn-danger" onclick="modal('{{ route('myproduct.deleteComment', $comment->id) }}')">删除评论
                                         </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="btn-group m-l-30">
                        {{ pagination($comments->appends(Input::except('page')), 'layout.paginator') }}
                    </div>

                </div>
            </div>
            {{-- /.col-lg-9 --}}


            <div class="col-sm-3">

                <div class="bg-white p-t-30 m-b-10 b-bot-2px-gray-light">

                    <div class="iconmelon m-r-10 m-l-30">
                        <svg viewBox="0 0 32 32">
                            <g filter="">
                                <use xlink:href="#speech-talk-user"></use>
                            </g>
                        </svg>
                    </div>

                    <span class="text-gray-dark text-large align-with-button">
                            收件箱
                        </span>

                    <hr class="m-b-0">

                    <div class="p-lr-30">
                        <button class="btn btn-primary btn-lg btn-block compose-btn">发消息</button>
                    </div>

                    <hr class="m-t-0 m-b-0">

                    <ul class="nav nav-pills nav-stacked">
                        <li class="active"><a href="messages.html#">收件箱</a>
                        </li>
                        <li><a href="messages.html#">已发送</a>
                        </li>
                        <li><a href="messages.html#">草稿箱</a>
                        </li>
                        <li><a href="messages.html#">收藏夹</a>
                        </li>
                        <li><a href="messages.html#">回收站</a>
                        </li>
                        <li><a href="messages.html#">垃圾信息</a>
                        </li>
                    </ul>
                </div>

                <div id="chat" class="bg-white p-t-30 p-b-10 chat-wrapper b-bot-2px-gray-light">

                    <div class="btn-group chat-toggle">
                        <a href="messages.html#" class="p-lr-30 hover-no-underline" data-toggle="dropdown">
                            <img class="img-circle chat-avatar available m-r-10" width="35" src="{{ Auth::user()->portrait_large }}">
                            <span class="hover-no-underline hover-gray-dark text-gray">
                                    <span class="text-gray-dark text-large align-with-button">
                                        {{ Auth::user()->nickname }}
                                    </span>
                            <span class="caret"></span>
                            </span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="messages.html#"><span class="circle-green m-r-10"></span>在线</a>
                            </li>
                            <li><a href="messages.html#"><span class="circle-yellow m-r-10"></span>忙碌</a>
                            </li>
                            <li><a href="messages.html#"><span class="circle-gray m-r-10"></span>隐身</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="messages.html#"><span class="circle-red m-r-10"></span>离线</a>
                            </li>
                        </ul>
                    </div>

                    <hr class="m-b-0">

                    <div class="p-lr-30">
                        <input type="text" class="input-light input-large brad chat-search" placeholder="查找好友...">
                    </div>

                    <hr class="m-t-0">

                    <ul class="unstyled people">
                        <li>
                            <a href="messages.html#" class="p-lr-30 p-tb-10 pm-lr-10 d-block">
                                {{ HTML::image('images/avatars/5.jpg', '', array('class' => 'label label-success m-l-10')); }}
                                <span class="author">Erik Dean</span>
                                <span class="label label-success m-l-10">3</span>
                            </a>
                        </li>

                        <li>
                            <a href="messages.html#" class="p-lr-30 p-tb-10 pm-lr-10 d-block">
                                {{ HTML::image('images/avatars/7.jpg', '', array('class' => 'img-circle chat-avatar available m-r-10')); }}
                                <span class="author">Doug Ross</span>
                            </a>
                        </li>

                        <li>
                            <a href="messages.html#" class="p-lr-30 p-tb-10 d-block">
                                {{ HTML::image('images/avatars/8.jpg', '', array('class' => 'img-circle chat-avatar busy m-r-10')); }}
                                <span class="author">Victor Benson</span>
                            </a>
                        </li>

                        <li>
                            <a href="messages.html#" class="p-lr-30 p-tb-10 d-block">
                                {{ HTML::image('images/avatars/9.jpg', '', array('class' => 'img-circle chat-avatar signedoff m-r-10')); }}
                                <span class="author">Henry Mccormick</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
        {{-- /.row --}}
    </div>
    <?php
    $modalData['modal'] = array(
        'id'      => 'myModal',
        'title'   => '系统提示',
        'message' => '确认删除此评论？',
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