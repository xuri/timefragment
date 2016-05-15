@include('layout.account-header')
@yield('content')
<body class="bg-gray-light">

    @include('layout.account-navigation')
    @yield('content')

    @include('layout.account-sidebar')
    @yield('content')
    <div class="preloader">
        <div class="timer"></div>
    </div>

    <div id="container" class="main-content p-30 tp-t-60 tp-lr-10">

        <button class="menu-btn btn btn-bordered text-gray-alt text-bold top-left-corner">&#9776; 菜单</button>

        <div class="row">

            <div class="col-sm-12">
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
                            我的{{ $resourceName }}
                        </span>

                    </div>

                    <div class="btn-group m-l-30">
                        {{ pagination($datas->appends(Input::except('page')), 'layout.paginator') }}
                    </div>

                    <div class="pull-right m-r-30 mail-nav">
                        <a href="{{ route($resource.'.create') }}" class="btn btn-bordered text-gray-alt">
                            分享新文章
                        </a>
                    </div>

                    <div class="p-lr-30 p-tb-10 pm-lr-10">
                        @include('layout.notification')
                    </div>
                </div>
            </div>
        </div>
        <!-- <form action="#" class="dropzone dz-clickable" id="demo-upload">
            <div class="dz-default dz-message"><span>拖动文件到此处上传</span>
            </div>
        </form> -->
        <div class="bg-white p-30">
            @if($datas->first())
            <div class="clearfix mosaicflow">
                @foreach ($datas as $data)
                <div class="mosaicflow__item m-r-10 m-b-10" data-path-hover="m 180,34.57627 -180,0 L 0,0 180,0 z" style="cursor:pointer">
                    @if($data->thumbnails)
                    <img src="{{ route('home') }}/uploads/travel_small_thumbnails/{{ $data->thumbnails }}" alt="{{ $data->title }}" title="{{ $data->title }}">
                    @else
                    {{ HTML::image('images/thumbnails/mytravel.jpg', '', array('class' => 'retina')); }}
                    @endif
                    <svg viewBox="0 0 180 320" preserveAspectRatio="none">
                        <path d="M180,160C180,160,0,218,0,218C0,218,0,0,0,0C0,0,180,0,180,0C180,0,180,160,180,160"></path>
                        <defs></defs>
                    </svg>
                    <figcaption>
                        <h3 class="text-uppercase font-w-100">{{ $data->title }}</h3>
                        <p class="text-small text-uppercase">发布于{{ $data->friendly_created_at }}</p>
                    </figcaption>
                    <div class="item__buttons">
                        <button class="btn btn-bordered btn-block text-uppercase text-bold"><a href="javascript:void(0)" onclick="modal('{{ route($resource.'.destroy', $data->id) }}')" style="color: #fff; text-decoration: none;">删除</a></button>
                        <button class="btn btn-bordered btn-block text-uppercase text-bold">
                            <a href="{{ route($resource.'.edit', $data->id) }}" style="color: #fff; text-decoration: none;">编辑<a>
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <center class="p-b-30">
                还没有文章，快去分享一段关于旅行的故事吧。
            </center>
            @endif
        </div>
    </div>
    {{-- /main content --}}
    <?php
    $modalData['modal'] = array(
        'id'      => 'myModal',
        'title'   => '系统提示',
        'message' => '确认删除此'.$resourceName.'？',
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
    <style>
        .modal-content {
            color:#000;
        }
    </style>
</body>

</html>