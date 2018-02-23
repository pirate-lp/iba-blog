@extends('iba-blog::weblog.base')

@push('title') {{ $post->title->value  }} | Blog @endpush

@section('main')

	<div class="post-single">
	
		<div class="container shadow"  v-if="!isNaN($route.params.id)">
			
			<article class="text" itemscope itemtype="http://schema.org/LiveBlogPosting">
				
				<header>
					
					@if ( $post->thumbnail )
						<img itemprop="image" src="/weblog/{{ $post->id }}/{{ $post->thumbnail->name }}" />
					@endif
			
					<h2 itemprop="headline"><a href="/weblog/{{ $post->id }}/">{{ $post->title->value }}</a></h2>
					
					<span class="mc">{{ $post->timestamp->publish->diffForHumans() }}</span>
					
					 | 
					@if ( $post->bundle('category')->count() > 0 )
						@foreach ( $post->bundle('category')->get() as $category )
							<span style="color: #333"><a href="/weblog/categories/{{ $category->slug->value }}/">{{ $category->title->value }}</a></span>
						@endforeach
					@endif
					
				</header>
				
				{!! $post->content() !!}
				
			</article>
			
		</div>
		
		<div class="tag-container">
			@foreach ( $post->keywords as $keyword)
				<span class="tag"><a href="{{ url(config('iba-blog.analog.uri')) }}/?tag=<?php echo urlencode( $keyword->word ); ?>">{{ $keyword->word }}</a></span>
			@endforeach
		</div>
	</div>
	
@endsection