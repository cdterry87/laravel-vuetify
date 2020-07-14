import Vue from 'vue'
import apolloProvider from './apollo'
import router from './router'
import vuetify from './vuetify'

import './register'

window._ = require('lodash');
window.moment = require('moment');

import App from './components/App'
import ButtonLink from './components/ButtonLink'
import Login from './components/auth/Login'
import Register from './components/auth/Register'
import Email from './components/auth/passwords/Email'
import Reset from './components/auth/passwords/Reset'

const app = new Vue({
  el: '#app',
  apolloProvider,
  router,
  vuetify,
  components: {
    App,
    ButtonLink,
    Login,
    Register,
    Email,
    Reset
  }
})