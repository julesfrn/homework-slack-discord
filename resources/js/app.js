import Vue from 'vue'
import VueRouter from 'vue-router'
import router from './router'

Vue.use(VueRouter)

const app = new Vue({
  el: '#app',
  router: new VueRouter(router)
})
