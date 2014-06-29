<div class="col-md-9">
	<div class="element-line">
		<div class="flexslider">
			<ul class="slides">
				@foreach ($travel->pictures as $picture)
				<li>
					<img class="img-responsive img-center img-rounded" src="{{
				 route('home')}}/uploads/travel/{{ $picture->filename }}" alt="{{ $picture->article->title }}" title="{{ $picture->article->title }}" />
				</li>
				@endforeach
			</ul>
		</div>
		<div class="blog-text">
			<p>
				{{ $travel->content }}
			</p>
		</div>

	</div>
</div>