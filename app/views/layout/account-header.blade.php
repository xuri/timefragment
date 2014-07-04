<!DOCTYPE html>
<html>
    <head>
        <title>仪表盘 | 时光碎片</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="{{ route('home')}}/images/icon/ico-16.ico" sizes="16x16">
        <link rel="apple-touch-icon" href="{{ route('home')}}/images/icon/ico-57.png" sizes="57x57">
        <link rel="apple-touch-icon" href="{{ route('home')}}/images/icon/ico-72.png" sizes="72x72">
        <link rel="apple-touch-icon" href="{{ route('home')}}/images/icon/ico-114.png" sizes="114x114">
        <link rel="apple-touch-icon" href="{{ route('home')}}/images/icon/ico-144.png" sizes="144x144">
        {{ HTML::style('assets/css/fonts.googleapis.css') }}
        {{ HTML::style('assets/css/admin.css') }}

        {{-- Js Library --}}

        {{-- jQuery (necessary for Bootstrap's JavaScript plugins) --}}

        {{ script('jquery-2.1.1') }}

        {{-- Include all compiled plugins (below), or include individual files as needed --}}

        {{ script('bootstrap-3.0.3') }}
        {{ script('bootstrap-select') }}
        {{ script('modernizr-2.8.1') }}

        {{ HTML::script('assets/js/admin.js') }}
        {{ HTML::script('assets/js/retina-1.3.0.min.js') }}

        {{-- Album Library --}}

        {{ HTML::script('assets/js/lib/mosaicflow.js') }}
        {{ HTML::script('assets/js/lib/snap.svg-0.2.0.min.js') }}
        {{ HTML::script('assets/js/lib/dropzone-3.10.2.min.js') }}
        {{ HTML::script('assets/js/lib/pushy.js') }}
        {{ HTML::script('assets/js/lib/moment.js') }}
        {{ HTML::script('assets/js/lib/jquery.timeago.js') }}
        {{ HTML::script('assets/js/lib/jquery.eventCalendar.js') }}
        {{ HTML::script('assets/js/lib/icheck.js') }}
        {{ HTML::script('assets/js/lib/lifestream.js') }}
        {{ HTML::script('assets/js/lib/raphael-2.1.2.min.js') }}
        {{ HTML::script('assets/js/lib/morris.js') }}
        {{ HTML::script('assets/js/lib/easypiechart.js') }}
        {{ HTML::script('assets/js/lib/sparkline.js') }}
        {{ HTML::script('assets/js/lib/backstretch.js') }}
        {{ HTML::script('assets/js/lib/city.js') }}
        {{ HTML::script('assets/js/lib/notify.js') }}

        {{-- WARNING: Respond.js doesn't work if you view the page via file:// --}}

            <!--[if lt IE 9]>
                {{ script('html5shiv-3.7.0') }}
                {{ HTML::script('assets/js/respond.min.js') }}
            <![endif]-->

        {{-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries --}}

        {{-- Js Library --}}
    </head>