<template>
<div >
	<div class="post-single">
	<article class="text shadow"  v-if="!isNaN($route.params.id)">
		<div>
			<template v-if="content.thumbnail">
				<img :src="content.thumbnail.name" style="" />
			</template>
			<h1 v-html="content.title.value"></h1>
		</div>
		<div>
			<span class="mc tag">{{ content.timestamp.publish | date }}</span> | 
			<template v-if="content.bundles">
				<template v-for="bundle in content.bundles" v-if="bundle.type == 'category'">
					<router-link class="inlink-sc" :to="{ name: 'categories', params: { slug: bundle.slug.value }}">
						{{ bundle.title.value }}
					</router-link>
				</template>
			</template>
		</div>
		<div v-html="content.content">
		</div>
		<div>
			<template v-if="content.keywords">
				<template v-for="keyword in content.keywords">
					<span class="mc"><router-link :to="{ name: 'home', query: { tag: keyword.word }}">
						#{{ keyword.word }}
					</router-link>, </span> 
				</template>
			</template>
		</div>
	</article>
	<article class="text shadow"  v-if="isNaN($route.params.id)">
		<div>
			<h2>{{ content.title }}</h2>
		</div>
		<div v-html="content.content">
		</div>
	</article>
	</div>
</div>
</template>

<script>
	
import app from '../configs/app'
var _ = require('underscore')
var moment = require('moment')

export default {
	data () {
		return {
			content: {},
			underscore: _,
		}
	},
	components: {
	},
	methods: {
		initialize() {
			let self = this;
			this.$http.get(app.host + '/' + this.$route.params.id )
				.then(function(response){
					self.content = response.data 
				});
			
		}
	},
	created() {
		this.initialize();
	},
	filters: {
		date(date) {
			return moment(date).format("MMMM D, YYYY");
		}
	},
	watch: {
		'$route.params.id': function() {
			this.content = {};
			this.initialize();
		}
	},
}
</script>

<style>
.post-single {
	padding: 2rem 0px 1rem 0px;
}
.tag-sc {
	background-color: #e691e6;
}
@media screen and (min-width: 64em) {
	.post-single {
		margin: 0px 5vw;
	}
}
@media screen and (min-width: 80em) {
	.post-single {
		margin: 0px 10vw;
	}
}
</style>
