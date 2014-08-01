<div class="pricing-box col-md-3 .col-md-push-9">
	<div class="item_bottom" style="opacity: 1; bottom: 0px;">
		<div class="element-line">
			<ul style="border: solid 1px #eee;">
				<li class="title-row">
					<h4>商品详情</h4>
				</li>
				<li class="price-row">
					<h1>￥{{ $product->price }}</h1>
					<span>/单价</span>
				</li>
				@if($product->user->nickname)
				<li> 来自卖家：{{ $product->user->nickname }}</li>
				@else
				@endif
				<li> 商品分类：{{ $product->category->name }}</li>
				<li> 卖家来自：{{ $product->province }} {{ $product->city }}</li>
				<li> 剩余数量：{{ $product->quantity }}</li>
				<li> 上架时间：{{ $product->friendly_created_at }}</li>
				<li class="btn-row">
					<div class="mybutton small">
						<a href="#">
							<span data-hover="加入购物车">购买此商品</span>
						</a>
					</div>
				</li>
			</ul>
		</div>
	</div>
</div>