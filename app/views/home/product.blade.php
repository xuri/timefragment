{{-- Portfolio Section --}}
        <section id="shop-exp" class="section-content">
            <div class="container">

                {{-- Section title --}}
                <div class="section-title text-center">
                    <div>
                        <span class="line big"></span>
                        <span>全新交易信息发布平台</span>
                        <span class="line big"></span>
                    </div>
                    <a href="{{ route('product.getIndex') }}"><h1 class="item_right">尚品汇</h1></a>
                    <div>
                        <span class="line"></span>
                        <span>低碳·环保·健康·绿色</span>
                        <span class="line"></span>
                    </div>
                    <p class="lead">
                        这里是发布商品交易信息的全新平台！
                    </p>
                </div>
                {{-- Section title --}}
            </div>

            <div class="portfolio-top"></div>

            {{-- Portfolio filters --}}
            <div class="element-line">
                <div id="filters" class="mybutton small">
                    <a href="#" data-filter="*"><span data-hover="查看">显示所有</span></a>
                    @foreach($productCategories as $category)
                    <a href="#" data-filter=".{{ $category->id }}"><span data-hover="筛选">{{ $category->name }}</span></a>
                    @endforeach
                </div>
            </div>
            {{-- Portfolio filters --}}

            <div id="portfolio-wrap">
                @foreach($product as $product)
                {{-- portfolio item --}}
                <div class="portfolio-item {{ $product->category_id }}">
                    <div class="portfolio">
                        <a href="{{ route('product.show', $product->slug) }}" class="zoom">

                            @if($product->thumbnails)
                            <img src="{{ route('home') }}/uploads/product_thumbnails/{{ $product->thumbnails }}" alt="{{ $product->title }}" title="{{ $product->title }}">
                            @else
                            <img src="{{ route('home') }}/images/thumbnails/product.jpg" alt="{{ $product->title }}" title="{{ $product->title }}">
                            @endif

                            <div class="hover-items">
                                <span>
                                    @if($product->user->nickname)
                                        <i class="fa fa-plus fa-4x"></i> <em class="lead">{{ $product->title }}</em> <em>卖家：{{ $product->user->nickname }}</em>
                                    @else
                                        <i class="fa fa-plus fa-4x"></i> <em class="lead">{{ $product->title }}</em> <em>商品分类：{{ $product->category->name }}</em>
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
            <div class="clear"></div>
            {{-- Ajax content --}}

        </section>
        {{-- Portfolio Section --}}