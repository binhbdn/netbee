import Vue from 'vue';
import Lazyload from 'vue-lazyload';

Vue.use(Lazyload, {
	preLoad: 1,
	error: '/assets/img/logo.png',
	loading: 'assets/img/loading.gif',
	attempt: 1,
	listenEvents: [ 'scroll' ]
})