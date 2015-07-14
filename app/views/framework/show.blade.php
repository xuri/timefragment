@extends('framework.base')

@section('title') 时光碎片 @parent @stop

@section('beforeStyle')

@parent @stop

@section('style')

@parent @stop

@section('body')

    @include('layout.header')
    @yield('content')

@stop

@section('end')

@parent @stop