import { createRouter, createWebHistory } from 'vue-router'
import Online_Store from '../views/Client/Online_Store.vue'

const routes = [
  {
    path: '/',
    name: 'Online_Store',
    component: Online_Store
  },
  {
    path: '/Shop',
    name: 'Shop',
    component: () => import(/* webpackChunkName: "shop" */ '../views/Client/Shop.vue')
  },
  {
    path: '/Contact',
    name: 'Contact',
    component: () => import(/* webpackChunkName: "signup" */ '../views/Client/Contact')
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
