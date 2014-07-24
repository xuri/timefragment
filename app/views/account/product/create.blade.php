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
								发布{{ $resourceName }}
						</span>

                    </div>


                    <div class="pull-right m-r-30 mail-nav">

                        <a href="{{ route($resource.'.index') }}" class="btn btn-bordered text-gray-alt">
                            返回{{ $resourceName }}列表
                        </a>

                    </div>

                    <div class="p-lr-30 p-tb-10 pm-lr-10">
                        @include('layout.notification')
                    </div>

                    <div class="p-lr-30 p-tb-10 pm-lr-10">

                        <form class="form-horizontal" method="post" action="{{ route($resource.'.store') }}" autocomplete="off" name="form">
                            {{-- CSRF Token --}}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                            {{-- Tabs Content --}}
                            <div class="tab-content">

                                {{-- General tab --}}
                                <div class="tab-pane active" id="tab-general" style="margin:0 1em;">

                                    <div class="form-group">
                                        <label for="category">{{ $resourceName }}分类</label>
                                        {{ $errors->first('category', '<span style="color:#c7254e;margin:0 1em;">:message</span>') }}
                                        {{ Form::select('category', $categoryLists, 1, array('class' => 'form-control input-sm selectpicker input-light brad')) }}
                                    </div>

                                    <div class="form-group">
                                        <label for="location">所在地</label>
                                        {{ $errors->first('province', '<span style="color:#c7254e;margin:0 1em;">:message</span>') }}
                                        <div>
                                            <select id="province" class="input-light brad" data-live-search="false" name="province" onchange="setcity();" rel="">
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
                                                <select name="city" id="city" class="input-light brad" rel="" style="width: 140px">
                                                    <option value="">----请选择城市----</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="title">{{ $resourceName }}标题</label>
                                        {{ $errors->first('title', '<span style="color:#c7254e;margin:0 1em;">:message</span>') }}
                                        <input class="form-control" type="text" name="title" id="title" value="{{ Input::old('title') }}" />
                                    </div>

                                    <div class="form-group">
                                        <label for="content">内容</label>
                                        {{ $errors->first('content', '<span style="color:#c7254e;margin:0 1em;">:message</span>') }}
                                        <textarea rows="10" id="content" class="ckeditor form-control" name="content" rows="10">{{ Input::old('content') }}</textarea>
                                    </div>

                                </div>

                            </div>

                            {{-- Form Actions --}}
                            <div class="control-group p-b-30">
                                <div class="controls">
                                    <button type="reset" class="btn btn-bordered text-gray-alt">清 空</button>
                                    <button type="submit" class="btn btn-success">提 交</button>
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

    <?php
    $modalData['modal'] = array(
        'id'      => 'myModal',
        'title'   => '系统提示',
        'message' => '确认删除此图片？',
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
    </script>
</body>

</html>