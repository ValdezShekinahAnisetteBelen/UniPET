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
          <v-icon>mdi-clock</v-icon> &nbsp; Appointment History
          <v-spacer></v-spacer>
          <v-text-field v-model="search" prepend-inner-icon="mdi-magnify" density="compact" label="Search" single-line flat hide-details variant="solo-filled"></v-text-field>
        </v-card-title>

     
<!-- Your existing content inside v-card-title -->


        <v-divider></v-divider>

        <!-- Data Table -->
        <v-data-table v-model:search="search" :headers="headers" :items="items">

          
          <template v-slot:header.pet_id>
  <div class="text-end">Pet ID</div>
</template>
          <template v-slot:header.pet_name>
  <div class="text-end">Pet Name</div>
</template>
<template v-slot:header.breed>
  <div class="text-end">Breed</div>
</template>
<template v-slot:header.date_of_birth>
  <div class="text-end">Date of Birth</div>
</template>
<template v-slot:header.weight>
  <div class="text-end">Weight</div>
</template>
<template v-slot:header.color>
  <div class="text-end">Color</div>
</template>
<template v-slot:header.temperature>
  <div class="text-end">Temperature</div>
</template>
<template v-slot:header.full_name>
  <div class="text-end">Full Name</div>
</template>
<template v-slot:header.area>
  <div class="text-end">Area</div>
</template>
<template v-slot:header.city>
  <div class="text-end">City</div>
</template>
<template v-slot:header.postal_code>
  <div class="text-end">Postal Code</div>
</template>
<template v-slot:header.contact_no>
  <div class="text-end">Contact No</div>
</template>
<template v-slot:header.email_address>
  <div class="text-end">Email Address</div>
</template>
<template v-slot:header.appointment_date>
  <div class="text-end">Appointment Date</div>
</template>
<template v-slot:header.appointment_time>
  <div class="text-end">Appointment Time</div>
</template>
<template v-slot:header.appointment_type>
  <div class="text-end">Appointment Type</div>
</template>
<template v-slot:header.grooming_type>
  <div class="text-end">Grooming Type</div>
</template>
<template v-slot:header.grooming_shampoo>
  <div class="text-end">Grooming Shampoo</div>
</template>
<template v-slot:header.image>
  <div class="text-end">Image</div>
</template>
<template v-slot:header.customer_id>
  <div class="text-end">Customer ID</div>
</template>
<template v-slot:header.status>
  <div class="text-end">Status</div>
</template>
<template v-slot:header.Year>
  <div class="text-end">Year</div>
</template>
<template v-slot:header.action>
  <div class="text-end">Action</div>
</template>

<!-- Item Templates -->

<template v-slot:item.image="{ item }">
  <v-card class="my-2" elevation="2" rounded>
    <!-- Check if item.image is not null before accessing its value -->
    <img v-if="item.image" :src="`${item.image.replace(/\\/g, '/')}`" :title="item.pet_name" :alt="item.pet_name" @error="handleImageError(item)">
    <!-- Add a placeholder or default image if item.image is null -->
    <img v-else src="path/to/placeholder-image.jpg" :title="item.pet_name" :alt="item.pet_name" @error="handleImageError(item)">
  </v-card>
</template>

<!-- Customize other item templates based on your field types -->


        <!-- Custom Item Templates -->
<template v-slot:item.action="{ item }">
<div class="text-end">
  <v-icon @click="editAppointment(item)" class="mr-2">mdi-pencil</v-icon>
  <!-- You can add other icons or actions here -->
</div>
</template>


        </v-data-table>
        

        <!-- Details Modal -->
        <!-- <details-modal ref="detailsModal" /> -->

        <!-- Modal for editing status -->
        <!-- Modal for editing appointment -->
    <v-dialog v-model="editModal" max-width="600px">
      <v-card>
        <v-card-title>Edit Appointment</v-card-title>
        <v-card-text>
        
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

    editedStatus: '',
    editedpetId: null,

    editModal: false,

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
      { text: ' Reports ', route: '/Reports', icon: 'mdi-cart' },
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
  { text: 'Pet ID', value: 'pet_id' },
  { text: 'Pet Name', value: 'pet_name' },
      { text: 'Breed', value: 'breed' },
      { text: 'Date of Birth', value: 'date_of_birth' },
      { text: 'Weight', value: 'weight' },
      { text: 'Color', value: 'color' },
      { text: 'Temperature', value: 'temperature' },
      { text: 'Full Name', value: 'full_name' },
      { text: 'Area', value: 'area' },
      { text: 'City', value: 'city' },
      { text: 'Postal Code', value: 'postal_code' },
      { text: 'Contact No', value: 'contact_no' },
      { text: 'Email Address', value: 'email_address' },
      { text: 'Appointment Date', value: 'appointment_date' },
      { text: 'Appointment Time', value: 'appointment_time' },
      { text: 'Appointment Type', value: 'appointment_type' },
      { text: 'Grooming Type', value: 'grooming_type' },
      { text: 'Grooming Shampoo', value: 'grooming_shampoo' },
      { text: 'Image', value: 'image' },
      { text: 'Customer ID', value: 'customer_id' },
      { text: 'Status', value: 'status' },
      { text: 'Year', value: 'Year' },
      { text: 'Action', value: 'action', sortable: false },

    ];
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

async fetchProducts() {
  try {
    const response = await axios.get('/api/getAll'); // Replace with the correct endpoint
    this.items = response.data;
  } catch (error) {
    console.error('Error fetching products:', error);
  }
},

editAppointment(item) {
  console.log('Editing appointment:', item);
  this.editedStatus = item.status;
  this.editModal = true; // Ensure this line is present
  this.editedpetId = item.pet_id; // Assuming 'id' is the primary key of your orders table
},

async saveStatus() {
    try {
        // Ensure that this.editedpetId is not null or undefined
        if (!this.editedpetId) {
            console.error('Invalid petId:', this.editedpetId);
            return;
        }

        // Use Axios to send the edited status and pet ID to the server
        await axios.post('api/edit-appointment-status', {
            status: this.editedStatus,
            petId: this.editedpetId,
        });

        // Optionally, you can fetch updated appointments after editing
        await this.fetchProducts();

        // Close the modal afterward
        this.editModal = false;
    } catch (error) {
        console.error('Error updating status:', error);
        // Handle errors as needed
    }
}
},
mounted() {
  this.fetchProducts();
},
};
</script>