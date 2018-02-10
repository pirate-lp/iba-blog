@extends('iba-blog::master')

@push('title')
	{{ config('iba-blog.title') }}
@endpush

@push('rssfeed')
@endpush

@section('cssclass', 'weblog')

@section('body')

	<header>
		<h1><a href="{{ url(config('iba-blog.analog.uri'), '') }}">{{ config('iba-blog.title')}}</a></h1>
	</header>

	<div class="blog">
		
		@include('iba-blog::modules.main.head')
		
		@yield('main')
		
		@include('iba-blog::modules.main.bottom')
	
	</div>

@endsection