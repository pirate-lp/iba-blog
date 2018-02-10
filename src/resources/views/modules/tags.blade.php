@foreach ( $keywords as $keyword )
	<a href="{{ url(config('iba-blog.analog.uri')) }}/?tag=<?php echo urlencode( $keyword->word ); ?>">{{ $keyword->word }}</a>, 
@endforeach