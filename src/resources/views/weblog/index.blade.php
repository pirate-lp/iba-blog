@extends('iba-blog::weblog.base')

@push('title') Blog @endpush

@section('main')

<!-- <div class=" shadow" style="margin: 2rem; background-color: white; color: black; border-radius: 8px; text-align: left; text-shadow: none;"> -->
<div id="blog-timeline" class="blog-container">
	@stack('bundle-intro')
	@foreach ( $posts as $post )
	<div class="blog-timeline-block">
		<div class="blog-timeline-img blog-picture">
		</div>
		
		<a class="blog-timeline-content" href="/weblog/{{ $post->id }}/">
			
			@if ( $post->thumbnail )
				<img src="/weblog/{{ $post->id }}/{{ $post->thumbnail->name }}" style="display: block; max-height: 70vh; max-width: 100%; margin: 0px auto 1rem auto;" />
			@endif
			
			<h3>{{ $post->title->value }}</h3>
		</a> <!-- cd-timeline-content -->
		
		<div class="blog-aside">
			<span class="date mc">{{ $post->timestamp->publish->format('F j, Y') }}</span>
			<span class="date-aside timeline-content-info-title">
					@if ( $post->bundle('category')->count() >= 0 )
						@foreach ( $post->bundle('category')->get() as $category )
							<span>{{ $category->title->value }}</span>
						@endforeach
					@endif
			</span>
			<div class="timeline-content-info">
				@foreach ( $post->keywords as $keyword )
					<span class="tag"><a href="{{ url(config('iba-blog.analog.uri')) }}/?tag=<?php echo urlencode( $keyword->word ); ?>">{{ $keyword->word }}</a></span>
				@endforeach
			</div>
		</div>
	</div> <!-- cd-timeline-block -->
	@endforeach
</div>

<!-- <div> -->
@endsection