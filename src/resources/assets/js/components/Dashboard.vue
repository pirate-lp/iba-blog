<template>
<div id="dashboard-right-content" class="mobile-no">
	
	<section itemprop="about"  class="dashboard-gray">
	    <header><h4>Introduction</h4></header>
	    <p>It is just to have an answer to that question “what are you doing?” ...</p>
	    <p style="text-align: right;"><router-link :to="{ name: 'post', params: { id: 'introduction' } }">read the rest</router-link></p>
	</section>
<!--
	<section class="dashboard-gray">
		<header><h4>Categories</h4></header>
		<p></p>
		<div style="text-align: left;">
			<ul>
	    		<li v-for="category in categories">
	    			<router-link :to="{ name: 'categories', params: { slug: category.slug.value }}">{{ category.title.value }}</router-link>
	    		</li>
			</ul>
		</div>
			<p></p>
	</section>
-->
	<div style="margin-bottom: 24px;">
<!--
	    <nav class="in-section" style="margin: 0px;">
	        <header>all ideas at <a class="mc" href="/">Lost Ideas Lab</a></header>
	        <ul class="y">
			</ul>
		</nav>
-->
	</div>
		
	<section class="dashboard-gray">
		<header><h4>Tags</h4></header>
		<div v-if="tags">
			<span v-for="tag in tags"><router-link :to="{ name: 'home', query: { tag: tag.word }}">
						#{{ tag.word }}
					</router-link></span>
		</div>
	</section>
	<section  class="dashboard-gray" style="text-align: left;">	    
	    <header><h4>Search</h4></header>
	    <!--<ul class="related-topics" style="font-size: 0.9em;">
	    	<li>
		    	@foreach ( $mentions as $mention )
	    			<a class="inlink-sc" href="/blog/?people=<?php echo urlencode( $mention->detail->identifier ); ?>" rel="people">{{ $mention->detail->identifier }}</a>
	    		@endforeach 
            </li>
        </ul>-->
       
        
	</section>
	<section class="dashboard-gray">
		<header>
	        <h4><a onclick="jQuery('#sidebar-follow').toggle();">Follow me</a></h4>
	    </header>
	    <div id="sidebar-follow">
			<p>Thanks for your interest in what I'm doing ...</p>
			<h5>Subscribe <sup>*</sup></h5>
			<p><small><a class="inlink" href="https://www.bloglovin.com/blogs/lost-ideas-lab-blog-18989397" target="_blank">BLOGLOVIN'</a> <a class="inlink-sc" href="/blog/feed/atom/" target="_blank"><i class="fa fa-rss" aria-hidden="true"></i> Atom</a> <a class="inlink-sc" href="/blog/feed/rss/" target="_blank"><i class="fa fa-rss" aria-hidden="true"></i> RSS</a></small></p>
			<h5>Social Media</h5>
			<p><a class="inlink" href="https://www.facebook.com/lostideaslab/" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a> <a class="inlink" href="https://twitter.com/hossein_lil" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></p>
			<footer><p><small>* <a href="/humane-internet/carnet/rss-readers/">What is RSS and how to use it?</a></small></p></footer>
	    </div>
	</section>
<!--
	<section class="dashboard-gray">
		<header>
	        <h4><a onclick="jQuery('#sidebar-social').toggle();"></a></h4>
	    </header>
	    <div id="sidebar-social">
			
	    </div>
	</section>
-->
	<section class="dashboard-gray">
	    <header>
	        <h4><a onclick="jQuery('#sidebar-contact').toggle();">Contact</a></h4>
	    </header>
	    <div id="sidebar-contact">
	        <p>Thanks for passing by.</p>
	        <p>The best way to contact us at the moment would be to drop us a mail at <a href="mailto:info@lostideaslab.com">info@lostideaslab.com</a>.</p>
	        <p><small>For other information please visit <a href="/contact/">Lost Ideas Lab's contact section</a>.</small></p>
	    </div>
	</section>
	<section class="dashboard-gray">
	    <header>
	        <h4><a onclick="jQuery('#sidebar-gratitude').toggle();">Gratitude</a></h4>
	    </header>
	    <div id="sidebar-gratitude">
	        <p>Thanks, everyone who helped us on our way.</p>
	        <p>A. S. and N. thank you very very much.</p>
	        <p>The worshippers’ thanksgiving and Adoration is due only to Allah: The Creator and Nurturer of the worlds [And their inhabitants];</p>
	    </div>
	</section>
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
		}
	},
	methods: {
	},
	created() {
		let self = this
		this.$http.get(app.host + 'modules/tags/')
			.then(function(response){
				self.tags = response.data 
				});
		this.$http.get(app.host + 'modules/categories/')
			.then(function(response){
				self.categories = response.data 
			});
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