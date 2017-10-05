@extends('iba-blog::master')

@push('title')
{{ config('iba-blog.title') }}
@endpush

@push('rssfeed')
@endpush

@section('cssclass', 'blog')

@section('body')

<header>
    <h1 class="logo"><a href="{{ url(config('iba-blog.analog.uri'), '') }}">{{ config('iba-blog.title')}}</a></h1>
<!--
	<nav class="mobile-yes" style="width: 100%; margin-top: 24px;">
	    <ul>
	        <li><a onclick="$('#dashboard-left-content').toggle();">About</a></li>
	        <li><a onclick="$('#dashboard-right-content').toggle();">More</a></li>
	    </ul>
	</nav>    
-->
</header>

<div class="blog">
	
	@include('iba-blog::modules.main.head')
	
	
	@yield('main')
	
	@include('iba-blog::modules.main.bottom')

</div>
	
	
<!--
<div class="pure-g">
    <div class="blogbase page pure-u-1 pure-u-sm-23-24 pure-u-md-23-24 pure-u-lg-23-24 pure-u-xl-19-24">
    <div class="pure-g">
    	<section class="b-dashboard-left page pure-u-1 pure-u-sm-1-1 pure-u-md-3-8 pure-u-lg-6-24 pure-u-xl-6-24">
    		{{-- @include('iba-blog::blog.sidebar-left') --}}
    	</section>
    	<main class="pure-u-1 pure-u-sm-1-1 pure-u-md-5-8 pure-u-lg-12-24 pure-u-xl-12-24">
	    	
	    </main>
	    <section class="b-dashboard-right page pure-u-1 pure-u-sm-1-1 pure-u-md-2-7 pure-u-lg-6-24 pure-u-xl-6-24">
		    {{-- @include('iba-blog::blog.sidebar-right') --}}
	    </section>
    </div>
    </div>
</div>
-->

	

@endsection