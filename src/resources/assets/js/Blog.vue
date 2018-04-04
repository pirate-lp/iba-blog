<template>
	<div class="blog">
		
		<div class="blog-contact blog-top">
			<div class="menu pure-menu pure-menu-horizontal pure-menu-scrollable">
				<ul class="pure-menu-list">
					</li><li class="pure-menu-item"><a v-on:click="dashboardToggle('introduction')" class="extra pure-menu-link">Introduction</a>
			    	</li><li class="pure-menu-item"><a v-on:click="dashboardToggle('search')" class="extra pure-menu-link">Mentioned People</a>
			    	</li><li class="pure-menu-item"><a v-on:click="dashboardToggle('tags')" class="extra pure-menu-link">Tags</a>
			    	</li><!--
			    	<li class="pure-menu-item">
			    		<router-link to="/" class="pure-menu-link">All Posts</router-link>
			    		</li>
					--><li class="pure-menu-item" v-for="category in categories">
			    		<router-link :to="{ name: 'categories', params: { slug: category.slug.value }}" class="pure-menu-link">{{ category.title.value }}</router-link></li>
				</ul>
			</div>
		</div>
		
		<dashboard :introduction="introduction"></dashboard>
		
		<router-view name="back" :collection="collection" :posts="posts" :title="title"></router-view>
		<router-view name="single" :route="route"></router-view>
		
		<div class="blog-footer">
			<template v-for="(text, item, index) in footer">
				<div :id="'footer-' + index" class="content no" v-html="text">
				</div>
			</template>
		</div>
		
		<div class="blog-bottom blog-contact">
			<div class="menu pure-menu pure-menu-horizontal pure-menu-scrollable">
				<ul class="pure-menu-list">
					<li class="pure-menu-item" v-for="(text, item, index) in footer">
						<a v-on:click="onClick(index)" :href="'#footer-' + index" class="pure-menu-link">{{ item | capitalize }}</a>
					</li>
				</ul>
			</div>
		</div>
		
	</div>
</template>

<script>
import app from './configs/app.js'
import Dashboard from './components/Dashboard'

var _ = require('underscore')
var moment = require('moment')

export default {
	name: 'Blog',
	components: {
		Dashboard,
	},
	data () {
		return {
			categories: {},
			collection: {},
			posts: {},
			underscore: _,
			startOfTime: 0,
			endOfTime: 1,
			first: 0,
			last: 1,
			requestSent: false,
			title: '',
			route: 0,
// 			footerD: {},
			head: '',
		}
	},
	metaInfo () {
		return {
			title: this.head + ' | ' + Window.Config.title,
			meta: [{ vmid: 'description', name: 'description', content: Window.Config.description }]
		}
	},
	mounted () {
		let self = this;
		this.$http.get(app.host + '/modules/categories/')
			.then(function(response) {
				self.categories = response.data 
			});
	},
	methods: {
		initiate() {
			let self = this;
			if ( this.$route.query.tag ) {
				if ( !_.isEmpty(this.posts) ) {
					self.collection = _.filter(self.posts, function (item) {
						return self.hasKeyword(item, self.$route.query.tag)
						});
				} else {
					this.$http.get(app.host + '?tag=' + this.$route.query.tag )
						.then(function(response){
							self.collection = _.toArray(response.data)
							self.requestSent = true;
						});
					console.log("One")
				}
				this.title = this.$route.query.tag;
				this.head = this.$route.query.tag;
			} else if ( this.$route.query.mention ) {
				if ( !_.isEmpty(this.posts) ) {
					self.collection = _.filter(self.posts, function (item) {
						return self.hasMention(item, self.$route.query.mention)
						});
				} else {
					this.$http.get(app.host + '?mention=' + this.$route.query.mention )
						.then(function(response){
							self.collection = _.toArray(response.data)
							self.requestSent = true;
						});
					console.log("People")
				}
				this.title = '<small>Person mentioned: </small><br/>' + this.$route.query.identifier;
				this.head = this.$route.query.identifier + 'mentioned';
// 				this.title = this.$route.query.tag;
			} else if ( this.$route.name == 'categories' ) {
				if ( !_.isEmpty(this.posts) ) {
					self.collection = _.filter(self.posts, function (item) {
						return self.hasCategory(item, self.$route.params.slug)
						});
				} else {
					this.$http.get(app.host + '/categories/' + this.$route.params.slug )
						.then(function(response){
							self.collection = _.toArray(response.data)
							self.requestSent = true;
						});
						console.log("Two")
				}
				this.title = '';
				this.head = this.$route.params.slug;
			} else if ( this.$route.name != 'post' ) {
				console.log("hi")
				if ( _.isEmpty(this.posts) ) {
					this.$http.get(app.host + '/index/')
					.then(function(response){
						self.posts = response.data 
						self.collection = _.toArray(self.posts);
						self.requestSent = true;
					});
					console.log("Three")
				} else {
					self.collection = _.toArray(this.posts);
				}
				this.title = null;
				this.head = '';
			}
/*
			if ( this.$route.path == '/' ) {
				this.$http.get(app.host + 'index/')
					.then(function(response){
						self.posts = response.data 
						self.items = _.toArray(self.posts);
						self.requestSent = true;
					});
			}
*/
			
		},
		
		hasCategory(item, slug) {
			if ( item.bundles) {
				for ( var n in item.bundles ) {
					if ( item.bundles[n].type == 'category' && (item.bundles[n].slug.value == slug) ) {
						return true
					}
				}
			}
			return false
		},
		hasKeyword(item, keyword) {
			if ( item.keywords) {
				for ( var n in item.keywords ) {
					if ( item.keywords[n].word == keyword ) {
						return true
					}
				}
			}
			return false
		},
		hasMention(item, person) {
			if ( item.people) {
				for ( var n in item.people ) {
					if ( item.people[n].id == person && item.people[n].pivot.role == "mention" ) {
						return true
					}
				}
			}
			return false
		},
		
		toggleFooter(item) {
			let id = '#footer' + item
			$(id).toggle();
		},
/*
		toggleFooter(item) {
			if ( this.footerD[item] == true ) {
				console.log(item)
				this.footerD[item] = false
			} else  { this.footerD[item] = true }
			console.log(this.footerD[item])
		},
		
*/
		onClick(item) {
// 			let id = '#footer-'+ item
			let id = 'footer-' + item;
// 			$(id).toggle();
			this.dashboardToggle(id);
		},
		
		
		dashboardToggle(id) {
			let element = document.getElementById(id);
			if (element.style.maxHeight){
				element.style.maxHeight = null;
			} else { 
				element.style.maxHeight = element.scrollHeight + "px";
			}
		}
		
	},
	filters: {
		capitalize: function(text) {
			return text[0].toUpperCase() + text.slice(1);
		}
	},
	created() {
		this.initiate()
	},
	watch: {
        
        $route() {
	        this.initiate()
	        this.route = this.route + 1
        },
    },
    computed: {
	    introduction() {
		    return Window.Config.introduction
	    },
	    footer() {
/*
		    for (var variable in Window.Config.footer) {
			    this.footerD[variable] = false
		    }
*/
		    return Window.Config.footer
	    },
    },
}
</script>


<!--
<style lang="sass">
	@import "node_modules/purecss/build/pure-min";
	@import "node_modules/purecss/build/grids-responsive-min";
</style>
-->
<style scoped>

</style>
