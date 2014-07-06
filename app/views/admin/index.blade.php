@include('layout.account-header')
@yield('content')
<body id="dashboard-page" class="bg-gray-light">
    @include('layout.admin-navigation')
    @yield('content')

    @include('layout.admin-sidebar')
    @yield('content')
    <div class="preloader">
        <div class="timer"></div>
    </div>

    <div id="container" class="main-content p-30 tp-t-60 tp-lr-10">

        <button class="menu-btn btn btn-bordered text-gray-alt text-bold top-left-corner">&#9776; 菜单</button>
        {{-- Dashboard Tab --}}
        <div class="bg-white b-1px-gray-light b-top-none brad-bottom brad-tr b-bot-2px-gray-light">

            <div class="tab-content">

                <div class="tab-pane active fade in p-30" id="dashboard">

                    <h1 class="text-center font-w-100">欢迎回来 <span class="text-blue">管理员</span></h1>
                    <div class="row">
                        <p class="m-b-30 p-b-30 text-gray-alt text-uppercase text-center col-lg-8 col-lg-offset-2">这里是网站系统的管理员控制面板，负责整个系统的资源管理。</p>
                    </div>

                    <div class="row">

                        <div class="col-sm-6 m-b-30">

                            <div class="pos-rel">
                                <div class="iconmelon m-r-10">
                                    <svg viewBox="0 0 32 32">
                                        <g filter="">
                                            <use xlink:href="#receipt-shopping"></use>
                                        </g>
                                    </svg>
                                </div>

                                <span class="text-gray-dark text-large align-with-button pos-abs hidden-xs">
                                        新增注册用户
                                    </span>
                                <span class="hidden-sm hidden-md hidden-lg text-gray-dark text-large align-with-button pos-abs ">
                                        新增注册用户
                                    </span>


                                <div class="btn-group pull-right">
                                    <button class="btn btn-primary">
                                        <i class="glyphicon glyphicon-list text-white"></i>
                                    </button>
                                </div>
                            </div>

                            <hr class="m-b-0">


                            <div id="tasks-list" class="tasks-wrapper">
                                <ul class="unstyled messages">

                                    <li>
                                        <a href="index.html#" class="p-tb-10 pm-lr-10 p-l-10">
                                            <span class="avatar">
                                                {{ HTML::image('images/avatars/8.jpg', '', array('class' => 'img-circle retina')); }}
                                            </span>
                                            <span class="author hidden-xs">Victor Benson</span>
                                            <span class="subject">
                                                <i class="glyphicon glyphicon-star m-r-10 text-gray-light"></i>
                                                And I was getting a tattoo during the death from above.
                                            </span>
                                            <span class="date"><span class="text-gray-dark">2</span> days ago</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="index.html#" class="p-tb-10 pm-lr-10 p-l-10">
                                            <span class="avatar">
                                                {{ HTML::image('images/avatars/8.jpg', '', array('class' => 'img-circle retina')); }}
                                            </span>
                                            <span class="author hidden-xs">Victor Benson</span>
                                            <span class="subject">
                                                <i class="glyphicon glyphicon-star m-r-10 text-gray-light"></i>
                                                And I was getting a tattoo during the death from above.
                                            </span>
                                            <span class="date"><span class="text-gray-dark">2</span> days ago</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="index.html#" class="p-tb-10 pm-lr-10 p-l-10">
                                            <span class="avatar">
                                                {{ HTML::image('images/avatars/8.jpg', '', array('class' => 'img-circle retina')); }}
                                            </span>
                                            <span class="author hidden-xs">Victor Benson</span>
                                            <span class="subject">
                                                <i class="glyphicon glyphicon-star m-r-10 text-gray-light"></i>
                                                And I was getting a tattoo during the death from above.
                                            </span>
                                            <span class="date"><span class="text-gray-dark">2</span> days ago</span>
                                        </a>
                                    </li>


                                    <li>
                                        <a href="index.html#" class="p-tb-10 pm-lr-10 p-l-10">
                                            <span class="avatar">
                                                {{ HTML::image('images/avatars/8.jpg', '', array('class' => 'img-circle retina')); }}
                                            </span>
                                            <span class="author hidden-xs">Victor Benson</span>
                                            <span class="subject">
                                                <i class="glyphicon glyphicon-star m-r-10 text-gray-light"></i>
                                                And I was getting a tattoo during the death from above.
                                            </span>
                                            <span class="date"><span class="text-gray-dark">2</span> days ago</span>
                                        </a>
                                    </li>
                                </ul>

                            </div>

                        </div>

                        <div class="col-sm-6">
                            {{-- Social Stream --}}
                            <div class="iconmelon m-r-10">
                                <svg viewBox="0 0 32 32">
                                    <g filter="">
                                        <use xlink:href="#bubble-love-talk"></use>
                                    </g>
                                </svg>
                            </div>

                            <span class="text-gray-dark text-large align-with-button pos-abs hidden-xs">
                                    待处理信息
                                </span>
                            <span class="hidden-sm hidden-md hidden-lg text-gray-dark text-large align-with-button ">
                                    待处理信息
                                </span>

                            <div class="btn-group pull-right">
                                <button class="btn btn-primary">
                                    <i class="glyphicon glyphicon-list text-white"></i>
                                </button>
                            </div>

                            <hr class="m-b-0">

                            <ul class="unstyled messages">
                                <li>
                                    <a href="message-single.html" class="p-tb-10 p-l-10 pm-lr-10">
                                        <span class="avatar">
                                                {{ HTML::image('images/avatars/4.jpg', '', array('class' => 'img-circle retina')); }}
                                            </span>
                                        <span class="author hidden-xs m-r-1">Eddie Mcgee</span>
                                        <span class="subject">
                                                <i class="glyphicon glyphicon-star m-r-10 text-orange"></i>
                                                This product is meant for educational purposes only. Any resemblance to real persons, living or dead is purely coincidental.
                                            </span>
                                        <span class="date"><span class="text-gray-dark">23</span> minutes ago</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="index.html#" class="p-tb-10 pm-lr-10 p-l-10">
                                        <span class="avatar">
                                                {{ HTML::image('images/avatars/6.jpg', '', array('class' => 'img-circle retina')); }}
                                            </span>
                                        <span class="author hidden-xs">Timmy Osborne</span>
                                        <span class="subject">
                                                <i class="glyphicon glyphicon-star m-r-10 text-gray-light"></i>
                                                Own yo' eget tortizzle. Sizzle erizzle.
                                            </span>
                                        <span class="date">Today <span class="text-gray-dark">1:05pm</span></span>
                                    </a>
                                </li>

                                <li>
                                    <a href="index.html#" class="p-tb-10 pm-lr-10 p-l-10">
                                        <span class="avatar">
                                                {{ HTML::image('images/avatars/7.jpg', '', array('class' => 'img-circle retina')); }}
                                            </span>
                                        <span class="author hidden-xs">Doug Ross</span>
                                        <span class="subject">
                                                <i class="glyphicon glyphicon-star m-r-10 text-gray-light"></i>
                                                Children of the sun, see your time has just begun, searching for your ways, through adventures every day.
                                            </span>
                                        <span class="date">Yesterday <span class="text-gray-dark">2:23pm</span></span>
                                    </a>
                                </li>

                                <li>
                                    <a href="index.html#" class="p-tb-10 pm-lr-10 p-l-10">
                                        <span class="avatar">
                                                {{ HTML::image('images/avatars/8.jpg', '', array('width' => '25', 'class' => 'img-circle retina')); }}
                                            </span>
                                        <span class="author hidden-xs">Victor Benson</span>
                                        <span class="subject">
                                                <i class="glyphicon glyphicon-star m-r-10 text-gray-light"></i>
                                                And I was getting a tattoo during the death from above.
                                            </span>
                                        <span class="date"><span class="text-gray-dark">2</span> days ago</span>
                                    </a>
                                </li>

                            </ul>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-sm-5">
                            {{-- Events Calendar --}}
                            <div class="iconmelon m-r-10">
                                <svg viewBox="0 0 32 32">
                                    <g filter="">
                                        <use xlink:href="#clock-time"></use>
                                    </g>
                                </svg>
                            </div>

                            <span class="text-gray-dark text-large align-with-button hidden-xs">
                                    网站运行状态
                                </span>
                            <span class="hidden-lg hidden-md hidden-sm text-gray-dark text-large align-with-button">
                                    网站运行状态
                                </span>

                            <div class="btn-group pull-right">
                                <div class="btn btn-alt">
                                    <i class="glyphicon glyphicon-plus text-white"></i>
                                </div>
                                <div class="btn btn-primary">
                                    Add
                                </div>
                            </div>

                            <hr>

                            <!-- <div class="cal1" id="events-calendar"></div> -->
                        </div>



                    </div>
                </div>

                {{-- Statistics Tab --}}
                <div class="tab-pane fade p-30" id="statistics">

                    <div class="row m-b-30">
                        <div class="col-sm-4">
                            <h1 class="font-w-100"><span class="text-blue">12</span> new followers</h1>
                        </div>
                        <div class="col-sm-8 m-t-30">

                            <div class="row">
                                <div class="col-sm-4 text-center">
                                    <span class="twitter-sparkline">Loading..</span>
                                    <div class="text-uppercase text-small text-gray-alt m-t-10">TWITTER</div>
                                </div>

                                <div class="col-sm-4 text-center">
                                    <span class="facebook-sparkline">Loading..</span>
                                    <div class="text-uppercase text-small text-gray-alt m-t-10">FACEBOOK</div>
                                </div>

                                <div class="col-sm-4 text-center">
                                    <span class="google-sparkline">Loading..</span>
                                    <div class="text-uppercase text-small text-gray-alt m-t-10">GOOGLE+</div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <hr class="m-b-30">

                    {{-- Visiotrs Chart --}}
                    <div class="iconmelon m-r-10">
                        <svg viewBox="0 0 32 32">
                            <g filter="">
                                <use xlink:href="#man-people-user"></use>
                            </g>
                        </svg>
                    </div>

                    <span class="text-gray-dark text-large align-with-button pos-abs">
                            Visitors
                        </span>

                    <div class="btn-group pull-right" data-toggle="buttons">
                        <label class="btn btn-primary active">
                            <input type="radio" name="visitors" id="option1">Week
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" name="visitors" id="option2">Month
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" name="visitors" id="option3">Year
                        </label>
                    </div>

                    <div id="visitors-chart" style="height: 315px;" class="m-b-30"></div>

                    <hr>

                    <div class="row">
                        <div class="col-sm-7">
                            <div class="iconmelon m-r-10">
                                <svg viewBox="0 0 32 32">
                                    <g filter="">
                                        <use xlink:href="#earth-globe"></use>
                                    </g>
                                </svg>
                            </div>

                            <span class="text-gray-dark text-large align-with-button pos-abs">
                                    Source
                                </span>

                            <div id="source-chart" class="m-b-30" style="height: 320px;"></div>
                        </div>

                        <div class="col-sm-5">

                            <div class="iconmelon m-r-10">
                                <svg viewBox="0 0 32 32">
                                    <g filter="">
                                        <use xlink:href="#macintosh"></use>
                                    </g>
                                </svg>
                            </div>

                            <span class="text-gray-dark text-large align-with-button pos-abs">
                                    Devices
                                </span>

                            <div id="device-chart" class="m-tb-30" style="height: 300px;"></div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>
    {{-- /main content --}}
</body>

</html>