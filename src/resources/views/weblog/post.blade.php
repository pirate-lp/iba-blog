@extends('iba-blog::weblog.base')

@push('title') {{ $post->title->value  }} | Blog @endpush

@section('main')
<div class="pure-g">
	<div class="cen pure-u-1-1 pure-u-sm-23-24 pure-u-md-20-24 pure-u-lg-16-24">
		@include('iba-blog::modules.blog.post-l')
	</div>
</div>
@endsection