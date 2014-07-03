<div class="col-md-9">
	@foreach($jobs as $jobs)
	<div class="element-line">
	    <div class="post type-post status-publish format-standard">
	        <div class="blog-text">
	            <h2>
	            	<a href="{{ route('jobs.show', $jobs->slug) }}">[{{ $jobs->location }}] {{ $jobs->title }}</a>
	            </h2>
	            @if($jobs->user->nickname)
	            <span class="post-info">发布时间 <i class="fa fa-calendar"></i> {{ $jobs->friendly_created_at }} 用户 <a href="#" title="{{ $jobs->user->nickname }}" rel="author">{{ $jobs->user->nickname }}</a> 发布在 <ul class="post-categories"><li><a href="#" title="查看{{ $current_category->name }}下的所有工作机会" rel="category tag">{{ $current_category->name }}</a></li></ul> {{ $jobs->resume_count }}位应聘者</a> </span>
	            @else
	            <span class="post-info">发布时间 <i class="fa fa-calendar"></i> 一个未设定昵称的用户发布在 <ul class="post-categories"><li><a href="#" title="查看{{ $current_category->name }}下的所有工作机会" rel="category tag">{{ $current_category->name }}</a></li></ul> {{ $jobs->resume_count }}位应聘者</a> </span>
	            @endif
	            <p>{{ $jobs->excerpt }}</p>
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