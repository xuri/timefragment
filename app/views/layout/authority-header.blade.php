<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <title>时光碎片 | TimeFragment</title>
        <meta charset="utf-8">
        <meta name="viewport" content="maximum-scale=1.0, width=500"/>
        <meta name="description" content="time luxurioust fragment life travel and more."/>
        <meta name="og:description" content="TimeFragment">
        <meta name="og:image" content="images/timefragment.png">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@mrxuri">
        <meta name="twitter:title" content="TimeFragment">
        <meta name="twitter:creator" content="@mrxuri">
        <meta name="twitter:domain" content="mrxuri.com">
        <meta name="apple-mobile-web-app-capable" content="yes"/>
        {{-- Favicons --}}

        <link rel="shortcut icon" href="{{ route('home')}}/images/icon/ico-16.ico" sizes="16x16">
        <link rel="apple-touch-icon" href="{{ route('home')}}/images/icon/ico-57.png" sizes="57x57">
        <link rel="apple-touch-icon" href="{{ route('home')}}/images/icon/ico-72.png" sizes="72x72">
        <link rel="apple-touch-icon" href="{{ route('home')}}/images/icon/ico-114.png" sizes="114x114">
        <link rel="apple-touch-icon" href="{{ route('home')}}/images/icon/ico-144.png" sizes="144x144">

        {{-- Stylesheet --}}

        {{ HTML::style('assets/css/style-1.css') }}
        {{ HTML::style('assets/css/style-2.css') }}

        {{ style('bootstrap-3.0.3') }}
        {{ style('font-awesome-4.0.3') }}
        {{ HTML::style('assets/css/fonts.googleapis.css') }}
        {{ HTML::style('assets/css/main.css') }}
        {{ HTML::style('assets/css/style-responsive.css') }}

        {{-- Js Library --}}

        {{-- jQuery (necessary for Bootstrap's JavaScript plugins) --}}

        {{ script('jquery-2.1.1') }}

        {{-- Include all compiled plugins (below), or include individual files as needed --}}

        {{ script('bootstrap-3.0.3') }}

        {{ HTML::script('assets/js/js-1.js') }}
        {{ HTML::script('assets/js/js-2.js') }}

        {{-- WARNING: Respond.js doesn't work if you view the page via file:// --}}

        <!--[if lt IE 9]>
            {{ script('html5shiv-3.7.0') }}
            {{ HTML::script('assets/js/respond.min.js') }}
        <![endif]-->

        {{-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries --}}

        {{-- Js Library --}}
    </head>