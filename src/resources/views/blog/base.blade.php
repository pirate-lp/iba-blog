@extends('iba-blog::blog.master')

@section('body')
	<header>
		<h1>
			<a href="{{ url(config('iba-blog.digital.uri'), '') }}">{{ config('iba-blog.title')}}</a>
			<span><a class="inlink" style="font-size: .8rem;" href="{{ url(config('iba-blog.analog.uri'), '') }}">static version</a></span>
		</h1>
	</header>
	
	<div id="iba-blog">
	</div>

@endsection
