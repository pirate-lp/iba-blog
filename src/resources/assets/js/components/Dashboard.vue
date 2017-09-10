<template>
<div id="dashboard-right-content" class="mobile-no">
	<div html="dashboard_1">
	</div>
	<section class="dashboard-gray">
		<header><h4>Tags</h4></header>
		<div v-if="tags">
			<span v-for="tag in tags"><router-link :to="{ name: 'home', query: { tag: tag.word }}">
						#{{ tag.word }}
					</router-link></span>
		</div>
	</section>
	<div html="dashboard_2">
	</div>
</div>
</template>

<script>

import app from '../configs/app'

export default {
	name: 'Dashboard',
	props: [],
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
</style>