import Online_Store from "../views/Client/Online_Store.vue";

module.exports = {
  presets: [
    '@vue/cli-plugin-babel/preset'
  ]
};
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
    path: '/Booking',
    name: 'BookingForm',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/Client/Shop.vue')
  }
]
