import { createRouter, createWebHistory } from 'vue-router'
import Online_Store from '../views/Client/Online_Store.vue'

const routes = [
  {
    path: '/',
    name: 'Online_Store',
    component: Online_Store,
    meta:{ requiresAuth: true}
    
  },
  {
    path: '/Shop',
    name: 'Shop',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/Client/Shop.vue'),
    meta:{ requiresAuth: true}
},
{
path: '/ProductDetails',
name: 'ProductDetails',
// route level code-splitting
// this generates a separate chunk (about.[hash].js) for this route
// which is lazy-loaded when the route is visited.
component: () => import(/* webpackChunkName: "about" */ '../views/Client/ProductDetails.vue'),
meta:{ requiresAuth: true}
},
{
  path: '/login',
  name: 'SignUp',
  component: () => import(/* webpackChunkName: "signup" */ '../components/SignUp'),
  meta:{ requiresAuth: true}
},
{
  path: '/Contact',
  name: 'Contact',
  component: () => import(/* webpackChunkName: "signup" */ '../views/Client/Contact'),
  meta:{ requiresAuth: true}
},
{
  path: '/Checkout',
  name: 'Checkout',
  component: () => import(/* webpackChunkName: "signup" */ '../views/Client/Checkout'),
  meta:{ requiresAuth: true}
},
{
  path: '/Checkout2',
  name: 'Checkout2',
  component: () => import(/* webpackChunkName: "signup" */ '../views/Client/Checkout2'),
  meta:{ requiresAuth: true}
},
{
  path: '/Checkout3',
  name: 'Checkout3',
  component: () => import(/* webpackChunkName: "signup" */ '../views/Client/Checkout3'),
  meta:{ requiresAuth: true}
},
{
  path: '/OrderHistory',
  name: 'OrderHistory',
  component: () => import(/* webpackChunkName: "signup" */ '../views/Client/OrderHistory'),
  meta:{ requiresAuth: true}
},
{
  path: '/register',
  name: 'RegisterForm',
  component: () => import(/* webpackChunkName: "signup" */ '../components/RegisterForm')
},
{
  path: '/DeliveryStatus',
  name: 'DeliveryStatus',
  component: () => import(/* webpackChunkName: "signup" */ '../views/Client/DeliveryStatus'),
  meta:{ requiresAuth: true}
},
{
  path: '/Appointment',
  name: 'Appointment',
  component: () => import(/* webpackChunkName: "signup" */ '../views/Client/Appointment'),
  meta:{ requiresAuth: true}
},
{
path: '/PetInfo',
name: 'PetInfo',
component: () => import(/* webpackChunkName: "signup" */ '../views/Client/PetInfo'),
meta:{ requiresAuth: true}
},
{
  path: '/Dashboard',
  name: 'Dashboard',
  component: () => import(/* webpackChunkName: "signup" */ '../views/Admin/Dashboard'),
  meta:{ requiresAuth: true}
},
{
  path: '/order',
  name: 'order',
  component: () => import(/* webpackChunkName: "signup" */ '../views/Admin/order'),
  meta:{ requiresAuth: true}
}

];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

router.beforeEach((to, from, next) => {
  const isLoggedin = checkUserLogin();

  // Exclude the '/login' route from redirection logic
  if (to.name !== 'SignUp' && to.matched.some((record) => record.meta.requiresAuth)) {
    if (!isLoggedin) {
      next('/login');
    } else {
      next();
    }
  } else {
    next();
  }
});

function checkUserLogin() {
  const userToken = sessionStorage.getItem('token');
  return !!userToken;
}

export default router;