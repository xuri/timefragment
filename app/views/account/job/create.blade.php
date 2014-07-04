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

                        <form class="form-horizontal" method="post" action="{{ route($resource.'.store') }}" autocomplete="off">
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
                                        {{ $errors->first('location', '<span style="color:#c7254e;margin:0 1em;">:message</span>') }}
                                        <select id="location" class="form-control input-sm selectpicker input-light brad" data-live-search="false" name="location" rel="">
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