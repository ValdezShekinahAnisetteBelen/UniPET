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
        </v-list>
      </v-navigation-drawer>
  
      <!-- Main Content -->
      <v-main class="d-flex align-center justify-center" style="min-height: 300px;">
        <v-card flat>
          <!-- Card title and search field -->
          <v-card-title class="d-flex align-center pe-2">
            <v-icon>mdi-package-variant</v-icon> &nbsp; All Products
            <v-spacer></v-spacer>
            <v-text-field v-model="search" prepend-inner-icon="mdi-magnify" density="compact" label="Search" single-line flat hide-details variant="solo-filled"></v-text-field>
          </v-card-title>
  
          <v-divider></v-divider>
  
          <!-- Data Table -->
          <v-data-table v-model:search="search" :headers="headers" :items="items">
            <!-- Header Templates -->
            <template v-slot:header.id>
      <div class="text-end">Product ID</div>
    </template>
    <template v-slot:header.name>
      <div class="text-end">Name</div>
    </template>
            <template v-slot:header.description>
      <div class="text-end">Description</div>
    </template>
    <template v-slot:header.price>
      <div class="text-end">Price</div>
    </template>
    <template v-slot:header.stock>
      <div class="text-end">Stock</div>
    </template>
    <template v-slot:header.image>
      <div class="text-end">Image</div>
    </template>
    <template v-slot:header.productgroup>
      <div class="text-end">Product Group</div>
    </template>
    <template v-slot:header.status>
      <div class="text-end">Status</div>
    </template>
    <template v-slot:header.action>
      <div class="text-end">Action</div>
    </template>
  
    <template v-slot:item.image="{ item }">
  <v-card class="my-2" elevation="2" rounded>
    <!-- Use the correct relative path to the image source -->
    <img :src="`${item.image}`" :title="item.name" :alt="item.name" @error="handleImageError(item)">
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

          <!-- Custom Item Templates -->
<template v-slot:item.action="{ item }">
  <div class="text-end">
    <v-icon @click="editStatus(item)" class="mr-2">mdi-pencil</v-icon>
    <!-- You can add other icons or actions here -->
  </div>
</template>

  
          </v-data-table>
          
  
          <!-- Details Modal -->
          <!-- <details-modal ref="detailsModal" /> -->
  
          <!-- Modal for editing status -->
          <v-dialog v-model="editModal" max-width="600px">
            <v-card>
              <v-card-title>Edit Products</v-card-title>
              <v-card-text>
                <!-- Your form or input fields for editing status go here -->
                <v-text-field v-model="editedName" label="New Name"></v-text-field>
                <v-text-field v-model="editedDescription" label="New Description"></v-text-field>
                <v-text-field v-model="editedPrice" label="New Price"></v-text-field>
                <v-text-field v-model="editedStock" label="New Stock"></v-text-field>
                <v-text-field v-model="editedImage" label="New Image"></v-text-field>
                <v-text-field v-model="editedProductgroup" label="New Product Group"></v-text-field>
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
// import DetailsModal from './DetailsModal.vue'


export default {
//     props: {
//     details: Object,
//   },
  components: {
    // DetailsModal,
  },
  data() {
    return {
        editedName: '',
    editedDescription: '',
    editedPrice: '',
    editedStock: '',
    editedImage: '',
    editedProductgroup: '',
    editedStatus: '',
    editedOrderId: null,
        editModal: false,
      editedOrderId: null,
      search: '',
      itemsPerPage: 10,
      itemsPerPageOptions: [10, 20, 50],
      items: [],
      headers: [],
      drawer: false,
      
      links1: [
      { text: ' Key Metrics ', route: '/Dashboard', icon: 'mdi-view-dashboard' },//done
    ],
    links2: [
      { text: ' Orders ', route: '/admin/orders', icon: 'mdi-cart' }, //done
      { text: ' Products ', route: '/admin/products', icon: 'mdi-cart' },//done
    ],
    links3: [
      { text: ' Appointments ', route: '/admin/Appointments', icon: 'mdi-paw' }, //done
      { text: ' Pets ', route: '/admin/Pets', icon: 'mdi-paw' }, //done
      { text: ' Customers ', route: '/admin/Customers', icon: 'mdi-paw' }, //done
    ],
    links4: [
      { text: ' Customer Profiles ', route: '/admin/Profiles', icon: 'mdi-account' }, //done
      { text: ' Admin Accounts ', route: '/admin/Admin', icon: 'mdi-account' }, //done
      { text: ' Customers Payment Status ', route: '/admin/Payment', icon: 'mdi-account' }, //done
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
    { text: 'id', value: 'id' },
    { text: 'name', value: 'name' },
    { text: 'description', value: 'description' },
        { text: 'price', value: 'price' },
        { text: 'stock', value: 'stock' },
        { text: 'image', value: 'image' },
        { text: 'productgroup', value: 'productgroup' },
        { text: 'status', value: 'status' },
        // { text: 'Year', value: 'Year' },
        { text: 'Action', value: 'action', sortable: false },

      ];
    },
},
methods: {
    handleImageError(item) {
      console.error(`Error loading image for item: ${JSON.stringify(item)}`);
      // Optionally, you can set a default image or take other actions on image load error
    },
    async fetchProducts() {
      try {
        const response = await axios.get('/getData');
        this.items = response.data;
      } catch (error) {
        console.error('Error fetching products:', error);
      }
    },

    editStatus(item) {
      // Open the edit modal and set the initial values
      this.editModal = true;
      this.editedName = item.name; // Assuming 'status' is the field you want to edit
      this.editedDescription = item.description; // Assuming 'status' is the field you want to edit
      this.editedPrice = item.price; // Assuming 'status' is the field you want to edit
      this.editedStock = item.stock; // Assuming 'status' is the field you want to edit
      this.editedImage = item.image; // Assuming 'status' is the field you want to edit
      this.editedProductgroup = item.productgroup; // Assuming 'status' is the field you want to edit
      this.editedStatus = item.status; // Assuming 'status' is the field you want to edit
      this.editedOrderId = item.id; // Assuming 'id' is the primary key of your products table
    },

    async saveStatus() {
  try {
    // Use Axios to send the edited details and orderId to the server
    await axios.post('/api/edit-status2', {
    name: this.editedName,
    description: this.editedDescription,
    price: this.editedPrice,
    stock: this.editedStock,
    image: this.editedImage,
    productgroup: this.editedProductgroup,
    status: this.editedStatus,
    orderId: this.editedOrderId,
});

    // Optionally, you can fetch updated products after editing
    await this.fetchProducts();

    // Close the modal afterward
    this.editModal = false;
  } catch (error) {
    console.error('Error updating product details:', error);
    console.error('Axios Response Data:', error.response.data);
    console.error('Axios Response Status:', error.response.status);
    console.error('Axios Response Headers:', error.response.headers);
    // Handle errors as needed
  }
},
  },
  mounted() {
    this.fetchProducts();
  },
};
</script>