import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import './registerServiceWorker'
import vuetify from './plugins/vuetify'
import { loadFonts } from './plugins/webfontloader'
import store from './store';

import axios from 'axios'
import { Chart, LineController, LineElement, PointElement, LinearScale, CategoryScale } from 'chart.js';

Chart.register(LineController, LineElement, PointElement, LinearScale, CategoryScale);

import { BarController, BarElement } from 'chart.js';
Chart.register(BarController, BarElement);

axios.defaults.baseURL="http://unipet.test/public/"

loadFonts()
store.dispatch('init');

createApp(App)
  .use(router)
  .use(vuetify)
  .use(store)
  .mount('#app')
