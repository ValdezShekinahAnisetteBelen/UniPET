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
            <v-icon icon="mdi-store"></v-icon> &nbsp; In-Store Purchase
            <v-spacer></v-spacer>
            <v-text-field v-model="search" prepend-inner-icon="mdi-magnify" density="compact" label="Search" single-line flat hide-details variant="solo-filled"></v-text-field>
          </v-card-title>
  
          <v-divider></v-divider>
  
          <!-- Data Table -->
          <v-data-table v-model:search="search" :headers="headers" :items="items">
            <!-- Header Templates -->
            <template v-slot:header.product_id>
      <div class="text-end">Product ID</div>
    </template>
    <template v-slot:header.created_at>
      <div class="text-end">Created At</div>
    </template>
    <template v-slot:header.Year>
      <div class="text-end">Year</div>
    </template>
    <template v-slot:header.status>
      <div class="text-end">Status</div>
    </template>
    <template v-slot:header.action>
      <div class="text-end">Action</div>
    </template>
  
            <!-- Custom Item Templates -->
            <template v-slot:item.image="{ item }">
              <v-card class="my-2" elevation="2" rounded>
                <v-img :src="item.image" height="64" cover></v-img>
              </v-card>
            </template>
  
            <template v-slot:item.rating="{ item }">
              <v-rating :model-value="item.rating" color="orange-darken-2" density="compact" size="small" readonly></v-rating>
            </template>
  
            <template v-slot:item.stock="{ item }">
              <div class="text-end">
                <v-chip :color="item.stock ? 'green' : 'red'" :text="item.stock ? 'In stock' : 'Out of stock'" class="text-uppercase" label size="small"></v-chip>
              </div>
            </template>
  
            <template v-slot:item.actions="{ item }">
              <v-icon @click="editStatus(item)" class="mr-2">mdi-pencil</v-icon>
              <v-icon @click="openDetailsModal('product_id', item.product_id)" v-if="headers.find(header => header.value === 'product_id')" class="mr-2">mdi-help-circle</v-icon>
              
            </template>
          </v-data-table>
          
  
          <!-- Details Modal -->
          <details-modal ref="detailsModal" />
  
          <!-- Modal for editing status -->
          <v-dialog v-model="editModal" max-width="600px">
            <v-card>
              <v-card-title>Edit Status</v-card-title>
              <v-card-text>
                <!-- Your form or input fields for editing status go here -->
                <!-- Example: -->
                <v-text-field v-model="editedStatus" label="New Status"></v-text-field>
              </v-card-text>
              <v-card-actions>
                <v-btn @click="saveStatus">Save</v-btn>
                <v-btn @click="editModal = false">Cancel</v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-card>
      </v-main>
    </v-app>
  </template>
  
  
  <script>
import axios from 'axios';
import DetailsModal from './DetailsModal.vue'


export default {
    props: {
    details: Object,
  },
  components: {
    DetailsModal,
  },
  data() {
    return {
        modalOpen: false,
      modalTitle: '',
      modalDetails: null,
        editModal: false,
      editedStatus: '', // Store the edited status here
      editedOrderId: null, // Store the order ID being edited
        search: '',
      itemsPerPage: 10,
      itemsPerPageOptions: [10, 20, 50],
        items: [],
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
    // ... (existing headers)
    {
      text: 'Product ID',
      value: 'product_id',
      icon: 'mdi-help-circle',
      tooltip: 'View Product Details',
    },
    {
      text: 'Customer ID',
      value: 'customer_id',
      icon: 'mdi-help-circle',
      tooltip: 'View Customer Details',
    },
    {
      text: 'Transaction No',
      value: 'transaction_no',
      icon: 'mdi-help-circle',
      tooltip: 'View Transaction Details',
    },
        { text: 'Status', value: 'status' },
        { text: 'Created At', value: 'created_at' },
        { text: 'Year', value: 'Year' },
        { text: 'Actions', value: 'actions', sortable: false },

      ];
    },
},
methods: {
  logout() {
    sessionStorage.removeItem('token'); // Remove the token from session storage
    this.$router.push('/login'); // Navigate to the login page
  },
    openDetailsModal(field, id) {
    this.$refs.detailsModal.openModal(field, id);
},
    openModal(details) {
      // Your logic to handle modal opening with details
      console.log('Opening modal with details:', details);
    },
    openModal(details) {
      this.modalDetails = details;
      this.modalOpen = true;
      this.modalTitle = 'Details'; // Set your modal title here
    },
    closeModal() {
      this.modalOpen = false;
      this.modalDetails = null;
    },
    async fetchOrders() {
      try {
        const response = await axios.get('/api/orders2');
        this.items = response.data;
      } catch (error) {
        console.error('Error fetching orders:', error);
      }
    },
    async fetchProductDetails(productId) {
    try {
      const response = await axios.get(`/api/products/${productId}`);
      return response.data;
    } catch (error) {
      console.error('Error fetching product details:', error);
      return null;
    }
  },
  async fetchCustomerDetails(customerId) {
    try {
      const response = await axios.get(`/api/customers/${customerId}`);
      return response.data;
    } catch (error) {
      console.error('Error fetching customer details:', error);
      return null;
    }
  },
  async fetchTransactionDetails(transactionNo) {
    try {
      const response = await axios.get(`/api/transactions/${transactionNo}`);
      return response.data;
    } catch (error) {
      console.error('Error fetching transaction details:', error);
      return null;
    }
  },

  
  async openDetailsModal(field, id) {
    let details = null;

    switch (field) {
      case 'product_id':
        details = await this.fetchProductDetails(id);
        break;
    //   case 'customer_id':
    //     details = await this.fetchCustomerDetails(id);
    //     break;
    //   case 'transaction_no':
    //     details = await this.fetchTransactionDetails(id);
    //     break;
    }
      // Open the modal and pass the details
      this.$refs.detailsModal.openModal(details);
      
  },
    editStatus(item) {
      // Open the edit modal and set the initial values
      this.editModal = true;
      this.editedStatus = item.status; // Assuming 'status' is the field you want to edit
      this.editedOrderId = item.id; // Assuming 'id' is the primary key of your orders table
    },
    async saveStatus() {
    try {
        // Use Axios to send the edited status and orderId to the server
        await axios.post('/api/edit-status', {
            status: this.editedStatus,
            orderId: this.editedOrderId,
        });

        // Optionally, you can fetch updated orders after editing
        await this.fetchOrders();

        // Close the modal afterward
        this.editModal = false;
    } catch (error) {
        console.error('Error updating status:', error);
        // Handle errors as needed
    }
},

  },
  mounted() {
    this.fetchOrders();
  },
};
</script>