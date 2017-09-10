import VueRouter from 'vue-router'

import Home from './views/Home'
import SinglePost from './views/SinglePost'
// import Introduction from './views/Introduction'

let routes = [
	{
		path: '/',
		name: 'home',
		component: Home
	},
/*
	{
		path: '/info',
		name: 'info',
		component: Info
	},
	{
		path: '/setting',
		name: 'setting',
		component: Setting
	},
	{
		path: '/bundle/',
		component: BundleManage
	},*/
/*
	{
		path: '/introduction/',
		name: 'introduction',
		component: Introduction,
	},
*/
	{
		path: '/categories/:slug/',
		name: 'categories',
		component: Home,
		
	},
	{
		path: '/:id/',
		name: 'post',
		component: SinglePost
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
		return { x: 0, y: 0 }
	}
});