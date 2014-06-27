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
								我的创意汇
						</span>

                    </div>


                    <input type="text" class="input-light input-large brad valign-top m-r-10 m-l-10 search-box" placeholder="搜索...">

                    <div class="pull-right m-r-30 mail-nav">

                        <span class="text-gray">
								1-20 总共 1248
							</span>

                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-no-bg text-gray">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </label>
                            <label class="btn btn-no-bg text-gray">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                            </label>
                        </div>
                    </div>

                    <hr>


                    <div class="p-lr-30 p-tb-10 pm-lr-10">
                        <a href="" class="btn btn-bordered text-gray-alt">
                            分享新{{ $resourceName }}
                        </a>
                    </div>

                    <div class="table-responsive p-lr-30 p-tb-10 pm-lr-10">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>标题 <a href="http://localhost/~luxurioust/laravel-4.1-simple-blog/public/admin/articles?sort_up=title" class="glyphicon glyphicon-random"></a></th>
                                    <th>评论数 <a href="http://localhost/~luxurioust/laravel-4.1-simple-blog/public/admin/articles?sort_up=comments_count" class="glyphicon glyphicon-random"></a></th>
                                    <th>创建时间 <a href="http://localhost/~luxurioust/laravel-4.1-simple-blog/public/admin/articles?sort_up=created_at" class="glyphicon glyphicon-chevron-down"></a></th>
                                    <th style="width:7em;text-align:center;">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                                <tr>
                                    <td>
                                        <a href="http://localhost/~luxurioust/laravel-4.1-simple-blog/public/psr-0" target="_blank">
                                            <i class="glyphicon glyphicon-share" style="font-size:0.5em;"></i>
                                        </a>
                                        PSR-0 自动加载规范                    </td>
                                    <td>1</td>
                                    <td>2014-05-21 09:41:08（2周前）</td>
                                    <td>
                                        <a href="http://localhost/~luxurioust/laravel-4.1-simple-blog/public/admin/articles/60/edit" class="btn btn-xs">编辑</a>
                                        <a href="javascript:void(0)" class="btn btn-xs btn-danger"
                                             onclick="modal('http://localhost/~luxurioust/laravel-4.1-simple-blog/public/admin/articles/60')">删除</a>
                                    </td>
                                </tr>
                                                <tr>
                                    <td>
                                        <a href="http://localhost/~luxurioust/laravel-4.1-simple-blog/public/psr-1-basic-coding-standard" target="_blank">
                                            <i class="glyphicon glyphicon-share" style="font-size:0.5em;"></i>
                                        </a>
                                        PSR-1 基础编码规范                    </td>
                                    <td>0</td>
                                    <td>2014-05-21 09:41:08（2周前）</td>
                                    <td>
                                        <a href="http://localhost/~luxurioust/laravel-4.1-simple-blog/public/admin/articles/61/edit" class="btn btn-xs">编辑</a>
                                        <a href="javascript:void(0)" class="btn btn-xs btn-danger"
                                             onclick="modal('http://localhost/~luxurioust/laravel-4.1-simple-blog/public/admin/articles/61')">删除</a>
                                    </td>
                                </tr>
                                                <tr>
                                    <td>
                                        <a href="http://localhost/~luxurioust/laravel-4.1-simple-blog/public/psr-2-coding-style-guide" target="_blank">
                                            <i class="glyphicon glyphicon-share" style="font-size:0.5em;"></i>
                                        </a>
                                        PSR-2 编码风格规范                    </td>
                                    <td>0</td>
                                    <td>2014-05-21 09:41:08（2周前）</td>
                                    <td>
                                        <a href="http://localhost/~luxurioust/laravel-4.1-simple-blog/public/admin/articles/62/edit" class="btn btn-xs">编辑</a>
                                        <a href="javascript:void(0)" class="btn btn-xs btn-danger"
                                             onclick="modal('http://localhost/~luxurioust/laravel-4.1-simple-blog/public/admin/articles/62')">删除</a>
                                    </td>
                                </tr>
                                                <tr>
                                    <td>
                                        <a href="http://localhost/~luxurioust/laravel-4.1-simple-blog/public/psr-3-logger-interface" target="_blank">
                                            <i class="glyphicon glyphicon-share" style="font-size:0.5em;"></i>
                                        </a>
                                        PSR-3 日志接口规范                    </td>
                                    <td>0</td>
                                    <td>2014-05-21 09:41:08（2周前）</td>
                                    <td>
                                        <a href="http://localhost/~luxurioust/laravel-4.1-simple-blog/public/admin/articles/63/edit" class="btn btn-xs">编辑</a>
                                        <a href="javascript:void(0)" class="btn btn-xs btn-danger"
                                             onclick="modal('http://localhost/~luxurioust/laravel-4.1-simple-blog/public/admin/articles/63')">删除</a>
                                    </td>
                                </tr>
                                                <tr>
                                    <td>
                                        <a href="http://localhost/~luxurioust/laravel-4.1-simple-blog/public/slug-biao-ti-1" target="_blank">
                                            <i class="glyphicon glyphicon-share" style="font-size:0.5em;"></i>
                                        </a>
                                        标题1                    </td>
                                    <td>5</td>
                                    <td>2014-05-21 09:41:07（2周前）</td>
                                    <td>
                                        <a href="http://localhost/~luxurioust/laravel-4.1-simple-blog/public/admin/articles/1/edit" class="btn btn-xs">编辑</a>
                                        <a href="javascript:void(0)" class="btn btn-xs btn-danger"
                                             onclick="modal('http://localhost/~luxurioust/laravel-4.1-simple-blog/public/admin/articles/1')">删除</a>
                                    </td>
                                </tr>
                                                <tr>
                                    <td>
                                        <a href="http://localhost/~luxurioust/laravel-4.1-simple-blog/public/slug-biao-ti-2" target="_blank">
                                            <i class="glyphicon glyphicon-share" style="font-size:0.5em;"></i>
                                        </a>
                                        标题2                    </td>
                                    <td>6</td>
                                    <td>2014-05-21 09:41:07（2周前）</td>
                                    <td>
                                        <a href="http://localhost/~luxurioust/laravel-4.1-simple-blog/public/admin/articles/2/edit" class="btn btn-xs">编辑</a>
                                        <a href="javascript:void(0)" class="btn btn-xs btn-danger"
                                             onclick="modal('http://localhost/~luxurioust/laravel-4.1-simple-blog/public/admin/articles/2')">删除</a>
                                    </td>
                                </tr>
                                                <tr>
                                    <td>
                                        <a href="http://localhost/~luxurioust/laravel-4.1-simple-blog/public/slug-biao-ti-3" target="_blank">
                                            <i class="glyphicon glyphicon-share" style="font-size:0.5em;"></i>
                                        </a>
                                        标题3                    </td>
                                    <td>6</td>
                                    <td>2014-05-21 09:41:07（2周前）</td>
                                    <td>
                                        <a href="http://localhost/~luxurioust/laravel-4.1-simple-blog/public/admin/articles/3/edit" class="btn btn-xs">编辑</a>
                                        <a href="javascript:void(0)" class="btn btn-xs btn-danger"
                                             onclick="modal('http://localhost/~luxurioust/laravel-4.1-simple-blog/public/admin/articles/3')">删除</a>
                                    </td>
                                </tr>
                                                <tr>
                                    <td>
                                        <a href="http://localhost/~luxurioust/laravel-4.1-simple-blog/public/slug-biao-ti-4" target="_blank">
                                            <i class="glyphicon glyphicon-share" style="font-size:0.5em;"></i>
                                        </a>
                                        标题4                    </td>
                                    <td>6</td>
                                    <td>2014-05-21 09:41:07（2周前）</td>
                                    <td>
                                        <a href="http://localhost/~luxurioust/laravel-4.1-simple-blog/public/admin/articles/4/edit" class="btn btn-xs">编辑</a>
                                        <a href="javascript:void(0)" class="btn btn-xs btn-danger"
                                             onclick="modal('http://localhost/~luxurioust/laravel-4.1-simple-blog/public/admin/articles/4')">删除</a>
                                    </td>
                                </tr>
                                                <tr>
                                    <td>
                                        <a href="http://localhost/~luxurioust/laravel-4.1-simple-blog/public/slug-biao-ti-5" target="_blank">
                                            <i class="glyphicon glyphicon-share" style="font-size:0.5em;"></i>
                                        </a>
                                        标题5                    </td>
                                    <td>6</td>
                                    <td>2014-05-21 09:41:07（2周前）</td>
                                    <td>
                                        <a href="http://localhost/~luxurioust/laravel-4.1-simple-blog/public/admin/articles/5/edit" class="btn btn-xs">编辑</a>
                                        <a href="javascript:void(0)" class="btn btn-xs btn-danger"
                                             onclick="modal('http://localhost/~luxurioust/laravel-4.1-simple-blog/public/admin/articles/5')">删除</a>
                                    </td>
                                </tr>
                                                <tr>
                                    <td>
                                        <a href="http://localhost/~luxurioust/laravel-4.1-simple-blog/public/slug-biao-ti-6" target="_blank">
                                            <i class="glyphicon glyphicon-share" style="font-size:0.5em;"></i>
                                        </a>
                                        标题6                    </td>
                                    <td>0</td>
                                    <td>2014-05-21 09:41:07（2周前）</td>
                                    <td>
                                        <a href="http://localhost/~luxurioust/laravel-4.1-simple-blog/public/admin/articles/6/edit" class="btn btn-xs">编辑</a>
                                        <a href="javascript:void(0)" class="btn btn-xs btn-danger"
                                             onclick="modal('http://localhost/~luxurioust/laravel-4.1-simple-blog/public/admin/articles/6')">删除</a>
                                    </td>
                                </tr>
                                                <tr>
                                    <td>
                                        <a href="http://localhost/~luxurioust/laravel-4.1-simple-blog/public/slug-biao-ti-7" target="_blank">
                                            <i class="glyphicon glyphicon-share" style="font-size:0.5em;"></i>
                                        </a>
                                        标题7                    </td>
                                    <td>0</td>
                                    <td>2014-05-21 09:41:07（2周前）</td>
                                    <td>
                                        <a href="http://localhost/~luxurioust/laravel-4.1-simple-blog/public/admin/articles/7/edit" class="btn btn-xs">编辑</a>
                                        <a href="javascript:void(0)" class="btn btn-xs btn-danger"
                                             onclick="modal('http://localhost/~luxurioust/laravel-4.1-simple-blog/public/admin/articles/7')">删除</a>
                                    </td>
                                </tr>
                                                <tr>
                                    <td>
                                        <a href="http://localhost/~luxurioust/laravel-4.1-simple-blog/public/slug-biao-ti-8" target="_blank">
                                            <i class="glyphicon glyphicon-share" style="font-size:0.5em;"></i>
                                        </a>
                                        标题8                    </td>
                                    <td>0</td>
                                    <td>2014-05-21 09:41:07（2周前）</td>
                                    <td>
                                        <a href="http://localhost/~luxurioust/laravel-4.1-simple-blog/public/admin/articles/8/edit" class="btn btn-xs">编辑</a>
                                        <a href="javascript:void(0)" class="btn btn-xs btn-danger"
                                             onclick="modal('http://localhost/~luxurioust/laravel-4.1-simple-blog/public/admin/articles/8')">删除</a>
                                    </td>
                                </tr>
                                                <tr>
                                    <td>
                                        <a href="http://localhost/~luxurioust/laravel-4.1-simple-blog/public/slug-biao-ti-9" target="_blank">
                                            <i class="glyphicon glyphicon-share" style="font-size:0.5em;"></i>
                                        </a>
                                        标题9                    </td>
                                    <td>0</td>
                                    <td>2014-05-21 09:41:07（2周前）</td>
                                    <td>
                                        <a href="http://localhost/~luxurioust/laravel-4.1-simple-blog/public/admin/articles/9/edit" class="btn btn-xs">编辑</a>
                                        <a href="javascript:void(0)" class="btn btn-xs btn-danger"
                                             onclick="modal('http://localhost/~luxurioust/laravel-4.1-simple-blog/public/admin/articles/9')">删除</a>
                                    </td>
                                </tr>
                                                <tr>
                                    <td>
                                        <a href="http://localhost/~luxurioust/laravel-4.1-simple-blog/public/slug-biao-ti-10" target="_blank">
                                            <i class="glyphicon glyphicon-share" style="font-size:0.5em;"></i>
                                        </a>
                                        标题10                    </td>
                                    <td>0</td>
                                    <td>2014-05-21 09:41:07（2周前）</td>
                                    <td>
                                        <a href="http://localhost/~luxurioust/laravel-4.1-simple-blog/public/admin/articles/10/edit" class="btn btn-xs">编辑</a>
                                        <a href="javascript:void(0)" class="btn btn-xs btn-danger"
                                             onclick="modal('http://localhost/~luxurioust/laravel-4.1-simple-blog/public/admin/articles/10')">删除</a>
                                    </td>
                                </tr>
                                                <tr>
                                    <td>
                                        <a href="http://localhost/~luxurioust/laravel-4.1-simple-blog/public/slug-biao-ti-11" target="_blank">
                                            <i class="glyphicon glyphicon-share" style="font-size:0.5em;"></i>
                                        </a>
                                        标题11                    </td>
                                    <td>0</td>
                                    <td>2014-05-21 09:41:07（2周前）</td>
                                    <td>
                                        <a href="http://localhost/~luxurioust/laravel-4.1-simple-blog/public/admin/articles/11/edit" class="btn btn-xs">编辑</a>
                                        <a href="javascript:void(0)" class="btn btn-xs btn-danger"
                                             onclick="modal('http://localhost/~luxurioust/laravel-4.1-simple-blog/public/admin/articles/11')">删除</a>
                                    </td>
                                </tr>
                                            </tbody>
                        </table>
                    </div>

                    <div class="btn-group m-l-30">
                        Pagenation
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
</body>

</html>