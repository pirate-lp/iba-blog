<template>
<div class="blog">
<!--
	<div v-for="(pieces, year) in underscore.toArray(items).reverse()" key="year">
		<div class="blog-year-header"><h2>Year {{ Object.keys(items)[year] }}</h2></div>
		<div v-for="(posts, month) in underscore.toArray(pieces).reverse()" key="month">
			<div class="blog-month-header"><h3>{{ mon(Object.keys(pieces)[month]) }}</h3><small>{{ Object.keys(items)[year] }}</small></div>
			<div class="persons-gallery gallery-1-2-3-4" v-masonry transition-duration="0.3s" item-selector=".post-s">
				<post v-for="post in posts" :content="post" key="month" v-masonry-tile class="post-s">
				</post>
			</div>
		</div>
	</div>
-->
	<div class="blog-year-section" v-for="year in (endOfTime - startOfTime + 1)" v-if="items.length > 0">
		<div class="blog-year-header"><h2>Year {{ endOfTime - year + 1 }}</h2></div>
		<div class="month" v-for="month in 12" v-if="checkTimeSpan(year,month)">
			<div class="blog-month-header"><h3>{{ monthText(month) }}</h3><small>, {{ endOfTime - year + 1 }}</small></div>
			<div v-masonry transition-duration="0.3s" item-selector=".post-s-box">
			<template v-for="(item, index) in items">
				<post v-if="check(item,year,month)" :content="item" :key="item.id" v-masonry-tile  class="post-s-box">
				</post>
			</template>
			</div>
		</div>
	</div>
	<div v-else-if="requestSent">
		<h2>Opps ... !</h2>
		<p>Nothing interesting here ...</p>
	</div>
</div>
</template>

<script>

import Post from '../components/Post'
import app from '../configs/app'
var _ = require('underscore')
var moment = require('moment')
import Masonry from 'masonry-layout'

export default {
	data () {
		return {
			posts: {},
			items: {},
			underscore: _,
			startOfTime: 0,
			endOfTime: 1,
			first: 0,
			last: 1,
			requestSent: false,
		}
	},
	components: {
		Post,
	},
	methods: {
		initiate() {
			let self = this;
			if ( this.$route.query.tag ) {
				if ( !_.isEmpty(this.post) ) {
					self.items = _.filter(self.posts, function (item) {
						return self.hasKeyword(item, self.$route.query.tag)
						});
				} else {
					this.$http.get(app.host + '?tag=' + this.$route.query.tag )
						.then(function(response){
							self.items = _.toArray(response.data)
							self.requestSent = true;
						});
				}
			} else if ( this.$route.name == 'categories' ) {
				if ( !_.isEmpty(this.posts) ) {
					self.items = _.filter(self.posts, function (item) {
						return self.hasCategory(item, self.$route.params.slug)
						});
				} else {
					this.$http.get(app.host + '/categories/' + this.$route.params.slug )
						.then(function(response){
							self.items = _.toArray(response.data)
							self.requestSent = true;
						});
				}
			} else {
				this.$http.get(app.host + '/index/')
					.then(function(response){
						self.posts = response.data 
						self.items = _.toArray(self.posts);
						self.requestSent = true;
					});
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
				for ( var bundle in item.bundles ) {
					if ( item.bundles[bundle].type == 'category' && (item.bundles[bundle].slug.value == slug) ) {
						return true
					}
				}
			}
			return false
		},
		hasKeyword(item, keyword) {
			if ( item.keywords) {
				for ( var word in item.keywords ) {
					if ( item.keywords[word] == keyword ) {
						return true
					}
				}
			}
			return false
		},
		check(post, year, month) {
			return ( ( moment(post.timestamp.publish).year() == (this.endOfTime - year + 1) ) && ( moment(post.timestamp.publish).month() == (12 - month) ) );
		},
		checkTimeSpan(year,month) {
			let current = moment().year( (this.endOfTime - year) + 1 ).month((12-month))
			var first = moment.unix(this.first)
			return ( (this.first <= current.unix() && (current.unix() <= this.last) ) ||  ( (first.year() == current.year()) && (first.month() == current.month()) )  )
		},
		monthText(date) {
			date = 12 - date ;
			return moment().month(date).format('MMMM')
		},
	},
	created() {
		this.initiate()
	},
	watch: {
        items:function() {
	        let first = moment(_.first(this.items).timestamp.publish);
	        let last = moment(_.last(this.items).timestamp.publish);
	        this.first = Math.min(first.unix(),last.unix())
	        this.last =  Math.max(first.unix(),last.unix())
	        this.startOfTime = Math.min(first.year(),last.year());
	        this.endOfTime = Math.max(first.year(),last.year());
	        this.$redrawVueMasonry();
        },
        $route() {
	        this.initiate()
        },
    }
}
</script>

<style>
.blog {
	text-align: left;
}
.post-s-box {
	width: 100%;
	padding: 0.2rem 0.4rem;
	box-sizing: border-box;
}
.blog-year-section {
	margin-bottom: 20vh;
}
.blog-month-header > * {
	display: inline-block;
}
.blog-year-header {
	padding: 0rem 1.5rem;
}
.blog-month-header {
	padding: 1rem 2rem;
}
@media screen and (min-width: 35.5em) {
	.post-s-box {
		padding: 0.2rem;
		width: 50%;
	}
	.post-s-width--2 {
		width: 100%;
	}
}
@media screen and (min-width: 48em) {
	.month {
/* 		float:left; */
	}
	.post-s-box {
		width: 50%;
	}
}
@media screen and (min-width: 64em) {
	.post-s-box {
		width: 33%;
	}
	.post-s-width--2 {
		width: 66%;
	}
}
@media screen and (min-width: 80em) {
	.post-s-box {
		width: 25%;
	}
	.post-s-width--2 {
		width: 50%;
	}
}
</style>
