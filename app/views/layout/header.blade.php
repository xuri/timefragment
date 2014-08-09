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

		<link rel="shortcut icon" href="{{ route('home')}}/images/icon/ico-16.ico" sizes="16x16">
		<link rel="apple-touch-icon" href="{{ route('home')}}/images/icon/ico-57.png" sizes="57x57">
		<link rel="apple-touch-icon" href="{{ route('home')}}/images/icon/ico-72.png" sizes="72x72">
		<link rel="apple-touch-icon" href="{{ route('home')}}/images/icon/ico-114.png" sizes="114x114">
		<link rel="apple-touch-icon" href="{{ route('home')}}/images/icon/ico-144.png" sizes="144x144">
		{{ HTML::style('assets/css/fonts.googleapis.css') }}

		{{-- Stylesheet --}}

		{{ style('bootstrap-3.0.3') }}
		{{ style('font-awesome-4.1.0') }}
		{{ style('flexslider-2.2') }}
		{{ style('normalize-3.0.1') }}

		{{ HTML::style('assets/css/loading.css') }}
		{{ HTML::style('assets/css/main.css') }}
		{{ HTML::style('assets/css/style-responsive.css') }}
		{{ HTML::style('assets/css/isotope.css') }}

		{{-- Primary color theme --}}

		{{ HTML::style('assets/css/color/blu.css') }}

		{{-- WARNING: Respond.js doesn't work if you view the page via file:// --}}

		<!--[if lte IE 9]>
		<script type=text/javascript>window.location.href="{{ route('browser_not_support') }}";  </script>
		<![endif]-->

	    <!--[if lt IE 9]>
	        {{ script('html5shiv-3.7.0') }}
            {{ HTML::script('assets/js/respond.min.js') }}
	    <![endif]-->

	    {{-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries --}}
	</head>