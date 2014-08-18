<?php

class ProductOrderController extends BaseController
{
    /**
     * Resource view directory
     * @var string
     */
    protected $resourceView = 'account.order';

    /**
     * Model name of the resource, after initialization to a model instance
     * @var string|Illuminate\Database\Eloquent\Model
     */
    protected $model = 'ProductOrder';

    /**
     * Resource identification
     * @var string
     */
    protected $resource = 'order';

    /**
     * Resource database tables
     * @var string
     */
    protected $resourceTable = 'product_orders';

    /**
     * Resource name (Chinese)
     * @var string
     */
    protected $resourceName = '订单';

    protected $validatorMessages = array(
		'customer_name.required'    => '请填写收货人姓名',
		'customer_address.required' => '请填写收货地址',
		'customer_phone.required'   => '请填写您的手机号码',
		'phone.numeric'             => '请填写正确的手机号码',
    );

    /**
     * View: Customer order index
     * @return Response
     */
	public function index()
    {
    	// Get sort conditions
        $orderColumn = Input::get('sort_up', Input::get('sort_down', 'created_at'));
        $direction   = Input::get('sort_up') ? 'asc' : 'desc' ;
        // Get search conditions
        switch (Input::get('target')) {
            case 'title':
                $title = Input::get('like');
                break;
        }
		// Construct query statement
		$unpayment_order = ProductOrder::orderBy($orderColumn, $direction)->where('customer_id', Auth::user()->id)->where('is_payment', 0)->paginate(15);
		$payment_order   = ProductOrder::orderBy($orderColumn, $direction)->where('customer_id', Auth::user()->id)->where('is_payment', 1)->where('is_checkout', 0)->paginate(15);
		$checkout_order  = ProductOrder::orderBy($orderColumn, $direction)->where('customer_id', Auth::user()->id)->where('is_checkout', 1)->paginate(15);
		isset($title) AND $query->where('title', 'like', "%{$title}%");
		$resourceName    = '订单';
		$resource        = 'order';
        return View::make($this->resourceView.'.index')->with(compact('unpayment_order', 'payment_order', 'checkout_order', 'resourceName', 'resource'));
    }

    /**
     * View: Customer order details
     * @return Response
     */
    public function customerOrderDetails($id)
    {
    	$data         = ProductOrder::where('customer_id', Auth::user()->id)->where('id', $id)->first();
		$resourceName = '订单';
		$resource     = 'order';
        return View::make($this->resourceView.'.customerOrderDetails')->with(compact('data', 'resourceName', 'resource'));
    }

    /**
     * View: Seller order details
     * @return Response
     */
    public function sellerOrderDetails($id)
    {
    	$data         = ProductOrder::where('seller_id', Auth::user()->id)->where('id', $id)->first();
		$resourceName = '订单';
		$resource     = 'order';
        return View::make($this->resourceView.'.sellerOrderDetails')->with(compact('data', 'resourceName', 'resource'));
    }

    /**
     * View: Generate order details
     * @return Response
     */
    public function order($id)
    {
		$data         = ShoppingCart::where('buyer_id', Auth::user()->id)->where('id', $id)->first();
		$resourceName = '订单';
		$resource     = 'order';
		$product_id   = Input::input('product_id');
		$product      = Product::where('id', $data->product_id)->first()->title;
		$seller       = User::where('id', $data->seller_id)->first()->nickname;
        return View::make($this->resourceView.'.order')->with(compact('data', 'resourceName', 'resource', 'product_id', 'product', 'seller'));
    }

