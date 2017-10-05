@extends('iba-blog::weblog.index')

@push('bundle-intro')
<header class="article">
	<h3 class="sc">Reference Tag</h3>
	<h2><a href="" rel="people">#{{ $keyword->word }}</a></h2>
	<p style="text-align: right;"><a class="inlink" href="{{ url( config('iba-blog.analog.uri') ) }}">All Posts</a>
</header>
	
@endpush