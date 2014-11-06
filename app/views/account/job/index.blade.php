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
								我的{{ $resourceName }}
						</span>

					</div>

					<input type="text" class="input-light input-large brad valign-top m-r-10 m-l-10 search-box" placeholder="搜索...">

					<div class="pull-right m-r-30 mail-nav">
						<a href="{{ route($resource.'.create') }}" class="btn btn-bordered text-gray-alt">
							发布{{ $resourceName }}
						</a>
					</div>

					<div class="p-lr-30 p-tb-10 pm-lr-10">
						@include('layout.notification')
					</div>

					<div class="table-responsive p-lr-30 p-tb-10 pm-lr-10">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>标题 {{ order_by('title') }}</th>
									<th>评论数 {{ order_by('comments_count') }}</th>
									<th>创建时间 {{ order_by('created_at', 'desc') }}</th>
									<th style="width:7em;text-align:center;">操作</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($datas as $data)
								<tr>
									<td>
										<a href="{{ route('job.show', $data->slug) }}" target="_blank">
											<i class="glyphicon glyphicon-share" style="font-size:0.8em;"></i>
										</a>
										{{ $data->title }}
									</td>
									<td>{{ $data->comments_count }}</td>
									<td>{{ $data->created_at }}（{{ $data->friendly_created_at }}）</td>
									<td>
										<a href="{{ route($resource.'.edit', $data->id) }}" class="btn btn-xs">编辑</a>
										<a href="javascript:void(0)" class="btn btn-xs btn-danger"
											 onclick="modal('{{ route($resource.'.destroy', $data->id) }}')">删除</a>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<div class="btn-group m-l-30">
						{{ pagination($datas->appends(Input::except('page')), 'layout.paginator') }}
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
		'message' => '确认删除此'.$resourceName.'？',
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