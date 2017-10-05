<template>

<div class="blog">
	
	<dashboard :introduction="introduction"></dashboard>
	
	<div class="cd-contact cd-top">
		<div class="menu pure-menu pure-menu-horizontal pure-menu-scrollable">
			<ul class="pure-menu-list">
				</li><li class="pure-menu-item"><a onclick="$('#introduction').toggle()" href="#intro" class="extra pure-menu-link">Introduction</a>
		    	</li><li class="pure-menu-item"><a onclick="$('#search').toggle()" href="#search" class="extra pure-menu-link">Search</a>
		    	</li><li class="pure-menu-item"><a onclick="$('#tags').toggle()" href="#tags" class="extra pure-menu-link">Tags</a>
		    	</li><!--
		    	<li class="pure-menu-item">
		    		<router-link to="/" class="pure-menu-link">All Posts</router-link>
		    		</li>
				--><li class="pure-menu-item" v-for="category in categories">
		    		<router-link :to="{ name: 'categories', params: { slug: category.slug.value }}" class="pure-menu-link">{{ category.title.value }}</router-link></li>
			</ul>
		</div>
	</div>
	
	<router-view name="back" :collection="collection" :posts="posts" :title="title"></router-view>
	<router-view name="single" :route="route"></router-view>
	
	<div class="cd-bottom cd-contact">
		<div class="menu pure-menu pure-menu-horizontal pure-menu-scrollable">
			<ul class="pure-menu-list">
				<li class="pure-menu-item" v-for="(text, item) in footer">
					<a v-on:click="onClick(item)" :href="'#footer-' + item" class="pure-menu-link">{{ item | capitalize }}</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="cd-footer">
		<template v-for="(text, item) in footer">
			<div :id="'footer-' + item" class="content no" v-html="text">
			</div>
		</template>
	</div>
<!--
<div class="cd-footer">
	<div id="footer-follow" class="no">
		<header>
	        <h4></h4>
	    </header>
	    <div id="sidebar-follow">
			{{ config.follow }}
	    </div>
	</div>
	<div id="footer-contact" class="no">
	    <header>
	        <h4>Contact</h4>
	    </header>
	    <div id="sidebar-contact">
	        {{ config.contact }}
	    </div>
	</div>
	<div id="footer-gratitude" class="no">
	    <header>
	        <h4>Gratitude</h4>
	    </header>
	    <div id="sidebar-contact">
	        {{ config.gratitude }}
	    </div>
	</div>
	<div id="footer-policy" class="no">
	    <header>
	        <h4>Gratitude</h4>
	    </header>
	    <div id="sidebar-contact">
	        {{ config.policy }}
	    </div>
	</div>
</div>
-->
	
	
	

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
			let id = '#footer-'+ item
			$(id).toggle();
			console.log(id);
			console.log($(id).val())
		},
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
