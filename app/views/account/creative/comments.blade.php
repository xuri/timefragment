@include('layout.account-header')
@yield('content')

<body id="inbox-page" class="bg-gray-light">

	@include('layout.account-navigation')
	@yield('content')

	@include('layout.account-sidebar')
	@yield('content')

	<div class="preloader">
		<div class="timer"></div>
	</div>

	<div id="container" class="main-content tp-t-60">

		<button class="menu-btn btn btn-bordered text-gray-alt text-bold top-left-corner tm-l-30 pull-left">&#9776; 菜单</button>

		<div class="row">

			<div class="col-sm-9">
				<div class="bg-white p-tb-30">

					<div class="btn-group">
						<div class="iconmelon m-r-10 m-l-30">
							<svg viewBox="0 0 32 32">
								<g filter="">
									<use xlink:href="#speech-talk-user"></use>
								</g>
							</svg>
						</div>

						<span class="text-gray-dark text-large align-with-button m-r-30">
							我评论过的创意分享
						</span>
					</div>

					<hr>

					<div class="p-lr-30 p-tb-10 pm-lr-10">
						@include('layout.notification')
					</div>

					<div class="table-responsive p-lr-30 p-tb-10 pm-lr-10">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>标题</th>
									<th>评论内容</th>
									<th style="width:35%;">创建时间</th>
									<th style="width:8%;text-align:center;">操作</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($comments as $comment)
								<tr>
									<td>
										@if($comment->creative)
										<a href="{{ route('creative.show', $comment->creative->slug) }}" target="_blank">
											<i class="glyphicon glyphicon-share" style="font-size:0.8em;"></i>
										</a> {{ $comment->creative->title }}
										@else
										此文章已被删除
										@endif
									</td>
									<td>{{ $comment->content }}</td>
									<td>{{ $comment->created_at }}（{{ $comment->friendly_created_at }}）</td>
									<td>
										<a href="javascript:void(0)" class="btn btn-xs btn-danger" onclick="modal('{{ route('mycreative.deleteComment', $comment->id) }}')">删除评论
										 </a>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<div class="btn-group m-l-30">
						{{ pagination($comments->appends(Input::except('page')), 'layout.paginator') }}
					</div>

				</div>
			</div>
			{{-- /.col-lg-9 --}}

			@include('layout.account-slider')
			@yield('content')

		</div>
		{{-- /.row --}}
	</div>

	@include('layout.account-chat')
	@yield('content')

	<?php
	$modalData['modal'] = array(
		'id'      => 'myModal',
		'title'   => '系统提示',
		'message' => '确认删除此评论？',
		'footer'  =>
			Form::open(array('id' => 'real-delete', 'method' => 'delete')).'
				<button type="button" class="btn btn-sm btn-default btn-bordered" data-dismiss="modal">取消</button>
				<button type="submit" class="btn btn-sm btn-danger">确认删除</button>'.
			Form::close(),
	);
	?>
	@include('layout.modal', $modalData)
	<script>
		function modal(href) {
			$('#real-delete').attr('action', href);
			$('#myModal').modal();
		}
	</script>
</body>

</html>