<template>
	<div>
	<header>
	<nav class="pure-menu pure-menu-horizontal pure-menu-scrollable">
	    <ul class="pure-menu-list">
	    	<li class="pure-menu-item sc"><router-link to="/">Index</router-link>
	    	</li><li class="pure-menu-item" v-for="category in categories">
	    		<router-link :to="{ name: 'categories', params: { slug: category.slug.value }}">{{ category.title.value }}</router-link>
	    	</li>
		</ul>
	</nav>
<!--
	    <div class="logo">
		   <h1 style="display: inline-block;" itemprop="name"><router-link to="/">Lost Idea Lab's Blog</router-link></h1>
		</div>
-->
		<nav class="mobile-yes" style="width: 100%;">
		    <ul>
		        <li style="margin: 0rem 1rem 2rem 1rem;"><a class="inline-sc" onclick="$('#mobile-dashboard').toggle();">Dashboard</a></li>
		    </ul>
		    <dashboard id="mobile-dashboard"></dashboard>
		</nav>
	</header>
	<div class="pure-g">
		<div class="cen pure-u-1-1 pure-u-sm-23-24 pure-u-md-2-3 pure-u-lg-3-4 pure-u-xl-4-5">
		    <router-view template></router-view>
	    </div>
	    <div class="cen pure-u-1-1 pure-u-sm-23-24 pure-u-md-1-3 pure-u-lg-1-4 pure-u-xl-1-5">
			<dashboard id="mobile-dashboard"></dashboard>
	    </div>
	</div>

</div>
</template>

<script>
import app from './configs/app.js'
import Dashboard from './components/Dashboard'

export default {
	name: 'Blog',
	components: {
		Dashboard,
	},
	data () {
		return {
			categories: {},
		}
	},
	mounted() {
		let self = this;
		this.$http.get(app.host + '/modules/categories/')
			.then(function(response){
				self.categories = response.data 
			});
	},
	methods: {
	},
	filters: {
		capitalize: function(text) {
			return text[0].toUpperCase() + text.slice(1);
		}
	},
	watch: {
	}
}
</script>


<!--
<style lang="sass">
	@import "node_modules/purecss/build/pure-min";
	@import "node_modules/purecss/build/grids-responsive-min";
</style>
-->
<style scoped>
header > nav > ul {
    margin: 0px 0px 0px 0px;
    padding-right: 4px;
}
header > nav > ul > li {
/* 	float: left; */
/*     margin-right: -4px; */
    border-top: 1px solid rgba(90, 130, 170, 1);
    border-bottom: 1px solid rgba(90, 130, 170, 1);
    border-right: 1px solid rgba(90, 130, 170, 1);
    color: rgba(90, 130, 170, 1);
    background-color: rgba(0, 0, 0, 0.75);
    text-shadow: none;
}
header > nav > ul > li.current-menu-item > a {
    color: black;
    background-color: rgba(90, 130, 170, 0.5);
}
header > nav > ul > li > a {
    display: block;
    padding: 0.5em 1.5em;
    border-bottom: none;
}
header > nav > ul > li > a:hover {
    color: white;
    border-bottom: none;
    background-color: rgba(90, 130, 170, 0.5);
}
header > nav > ul > li:first-child {
    border-left: 1px solid rgba(90, 130, 170, 1);
    border-top-left-radius: 4px;
    border-bottom-left-radius: 4px;
}
header > nav > ul > li:last-child {
    border-top-right-radius: 4px;
    border-bottom-right-radius: 4px;
}
header > nav li a, .dropbtn {
    display: inline-block;
    color: rgba(90, 130, 170, 1);
    padding: 0.5em 1.5em;
}

header > nav li a:hover, .dropdown:hover .dropbtn {
    background-color: rgba(90, 130, 170, 0.5);
}

li.dropdown {
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 100000;
}

.dropdown-content a {
    padding: 12px 16px;
    display: block;
}

.dropdown-content a:hover {
	background-color: rgba(90, 130, 170, 0.5);
}

.dropdown:hover .dropdown-content {
    display: block;
}
</style>