    /**
     * Action: Payment after add goods in shopping cart
     * @return Response
     */
    public function payment()
    {
    	$resourceName = '订单';
		$resource     = 'order';
    	// Get all form data.
        $data   = Input::all();
        $rules  = array(
			'product_id'       => 'required|',
			'customer_name'    => 'required',
			'customer_address' => 'required',
			'customer_phone'   => 'required|numeric',
        );
        // Custom validation message
        $messages = array(
            'customer_name.required'    => '请填写收货人姓名',
			'customer_address.required' => '请填写收货地址',
			'customer_phone.required'   => '请填写您的手机号码',
			'customer_phone.numeric'    => '请填写正确的手机号码',
        );
        // Begin verification
        $validator = Validator::make($data, $rules, $messages);
        // Save user real name
        if ( Auth::user()->username == NULL ) {
        	$user = Auth::user();
            $user->username      = Input::get('customer_name');
            $user->save();
        };
        // Save user mobile phone number
        if ( Auth::user()->phone == NULL ) {
        	$user = Auth::user();
            $user->phone      = Input::get('customer_phone');
            $user->save();
        };

        $product_id = Input::input('product_id');
		$product    = Product::where('id', $product_id)->first();
		$data       = ShoppingCart::where('buyer_id', Auth::user()->id)->where('product_id', $product_id)->first();

        if ($product->quantity < $data->quantity) {
            return Redirect::back()
            ->with('error', '商品剩余数量不足');
        } else {
	        // Vrification Success
			if ($validator->passes()) {
				$order_id                        = md5(date('his')).$product_id.Auth::user()->id;
				$seller_id                       = $data->seller_id;
				$seller_alipay                   = User::where('id', $seller_id)->first()->alipay;
				$order_name                      = '时光碎片网购物-'.$product->title;
				$payment                         = $data->payment;
				$goods_show                      = 'https://www.timefragment.com/product/'.$product->slug;
				$customer_name                   = Input::input('customer_name');
				$customer_address                = Input::input('customer_address');
				$customer_phone                  = Input::input('customer_phone');
				// Create product order
				$product_order                   = new ProductOrder;
				$product_order->order_id         = $order_id;
				$product_order->seller_id        = $seller_id;
				$product_order->product_id       = $product_id;
				$product_order->customer_id      = Auth::user()->id;
				$product_order->customer_address = $customer_address;
				$product_order->quantity         = $data->quantity;
				$product_order->price            = $data->price;
				$product_order->payment          = $payment;
				$product_order->save();
				// Destroy goods in shopping cart
				$data->delete();
				// Alipay API
				require_once( app_path('api/alipay/alipay.config.php' ));
				require_once( app_path('api/alipay/lib/alipay_submit.class.php' ));
				// Request parameters
				$payment_type      = "1"; 					//支付类型 //必填，不能修改
				$notify_url        = route('order.tradeNotify'); //服务器异步通知页面路径 //需http://格式的完整路径，不能加?id=123这类自定义参数
				$return_url        = route('order.tradeReturn'); //页面跳转同步通知页面路径 //需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/
				$seller_email      = $seller_alipay; 		//卖家支付宝帐户 //必填
				$out_trade_no      = $order_id; 			//商户订单号 //商户网站订单系统中唯一订单号，必填
				$subject           = $order_name; 			//订单名称 //必填
				$price             = $payment; 				//付款金额 //必填
				$quantity          = "1"; 					//商品数量 //必填，建议默认为1，不改变值，把一次交易看成是一次下订单而非购买一件商品
				$logistics_fee     = "0.00"; 				//物流费用 //必填，即运费
				$logistics_type    = "EXPRESS"; 			//物流类型 //必填，三个值可选：EXPRESS（快递）、POST（平邮）、EMS（EMS）
				$logistics_payment = "SELLER_PAY"; 			//物流支付方式 //必填，两个值可选：SELLER_PAY（卖家承担运费）、BUYER_PAY（买家承担运费）
				$body              = $goods_show; 			//订单描述
				$show_url          = $goods_show; 			//商品展示地址 //需以http://开头的完整路径，如：http://www.xxx.com/myorder.html
				$receive_name      = $customer_name; 		//收货人姓名 //如：张三
				$receive_address   = $customer_address; 	//收货人地址 //如：XX省XXX市XXX区XXX路XXX小区XXX栋XXX单元XXX号
				$receive_zip       = NULL; 					//收货人邮编 //如：123456
				$receive_phone     = NULL; 					//收货人电话号码 //如：0571-88158090
				$receive_mobile    = $customer_phone; 		//收货人手机号码 //如：13312341234
				//构造要请求的参数数组，无需改动
				$parameter = array(
					"service"           => "trade_create_by_buyer",
					"partner"           => trim($alipay_config['partner']),
					"payment_type"      => $payment_type,
					"notify_url"        => $notify_url,
					"return_url"        => $return_url,
					"seller_email"      => $seller_email,
					"out_trade_no"      => $out_trade_no,
					"subject"           => $subject,
					"price"             => $price,
					"quantity"          => $quantity,
					"logistics_fee"     => $logistics_fee,
					"logistics_type"    => $logistics_type,
					"logistics_payment" => $logistics_payment,
					"body"              => $body,
					"show_url"          => $show_url,
					"receive_name"      => $receive_name,
					"receive_address"   => $receive_address,
					"receive_zip"       => $receive_zip,
					"receive_phone"     => $receive_phone,
					"receive_mobile"    => $receive_mobile,
					"_input_charset"    => trim(strtolower($alipay_config['input_charset']))
				);
				//建立请求
				$alipaySubmit = new AlipaySubmit($alipay_config);
				$html_text    = $alipaySubmit->buildRequestForm($parameter,"get", "确认付款");
				echo $html_text;
	        }
	        else{
	        	return Redirect::back()->withInput()->withErrors($validator);
	        }
	    }
	}

