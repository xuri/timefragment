@include('layout.account-header')
@yield('content')
<body class="bg-gray-light">
    @include('layout.admin-navigation')
    @yield('content')

    @include('layout.admin-sidebar')
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
                            {{ $resourceName }}管理
                        </span>

                    </div>

                    <a href="" class="btn btn-circle btn-bordered m-r-10 m-l-30 mm-l-10">
                        <span class="glyphicon glyphicon-remove"></span>
                    </a>

                    <a href="" class="btn btn-circle btn-bordered m-r-10">
                        <span class="glyphicon glyphicon-refresh"></span>
                    </a>

                    <a href="" class="btn btn-circle btn-bordered m-r-10">
                        <span class="glyphicon glyphicon-share-alt"></span>
                    </a>

                    <a href="" class="btn btn-circle btn-bordered m-r-10">
                        <span class="glyphicon glyphicon-star"></span>
                    </a>

                    <div class="pull-right m-r-30 mail-nav">
                        <a href="{{ route($resource.'.create') }}" class="btn btn-bordered text-gray-alt">
                            添加{{ $resourceName }}
                        </a>
                    </div>

                    <div class="p-lr-30 p-tb-10 pm-lr-10">
                        @include('layout.notification')
                    </div>

                    <div class="m-30 mail-nav">
                        {{ Form::open(array('method' => 'get', 'class' => 'form-horizontal')) }}
                            {{
                                Form::select(
                                    'status',
                                    array('all' => '所有', '1' => '管理员', '0' => '普通用户'),
                                    Input::get('status', 'all'),
                                    array('class' => 'form-control input-sm selectpicker input-light brad', 'data-width' => '20%')
                                )
                            }}
                            {{
                                Form::select(
                                    'target',
                                    array('email' => '邮箱'),
                                    Input::get('target', 'email'),
                                    array('class' => 'form-control input-sm selectpicker input-light brad', 'data-width' => '20%')
                                )
                            }}
                            <input type="text" style="margin:0" class="input-light input-large brad valign-top search-box" placeholder="请输入搜索条件..." name="like" value="{{ Input::get('like') }}">
                            <button class="btn btn-primary" style="margin: 0px;" type="submit">搜索</button>
                        {{ Form::close() }}
                    </div>

                    <div class="table-responsive p-lr-30 p-tb-10 pm-lr-10">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>身份 {{ order_by('is_admin') }}</th>
                                    <th>邮箱 {{ order_by('email') }}</th>
                                    <th>注册时间 {{ order_by('created_at', 'desc') }}</th>
                                    <th>最后登录时间 {{ order_by('signin_at') }}</th>
                                    <th style="width:7em;text-align:center;">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $currentId = Auth::user()->id; ?>
                                @foreach ($datas as $data)
                                <tr>
                                    <td>{{ $data->is_admin ? '管理员' : '普通用户' }}</td>
                                    <td>
                                        <a href="mailto:{{ $data->email }}" target="_blank">
                                            <i class="glyphicon glyphicon-envelope" style="font-size:0.8em;"></i>
                                        </a>
                                        {{ $data->email }}</td>
                                    <td>{{ $data->created_at }}（{{ $data->friendly_created_at }}）</td>
                                    <td>{{ $data->signin_at }}（{{ $data->friendly_signin_at }}）</td>
                                    <td>
                                        @if($data->id!=$currentId)
                                        <a href="{{ route($resource.'.edit', $data->id) }}" class="btn btn-xs">编辑</a>
                                        <a href="javascript:void(0)" class="btn btn-xs btn-danger"
                                             onclick="modal('{{ route($resource.'.destroy', $data->id) }}')">删除</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="btn-group m-l-30">
                        {{ pagination($datas->appends(Input::except('page')), 'layout.paginator') }}
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /main content -->
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
</body>
</html>