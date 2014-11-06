<div class="col-md-9">
	@foreach($job as $job)
	<div class="element-line">
		<div class="post type-post status-publish format-standard">
			<div class="blog-text">
				<h2>
					<a href="{{ route('job.show', $job->slug) }}">[{{ $job->location }}] {{ $job->title }}</a>
				</h2>
				@if($job->user->nickname)
				<span class="post-info">发布时间 <i class="fa fa-calendar"></i> {{ $job->friendly_created_at }} 用户 <a href="{{ route('timeline.getTimeline', $job->user->id) }}" title="{{ $job->user->nickname }}" rel="author">{{ $job->user->nickname }}</a> 发布在 <ul class="post-categories"><li><a href="#" title="查看{{ $current_category->name }}下的所有工作机会" rel="category tag">{{ $current_category->name }}</a></li></ul></a></span>
				@else
				<span class="post-info">发布时间 <i class="fa fa-calendar"></i> 一个未设定昵称的用户发布在 <ul class="post-categories"><li><a href="#" title="查看{{ $current_category->name }}下的所有工作机会" rel="category tag">{{ $current_category->name }}</a></li></ul></span>
				@endif
				<p>{{ $job->excerpt }}</p>
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