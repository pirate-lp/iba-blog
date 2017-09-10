import Vue from 'vue';

import VueRouter from 'vue-router';
Vue.use(VueRouter);

Vue.config.productionTip = false

import axiosApp from './configs/axios';

Vue.prototype.$http = axiosApp;

import {VueMasonryPlugin} from 'vue-masonry';
Vue.use(VueMasonryPlugin)

import Blog from './Blog'

import router from './router.js'

const ibaBlog = new Vue({
	el: '#iba-blog',
	router,
	template: '<Blog/>',
	components: { Blog },
})