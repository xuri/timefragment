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

        <form action="#" class="dropzone dz-clickable" id="demo-upload">
            <div class="dz-default dz-message"><span>拖动文件到此处上传</span>
            </div>
        </form>

        <div class="bg-white p-30 m-t-30">

            <div class="clearfix mosaicflow">
                <a href="gallery.html#" class="mosaicflow__item m-r-10 m-b-10" data-path-hover="m 180,34.57627 -180,0 L 0,0 180,0 z">
                    {{ HTML::image('images/photos/1.jpg', '', array('class' => 'retina')); }}
                    <svg viewBox="0 0 180 320" preserveAspectRatio="none">
                        <path d="M180,160C180,160,0,218,0,218C0,218,0,0,0,0C0,0,180,0,180,0C180,0,180,160,180,160"></path>
                        <defs></defs>
                    </svg>
                    <figcaption>
                        <h3 class="text-uppercase font-w-100">Malesuada Fuscev</h3>
                        <p class="text-small text-uppercase">Uploaded on 01-07-2014</p>
                    </figcaption>
                    <div class="item__buttons">
                        <button class="btn btn-bordered btn-block text-uppercase text-bold">Delete</button>
                        <button class="btn btn-bordered btn-block text-uppercase text-bold">Edit</button>
                    </div>
                </a>
                <a href="gallery.html#" class="mosaicflow__item m-r-10 m-b-10" data-path-hover="m 180,54.57627 -180,0 L 0,0 180,0 z">
                    {{ HTML::image('images/photos/2.jpg', '', array('class' => 'retina')); }}
                    <svg viewBox="0 0 180 320" preserveAspectRatio="none">
                        <path d="M180,160C180,160,0,218,0,218C0,218,0,0,0,0C0,0,180,0,180,0C180,0,180,160,180,160"></path>
                        <defs></defs>
                    </svg>
                    <figcaption>
                        <h3 class="text-uppercase font-w-100">Ullamcorper Consectetur</h3>
                        <p class="text-small text-uppercase">Uploaded on 01-07-2014</p>
                    </figcaption>
                    <div class="item__buttons">
                        <button class="btn btn-bordered btn-block text-uppercase text-bold">Delete</button>
                        <button class="btn btn-bordered btn-block text-uppercase text-bold">Edit</button>
                    </div>
                </a>
                <a href="gallery.html#" class="mosaicflow__item m-r-10 m-b-10" data-path-hover="m 180,64.57627 -180,0 L 0,0 180,0 z">
                    {{ HTML::image('images/photos/3.jpg', '', array('class' => 'retina')); }}
                    <svg viewBox="0 0 180 320" preserveAspectRatio="none">
                        <path d="M180,160C180,160,0,218,0,218C0,218,0,0,0,0C0,0,180,0,180,0C180,0,180,160,180,160"></path>
                        <defs></defs>
                    </svg>
                    <figcaption>
                        <h3 class="text-uppercase font-w-100">Sollicitudin</h3>
                        <p class="text-small text-uppercase">Uploaded on 01-07-2014</p>
                    </figcaption>
                    <div class="item__buttons">
                        <button class="btn btn-bordered btn-block text-uppercase text-bold">Delete</button>
                        <button class="btn btn-bordered btn-block text-uppercase text-bold">Edit</button>
                    </div>
                </a>
                <a href="gallery.html#" class="mosaicflow__item m-r-10 m-b-10" data-path-hover="m 180,34.57627 -180,0 L 0,0 180,0 z">
                    {{ HTML::image('images/photos/4.jpg', '', array('class' => 'retina')); }}
                    <svg viewBox="0 0 180 320" preserveAspectRatio="none">
                        <path d="M180,160C180,160,0,218,0,218C0,218,0,0,0,0C0,0,180,0,180,0C180,0,180,160,180,160"></path>
                        <defs></defs>
                    </svg>
                    <figcaption>
                        <h3 class="text-uppercase font-w-100">Etiam</h3>
                        <p class="text-small text-uppercase">Uploaded on 01-07-2014</p>
                    </figcaption>
                    <div class="item__buttons">
                        <button class="btn btn-bordered btn-block text-uppercase text-bold">Delete</button>
                        <button class="btn btn-bordered btn-block text-uppercase text-bold">Edit</button>
                    </div>
                </a>
                <a href="gallery.html#" class="mosaicflow__item m-r-10 m-b-10" data-path-hover="m 180,64.57627 -180,0 L 0,0 180,0 z">
                    {{ HTML::image('images/photos/5.jpg', '', array('class' => 'retina')); }}
                    <svg viewBox="0 0 180 320" preserveAspectRatio="none">
                        <path d="M180,160C180,160,0,218,0,218C0,218,0,0,0,0C0,0,180,0,180,0C180,0,180,160,180,160"></path>
                        <defs></defs>
                    </svg>
                    <figcaption>
                        <h3 class="text-uppercase font-w-100">Abminos</h3>
                        <p class="text-small text-uppercase">Uploaded on 01-07-2014</p>
                    </figcaption>
                    <div class="item__buttons">
                        <button class="btn btn-bordered btn-block text-uppercase text-bold">Delete</button>
                        <button class="btn btn-bordered btn-block text-uppercase text-bold">Edit</button>
                    </div>
                </a>
                <a href="gallery.html#" class="mosaicflow__item m-r-10 m-b-10" data-path-hover="m 180,64.57627 -180,0 L 0,0 180,0 z">
                    {{ HTML::image('images/photos/6.jpg', '', array('class' => 'retina')); }}
                    <svg viewBox="0 0 180 320" preserveAspectRatio="none">
                        <path d="M180,160C180,160,0,218,0,218C0,218,0,0,0,0C0,0,180,0,180,0C180,0,180,160,180,160"></path>
                        <defs></defs>
                    </svg>
                    <figcaption>
                        <h3 class="text-uppercase font-w-100">Elit</h3>
                        <p class="text-small text-uppercase">Uploaded on 01-07-2014</p>
                    </figcaption>
                    <div class="item__buttons">
                        <button class="btn btn-bordered btn-block text-uppercase text-bold">Delete</button>
                        <button class="btn btn-bordered btn-block text-uppercase text-bold">Edit</button>
                    </div>
                </a>
                <a href="gallery.html#" class="mosaicflow__item m-r-10 m-b-10" data-path-hover="m 180,64.57627 -180,0 L 0,0 180,0 z">
                    {{ HTML::image('images/photos/7.jpg', '', array('class' => 'retina')); }}
                    <svg viewBox="0 0 180 320" preserveAspectRatio="none">
                        <path d="M180,160C180,160,0,218,0,218C0,218,0,0,0,0C0,0,180,0,180,0C180,0,180,160,180,160"></path>
                        <defs></defs>
                    </svg>
                    <figcaption>
                        <h3 class="text-uppercase font-w-100">Cras</h3>
                        <p class="text-small text-uppercase">Uploaded on 01-07-2014</p>
                    </figcaption>
                    <div class="item__buttons">
                        <button class="btn btn-bordered btn-block text-uppercase text-bold">Delete</button>
                        <button class="btn btn-bordered btn-block text-uppercase text-bold">Edit</button>
                    </div>
                </a>
                <a href="gallery.html#" class="mosaicflow__item m-r-10 m-b-10" data-path-hover="m 180,64.57627 -180,0 L 0,0 180,0 z">
                    {{ HTML::image('images/photos/8.jpg', '', array('class' => 'retina')); }}
                    <svg viewBox="0 0 180 320" preserveAspectRatio="none">
                        <path d="M180,160C180,160,0,218,0,218C0,218,0,0,0,0C0,0,180,0,180,0C180,0,180,160,180,160"></path>
                        <defs></defs>
                    </svg>
                    <figcaption>
                        <h3 class="text-uppercase font-w-100">Amet</h3>
                        <p class="text-small text-uppercase">Uploaded on 01-07-2014</p>
                    </figcaption>
                    <div class="item__buttons">
                        <button class="btn btn-bordered btn-block text-uppercase text-bold">Delete</button>
                        <button class="btn btn-bordered btn-block text-uppercase text-bold">Edit</button>
                    </div>
                </a>
                <a href="gallery.html#" class="mosaicflow__item m-r-10 m-b-10" data-path-hover="m 180,64.57627 -180,0 L 0,0 180,0 z">
                    {{ HTML::image('images/photos/9.jpg', '', array('class' => 'retina')); }}
                    <svg viewBox="0 0 180 320" preserveAspectRatio="none">
                        <path d="M180,160C180,160,0,218,0,218C0,218,0,0,0,0C0,0,180,0,180,0C180,0,180,160,180,160"></path>
                        <defs></defs>
                    </svg>
                    <figcaption>
                        <h3 class="text-uppercase font-w-100">Condimentum Bibendum</h3>
                        <p class="text-small text-uppercase">Uploaded on 01-07-2014</p>
                    </figcaption>
                    <div class="item__buttons">
                        <button class="btn btn-bordered btn-block text-uppercase text-bold">Delete</button>
                        <button class="btn btn-bordered btn-block text-uppercase text-bold">Edit</button>
                    </div>
                </a>
                <a href="gallery.html#" class="mosaicflow__item m-r-10 m-b-10" data-path-hover="m 180,44.57627 -180,0 L 0,0 180,0 z">
                    {{ HTML::image('images/photos/10.jpg', '', array('class' => 'retina')); }}
                    <svg viewBox="0 0 180 320" preserveAspectRatio="none">
                        <path d="M180,160C180,160,0,218,0,218C0,218,0,0,0,0C0,0,180,0,180,0C180,0,180,160,180,160"></path>
                        <defs></defs>
                    </svg>
                    <figcaption>
                        <h3 class="text-uppercase font-w-100">Ligula</h3>
                        <p class="text-small text-uppercase">Uploaded on 01-07-2014</p>
                    </figcaption>
                    <div class="item__buttons">
                        <button class="btn btn-bordered btn-block text-uppercase text-bold">Delete</button>
                        <button class="btn btn-bordered btn-block text-uppercase text-bold">Edit</button>
                    </div>
                </a>
                <a href="gallery.html#" class="mosaicflow__item m-r-10 m-b-10" data-path-hover="m 180,34.57627 -180,0 L 0,0 180,0 z">
                    {{ HTML::image('images/photos/11.jpg', '', array('class' => 'retina')); }}
                    <svg viewBox="0 0 180 320" preserveAspectRatio="none">
                        <path d="M180,160C180,160,0,218,0,218C0,218,0,0,0,0C0,0,180,0,180,0C180,0,180,160,180,160"></path>
                        <defs></defs>
                    </svg>
                    <figcaption>
                        <h3 class="text-uppercase font-w-100">Sollicitudin</h3>
                        <p class="text-small text-uppercase">Uploaded on 01-07-2014</p>
                    </figcaption>
                    <div class="item__buttons">
                        <button class="btn btn-bordered btn-block text-uppercase text-bold">Delete</button>
                        <button class="btn btn-bordered btn-block text-uppercase text-bold">Edit</button>
                    </div>
                </a>
                <a href="gallery.html#" class="mosaicflow__item m-r-10 m-b-10" data-path-hover="m 180,54.57627 -180,0 L 0,0 180,0 z">
                    {{ HTML::image('images/photos/12.jpg', '', array('class' => 'retina')); }}
                    <svg viewBox="0 0 180 320" preserveAspectRatio="none">
                        <path d="M180,160C180,160,0,218,0,218C0,218,0,0,0,0C0,0,180,0,180,0C180,0,180,160,180,160"></path>
                        <defs></defs>
                    </svg>
                    <figcaption>
                        <h3 class="text-uppercase font-w-100">Ligula</h3>
                        <p class="text-small text-uppercase">Uploaded on 01-07-2014</p>
                    </figcaption>
                    <div class="item__buttons">
                        <button class="btn btn-bordered btn-block text-uppercase text-bold">Delete</button>
                        <button class="btn btn-bordered btn-block text-uppercase text-bold">Edit</button>
                    </div>
                </a>
                <a href="gallery.html#" class="mosaicflow__item m-r-10 m-b-10" data-path-hover="m 180,34.57627 -180,0 L 0,0 180,0 z">
                    {{ HTML::image('images/photos/13.jpg', '', array('class' => 'retina')); }}
                    <svg viewBox="0 0 180 320" preserveAspectRatio="none">
                        <path d="M180,160C180,160,0,218,0,218C0,218,0,0,0,0C0,0,180,0,180,0C180,0,180,160,180,160"></path>
                        <defs></defs>
                    </svg>
                    <figcaption>
                        <h3 class="text-uppercase font-w-100">Pellentesque</h3>
                        <p class="text-small text-uppercase">Uploaded on 01-07-2014</p>
                    </figcaption>
                    <div class="item__buttons">
                        <button class="btn btn-bordered btn-block text-uppercase text-bold">Delete</button>
                        <button class="btn btn-bordered btn-block text-uppercase text-bold">Edit</button>
                    </div>
                </a>
                <a href="gallery.html#" class="mosaicflow__item m-r-10 m-b-10" data-path-hover="m 180,44.57627 -180,0 L 0,0 180,0 z">
                    {{ HTML::image('images/photos/14.jpg', '', array('class' => 'retina')); }}
                    <svg viewBox="0 0 180 320" preserveAspectRatio="none">
                        <path d="M180,160C180,160,0,218,0,218C0,218,0,0,0,0C0,0,180,0,180,0C180,0,180,160,180,160"></path>
                        <defs></defs>
                    </svg>
                    <figcaption>
                        <h3 class="text-uppercase font-w-100">Sem</h3>
                        <p class="text-small text-uppercase">Uploaded on 01-07-2014</p>
                    </figcaption>
                    <div class="item__buttons">
                        <button class="btn btn-bordered btn-block text-uppercase text-bold">Delete</button>
                        <button class="btn btn-bordered btn-block text-uppercase text-bold">Edit</button>
                    </div>
                </a>
            </div>

        </div>


    </div>
    {{-- /main content --}}

</body>

</html>