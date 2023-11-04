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
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/Client/Shop.vue')
},
{
path: '/ProductDetails',
name: 'ProductDetails',
// route level code-splitting
// this generates a separate chunk (about.[hash].js) for this route
// which is lazy-loaded when the route is visited.
component: () => import(/* webpackChunkName: "about" */ '../views/Client/ProductDetails.vue')
},
{
  path: '/SignUp',
  name: 'SignUp',
  component: () => import(/* webpackChunkName: "signup" */ '../components/SignUp')
},
{
  path: '/Contact',
  name: 'Contact',
  component: () => import(/* webpackChunkName: "signup" */ '../views/Client/Contact')
},
{
  path: '/Checkout',
  name: 'Checkout',
  component: () => import(/* webpackChunkName: "signup" */ '../views/Client/Checkout')
},
{
  path: '/Checkout2',
  name: 'Checkout2',
  component: () => import(/* webpackChunkName: "signup" */ '../views/Client/Checkout2')
},
{
  path: '/Checkout3',
  name: 'Checkout3',
  component: () => import(/* webpackChunkName: "signup" */ '../views/Client/Checkout3')
},
{
  path: '/OrderHistory',
  name: 'OrderHistory',
  component: () => import(/* webpackChunkName: "signup" */ '../views/Client/OrderHistory')
},
{
  path: '/RegisterForm',
  name: 'RegisterForm',
  component: () => import(/* webpackChunkName: "signup" */ '../components/RegisterForm')
},
{
  path: '/DeliveryStatus',
  name: 'DeliveryStatus',
  component: () => import(/* webpackChunkName: "signup" */ '../views/Client/DeliveryStatus')
},
{
  path: '/Appointment',
  name: 'Appointment',
  component: () => import(/* webpackChunkName: "signup" */ '../views/Client/Appointment')
},
{
  path: '/Dashboard',
  name: 'Dashboard',
  component: () => import(/* webpackChunkName: "signup" */ '../views/Admin/Dashboard')
}
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
