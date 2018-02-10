<div class="blog-contact blog-top">

	<div class="menu pure-menu pure-menu-horizontal pure-menu-scrollable">
		<ul class="pure-menu-list">
			<li class="pure-menu-item"><a onclick="$('#intro').toggle()" class="extra pure-menu-link">Introduction</a>
			</li><li class="pure-menu-item"><a onclick="$('#search').toggle()" class="extra pure-menu-link">Mentioned People</a>
			</li><li class="pure-menu-item"><a onclick="$('#tags').toggle()" class="extra pure-menu-link">Tags</a></li>@foreach($categories as $category)<li class="pure-menu-item"><a href="{{ url(config('iba-blog.analog.uri') . '/categories', $category->slug->value) }}" class="pure-menu-link"">{{ $category->title->value }}</a></li>@endforeach
		</ul>
	</div>
	
	<div id="intro" class="no content">
	    <p>{{ config('iba-blog.intro') }} How are you?</p>
	</div>
	<div id="tags" class="no content">
		<header><h4>Tags</h4></header>
		<div>
			<p>
			@include('iba-blog::modules.tags')
			</p>
		</div>
	</div>
	<div id="search" class="no content">
		<form>
			<div class="field-label is-normal is-small">
				<label></label>
			</div>
			<div class="field-body">
				<input id="select-people" name="mention" type="text" >			</div>
			<script>
				$( document ).ready(function() {
	$('#select-people').selectize({
	    valueField: 'id',
	    labelField: 'identifier',
	    searchField: 'identifier',
	    maxItems: 1,
 	    create: true,
/* 
	    score: function(search) {
	        var score = this.getScoreFunction(search);
	        return function(item) {
	            return score(item) * (1 + Math.min(item.watchers / 100, 1));
	        };
	    },
*/
	    load: function(query, callback) {
	        if (!query.length) return callback();
	        $.ajax({
	            url: '{{ config('iba-blog.host') }}' + '/' + '{{ config('iba-blog.analog.uri') }}' + '/modules/people/search/?person=' + encodeURIComponent(query),
	            type: 'GET',
	            error: function() {
	                callback();
	            },
	            success: function(res) {
	                callback(res.slice(0, 10));
	            }
	        });
	    },
	});
	});
</script>
		<button type="submit" class="pure-button pure-button-primary">Search</button>
	</form>
	</div>
</div>