@extends('iba-blog::blog.master')

@section('body')
	<header>
		<div class="logo">
			<header><h1><a href="{{ url(config('iba-blog.digital.uri'), '') }}">{{ config('iba-blog.title')}}</a></h1></header>
		</div>
	</header>
	<div id="iba-blog">
	</div>

@endsection
