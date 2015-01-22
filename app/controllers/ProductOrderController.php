<?php

/**
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @uses        Laravel The PHP frameworks for web artisans http://laravel.com
 * @author      Ri Xu http://xuri.me <xuri.me@gmail.com>
 * @copyright   Copyright (c) TimeFragment
 * @link        http://www.timefragment.com
 * @since       25th Nov, 2014
 * @license     Licensed under The MIT License http://www.opensource.org/licenses/mit-license.php
 * @version     0.1
 */

class ProductOrderController extends BaseResource
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
		'customer_name.required'	=> '请填写收货人姓名',
		'customer_address.required'	=> '请填写收货地址',
		'customer_phone.required'	=> '请填写您的手机号码',
		'phone.numeric'				=> '请填写正确的手机号码',
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
		$unpayment_order	= $this->model->orderBy($orderColumn, $direction)->where('customer_id', Auth::user()->id)->where('is_payment', 0)->paginate(15);
		$payment_order		= $this->model->orderBy($orderColumn, $direction)->where('customer_id', Auth::user()->id)->where('is_payment', 1)->where('is_checkout', 0)->paginate(15);
		$checkout_order		= $this->model->orderBy($orderColumn, $direction)->where('customer_id', Auth::user()->id)->where('is_checkout', 1)->paginate(15);
		isset($title) AND $query->where('title', 'like', "%{$title}%");
		$resourceName		= '订单';
		$resource			= 'order';
		return View::make($this->resourceView.'.index')->with(compact('unpayment_order', 'payment_order', 'checkout_order', 'resourceName', 'resource'));
	}

	/**
	 * View: Customer order details
	 * @return Response
	 */
	public function customerOrderDetails($id)
	{
		$data			= $this->model->where('customer_id', Auth::user()->id)->where('id', $id)->first();
		$resourceName	= '订单';
		$resource		= 'order';
		return View::make($this->resourceView.'.customerOrderDetails')->with(compact('data', 'resourceName', 'resource'));
	}

	/**
	 * View: Seller order details
	 * @return Response
	 */
	public function sellerOrderDetails($id)
	{
		$data			= $this->model->where('seller_id', Auth::user()->id)->where('id', $id)->first();
		$resourceName	= '订单';
		$resource		= 'order';
		return View::make($this->resourceView.'.sellerOrderDetails')->with(compact('data', 'resourceName', 'resource'));
	}

	/**
	 * View: Generate order details
	 * @return Response
	 */
	public function order($id)
	{
		$data			= ShoppingCart::where('buyer_id', Auth::user()->id)->where('id', $id)->first();
		$resourceName	= '订单';
		$resource		= 'order';
		$product_id		= Input::input('product_id');
		$product		= Product::where('id', $data->product_id)->first()->title;
		$seller			= User::where('id', $data->seller_id)->first()->nickname;
		return View::make($this->resourceView.'.order')->with(compact('data', 'resourceName', 'resource', 'product_id', 'product', 'seller'));
	}

	/**
	 * Action: Payment after add goods in shopping cart
	 * @return Response
	 */
	public function payment()
	{
		$resourceName	= '订单';
		$resource		= 'order';
		// Get all form data.
		$data   = Input::all();
		$rules  = array(
			'product_id'		=> 'required|',
			'customer_name'		=> 'required',
			'customer_address'	=> 'required',
			'customer_phone'	=> 'required|numeric',
		);
		// Custom validation message
		$messages = array(
			'customer_name.required'	=> '请填写收货人姓名',
			'customer_address.required'	=> '请填写收货地址',
			'customer_phone.required'	=> '请填写您的手机号码',
			'customer_phone.numeric'	=> '请填写正确的手机号码',
		);
		// Begin verification
		$validator = Validator::make($data, $rules, $messages);
		// Save user real name
		if ( Auth::user()->username == NULL ) {
			$user			= Auth::user();
			$user->username	= Input::get('customer_name');
			$user->save();
		};
		// Save user mobile phone number
		if ( Auth::user()->phone == NULL ) {
			$user			= Auth::user();
			$user->phone	= Input::get('customer_phone');
			$user->save();
		};

		$product_id	= Input::input('product_id');
		$product	= Product::where('id', $product_id)->first();
		$data		= ShoppingCart::where('buyer_id', Auth::user()->id)->where('product_id', $product_id)->first();

		if ($product->quantity < $data->quantity) {
			return Redirect::back()
			->with('error', '商品剩余数量不足');
		} else {
			// Verification Success
			if ($validator->passes()) {
				$order_id							= md5(date('his')).$product_id.Auth::user()->id;
				$seller_id							= $data->seller_id;
				$seller_alipay						= User::where('id', $seller_id)->first()->alipay;
				$order_name							= '时光碎片网购物-'.$product->title;
				$payment							= $data->payment;
				$goods_show							= 'http://www.timefragment.com/product/'.$product->slug;
				$customer_name						= Input::input('customer_name');
				$customer_address					= Input::input('customer_address');
				$customer_phone						= Input::input('customer_phone');
				// Create product order
				$product_order						= $this->model;
				$product_order->order_id			= $order_id;
				$product_order->seller_id			= $seller_id;
				$product_order->product_id			= $product_id;
				$product_order->customer_id			= Auth::user()->id;
				$product_order->customer_address	= $customer_address;
				$product_order->quantity			= $data->quantity;
				$product_order->price				= $data->price;
				$product_order->payment				= $payment;
				$product_order->save();
				// Destroy goods in shopping cart
				$data->delete();
				// Alipay API
				require_once( app_path('api/alipay/alipay.config.php' ));
				require_once( app_path('api/alipay/lib/alipay_submit.class.php' ));
				// Request parameters
				$payment_type		= "1";                           // Payment type (required, don't modify)
				$notify_url			= route('order.tradeNotify');    // Server asynchronous notification page URL (start with http://, don't use http://localhost/ or add ?id=123)
				$return_url			= route('order.tradeReturn');    // Synchronization notification page URL (start with http://, don't use http://localhost/ or add ?id=123)
				$seller_email		= $seller_alipay;                // Saller Alipay ID (required)
				$out_trade_no		= $order_id;                     // Order ID (required)
				$subject			= $order_name;                   // Order name (required)
				$price				= $payment;                      // Order payment (required)
				$quantity			= "1";                           // Goods quantity (default is 1)
				$logistics_fee		= "0.00";                        // Express payment (required)
				$logistics_type		= "EXPRESS";                     // Express type: EXPRESS, POST or EMS
				$logistics_payment	= "SELLER_PAY";                  // Express payment type (require:SELLER_PAY customer pay or BUYER_PAY saller pay)
				$body				= $goods_show;                   // Order describe
				$show_url			= $goods_show;                   // Goods show page (URL start with http://)
				$receive_name		= $customer_name;                // Customer name
				$receive_address	= $customer_address;             // Customer address
				$receive_zip		= NULL;                          // Customer zip (code such as:123456)
				$receive_phone		= NULL;                          // Custome telephone number (such as:0571-88158090)
				$receive_mobile		= $customer_phone;               // Customer mobile phone numer (such as:13312341234)
				// Constructs an array of arguments to request, no need to change
				$parameter = array(
					"service"			=> "trade_create_by_buyer",
					"partner"			=> trim($alipay_config['partner']),
					"payment_type"		=> $payment_type,
					"notify_url"		=> $notify_url,
					"return_url"		=> $return_url,
					"seller_email"		=> $seller_email,
					"out_trade_no"		=> $out_trade_no,
					"subject"			=> $subject,
					"price"				=> $price,
					"quantity"			=> $quantity,
					"logistics_fee"		=> $logistics_fee,
					"logistics_type"	=> $logistics_type,
					"logistics_payment"	=> $logistics_payment,
					"body"				=> $body,
					"show_url"			=> $show_url,
					"receive_name"		=> $receive_name,
					"receive_address"	=> $receive_address,
					"receive_zip"		=> $receive_zip,
					"receive_phone"		=> $receive_phone,
					"receive_mobile"	=> $receive_mobile,
					"_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
				);
				//建立请求
				$alipaySubmit	= new AlipaySubmit($alipay_config);
				$html_text		= $alipaySubmit->buildRequestForm($parameter,"get", "确认付款");
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
		$resourceName	= '订单';
		$resource		= 'order';
		// Get all form data.
		$data			= $this->model->where('id', Input::get('order_id'))->first();
		$product_id		= $data->product_id;
		$product		= Product::where('id', $product_id)->first();

		if ($product->quantity < $data->quantity) {
			return Redirect::back()
			->with('error', '商品剩余数量不足');
		} else {
			if ($data) {

				$order_id			= $data->order_id;
				$seller_id			= $data->seller_id;
				$seller_alipay		= User::where('id', $seller_id)->first()->alipay;
				$order_name			= '时光碎片网购物支付：'.$product->title;
				$payment			= $data->payment;
				$goods_show			= 'http://www.timefragment.com/product/'.$product->slug;
				$customer_name		= Auth::user()->username;
				$customer_address	= $data->customer_address;
				$customer_phone		= Auth::user()->phone;

				// Alipay API
				require_once( app_path('api/alipay/alipay.config.php' ));
				require_once( app_path('api/alipay/lib/alipay_submit.class.php' ));
				// Request parameters
				$payment_type		= "1";                           // Payment type (required, don't modify)
				$notify_url			= route('order.tradeNotify');    // Server asynchronous notification page URL (start with http://, don't use http://localhost/ or add ?id=123)
				$return_url			= route('order.tradeReturn');    // Synchronization notification page URL (start with http://, don't use http://localhost/ or add ?id=123)
				$seller_email		= $seller_alipay;                // Saller Alipay ID (required)
				$out_trade_no		= $order_id;                     // Order ID (required)
				$subject			= $order_name;                   // Order name (required)
				$price				= $payment;                      // Order payment (required)
				$quantity			= "1";                           // Goods quantity (default is 1)
				$logistics_fee		= "0.00";                        // Express payment (required)
				$logistics_type		= "EXPRESS";                     // Express type: EXPRESS, POST or EMS
				$logistics_payment	= "SELLER_PAY";                  // Express payment type (require:SELLER_PAY customer pay or BUYER_PAY saller pay)
				$body				= $goods_show;                   // Order describe
				$show_url			= $goods_show;                   // Goods show page (URL start with http://)
				$receive_name		= $customer_name;                // Customer name
				$receive_address	= $customer_address;             // Customer address
				$receive_zip		= NULL;                          // Customer zip (code such as:123456)
				$receive_phone		= NULL;                          // Custome telephone number (such as:0571-88158090)
				$receive_mobile		= $customer_phone;               // Customer mobile phone numer (such as:13312341234)
				// Constructs an array of arguments to request, no need to change
				$parameter = array(
					"service"			=> "trade_create_by_buyer",
					"partner"			=> trim($alipay_config['partner']),
					"payment_type"		=> $payment_type,
					"notify_url"		=> $notify_url,
					"return_url"		=> $return_url,
					"seller_email"		=> $seller_email,
					"out_trade_no"		=> $out_trade_no,
					"subject"			=> $subject,
					"price"				=> $price,
					"quantity"			=> $quantity,
					"logistics_fee"		=> $logistics_fee,
					"logistics_type"	=> $logistics_type,
					"logistics_payment"	=> $logistics_payment,
					"body"				=> $body,
					"show_url"			=> $show_url,
					"receive_name"		=> $receive_name,
					"receive_address"	=> $receive_address,
					"receive_zip"		=> $receive_zip,
					"receive_phone"		=> $receive_phone,
					"receive_mobile"	=> $receive_mobile,
					"_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
				);
				// Establishment request
				$alipaySubmit	= new AlipaySubmit($alipay_config);
				$html_text		= $alipaySubmit->buildRequestForm($parameter,"get", "确认付款");
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
		$data = $this->model->find($id);
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

		$alipayNotify	= new AlipayNotify($alipay_config);
		$verify_result	= $alipayNotify->verifyReturn();
		if($verify_result) {

			$out_trade_no					= $_GET['out_trade_no'];  // Order ID
			$trade_no						= $_GET['trade_no'];      // Alipay order ID
			$trade_status					= $_GET['trade_status'];  // Alipay trade status

			$product_order					= $this->model->where('order_id', $out_trade_no)->first();
			$product_order->is_payment		= true;
			$product_order->alipay_trade	= $trade_no;
			$product_order->save();
			$product						= Product::where('id', $product_order->product_id)->first();
			$product->quantity				= $product->quantity - $product_order->quantity;
			$product->save();
			return Redirect::route('order.customerOrderDetails', $product_order->id)->with('success', '付款成功！等待卖家发货，祝您购物愉快。以下是订单详情。');
		} else {
			return Redirect::route('order.index')->with('error', '付款失败，请尝试重新支付。');
		}
	}

	/**
	 * View: Seller order list
	 * @return Response
	 */
	public function seller()
	{
		// Get sort conditions
		$orderColumn	= Input::get('sort_up', Input::get('sort_down', 'created_at'));
		$direction		= Input::get('sort_up') ? 'asc' : 'desc' ;
		// Get search conditions
		switch (Input::get('target')) {
			case 'title':
				$title = Input::get('like');
				break;
		}
		// Construct query statement
		$trading_order	= $this->model->orderBy($orderColumn, $direction)->where('seller_id', Auth::user()->id)->where('is_payment', 1)->where('is_checkout', 0)->paginate(15);
		$checkout_order	= $this->model->orderBy($orderColumn, $direction)->where('seller_id', Auth::user()->id)->where('is_checkout', 1)->paginate(15);
		isset($title) AND $query->where('title', 'like', "%{$title}%");
		$resourceName	= '订单';
		$resource		= 'order';
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
			'id'			=> 'required',
			'express_name'	=> 'required',
			'invoice_no'	=> 'required',
		);
		// Custom validation message
		$messages = array(
			'express_name.required'	=> '请填写物流公司名称',
			'invoice_no.required'	=> '请填写物流单号',
		);
		// Begin verification
		$validator = Validator::make($data, $rules, $messages);

		if ($validator->passes()) {
			$product_order					= $this->model->find(Input::get('id'));
			$product_order->is_express		= true;
			$product_order->express_name	= Input::get('express_name');
			$product_order->invoice_no		= Input::get('invoice_no');

			// Alipay Dualfun API
			require_once( app_path('api/alipay/alipay.config.php' ));
			require_once( app_path('api/alipay/lib/alipay_submit.class.php' ));

			$trade_no		= $this->model->where('id', Input::get('id'))->first()->alipay_trade; 	// Alipay trade number (required)
			$logistics_name	= Input::get('express_name');   										// Express company name (required)
			$invoice_no		= Input::get('invoice_no');     										// Express billing number
			$transport_type	= "EXPRESS";                    										// Express type: POST, EXPRESS or EMS

			// Constructs an array of arguments to request, no need to change
			$parameter = array(
				"service"			=> "send_goods_confirm_by_platform",
				"partner"			=> trim($alipay_config['partner']),
				"trade_no"			=> $trade_no,
				"logistics_name"	=> $logistics_name,
				"invoice_no"		=> $invoice_no,
				"transport_type"	=> $transport_type,
				"_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
			);

			// Establishment request
			$alipaySubmit	= new AlipaySubmit($alipay_config);
			$html_text		= $alipaySubmit->buildRequestHttp($parameter);

			$doc			= new DOMDocument();
			$doc->loadXML($html_text);
			$product_order->save();
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
			$product_order				= $this->model->find(Input::get('id'));
			$product_order->is_checkout	= true;
			$product_order->save();
			return Redirect::back()->with('success', '确认收货成功！欢迎再次使用时光碎片尚品汇购物。');
		} else {
			return Redirect::back()->with('error', '确认收货失败，请重新尝试。');
		}

	}


}