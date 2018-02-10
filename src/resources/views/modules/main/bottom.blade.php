<div class="blog-bottom blog-contact">
	
	<div class="blog-footer">
		@foreach ( config('iba-blog.footer') as $title => $text )
			<div id="footer-{{ $loop->iteration }}" class="content no">
				<header>
					<h4>{{ title_case($title) }}</h4>
				</header>
				{!! $text !!}
			</div>
		@endforeach
	</div>
	
	<div class="menu pure-menu pure-menu-horizontal pure-menu-scrollable">
		<ul class="pure-menu-list">
			@foreach ( config('iba-blog.footer') as $title => $text )<li class="pure-menu-item"><a onclick="jQuery('#footer-{{ $loop->iteration }}').toggle();" href="#footer-{{ $loop->iteration }}" class="pure-menu-link">{{ title_case($title) }}</a></li>@endforeach
		</ul>
	</div>
	
</div>