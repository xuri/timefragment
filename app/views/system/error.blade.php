@include('layout.header')
@yield('content')
    <meta content="15; {{ route('home') }}" http-equiv="refresh">
    <body data-spy="scroll" data-target=".navbar" data-offset="75">

        {{-- Intro loader --}}
        <div class="mask">
            <div id="intro-loader"></div>
        </div>
        {{-- Intro loader --}}


        {{-- Home Section --}}
        <section id="home" class="intro-pattern">
            <div class="text-home">
                <div class="intro-item">
                    <div class="section-title text-center">
                        <h1>500<i>服务器内部错误</i></h1>
                        <p class="lead">
                            很遗憾，服务器内部出现错误，请稍后访问。
                        </p>
                    </div>
                    <div class="mybutton ultra">
                        <a class="start-button" href="{{ route('home') }}"> <span data-hover="时光碎片">回到首页</span> </a>
                    </div>
                </div>
            </div>
        </section>
        <br />
        <br />
        {{-- Home Section --}}


        @include('layout.footer')
        @yield('content')