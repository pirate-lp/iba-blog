<template>
	
	<div id="cd-timeline" class="cd-container">
	
	<header v-if="title">
		<h1 v-html="title"></h1>
	</header>
	
	<post v-for="post in items" :content="post" key="post.id">
	</post>
	
</div>
</template>

<script>

import Post from '../components/Post'
import app from '../configs/app'
var _ = require('underscore')
var moment = require('moment')
import Masonry from 'masonry-layout'

export default {
	props: ['posts', 'collection', 'title'],
	data () {
		return {
// 			posts: {},
// 			collection: {},
			items: {},
			underscore: _,
			startOfTime: 0,
			endOfTime: 1,
			first: 0,
			last: 1,
			requestSent: false,
			config: {},
		}
	},
	components: {
		Post,
	},
	methods: {
		
		
		check(post, year, month) {
			return ( ( moment(post.timestamp.publish).year() == (this.endOfTime - year + 1) ) && ( moment(post.timestamp.publish).month() == (12 - month) ) );
		},
		checkTimeSpan(year,month) {
			let current = moment().year( (this.endOfTime - year) + 1 ).month((12-month))
			var first = moment.unix(this.first)
			var last = moment.unix(this.last).day(31).hour(23).minutes(59)
			return ( (this.first <= current.unix() && (current.unix() <= last.unix()) ) ||  ( (first.year() == current.year()) && (first.month() == current.month()) )  )
		},
		monthText(date) {
			date = 12 - date ;
			return moment().month(date).format('MMMM')
		},
		
		collect() {
	        this.items = _.sortBy(this.collection, function(item) {
		        return item.timestamp.publish;
		        }).reverse();
	        let first = moment(_.first(this.items).timestamp.publish);
	        let last = moment(_.last(this.items).timestamp.publish);
	        this.first = Math.min(first.unix(),last.unix())
	        this.last =  Math.max(first.unix(),last.unix())
	        this.startOfTime = Math.min(first.year(),last.year());
	        this.endOfTime = Math.max(first.year(),last.year());
	        this.$redrawVueMasonry();
        },
	},
	mounted() {
		this.collect()
	},
	watch: {
        collection() { 
	        this.collect()
	    },
/*
        $route() {
	        this.initiate()
        },
*/
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
