import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

export default new Router({
	routes: [
		{
			path: '/',
			name: 'home',
			component: require('./views/Home').default
		},
		{
			path: '/resumen',
			name: 'resumen',
			component: require('./views/Resumen').default,
			props: true
		},
		{
			path: '/transacciones',
			name: 'transacciones',
			component: require('./views/Transacciones').default,
			props: true
		},
		{
			path: '*',
			component: require('./views/404').default
		}
	],
	mode: 'history',
})
