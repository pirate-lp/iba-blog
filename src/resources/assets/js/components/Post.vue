<template>
	
	<div class="cd-timeline-block">
		
		<div class="cd-timeline-img cd-picture">
		</div>
		
		<router-link :to="uri()" class="cd-timeline-content">
			
			<template v-if="content.thumbnail">
				<img :src="thumbnail()" style="" />
			</template>
			
			
	        	
<!--
				<span class="timeline-content-info-date">
	            	<i class="fa fa-calendar-o" aria-hidden="true"></i>
					{{ content.timestamp.publish | fromNow }}
				</span>
-->
			
			
			<div class="cd-aside">
				<span class="date">{{ content.timestamp.publish | date }}</span>
				
				<span class="timeline-content-info-title">
					<template v-if="content.bundles">
						<span v-for="bundle in content.bundles" v-if="bundle.type == 'category'" class="tag sc">
							{{ bundle.title.value }}
						</span>
					</template>
				</span>
				
			</div>
			
			<h3 v-html="content.title.value"></h3>
	        
	        <div class="timeline-content-info">
	        <template v-if="content.keywords">
	        	<span v-for="keyword in content.keywords" class="tag sc">
					{{ keyword.word }}
				</span>
			</template>
			</div>
	       
	        
	       
		</router-link> <!-- cd-timeline-content -->
	</div>

<!--
		@if ( $post->bundle('category') !== NULL )
			@foreach ( $post->bundle('category') as $category )
				<span style="color: #333">{{ $category->title->value }}</span>
			@endforeach
		@endif
-->
</template>

<script>

var moment = require('moment');

export default {
	name: 'Post',
	props: ['content'],
	data () {
		return {
		}
	},
	methods: {
		uri() {
			return '/' + this.content.id + '/';
		},
		thumbnail() {
			return '/blog/' + this.content.id + '/' + this.content.thumbnail.name;
		},
	},
	mounted() {
	},
	filters: {
		capitalize: function(text) {
			return text[0].toUpperCase() + text.slice(1);
		},
		fromNow: function(date) {
			return moment(date).fromNow();
		},
		date: function(time) {
			return moment(time).format('MMMM D, YYYY');
		}
	},
	watch: {
		books(value) {
			this.items = value;
		}
	}
}
</script>

<style scoped>
.post-s {
	display: block;
	padding: 0.7rem 1rem 1rem 1rem;
	border: none;
	border-radius: 0.4rem;
	color: black;
	text-shadow: none;
	background-color: white;
	
}
.tag {
	font-size: 0.8em;
}
img {
	display: block;
	margin: 0px auto 1rem auto;
	max-width: 100%;
	max-height: 30vh;
	border-radius: 0.4rem;
}

</style>
