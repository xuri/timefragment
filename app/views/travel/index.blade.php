@include('layout.header')
@yield('content')

    <body data-spy="scroll" data-target=".navbar" data-offset="75">

        {{-- Intro loader --}}
        <div class="mask">
            <div id="intro-loader"></div>
        </div>
        {{-- Intro loader --}}

        @include('layout.navigation')
        @yield('content')

        {{-- About Section --}}
        <section id="about" class="section-content">
            <div class="container">

                {{-- Section title --}}
                <div class="section-title text-center">
                    <div>
                        <span class="line big"></span>
                        <span><a href="{{ route('home') }}">时光碎片</a></span>
                        <span class="line big"></span>
                    </div>
                    <h1 class="item_right">去旅行</h1>
                    <div>
                        <span class="line"></span>
                        <span>旅行的意义</span>
                        <span class="line"></span>
                    </div>
                    <p class="lead">
                        <a href="{{ route('mytravel.create') }}"><i class="fa fa-globe"></i> 选择一个话题</a>，在这里畅谈那些我们去过的和想去的地方，欣赏美丽的海岸，清新的海风……
                    </p>
                </div>
                {{-- Section title --}}

                <div class="row">
                    <!-- <div class="col-md-12">
                        <div class="element-line">
                            <div class="item_left">
                                <img src="images/devices.jpg" class="img-responsive img-center" alt="">
                            </div>
                        </div>
                    </div>
                    -->
                    @foreach($categories as $category)
                    {{-- Item Media --}}
                    <div class="col-md-6">
                        <div class="element-line">
                            <div class="item_left">
                                <div class="media">

                                    @if($category->thumbnails)
                                    <a class="pull-left rotate" href="{{ route('travel.category', $category->id) }}"> <img class="media-object img-circle" src="{{ route('home') }}/uploads/travel_category_thumbnails/{{ $category->thumbnails }}" alt="{{ $category->name }}" style="width:105px; height:105;"> </a>
                                    @else
                                    <a class="pull-left rotate" href="{{ route('travel.category', $category->id) }}"> <i class="hi-icon fa fa-rocket fa-4x media-object img-circle" style="background:#0098f9; margin:0;"></i>
                                        </a>
                                    @endif
                                    <div class="media-body">
                                        <a href="{{ route('travel.category', $category->id) }}">
                                            <h3 class="media-heading">{{ $category->name }}</h3>
                                        </a>
                                        <p>
                                            {{ $category->content }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Item Media --}}
                    @endforeach

                </div>
            </div>

            {{-- Ajax Portfolio content --}}
            <div id="ajax-section">
                <div class="container clearfix">
                    <div id="project-navigation" class="text-center">
                        <ul>
                            <li id="prevProject">
                                <a href="index.html#"><i class="fa fa-chevron-circle-left fa-2x"></i></a>
                            </li>
                            <li id="closeProject">
                                <a href="index.html#loader"><i class="fa fa-times-circle fa-2x"></i></a>
                            </li>
                            <li id="nextProject">
                                <a href="index.html#"><i class="fa fa-chevron-circle-right fa-2x"></i></a>
                            </li>
                        </ul>
                    </div>

                    {{-- Ajax loader --}}
                    <div id="loader"></div>
                    {{-- Ajax loader --}}

                    <div id="ajax-content-outer">
                        <div id="ajax-content-inner"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="element-line">
                    {{ pagination($categories->appends(Input::except('page')), 'layout.home-paginator') }}
                </div>
            </div>

            <div class="clear"></div>
            {{-- Ajax content --}}

        </section>

        {{-- Parallax Container --}}

        @include('layout.footer')
        @yield('content')