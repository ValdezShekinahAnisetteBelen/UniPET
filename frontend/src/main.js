import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import './registerServiceWorker'
import vuetify from './plugins/vuetify'
import { loadFonts } from './plugins/webfontloader'
import store from './store';

import axios from 'axios'


axios.defaults.baseURL="http://unipet.test/public/"

loadFonts()
store.dispatch('init');

createApp(App)
  .use(router)
  .use(vuetify)
  .use(store)
  .mount('#app')
