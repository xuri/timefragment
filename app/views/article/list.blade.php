<div class="col-md-9">
    @foreach($articles as $article)
    <div class="element-line">
        <div class="post type-post status-publish format-standard">
            <div class="blog-text">
                <h2>
                    <a href="{{ route('article.show', $article->slug) }}">{{ $article->title }}</a>
                </h2>
                @if($article->user->nickname)
                <span class="post-info">发布时间 <i class="fa fa-calendar"></i> {{ $article->friendly_created_at }} 用户 <a href="#" title="{{ $article->user->nickname }}" rel="author">{{ $article->user->nickname }}</a> 发布在 <ul class="post-categories"><li><a href="#" title="查看{{ $current_category->name }}下的所有文章" rel="category tag">{{ $current_category->name }}</a></li></ul> {{ $article->comments_count }}评论</a> </span>
                @else
                <span class="post-info">发布时间 <i class="fa fa-calendar"></i> 一个未设定昵称的用户发布在 <ul class="post-categories"><li><a href="#" title="查看{{ $current_category->name }}下的所有文章" rel="category tag">{{ $current_category->name }}</a></li></ul> {{ $article->comments_count }}评论</a> </span>
                @endif
                <p>{{ $article->excerpt }}</p>
            </div>

            <!-- <div class="post-tags">
                <div class="icon"><i class="fa fa-tags fa-lg"></i> 标签:</div>
                <a href="#" rel="tag">Tag1</a>
                <a href="#" rel="tag">Tag2</a>
                <a href="#" rel="tag">Tag3</a>
            </div> -->
        </div>
    </div>
    @endforeach
</div>