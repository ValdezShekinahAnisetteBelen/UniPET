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
    <v-main class="d-flex align-center justify-center" style="min-height: 300px; background-color: #ECECEC;">
      <v-card flat>
        <!-- Card title and search field -->
        <v-card-title class="d-flex align-center pe-2">
          <v-icon>mdi-package-variant</v-icon> &nbsp; All Products
          <v-spacer></v-spacer>
          <v-text-field v-model="search" prepend-inner-icon="mdi-magnify" density="compact" label="Search" single-line flat hide-details variant="solo-filled"></v-text-field>
        </v-card-title>

        <v-card-title class="d-flex align-center pe-2 text-end">
<!-- Your existing content inside v-card-title -->

<!-- Add a button with color="info" -->
<v-btn @click="addProduct" color="#03C9D7">+ ADD PRODUCT</v-btn>
</v-card-title>
<v-card-title class="d-flex align-center pe-2 text-end">
<router-link :to="{ path: '/products2' }">
  <v-btn color="#03C9D7">+ ADD Quantity</v-btn>
</router-link>
</v-card-title>

<!-- Add Product Modal -->
<v-dialog v-model="isAddProductModalOpen" max-width="600px">
<v-card>
  <v-card-title>Add New Product</v-card-title>
  <v-card-text>
    <!-- Your form or input fields for adding a new product go here -->
    <v-text-field v-model="editedName" label="Name"></v-text-field>
    <v-text-field v-model="editedDescription" label="Description"></v-text-field>

    <!-- Allow numeric input for Price and Stock directly -->
    <v-text-field v-model="editedPrice" label="Price" type="number"></v-text-field>
    <v-text-field v-model="editedStock" label="Stock" type="number"></v-text-field>

    <input type="file" ref="fileInput" accept="image/*" @change="handleFileChange">
    <p v-if="selectedFileName">Selected File Name: User/images/{{ selectedFileName }}</p>
    <v-text-field v-model="editedProductgroup" label="Product Group"></v-text-field>
    <v-text-field v-model="editedStatus" label="Status"></v-text-field>
  </v-card-text>
  <v-card-actions>
    <v-btn @click="saveProduct">Save</v-btn>
    <v-btn @click="isAddProductModalOpen = false">Cancel</v-btn>
  </v-card-actions>
</v-card>
</v-dialog>





        <v-divider></v-divider>

        <!-- Data Table -->
        <v-data-table v-model:search="search" :headers="headers" :items="items">

          

          <!-- Header Templates -->
          <template v-slot:header.upc>
    <div class="text-end">UPC</div>
  </template>
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
    <div class="text-end">Current Stock</div>
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
  <!-- Add "User/images/" to the image source URL -->
  <img :src="`${item.image.replace(/\\/g, '/')}`" :title="item.name" :alt="item.name" @error="handleImageError(item)">
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

              <v-text-field v-model="editedImage2" label="New Image"></v-text-field>
