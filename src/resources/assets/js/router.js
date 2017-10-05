import VueRouter from 'vue-router'

import Home from './views/Home'
import SinglePost from './views/SinglePost'

let routes = [
	{
		path: '/',
		name: 'home',
		components: {
			back: Home,
			single: ''
		}
	},
	{
		path: '/categories/:slug/',
		name: 'categories',
		components: {
			back: Home
		} ,
		
	},
	{
		path: '/:id/',
		name: 'post',
		components: {
			back: Home,
			single: SinglePost
		},
	},
];

export default new VueRouter({
	mode: 'history',
	base: '/blog/',
	routes,
	scrollBehavior (to, from, savedPosition) {
		if (to.hash) {
		return {
				selector: to.hash
				// , offset: { x: 0, y: 10 }
    		}
  		}
  		if ( to.name != 'post' ) {
	  		return { x: 0, y: 0 }
  		}	
	}
});