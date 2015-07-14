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
                    <h1>尚品汇</h1>
                    <div>
                        <span class="line"></span>
                        <span>全新的商品交易信息发布平台</span>
                        <span class="line"></span>
                    </div>
                    <p class="lead">
                        <a href="{{ route('myproduct.create') }}"><i class="fa fa-shopping-cart"></i> 发布商品</a>，这里是进行发布商品交易信息的全新平台！
                    </p>
                </div>
                {{-- Section Title --}}
            </div>

                @include('product.gallery')
                @yield('content')
        </section>
        {{-- Blog Section --}}

        {{-- Parallax Container --}}
        @include('layout.footer')
        @yield('content')