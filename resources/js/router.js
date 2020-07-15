import Vue from 'vue'
import Router from 'vue-router'

import Home from './views/Home'
import Account from './views/Account'
import NotFound from './views/NotFound'

Vue.use(Router);

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/home',
      name: 'home',
      component: Home,
    },
    {
      path: '/account',
      name: 'account',
      component: Account
    },
    {
      path: '*',
      component: NotFound
    }
  ]
})
