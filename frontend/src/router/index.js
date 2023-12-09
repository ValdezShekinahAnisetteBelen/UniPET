import { createRouter, createWebHistory } from 'vue-router'
import Online_Store from '../views/Client/Online_Store.vue'
import  HistoryPage from '../views/Admin/HistoryPage.vue'

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
  path: '/ProductDetails/:productName',
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
  path: '/AppointmentHistory',
  name: 'AppointmentHistory',
  component: () => import(/* webpackChunkName: "signup" */ '../views/Client/AppointmentHistory'),
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
  path: '/products',
  name: 'products',
  component: () => import(/* webpackChunkName: "signup" */ '../views/Admin/products'),
  meta:{ requiresAuth: true}
},

{
  path: '/UserProfile',
  name: 'UserProfile',
  component: () => import(/* webpackChunkName: "signup" */ '../views/Client/UserProfile'),
  meta:{ requiresAuth: true}
},

{
  path: '/Reports',
  name: 'Reports',
  component: () => import(/* webpackChunkName: "signup" */ '../views/Admin/Reports'),
  meta:{ requiresAuth: true}
},

{
  path: '/products2',
  name: 'products2',
  component: () => import(/* webpackChunkName: "signup" */ '../views/Admin/products2'),
  meta:{ requiresAuth: true}
},

{
  path: '/NavigationBar',
  name: 'NavigationBar',
  component: () => import(/* webpackChunkName: "signup" */ '../views/Client/NavigationBar'),
  meta:{ requiresAuth: true}
},
// {
//   path: '/Dashboard',
//   name: 'Dashboard',
//   component: () => import(/* webpackChunkName: "signup" */ '../views/Admin/Dashboard'),
//   meta:{ requiresAuth: true}
// },
{
  path: '/Chat',
  name: 'Chat',
  component: () => import(/* webpackChunkName: "signup" */ '../views/Admin/Chat'),
  meta:{ requiresAuth: true}
},
{
  path: '/admin/orders',
  name: 'orders',
  component: () => import(/* webpackChunkName: "signup" */ '../views/Admin/Orders'),
  meta:{ requiresAuth: true}
},
{
  path: '/POS',
  name: 'POS',
  component: () => import(/* webpackChunkName: "signup" */ '../views/Admin/POS'),
  meta:{ requiresAuth: true}
},
{
   path: '/history/:upc', component: HistoryPage 
},

{
  path: '/Appointments',
  name: 'Appointments',
  component: () => import(/* webpackChunkName: "signup" */ '../views/Admin/Appointments'),
  meta:{ requiresAuth: true}
},
{
  path: '/Store',
  name: 'Store',
  component: () => import(/* webpackChunkName: "signup" */ '../views/Admin/Store'),
  meta:{ requiresAuth: true}
},
{
  path: '/Pets',
  name: 'Pets',
  component: () => import(/* webpackChunkName: "signup" */ '../views/Admin/Pets'),
  meta:{ requiresAuth: true}
},
{
  path: '/admin/Customers',
  name: 'Customers',
  component: () => import(/* webpackChunkName: "signup" */ '../views/Admin/Customers'),
  meta:{ requiresAuth: true}
},

{
  path: '/admin/Profiles',
  name: 'Customer Profiles',
  component: () => import(/* webpackChunkName: "signup" */ '../views/Admin/Profiles'),
  meta:{ requiresAuth: true}
},

{
  path: '/admin/Admin',
  name: 'Admin Accounts',
  component: () => import(/* webpackChunkName: "signup" */ '../views/Admin/Admin'),
  meta:{ requiresAuth: true}
},

{
  path: '/admin/Payment',
  name: 'Customers Payment Status',
  component: () => import(/* webpackChunkName: "signup" */ '../views/Admin/Payment'),
  meta:{ requiresAuth: true}
},




{
  path: '/DetailsModal',
  name: 'DetailsModal',
  component: () => import(/* webpackChunkName: "signup" */ '../views/Admin/DetailsModal'),
  meta:{ requiresAuth: true}
},

];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});
router.beforeEach((to, from, next) => {
  const isAuthenticated = sessionStorage.getItem('token') !== null;
  const isLoginPage = to.name === 'SignUp';

  if (to.matched.some(record => record.meta.requiresAuth) && !isAuthenticated && !isLoginPage) {
    // Redirect to login if authentication is required and the user is not authenticated
    next('/login');
  } else if (isAuthenticated && isLoginPage) {
    // Redirect to the home page if the user is authenticated and trying to access the login page
    next('/');
  } else {
    // Proceed to the route
    next();
  }
});


export default router;