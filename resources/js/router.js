import VHome from './views/VHome.vue'

export default {
  mode: 'history',
  routes: [
    {
      name: 'Home',
      path: '/',
      component: VHome
    }
  ]
}
