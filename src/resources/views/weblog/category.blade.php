@extends('iba-blog::weblog.index')

@push('bundle-intro')
<header class="article">
	<h2><a href="" rel="people">{{ $category->title->value }}</a></h2>
	<p style="text-align: right;"><a class="inlink" href="/weblog/">All Posts</a></p>
</header>
@endpush