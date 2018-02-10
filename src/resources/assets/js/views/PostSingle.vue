<template>
	<modal v-on:close="close()">
		<div class="post-single" @mousedown.stop="close()" @touchstart.stop="close()">
			
			<div class="container shadow"  v-if="!isNaN($route.params.id)" @mousedown.stop @touchstart.stop>
				<article class="text">
					<template v-if="content.thumbnail">
						<img :src="content.thumbnail.name" style="" />
					</template>
					<h1 v-html="content.title.value"></h1>
				

					<p><span class="mc tag">{{ content.timestamp.publish | date }}</span> | 
					<template v-if="content.bundles">
						<template v-for="bundle in content.bundles" v-if="bundle.type == 'category'">
							<router-link class="inlink-sc" :to="{ name: 'categories', params: { slug: bundle.slug.value }}">
								{{ bundle.title.value }}
							</router-link>
						</template>
					</template>
					</p>
				</article>
				<article class="text" v-html="content.content"></article>
			</div>
			
			<div class="tag-container" @mousedown.stop @touchstart.stop>
				<template v-if="content.keywords">
					<template v-for="keyword in content.keywords">
						<span class="tag"><router-link :to="{ name: 'home', query: { tag: keyword.word }}">
							{{ keyword.word }}
						</router-link></span>
					</template>
				</template>
			</div>
			
			<div class="container shadow"  v-if="isNaN($route.params.id)" @mousedown.stop @touchstart.stop>
				<article class="text">
					<h1 v-html="content.title"></h1>
					<p><span v-html="content.date"></span></p>
				</article>	
				<article class="text" v-html="content.content"></article>
			</div>
		
		</div>
	</modal>
</template>

<script>
	
import app from '../configs/app'
import Modal from '../components/elements/Modal'
var _ = require('underscore')
var moment = require('moment')

export default {
	props: ['route'],
	data () {
		return {
			content: {
				title: {
					value: '',
				},
				date: {
					
				},
				timestamp: {
					publish: ''
				},
			},
			underscore: _,
		}
	},
	components: {
		Modal,
	},
	metaInfo () {
		return {
			title: this.content.id + ' | ' + Window.Config.title,
			meta: [{ vmid: 'description', name: 'description', content: this.content.title.value }],
		}
	},
	methods: {
		close() {
			this.back()
		},
		initialize() {
			let self = this;
			this.$http.get(app.host + '/' + this.$route.params.id )
				.then( function(response) {
					if ( !isNaN(self.$route.params.id) ) {
						self.content = response.data
					} 
					else
					{
						self.content = response.data.leaf
					}
				});
			
		},
		back() {
			if (this.route == 0) {
				this.$router.push({ path: '/' })
				return;
			}
			this.$router.go(-1)
		},
	},
	mounted() {
		this.initialize();
		
	},
	filters: {
		date(date) {
			return moment(date).format("MMMM D, YYYY");
		}
	},
	watch: {
		'$route.params.id': function() {
			this.initialize();
		}
	},
}
</script>

<style scoped lang="scss">
</style>
<style lang="sass">
</style>
