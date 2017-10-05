@extends('iba-blog::weblog.base')

@push('title') Blog @endpush

@section('main')

<!-- <div class=" shadow" style="margin: 2rem; background-color: white; color: black; border-radius: 8px; text-align: left; text-shadow: none;"> -->
<div id="cd-timeline" class="cd-container">
	@stack('bundle-intro')
	@foreach ( $posts as $post )
	<div class="cd-timeline-block">
		<div class="cd-timeline-img cd-picture">
		</div>
		
		<a class="cd-timeline-content" href="/weblog/{{ $post->id }}/">
			
			@if ( $post->thumbnail )
				<img src="/weblog/{{ $post->id }}/{{ $post->thumbnail->name }}" style="display: block; max-height: 70vh; max-width: 100%; margin: 0px auto 1rem auto;" />
			@endif
			
			<div class="cd-aside">
				<span class="cd-date">{{ $post->timestamp->publish->format('F j, Y') }}</span>
				<div class="timeline-content-info">
		        	<span class="timeline-content-info-title">
						@if ( $post->bundle('category')->count() >= 0 )
							@foreach ( $post->bundle('category')->get() as $category )
								<span>{{ $category->title->value }}</span>
							@endforeach
						@endif
					</span>
				</div>
			</div>
			<h3><span style="font-size: 1.3em">{{ $post->title->value }}</span><br /></h3>
	        
	        <ul class="content-skills">
	        </ul>
	       
		</a> <!-- cd-timeline-content -->
	</div> <!-- cd-timeline-block -->
	@endforeach
</div>

<!-- <div> -->
@endsection