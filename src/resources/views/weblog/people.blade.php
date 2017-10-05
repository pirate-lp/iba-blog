@extends('iba-blog::weblog.index')

@push('bundle-intro')
<header class="article">
	<h2><a href="" rel="people">{{ $person->detail->identifier }}</a></h2>
		<h3 class="sc">is mentioned in the posts ...</h3>
		<p style="text-align: right;"><a class="inlink" href="{{ url( config('iba-blog.analog.uri') ) }}">All Posts</a>
</header>
@endpush