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
  
      <!-- Main Content -->
      <v-main class="d-flex align-center justify-center" style="min-height: 300px;">
        <v-card flat>
          <!-- Card title and search field -->
          <v-card-title class="d-flex align-center pe-2">
            <v-icon icon="mdi-truck"></v-icon> &nbsp; Reports for Walk-in and Online sales
            <v-spacer></v-spacer>
            <v-text-field v-model="search" prepend-inner-icon="mdi-magnify" density="compact" label="Search" single-line flat hide-details variant="solo-filled"></v-text-field>
          </v-card-title>
  
          <v-divider></v-divider>
          <v-btn @click="generateReport" color="primary">Generate Report</v-btn>
          <!-- Data Table -->
          <v-data-table v-model:search="search" :headers="headers" :items="items">
            <!-- Header Templates -->
           
            <template v-slot:header.id>
      <div class="text-end">id</div>
    </template>
            <template v-slot:header.product_id>
      <div class="text-end">product_id</div>
    </template>
    <template v-slot:header.oldQuantity>
      <div class="text-end">oldQuantity</div>
    </template>
    <template v-slot:header.stock>
      <div class="text-end">stock</div>
    </template>
    <template v-slot:header.type>
      <div class="text-end">type</div>
    </template>
  
          
          </v-data-table>
        
        </v-card>
      </v-main>
    </v-app>
  </template>
  
  
  <script>
import axios from 'axios';

export default {
    props: {
    details: Object,
  },
  components: {
  
  },
  data() {
    return {
        
        search: '',
      itemsPerPage: 10,
      itemsPerPageOptions: [10, 20, 50],
      items: [], // Initialize as an empty array
    loading: true, // Add a loading state
        headers: [], // Define your headers array
      drawer: false,
      
      links1: [
      { text: ' Key Metrics ', route: '/Dashboard', icon: 'mdi-view-dashboard' },
    ],
    links5: [
    { text: ' POS ', route: '/POS', icon: 'mdi-cart' },
      { text: ' In Store Purchase ', route: '/Store', icon: 'mdi-cart' },
    ],
    links2: [

      { text: ' Orders ', route: '/admin/orders', icon: 'mdi-cart' },

      { text: ' Products ', route: '/products', icon: 'mdi-cart' },
      { text: ' Audit History ', route: '/products2', icon: 'mdi-cart' },
      { text: ' Reports ', route: '/Reports', icon: 'mdi-cart' },
    ],
    links3: [
      { text: ' Appointments ', route: '/Appointments', icon: 'mdi-paw' },
      { text: ' Pets ', route: '/Pets', icon: 'mdi-paw' },
      
    ],
    links4: [
      { text: ' Customer Accounts ', route: '/admin/Profiles', icon: 'mdi-account' },
      { text: ' Admin Accounts ', route: '/admin/Admin', icon: 'mdi-account' },
      
    ],
  };
  },
  computed: {
    headers() {
  return [
  { text: 'id', value: 'id' }, 
    { text: 'product_id', value: 'product_id' },
    { text: 'oldQuantity', value: 'oldQuantity' },
        { text: 'stock', value: 'stock' },
        { text: 'type', value: 'type' },
      ];
    },
},
methods: {
    generateReport() {
  // Assuming you want to trigger the report generation on the server
  axios.get('/generate-report', { responseType: 'blob' })
    .then(response => {
        console.log('Excel File Content:', response.data);
      // Create a Blob from the response data
      const blob = new Blob([response.data], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });

      // Create a link to download the Blob
      const link = document.createElement('a');
      link.href = window.URL.createObjectURL(blob);
     // Get the current date
    const currentDate = new Date();
    const formattedDate = currentDate.toISOString().slice(0, 10); // Format: YYYY-MM-DD

    // Set the download file name with the current date
    link.download = `Reports for Walk-in and Online sales ${formattedDate}.csv`;


      // Trigger a click on the link to start the download
      link.click();

      // Cleanup
      window.URL.revokeObjectURL(link.href);
    })
    .catch(error => {
      // Handle errors if needed
      console.error('Error generating report:', error);

      // You might want to notify the user about the error
      // You can use a UI library like Vuetify's Snackbar for this purpose
    });
},

    fetchData() {
      axios.get('/api/audit') // Assuming your API endpoint is '/api/audit'
        .then(response => {
          this.items = response.data; // Set the fetched data to the 'items' array
        })
        .catch(error => {
          console.error('Error fetching data:', error);
        });
    },

  logout() {
    sessionStorage.removeItem('token'); // Remove the token from session storage
    this.$router.push('/login'); // Navigate to the login page
  },
  
  },
  mounted() {
    this.fetchData(); // Fetch data when the component is mounted
  },
};
</script>