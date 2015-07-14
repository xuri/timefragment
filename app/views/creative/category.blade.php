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

    {{-- Blog Section --}}
    <section class="section-content blog-content">
        <div class="container">

            {{-- Section Title --}}
            <div class="section-title text-center">
                <div>
                    <span class="line big"></span>
                    <span><a href="{{ route('home') }}">时光碎片</a></span>
                    <span class="line big"></span>
                </div>
                <h1>{{ $current_category->name }}</h1>
                <div>
                    <span class="line"></span>
                    <span>创意汇</span>
                    <span class="line"></span>
                </div>
                <p class="lead">
                    <a href="{{ route('mycreative.create') }}"><i class="fa fa-lightbulb-o"></i> 分享创意</a>，在这里秀出你的创意，创意改变生活，汇聚智慧与灵感。
                </p>
            </div>
            {{-- Section Title --}}
        </div>

        <br />
        <br />

        <div id="portfolio-wrap">

            @foreach($creative as $single_creative)

            {{-- portfolio item --}}
            <div class="portfolio-item {{ $single_creative->category->name }} web">
                <div class="portfolio">
                    <a href="{{ route('creative.show', $single_creative->slug) }}" class="zoom">
                        @if($single_creative->thumbnails)
                        <img src="{{ route('home') }}/uploads/creative_thumbnails/{{ $single_creative->thumbnails }}" alt="{{ $single_creative->title }}" title="{{ $single_creative->title }}">
                        @else
                        <img src="{{ route('home') }}/images/thumbnails/creative.jpg" alt="{{ $single_creative->title }}" title="{{ $single_creative->title }}">
                        @endif
                        <div class="hover-items">
                            <span>
                                @if($single_creative->user->nickname)
                                    <i class="fa fa-bars fa-4x"></i> <em class="lead">{{ $single_creative->title }}</em> <em>作者：{{ $single_creative->user->nickname }}</em>
                                @else
                                    <i class="fa fa-bars fa-4x"></i> <em class="lead">{{ $single_creative->title }}</em> <em>创意分类：{{ $single_creative->category->name }}</em>
                                @endif
                            </span>
                        </div>
                    </a>
                </div>
            </div>
            {{-- portfolio item --}}
            @endforeach
        </div>

        {{-- Ajax Portfolio content --}}
        <div id="ajax-section">
            <div class="container clearfix">
                <div id="project-navigation" class="text-center">
                    <ul>
                        <li id="prevProject">
                            <a href="#"><i class="fa fa-chevron-circle-left fa-2x"></i></a>
                        </li>
                        <li id="closeProject">
                            <a href="#loader"><i class="fa fa-times-circle fa-2x"></i></a>
                        </li>
                        <li id="nextProject">
                            <a href="#"><i class="fa fa-chevron-circle-right fa-2x"></i></a>
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
                {{ pagination($creative->appends(Input::except('page')), 'layout.home-paginator') }}
            </div>
        </div>

        <div class="clear"></div>
        {{-- Ajax content --}}
</section>
{{-- Blog Section --}}

{{-- Parallax Container --}}
@include('layout.footer')
@yield('content')