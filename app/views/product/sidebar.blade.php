<div class="pricing-box col-md-3 .col-md-push-9">
	<div class="item_bottom" style="opacity: 1; bottom: 0px;">
		<div class="element-line">
			<form method="post" autocomplete="off">
				{{-- CSRF Token --}}
            	<input type="hidden" name="_token" 		value="{{ csrf_token() }}" />
            	<input type="hidden" name="addGoods"	value="addGoods" />
            	<input type="hidden" name="product_id" 	value="{{ $product->id }}" />
            	<input type="hidden" name="price" 		value="{{ $product->price }}" />
            	<input type="hidden" name="seller_id" 	value="{{ $product->user->id }}" />
            	<input type="hidden" name="inventory" 	value="{{ $product->quantity }}" />
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
					<li>商品分类：{{ $product->category->name }}</li>
					<li>卖家来自：{{ $product->province }} {{ $product->city }}</li>
					<li>剩余数量：{{ $product->quantity }}</li>
					<li>上架时间：{{ $product->friendly_created_at }}</li>
					<li class="navbar-form">购买数量：{{ $errors->first('quantity', '<span style="color:#c7254e;margin:0 1em;">:message</span>') }}
					  <div class="form-group">
					    <input type="text" class="form-control" name="quantity" id="quantity" value="1" />
					  </div>
					</li>
					@if($inCart)
					<li class="btn-row">
						<div class="mybutton small">
							<a href="{{ route('myproduct.cart') }}">
								<span data-hover="查看购物车">已添加至购物车</span>
							</a>
						</div>
					</li>
					@else
					<li class="btn-row">
						<div class="mybutton small">
							<button id="submit" type="submit">
								<span data-hover="加入购物车">购买此商品</span>
							</button>
						</div>
					</li>
					@endif
				</ul>
			</form>
		</div>
	</div>
</div>