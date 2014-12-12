<!DOCTYPE html>
<html xmlns:wb="http://open.weibo.com/wb" lang="zh-CN">
	<head>
		<title>时光碎片 | Time Fragment</title>
		<meta property="qc:admins" content="174222754064155621755646375" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta charset="UTF-8" />
		<meta name="renderer" content="webkit">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="description" content="时光碎片 -是一个集创意分享,商品交易及职位信息发布,经验分享等为一体的综合服务社区,旨在让我们的生活更加充实。" />
		<meta name="keywords" content="时光碎片 TimeFragment 创意汇 去旅行 酷工作 尚品汇 时间线 互动社区 爱生活 兼职信息 招聘 实习 工作机会 二手交易 创意分享 美文" />
		<meta name="author" content="Ri Xu">
		<meta name="og:description" content="时光碎片 | Time Fragment">
		<meta name="og:image" content="images/timefragment.png">
		<meta name="twitter:card" content="summary_large_image">
		<meta name="twitter:site" content="@timefragment">
		<meta name="twitter:title" content="时光碎片 | Time Fragment">
		<meta name="twitter:creator" content="@timefragment">
		<meta name="twitter:domain" content="timefragment.com">
		<meta name="apple-mobile-web-app-capable" content="yes"/>
		{{-- Favicons --}}
		<link rel="shortcut icon" href="{{ route('home') }}/images/icons/favicon.ico" sizes="32x32">
		{{-- For Chrome for Android: --}}
		<link rel="icon" sizes="192x192" href="{{ route('home') }}/images/icons/touch-icon-192x192.png">
		{{-- For iPhone 6 Plus with @3× display: --}}
		<link rel="apple-touch-icon-precomposed" sizes="180x180" href="{{ route('home')}}/images/icons/apple-touch-icon-180x180-precomposed.png">
		{{-- For iPad with @2× display running iOS ≥ 7: --}}
		<link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{ route('home')}}/images/icons/apple-touch-icon-152x152-precomposed.png">
		{{-- For iPad with @2× display running iOS ≤ 6: --}}
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ route('home')}}/images/icons/apple-touch-icon-144x144-precomposed.png">
		{{-- For iPhone with @2× display running iOS ≥ 7: --}}
		<link rel="apple-touch-icon-precomposed" sizes="120x120" href="{{ route('home')}}/images/icons/apple-touch-icon-120x120-precomposed.png">
		{{-- For iPhone with @2× display running iOS ≤ 6: --}}
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ route('home')}}/images/icons/apple-touch-icon-114x114-precomposed.png">
		{{-- For the iPad mini and the first- and second-generation iPad (@1× display) on iOS ≥ 7: --}}
		<link rel="apple-touch-icon-precomposed" sizes="76x76" href="{{ route('home')}}/images/icons/apple-touch-icon-76x76-precomposed.png">
		{{-- For the iPad mini and the first- and second-generation iPad (@1× display) on iOS ≤ 6: --}}
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ route('home')}}/images/icons/apple-touch-icon-72x72-precomposed.png">
		{{-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: --}}
		<link rel="apple-touch-icon-precomposed" href="{{ route('home')}}/images/icons/apple-touch-icon-precomposed.png">{{-- 57×57px --}}

		{{ HTML::style('assets/css/fonts.googleapis.min.css') }}

		{{-- Stylesheet --}}

		{{ style('bootstrap-3.0.3') }}
		{{ style('flexslider-2.2') }}

		{{ Minify::stylesheet(array(
			'/assets/normalize-3.0.1/normalize-3.0.1.min.css',
			'/assets/css/loading.css',
			'/assets/css/main.css',
			'/assets/css/isotope.css',
			'/assets/css/color/blu.css'
		)) }}

		{{ style('font-awesome-4.1.0') }}

		{{ HTML::style('assets/css/style-responsive.min.css') }}

		{{-- WARNING: Respond.js doesn't work if you view the page via file:// --}}

		<!--[if lte IE 9]>
		<script type=text/javascript>window.location.href="{{ route('browser_not_support') }}";  </script>
		<![endif]-->

		<!--[if lt IE 9]>
			{{ script('html5shiv-3.7.0') }}
			{{ HTML::script('assets/js/respond.min.js') }}
		<![endif]-->

		{{-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries --}}

		{{-- Js Library --}}

		{{ script('jquery-2.1.1') }}

		{{-- Js Library --}}
	</head>