	/**
     * Action: Payment for order in customer order list
     * @return Response
     */
	public function rePayment()
    {
		$resourceName = '订单';
		$resource     = 'order';
		// Get all form data.
		$data         = ProductOrder::where('id', Input::get('order_id'))->first();
		$product_id   = $data->product_id;
		$product      = Product::where('id', $product_id)->first();

        if ($product->quantity < $data->quantity) {
            return Redirect::back()
            ->with('error', '商品剩余数量不足');
        } else {
			if ($data) {

				$order_id                        = $data->order_id;
				$seller_id                       = $data->seller_id;
				$seller_alipay                   = User::where('id', $seller_id)->first()->alipay;
				$order_name                      = '时光碎片网购物支付：'.$product->title;
				$payment                         = $data->payment;
				$goods_show                      = 'https://www.timefragment.com/product/'.$product->slug;
				$customer_name                   = Auth::user()->username;
				$customer_address                = $data->customer_address;
				$customer_phone                  = Auth::user()->phone;

				// Alipay API
				require_once( app_path('api/alipay/alipay.config.php' ));
				require_once( app_path('api/alipay/lib/alipay_submit.class.php' ));
				// Request parameters
				$payment_type      = "1"; 							//支付类型 //必填，不能修改
				$notify_url        = route('order.tradeNotify'); 	//服务器异步通知页面路径 //需http://格式的完整路径，不能加?id=123这类自定义参数
				$return_url        = route('order.tradeReturn'); 	//页面跳转同步通知页面路径 //需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/
				$seller_email      = $seller_alipay; 				//卖家支付宝帐户 //必填
				$out_trade_no      = $order_id; 					//商户订单号 //商户网站订单系统中唯一订单号，必填
				$subject           = $order_name; 					//订单名称 //必填
				$price             = $payment; 						//付款金额 //必填
				$quantity          = "1"; 							//商品数量 //必填，建议默认为1，不改变值，把一次交易看成是一次下订单而非购买一件商品
				$logistics_fee     = "0.00"; 						//物流费用 //必填，即运费
				$logistics_type    = "EXPRESS"; 					//物流类型 //必填，三个值可选：EXPRESS（快递）、POST（平邮）、EMS（EMS）
				$logistics_payment = "SELLER_PAY"; 					//物流支付方式 //必填，两个值可选：SELLER_PAY（卖家承担运费）、BUYER_PAY（买家承担运费）
				$body              = $goods_show; 					//订单描述
				$show_url          = $goods_show; 					//商品展示地址 //需以http://开头的完整路径，如：http://www.xxx.com/myorder.html
				$receive_name      = $customer_name; 				//收货人姓名 //如：张三
				$receive_address   = $customer_address; 			//收货人地址 //如：XX省XXX市XXX区XXX路XXX小区XXX栋XXX单元XXX号
				$receive_zip       = NULL; 							//收货人邮编 //如：123456
				$receive_phone     = NULL; 							//收货人电话号码 //如：0571-88158090
				$receive_mobile    = $customer_phone; 				//收货人手机号码 //如：13312341234
				//构造要请求的参数数组，无需改动
				$parameter = array(
					"service"           => "trade_create_by_buyer",
					"partner"           => trim($alipay_config['partner']),
					"payment_type"      => $payment_type,
					"notify_url"        => $notify_url,
					"return_url"        => $return_url,
					"seller_email"      => $seller_email,
					"out_trade_no"      => $out_trade_no,
					"subject"           => $subject,
					"price"             => $price,
					"quantity"          => $quantity,
					"logistics_fee"     => $logistics_fee,
					"logistics_type"    => $logistics_type,
					"logistics_payment" => $logistics_payment,
					"body"              => $body,
					"show_url"          => $show_url,
					"receive_name"      => $receive_name,
					"receive_address"   => $receive_address,
					"receive_zip"       => $receive_zip,
					"receive_phone"     => $receive_phone,
					"receive_mobile"    => $receive_mobile,
					"_input_charset"    => trim(strtolower($alipay_config['input_charset']))
				);
				//建立请求
				$alipaySubmit = new AlipaySubmit($alipay_config);
				$html_text    = $alipaySubmit->buildRequestForm($parameter,"get", "确认付款");
				echo $html_text;
	        }
	        else{
	        	return Redirect::back()->with('error', '没有找到对应的'.$this->resourceName.'。');
	        }
	    }
	}

