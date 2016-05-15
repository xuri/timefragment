<div class="col-md-3 .col-md-push-9">
    <div class="element-line">
        <div id="sidebar">

            {{-- Search Widget --}}
            <div class="widget">
                <div class="widget-title">
                    <h4>寻找酷工作</h4>
                </div>
                <form method="POST" action="{{ route('job.search') }}" accept-charset="UTF-8">
                    <div class="form-group">
                        {{-- CSRF Token --}}
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" name="target" value="title">
                        <input class="form-control input-lg" type="text" placeholder="站内搜索" name="like" value="{{ Input::get('like') }}">
                    </div>
                {{ Form::close() }}

            </div>
            {{-- /Search Widget --}}

            {{-- Categories Widget --}}
            <div class="widget">
                <div class="widget-title">
                @if(Auth::guest()){{--游客--}}
                <h4><a href="{{ route('signin') }}">登陆</a> / <a href="{{ route('signup') }}">注册</a></h4>
                @else
                    @if (Auth::user()->username)
                    <h4><a href="{{ route('account') }}">{{ Auth::user()->username }}</a></h4>
                    @elseif (Auth::user()->nickname)
                    <h4><a href="{{ route('account') }}">{{ Auth::user()->nickname }}</a></h4>
                    @else
                    <h4><a href="{{ route('account') }}">{{ Auth::user()->email }}</a></h4>
                    @endif
                @endif
                </div>
                <ul class="widget-nav">
                    <li class="first">
                        <a href="{{ route('mycreative.create') }}"><i class="fa fa-angle-right"></i> 分享我的创意</a></a>
                    </li>
                    <li>
                        <a href="{{ route('mytravel.index') }}"><i class="fa fa-angle-right"></i> 美好旅行时光</a></a>
                    </li>
                    <li>
                        <a href="{{ route('myjob.create') }}"><i class="fa fa-angle-right"></i> 发布招聘信息</a></a>
                    </li>
                    <li>
                        <a href="{{ route('timeline') }}"><i class="fa fa-angle-right"></i> 我的时光印记</a>
                    </li>
                    <li>
                        <a href="{{ route('account.settings') }}"><i class="fa fa-angle-right"></i> 前往偏好设置</a>
                    </li>
                </ul>
            </div>
            {{-- /Categories Widget --}}

            {{-- Text Widget --}}
            <div class="widget">
                <?php
                $announce_category = Category::where('cat_status', 'open')->where('name', '站内简讯')->first();
                $announce          = Article::where('post_status', 'open')->where('category_id', $announce_category->id)->orderBy('created_at', 'desc')->first();
                ?>
                @if($announce)
                <div class="widget-title">
                    <h4><a href="{{ route('article.category'), $announce_category->id }}">站内简讯</a></h4>
                </div>
                <p>{{ $announce->excerpt }}</p>
                @else
                <div class="widget-title">
                    <h4>站内简讯</h4>
                </div>
                <p>
                    暂无站内简讯
                </p>
                @endif
            </div>
            {{-- /Text Widget --}}

            {{-- Recent Posts Widget --}}
            <div class="widget">

                <div class="widget-title">
                    <h4>热门职位</h4>
                </div>
                <?php
                $posts = Job::where('post_status', 'open')->orderBy('comments_count', 'desc')->paginate(4);
                ?>
                @foreach($posts as $post)
                <div class="post-box">
                    <a href="{{ route('timeline.getTimeline', $post->user->id) }}"> <img class="img-rounded" src="{{ $post->user->portrait_large }}" width="50" height="50" alt=""> </a>
                    <div>
                        <h5><a href="{{ route('job.show', $post->slug) }}">{{ $post->title }}</a></h5>
                        <small>{{ date("M d, Y",strtotime($post->created_at)) }}</small>
                    </div>
                </div>
                @endforeach
            </div>
            {{-- /Recent Posts Widget --}}

            {{-- Tags Widget --}}
            <div class="widget">
                <div class="widget-title">
                    <h4>热议主题</h4>
                </div>
                <ul class="widget-tag">
                    <?php
                    $categories = JobCategories::where('cat_status', 'open')->orderBy('sort_order')->get();
                    ?>
                    @foreach($categories as $category)
                    <li>
                        <a href="{{ route('job.category', $category->id) }}" class="tag-link">{{ $category->name }}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
            {{-- /Tags Widget --}}
        </div>
    </div>
</div>