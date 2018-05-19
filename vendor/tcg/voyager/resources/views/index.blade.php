@extends('voyager::master')

@section('css')
    <style type="text/css">
    	.notice{
		    margin-left: 25px;
		    padding: 20px 30px;
		    margin-right: 10px;

    	}
    	.notice h1{
    		padding-bottom: 15px;
    		margin-bottom: 15px;
    		font-size: 32px;
    		color: #19B5FE;
    	}
    	.notice .content{
    		font-size: 16px;
    	}
    	.notice .content img{
    		width: 100%;
    	}
    </style>
@stop

@section('content')
    <div class="page-content">
        @include('voyager::alerts')
        @include('voyager::dimmers')
    </div>
    <div class="panel notice">
    	@if (isset($notice))
			<h1>{{ $notice->title }}</h1>
			<div class="content">{!! $notice->content !!}</div>
		@else
			<div>暂无系统通知。</div>
		@endif
    </div>    	
@stop