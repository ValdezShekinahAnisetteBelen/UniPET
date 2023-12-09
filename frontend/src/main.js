// main.js

// Import Vue-related dependencies
import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import './registerServiceWorker';
import vuetify from './plugins/vuetify';
import { loadFonts } from './plugins/webfontloader';
import store from './store';

// Import additional dependencies
import axios from 'axios';
import { Chart, registerables } from 'chart.js'; // Import the main Chart.js module and registerables

// Register Chart.js components
Chart.register(...registerables); // Register all necessary components

// Set the base URL for Axios requests
axios.defaults.baseURL = 'http://unipet.test/public/';

// Load custom fonts
loadFonts();

// Initialize the Vuex store
store.dispatch('init');

// Create the Vue app
const app = createApp(App);

// Use Vue plugins
app.use(router);
app.use(vuetify);
app.use(store);

// Mount the app to the specified HTML element
app.mount('#app');