	/**
     * Action: Delete customer order
     * @return Response
     */
    public function destroyOrder($id)
    {
        $data = ProductOrder::find($id);
        if (is_null($data))
            return Redirect::back()->with('error', '没有找到对应的'.$this->resourceName.'。');
        elseif ($data)
        {
            $data->delete();

            return Redirect::back()->with('success', $this->resourceName.'删除成功。');
        }
        else
            return Redirect::back()->with('warning', $this->resourceName.'删除失败。');
    }

    /**
     * Action: Aplipay trade return
     * @return Response
     */
    public function tradeReturn()
    {
     	// Alipay Dualfun API
     	require_once( app_path('api/alipay/alipay.config.php' ));
		require_once( app_path('api/alipay/lib/alipay_notify.class.php' ));

		$alipayNotify = new AlipayNotify($alipay_config);
		$verify_result = $alipayNotify->verifyReturn();
		if($verify_result) {

			$out_trade_no = $_GET['out_trade_no'];  //商户订单号
			$trade_no     = $_GET['trade_no']; 		//支付宝交易号
			$trade_status = $_GET['trade_status'];  //交易状态

			$product_order               = ProductOrder::where('order_id', $out_trade_no)->first();
			$product_order->is_payment   = true;
			$product_order->alipay_trade = $trade_no;
			$product_order->save();
			$product                     = Product::where('id', $product_order->product_id)->first();
			$product->quantity           = $product->quantity - $product_order->quantity;
			$product->save();
        	return Redirect::route('order.customerOrderDetails', $product_order->id)->with('success', '付款成功！等待卖家发货，祝您购物愉快。以下是订单详情。');
		} else {
		    return Redirect::route('order.index')->with('error', '付款失败，请尝试重新支付。');
		}
    }

    /**
     * Action: Aplipay trade notify
     * @return Response
     */
    public function tradeNotify()
    {
    	require_once( app_path('api/alipay/alipay.config.php' ));
		require_once( app_path('api/alipay/lib/alipay_notify.class.php' ));

		//计算得出通知验证结果
		$alipayNotify = new AlipayNotify($alipay_config);
		$verify_result = $alipayNotify->verifyNotify();

		if($verify_result) {
			$out_trade_no = $_GET['out_trade_no'];  //商户订单号
			$trade_no     = $_GET['trade_no']; 		//支付宝交易号
			$trade_status = $_GET['trade_status'];  //交易状态

			$product_order               = ProductOrder::where('order_id', $out_trade_no)->first();
			$product_order->is_payment   = true;
			$product_order->alipay_trade = $trade_no;
			$product_order->save();
			$product                     = Product::where('id', $product_order->product_id)->first();
			$product->quantity           = $product->quantity - $product_order->quantity;
			$product->save();
		} else {
		    //验证失败
		    return Redirect::route('order.index')->with('error', '此订单付款失败，请尝试重新支付。');
		}
    }

