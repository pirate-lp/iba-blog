@foreach ( $keywords as $keyword )
	<a href="/weblog/?tag=<?php echo urlencode( $keyword->word ); ?>">#{{ $keyword->word }}</a>, 
@endforeach