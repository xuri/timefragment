@include('layout.account-header')
@yield('content')
<body class="bg-gray-light">
	@include('layout.admin-navigation')
	@yield('content')

	@include('layout.admin-sidebar')
	@yield('content')
	<div class="preloader">
		<div class="timer"></div>
	</div>
	<div id="container" class="main-content p-30 tp-t-60 tp-lr-10">

		<button class="menu-btn btn btn-bordered text-gray-alt text-bold top-left-corner">&#9776; 菜单</button>
		<div class="row">
			<div class="col-sm-12">
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
							{{ $resourceName }}模块管理
						</span>

					</div>

					<a href="" class="btn btn-circle btn-bordered m-r-10 m-l-30 mm-l-10">
						<span class="glyphicon glyphicon-remove"></span>
					</a>

					<a href="" class="btn btn-circle btn-bordered m-r-10">
						<span class="glyphicon glyphicon-refresh"></span>
					</a>

					<a href="" class="btn btn-circle btn-bordered m-r-10">
						<span class="glyphicon glyphicon-share-alt"></span>
					</a>

					<a href="" class="btn btn-circle btn-bordered m-r-10">
						<span class="glyphicon glyphicon-star"></span>
					</a>

					<div class="pull-right m-r-30 mail-nav">
						<a href="{{ route($resource.'.create') }}" class="btn btn-bordered text-gray-alt">
							添加新分类
						</a>
					</div>

					<div class="p-lr-30 p-tb-10 pm-lr-10">
						@include('layout.notification')
					</div>

					<div class="table-responsive p-lr-30 p-tb-10 pm-lr-10">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>排序</th>
									<th>名称</th>
									<th>创建时间</th>
									<th style="width:7em;text-align:center;">操作</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($datas as $data)
								<tr>
									<td>{{ $data->sort_order }}</td>
									<td>{{ $data->name }}</td>
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
		</div>

	</div>
	{{-- /main content --}}
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