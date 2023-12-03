<template>
    <v-app>
      <!-- App Bar -->
      <v-app-bar app color="#03C9D7">
        <v-app-bar-nav-icon @click.stop="drawer = !drawer" color="#FFFF"></v-app-bar-nav-icon>
        <v-app-bar-title class="d-inline align-center" style="color: #FFFFFF;">
          UniPET
          <v-icon color="#FFFF">mdi-paw</v-icon>
        </v-app-bar-title>
      </v-app-bar>
  
      <!-- Navigation Drawer -->
      <v-navigation-drawer
        app
        v-model="drawer"
        style="color: #FB9678; overflow-y: auto;"
        class="custom-scrollbar"
      >
        <!-- Dashboard Link -->
        <v-list style="background-color: #03C9D7;">
          <v-list-item>
            <v-list-item-content>
              <v-list-item-icon></v-list-item-icon>
              <v-list-item-title>DASHBOARD</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
  
          <!-- Links Group 1 -->
          <router-link v-for="(link, index) in links1" :key="index" :to="link.route" class="nav-link" style="color: #03C9D7; font-weight: bold; display: flex; align-items: center;">
            <v-icon>{{ link.icon }}</v-icon>
            {{ link.text }}
          </router-link>
        </v-list>

              <!-- Dashboard Link -->
              <v-list style="background-color: #03C9D7;">
          <v-list-item>
            <v-list-item-content>
              <v-list-item-icon></v-list-item-icon>
              <v-list-item-title> Point of Sale (POS) system </v-list-item-title>
            </v-list-item-content>
          </v-list-item>
  
          <!-- Links Group 1 -->
          <router-link v-for="(link, index) in links5" :key="index" :to="link.route" class="nav-link" style="color: #03C9D7; font-weight: bold; display: flex; align-items: center;">
            <v-icon>{{ link.icon }}</v-icon>
            {{ link.text }}
          </router-link>
        </v-list>
  
        <!-- Links Group 2 (E-COMMERCE) -->
        <v-list style="background-color: #03C9D7;">
          <v-list-item>
            <v-list-item-content>
              <v-list-item-icon></v-list-item-icon>
              <v-list-item-title>E-COMMERCE</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
  
          <router-link v-for="(link, index) in links2" :key="index" :to="link.route" class="nav-link" style="color: #03C9D7; font-weight: bold; display: flex; align-items: center;">
            <v-icon>{{ link.icon }}</v-icon>
            {{ link.text }}
          </router-link>
        </v-list>
  
        <!-- Links Group 3 (PETS APPOINTMENT) -->
        <v-list style="background-color: #03C9D7;">
          <v-list-item>
            <v-list-item-content>
              <v-list-item-icon></v-list-item-icon>
              <v-list-item-title>PETS APPOINTMENT</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
  
          <router-link v-for="(link, index) in links3" :key="index" :to="link.route" class="nav-link" style="color: #03C9D7; font-weight: bold; display: flex; align-items: center;">
            <v-icon>{{ link.icon }}</v-icon>
            {{ link.text }}
          </router-link>
        </v-list>
  
        <!-- Links Group 4 (ACCOUNTS) -->
        <v-list style="background-color: #03C9D7;">
          <v-list-item>
            <v-list-item-content>
              <v-list-item-icon></v-list-item-icon>
              <v-list-item-title>ACCOUNTS</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
  
          <router-link v-for="(link, index) in links4" :key="index" :to="link.route" class="nav-link" style="color: #03C9D7; font-weight: bold; display: flex; align-items: center;">
            <v-icon>{{ link.icon }}</v-icon>
            {{ link.text }}
          </router-link>
  
          <router-link to="/logout" @click.prevent="logout" class="nav-link" style="color: #03C9D7; font-weight: bold; display: flex; align-items: center;">
            <v-icon>logout_icon</v-icon>
            Logout
          </router-link>
  
  
        </v-list>
      </v-navigation-drawer>
  
        <v-main class="d-flex align-center justify-center" style="min-height: 300px;">
    <v-container style="background-color: #ECECEC;">
      <v-card-title class="d-flex align-center pe-2">
        <v-icon>mdi-paw</v-icon> &nbsp; Pet Profiles
        <v-spacer></v-spacer>
        <v-text-field v-model="search" prepend-inner-icon="mdi-magnify" density="compact" label="Search" single-line flat hide-details variant="solo-filled"></v-text-field>
      </v-card-title>
      <!-- Data Rows -->
      <v-row>
        <v-col v-for="(item, rowIndex) in filteredItems" :key="rowIndex" :cols="12 / itemsPerRow">
          <v-sheet class="pa-2 ma-2">
            <v-col v-for="(header, headerIndex) in headers" :key="headerIndex">
              <div v-if="header.value === 'image'" :style="{ borderRadius: '50%', overflow: 'hidden' }">
                <!-- Display image based on the 'image' column -->
                <v-img :src="item[header.value]" aspect-ratio="1"></v-img>
              </div>
              <div v-else>
                <strong>{{ header.text }}:</strong> {{ item[header.value] }}
              </div>
              <v-divider v-if="headerIndex < headers.length - 1" class="mx-2"></v-divider>
            </v-col>
          </v-sheet>
        </v-col>
      </v-row>
    </v-container>
  </v-main>

 
    </v-app>
  </template>
  
  
  <script>
  import axios from 'axios';
  // import DetailsModal from './DetailsModal.vue'
  
  export default {
  // props: {
  //   details: Object,
  // },
  components: {
    // DetailsModal,
  },
  data() {
    return {
  
    //   editedpetId: null,
    search: '',
    //   editModal: false,
    drawer: false,
    search: '',
      items: [],
      headers: [],
  
      links1: [
        { text: ' Key Metrics ', route: '/Dashboard', icon: 'mdi-view-dashboard' }, //done
      ],
      links5: [
    { text: ' POS ', route: '/POS', icon: 'mdi-cart' },
      { text: ' In Store Purchase ', route: '/Store', icon: 'mdi-cart' },
    ],
    links2: [

      { text: ' Orders ', route: '/admin/orders', icon: 'mdi-cart' },

      { text: ' Products ', route: '/products', icon: 'mdi-cart' },
    ],
      links3: [
        { text: ' Appointments ', route: '/Appointments', icon: 'mdi-paw' }, //done
        { text: ' Pets ', route: '/Pets', icon: 'mdi-paw' }, //done
         //done
      ],
      links4: [
        { text: ' Customer Accounts ', route: '/admin/Profiles', icon: 'mdi-account' }, //done
        { text: ' Admin Accounts ', route: '/admin/Admin', icon: 'mdi-account' }, //done
         //done
      ],
    };
  },
  computed: {
    headers() {
  return [
    // ... (existing headers)
    // {
    //   text: 'Product ID',
    //   value: 'product_id',
    // //   icon: 'mdi-help-circle',
    // //   tooltip: 'View Product Details',
    // },
    // {
    //   text: 'Customer ID',
    //   value: 'customer_id',
    // //   icon: 'mdi-help-circle',
    // //   tooltip: 'View Customer Details',
    // },
    // {
    //   text: 'Transaction No',
    //   value: 'transaction_no',
    // //   icon: 'mdi-help-circle',
    // //   tooltip: 'View Transaction Details',
    // },  { text: 'Status', value: 'status' },
    { text: 'Image', value: 'image' }, 
    { text: 'Pet ID', value: 'pet_id' },
    { text: 'Pet Name', value: 'pet_name' },
        { text: 'Breed', value: 'breed' },
        { text: 'Date of Birth', value: 'date_of_birth' },
        { text: 'Weight', value: 'weight' },
        { text: 'Color', value: 'color' },
        { text: 'Temperature', value: 'temperature' },
  
      ];
    },
    filteredItems() {
      // Filter items based on the search query
      return this.items.filter(item =>
        Object.values(item).some(value => String(value).toLowerCase().includes(this.search.toLowerCase()))
      );
    },
  },
  methods: {
    handleImageError(item) {
      // Handle the error when the image fails to load
      console.error('Error loading image:', item);
      // You can perform any necessary error handling here,
      // such as displaying a placeholder image or showing an error message.
    },
  
    
  logout() {
    sessionStorage.removeItem('token'); // Remove the token from session storage
    this.$router.push('/login'); // Navigate to the login page
  },
  
  async fetchHeaders() {
      try {
        const response = await axios.get('/api/getTableHeaders'); // Replace with the correct API endpoint
        this.headers = response.data.headers.map(header => ({ text: header, value: header }));
      } catch (error) {
        console.error('Error fetching table headers:', error);
      }
    },

    handleImageError(item) {
      console.error('Error loading image:', item);
    },

    async fetchProducts() {
      try {
        const response = await axios.get('/api/getAll'); // Replace with the correct endpoint
        this.items = response.data;
      } catch (error) {
        console.error('Error fetching products:', error);
      }
    },
  },
  mounted() {
    this.fetchHeaders();
    this.fetchProducts();
  },
};
</script>