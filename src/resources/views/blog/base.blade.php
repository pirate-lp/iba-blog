@extends('iba-blog::blog.master')

@push('title') Lost Ideas Lab's Blog @endpush

@push('rssfeed')
	<link rel="alternate" type="application/atom+xml" title="Lost Ideas Lab Blog's Atom feed" href="http://lostideaslab.com/blog/feed/atom" />
	<link rel="alternate" type="application/rss+xml" title="Lost Ideas Lab's Blog's RSS feed" href="http://lostideaslab.com/blog/feed/rss" />
@endpush

@section('cssclass', 'blog')

@section('body')

	@component('modules.layouts.header')
		@slot('title')
			<span><a href="/blog/">Lost Ideas Lab's Blog</a></span>
		@endslot
		
		<li><a href="/blog/introduction/">Introduction</a></li>
	@endcomponent
	
	<div id="iba-blog">
	</div>

@endsection
