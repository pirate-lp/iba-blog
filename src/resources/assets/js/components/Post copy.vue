<template>
<div>
	<router-link :to="uri()" class="post-s shadow">
		<div>
			<span class="mc tag">{{ content.timestamp.publish | fromNow }}</span> | 
			<template v-if="content.bundles">
				<span v-for="bundle in content.bundles" v-if="bundle.type == 'category'" class="tag sc">
					{{ bundle.title.value }}
				</span>
			</template>
		</div>
<!--
		@if ( $post->bundle('category') !== NULL )
			@foreach ( $post->bundle('category') as $category )
				<span style="color: #333">{{ $category->title->value }}</span>
			@endforeach
		@endif
-->
		<template v-if="content.thumbnail">
			<img :src="thumbnail()" style="" />
		</template>
		<h4 v-html="content.title.value"></h4>
	</router-link>
</div>
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