    /**
     * View: Seller order list
     * @return Response
     */
    public function seller()
    {
        // Get sort conditions
        $orderColumn = Input::get('sort_up', Input::get('sort_down', 'created_at'));
        $direction   = Input::get('sort_up') ? 'asc' : 'desc' ;
        // Get search conditions
        switch (Input::get('target')) {
            case 'title':
                $title = Input::get('like');
                break;
        }
		// Construct query statement
		$trading_order = ProductOrder::orderBy($orderColumn, $direction)->where('seller_id', Auth::user()->id)->where('is_payment', 1)->where('is_checkout', 0)->paginate(15);
		$checkout_order  = ProductOrder::orderBy($orderColumn, $direction)->where('seller_id', Auth::user()->id)->where('is_checkout', 1)->paginate(15);
		isset($title) AND $query->where('title', 'like', "%{$title}%");
		$resourceName    = '订单';
		$resource        = 'order';
        return View::make($this->resourceView.'.seller')->with(compact('trading_order', 'checkout_order', 'resourceName', 'resource'));
    }

    /**
     * Action: Seller send goods with express
     * @return Response
     */
    public function sendGoods()
    {

		// Get all form data.
		$data   = Input::all();
        $rules  = array(
			'id'           => 'required',
			'express_name' => 'required',
			'invoice_no'   => 'required',
        );
        // Custom validation message
        $messages = array(
			'express_name.required' => '请填写物流公司名称',
			'invoice_no.required'   => '请填写物流单号',
        );
        // Begin verification
        $validator = Validator::make($data, $rules, $messages);

        if ($validator->passes()) {
			$product_order               = ProductOrder::find(Input::get('id'));
			$product_order->is_express   = true;
			$product_order->express_name = Input::get('express_name');
			$product_order->invoice_no   = Input::get('invoice_no');

	    	// Alipay Dualfun API
	    	require_once( app_path('api/alipay/alipay.config.php' ));
			require_once( app_path('api/alipay/lib/alipay_submit.class.php' ));

			$trade_no       = ProductOrder::where('id', Input::get('id'))->first()->alipay_trade; //支付宝交易号 //必填
			$logistics_name = Input::get('express_name'); //物流公司名称 //必填
			$invoice_no     = Input::get('invoice_no'); //物流发货单号
			$transport_type = "EXPRESS"; //物流运输类型 //三个值可选：POST（平邮）、EXPRESS（快递）、EMS（EMS）

			//构造要请求的参数数组，无需改动
			$parameter = array(
				"service"        => "send_goods_confirm_by_platform",
				"partner"        => trim($alipay_config['partner']),
				"trade_no"       => $trade_no,
				"logistics_name" => $logistics_name,
				"invoice_no"     => $invoice_no,
				"transport_type" => $transport_type,
				"_input_charset" => trim(strtolower($alipay_config['input_charset']))
			);

			//建立请求
			$alipaySubmit = new AlipaySubmit($alipay_config);
			$html_text    = $alipaySubmit->buildRequestHttp($parameter);

			$doc = new DOMDocument();
			$doc->loadXML($html_text);
			//$product_order->save();
			return Redirect::back()->with('success', '<strong>发货成功！等待对方确认收货。</strong>');
		} else {
        	return Redirect::back()->withInput()->withErrors($validator);
        }
    }

    /**
     * Action: Customer checkout order
     * @return Response
     */
    public function checkout()
    {
    	if (Input::get('id')) {
			$product_order               = ProductOrder::find(Input::get('id'));
			$product_order->is_checkout  = true;
			$product_order->save();
			return Redirect::back()->with('success', '确认收货成功！欢迎再次使用时光碎片尚品汇购物。');
		} else {
        	return Redirect::back()->with('error', '确认收货失败，请重新尝试。');
        }

    }

}