<input type="file" ref="fileInput" accept="image/*" @change="handleFileChange2">
<p v-if="selectedFileName2">Selected File Name: User/images/{{ selectedFileName2 }}</p>
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
// props: {
//   details: Object,
// },
components: {
  // DetailsModal,
},
data() {
  return {
    numericInputDialog: false,
    numericInput: {
      price: '',
      stock: '',
    },
    selectedFileName2: '',
    selectedFileName: '', // new data property to store the selected file name
    editedImage: null, // Use null to store the file object
    isAddProductModalOpen: false,
    editedName: '',
    editedDescription: '',
    editedPrice: '',
    editedStock: '',
    editedImage: '',
    editedImage2: '',
    editedProductgroup: '',
    editedStatus: '',
    editedOrderId: null,
    editModal: false,
    editedOrderId: null,
    search: '', // <-- Remove extra 'S' here
    itemsPerPage: 10,
    itemsPerPageOptions: [10, 20, 50],
    items: [],
    headers: [],
    drawer: false,

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
      { text: ' Audit History ', route: '/products2', icon: 'mdi-cart' },
    ],
    links3: [
      { text: ' Appointments ', route: '/Appointments', icon: 'mdi-paw' }, //done
      { text: ' Pets ', route: '/admin/Pets', icon: 'mdi-paw' }, //done
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
  { text: 'upc', value: 'upc' },
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
openNumericInputDialog() {
    this.numericInputDialog = true;
  },
  closeNumericInputDialog() {
    this.numericInputDialog = false;
  },
  saveNumericValues() {
    // Convert the entered values to numbers and update the main form data
    this.editedPrice = parseFloat(this.numericInput.price);
    this.editedStock = parseInt(this.numericInput.stock);
    // Close the dialog
    this.closeNumericInputDialog();
  },
getFileName(filePath) {
    if (typeof filePath === 'string') {
      // Use a regular expression to extract the file name
      const match = filePath.match(/[^\/\\]*$/);
      return match ? match[0] : '';
    }
    return '';
  },
  
  async saveProduct() {
try {
  // Convert editedPrice and editedStock to integers
  const price = parseFloat(this.editedPrice);
  const stock = parseInt(this.editedStock);

  // Ensure that editedImage is a File object
  if (this.editedImage instanceof File) {
    // Create a new FormData object
    const formData = new FormData();
    formData.append('name', this.editedName);
    formData.append('description', this.editedDescription);
    formData.append('price', price); // Use the converted price
    formData.append('stock', stock); // Use the converted stock
    formData.append('image', this.editedImage);
    formData.append('productgroup', this.editedProductgroup);
    formData.append('status', this.editedStatus);

    // Use Axios to send the product data to the server
    await axios.post('/api/save-product', formData, {
      headers: {
        'Content-Type': 'multipart/form-data',
      },
    });

    // Optionally, you can fetch updated products after saving
    await this.fetchProducts();

    // Close the modal afterward
    this.isAddProductModalOpen = false;
  } else {
    console.error('Invalid editedImage structure:', this.editedImage);
  }
} catch (error) {
  console.error('Error saving product:', error);
  // Handle errors as needed
}
},

addProduct() {
  // Optionally, you can reset the form fields or perform any other setup
  // before opening the modal for adding a new product.

  // For example, you can clear the form fields:
  this.editedName = '';
  this.editedDescription = '';
  this.editedPrice = '';
  this.editedStock = '';
  this.editedImage = '';
  this.editedProductgroup = '';
  this.editedStatus = '';

  // Open the modal for adding a new product
  this.isAddProductModalOpen = true;
},
handleImageError(item) {
    // Handle the error when the image fails to load
    console.error('Error loading image:', item);
    // You can perform any necessary error handling here,
    // such as displaying a placeholder image or showing an error message.
  },

  // ... other component methods
logout() {
  sessionStorage.removeItem('token'); // Remove the token from session storage
  this.$router.push('/login'); // Navigate to the login page
},
 // Handle file change event
// Handle file change event
handleFileChange(event) {
const fileInput = this.$refs.fileInput;

if (fileInput && fileInput.files.length > 0) {
  this.editedImage = fileInput.files[0]; // Update editedImage with the File object
  this.selectedFileName = fileInput.files[0].name;
}
},
async fetchProducts() {
  try {
    const response = await axios.get('/getData');
    this.items = response.data;
  } catch (error) {
    console.error('Error fetching products:', error);
  }
},
handleFileChange2() {
  const fileInput = this.$refs.fileInput;
  if (fileInput.files.length > 0) {
    // Set the value of editedImage2 with the selectedFileName2
    this.editedImage2 = `User/images/${fileInput.files[0].name}`;
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
  // Create a FormData object
  const formData = new FormData();
  formData.append('name', this.editedName);
  formData.append('description', this.editedDescription);
  formData.append('price', this.editedPrice);
  formData.append('stock', this.editedStock);
  formData.append('image', this.editedImage2);
  formData.append('productgroup', this.editedProductgroup);
  formData.append('status', this.editedStatus);
  formData.append('orderId', this.editedOrderId);

 

  // Use Axios to send the edited details and orderId to the server
  await axios.post('/api/edit-status2', formData);

  // Close the edit modal afterward
  this.editModal = false;

  // Optionally, you can fetch updated products after saving
  await this.fetchProducts();
} catch (error) {
  console.error('Error saving product:', error);
  // Handle errors as needed
}
},
},
mounted() {
  this.fetchProducts();
},
};
</script>