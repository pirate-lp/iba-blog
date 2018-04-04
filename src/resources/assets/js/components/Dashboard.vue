<template>

<div class="blog-header">
	<div id="introduction" class="content" v-html="introduction">
	</div>
	
	<div id="tags" class="content">
		<header><h4>Tags</h4></header>
		<div v-if="tags" style="overflow: auto;">
			<template v-for="tag in tags">
				<div class="tag"><router-link :to="{ name: 'home', query: { tag: tag.word }}">#{{ tag.word }}</router-link></div>
			</template>
		</div>
	</div>
	
	<div id="search" class=" content">
		<people></people>
	</div>
	
</div>

</template>

<script>

import app from '../configs/app'
import People from '../components/People'

export default {
	name: 'Dashboard',
	props: ['introduction'],
	components: {
		People,
	},
	data () {
		return {
			tags: {},
			categories: {},
			dashboard_1: '',
			dashboard_2: '',
		}
	},
	methods: {
	},
	created() {
		let self = this
		this.$http.get(app.host + '/modules/tags/')
			.then(function(response){
				self.tags = response.data 
				});
		this.$http.get(app.host + '/modules/categories/')
			.then(function(response){
				self.categories = response.data 
			});
		this.dashboard_1 = Window.Config.dasbhoard_1
		this.dashboard_2 = Window.Config.dasbhoard_2
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
	}
}
</script>

<style scoped>
.tag {
	float: left;
}
</style>