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
  
          <router-link to="/logout" @click.prevent="logout" class="nav-link" style="color: #03C9D7; font-weight: bold; display: flex; align-items: center;">
            <v-icon>logout_icon</v-icon>
            Logout
          </router-link>
  
  
        </v-list>
      </v-navigation-drawer>
  
        <v-main class="d-flex align-center justify-center" style="min-height: 300px;">
    <v-container style="background-color: #ECECEC;">
      <v-card-title class="d-flex align-center pe-2">
        <v-icon>mdi-paw</v-icon> &nbsp; Admin Accounts
        <v-spacer></v-spacer>
       
        <v-text-field v-model="search" prepend-inner-icon="mdi-magnify" density="compact" label="Search" single-line flat hide-details variant="solo-filled"></v-text-field>
      </v-card-title>
      <!-- Data Rows -->
      <v-btn @click="openAddUserModal" style="background-color: #03C9D7; color: white;">
  Add User
</v-btn>
      <v-row>
  <v-col v-for="(item, rowIndex) in filteredItems" :key="rowIndex" :cols="12 / itemsPerRow">
    <v-sheet class="pa-2 ma-2">
      <v-col v-for="(header, headerIndex) in headers" :key="headerIndex">
        <div v-if="header.value === 'image'" :style="{ borderRadius: '50%', overflow: 'hidden' }">
          <!-- Display image based on the 'image' column -->
          <v-img :src="item[header.value]" aspect-ratio="1"></v-img>
        </div>
        <div v-else>
          <strong>{{ header.text }}:</strong>
          <span v-if="header.value === 'status'" :style="getStatusStyle(item[header.value])">{{ item[header.value] }}</span>
          <span v-else>{{ item[header.value] }}</span>
        </div>
        <v-divider v-if="headerIndex < headers.length - 1" class="mx-2"></v-divider>
      </v-col>

      <!-- Edit button for logged-in customer_id -->
     <v-btn v-if="isEditableCustomer(item.customer_id)" @click="editCustomer(item.customer_id)" style="background-color: #03C9D7; color: white;">
  Edit
</v-btn>

   <!-- Edit button for logged-in customer_id -->
   <v-btn @click="editRole(item.customer_id)" style="background-color: #03C9D7; color: white;">
      Edit Role
    </v-btn>
<v-btn @click="deleteCustomer(item.customer_id)" style="background-color: #FF5722; color: white;">
        Delete
      </v-btn>

      <v-dialog v-model="isEditingRole" max-width="600">
    <v-card>
      <v-card-title>
        Edit Role
        <v-spacer></v-spacer>
        <v-btn icon @click="closeEditRoleModal">
          <v-icon>mdi-close</v-icon>
        </v-btn>
      </v-card-title>
      <v-card-text>
        <v-form ref="editRoleForm" @submit.prevent="saveEditedRole">
          <v-text-field v-model="editedRoleData.role" label="Role"></v-text-field>
          <v-btn type="submit" color="primary">Save Role</v-btn>
        </v-form>
      </v-card-text>
    </v-card>
  </v-dialog>

  <!-- Include EditCustomerModal component -->
  <EditCustomerModal :dialog="isEditing" :editedCustomer="editedCustomer" @save="saveEditedCustomer" @close="closeEditModal" />
    </v-sheet>
  </v-col>
</v-row>
<v-btn @click="openAddUserModal" style="background-color: #03C9D7; color: white;">
    Add User
  </v-btn>
    </v-container>


  <v-dialog v-model="isAddingUser" max-width="600">
    <v-card>
      <v-card-title>
        Add User
        <v-spacer></v-spacer>
        <v-btn icon @click="closeAddUserModal">
          <v-icon>mdi-close</v-icon>
        </v-btn>
      </v-card-title>
      <v-card-text>
        <v-form ref="newUserForm" @submit.prevent="saveNewUser">
  <v-text-field v-model="newUserData.username" label="Username" :rules="usernameRules"></v-text-field>
  <v-text-field v-model="newUserData.email" label="Email" :rules="emailRules"></v-text-field>
  <v-text-field v-model="newUserData.password" label="Password" type="password" :rules="passwordRules"></v-text-field>
  <v-text-field v-model="newUserData.role" label="role"></v-text-field>
  <!-- ... other form fields for additional user data -->
  <v-btn type="submit" color="primary">Add User</v-btn>
</v-form>
      </v-card-text>
      <v-card-actions>
        <v-btn @click="saveNewUser" color="primary">Add User</v-btn>
        <v-btn @click="closeAddUserModal" color="error">Cancel</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
  </v-main>

 
    </v-app>
  </template>
  
  
  <script>
  import EditCustomerModal from './EditCustomerModal.vue';
  import axios from 'axios';
  // import DetailsModal from './DetailsModal.vue'
  
  export default {
  // props: {
  //   details: Object,
  // },
  components: {
    // DetailsModal,
    EditCustomerModal,
  },
  data() {
    return {
        usernameRules: [
        (v) => !!v || 'Username is required',
        // Add more rules as needed
      ],
      emailRules: [
        (v) => !!v || 'Email is required',
        // Add more rules as needed
      ],
      passwordRules: [
        (v) => !!v || 'Password is required',
        // Add more rules as needed
      ],
        isAddingUser: false,
      newUserData: {
        username: '',
        email: '',
        password: '',
    },
    isEditingRole: false,
    editedRoleData: {
        customerId: null,
        role: '',
      },
      isEditing: false,
      editedCustomer: {},
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
    { text: 'Customer ID', value: 'customer_id' }, 
    { text: 'First Name', value: 'first_name' },
    { text: 'Last Name', value: 'last_name' },
        { text: 'email', value: 'email' },
        { text: 'Phone Number', value: 'phone_number' },
        { text: 'username', value: 'username' },
        { text: 'password', value: 'password' },
        { text: 'status', value: 'status' },
        { text: 'role', value: 'role' },
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
    closeAddUserModal() {
      this.isAddingUser = false;
    },
    async saveNewUser() {
  try {
    // Perform form validation before making the request
    if (this.$refs.newUserForm.validate()) {
      // Make an HTTP request to save the new user data
      const response = await axios.post('/api/register', {
        username: this.newUserData.username,
        email: this.newUserData.email,
        password: this.newUserData.password,
        role: this.newUserData.role, // Add role here
      });

      // Log the entire response for debugging
      console.log('Response:', response);

      // Check if the response indicates success (you might need to adjust this condition)
      if (response.status >= 200 && response.status < 300) {
        // User created successfully
        console.log('User saved successfully:', response.data);

        // Optionally, you may want to fetch the updated user list or perform other actions

        // Close the modal
        this.isAddingUser = false;
        window.alert('User created successfully');
      } else {
        // Log the error details for debugging
        console.error('Failed to create user. Server returned:', response.status, response.data);
        window.alert('Failed to create user');
      }
    }
  } catch (error) {
    // Handle the error (display an error message, log it, etc.)
    console.error('Error saving new user:', error);
    // Display an error message in the UI if needed
    window.alert('Failed to create user');
  }
},
    // ... your other methods ...
    async addUser() {
    try {
      // Open the modal
      this.isAddingUser = true;

      // Clear existing form data
      this.newUserData = {
        username: '',
        email: '',
        role: '',
        password: '',
        // ... other fields
      };
    } catch (error) {
      console.error('Error opening the add user modal:', error);
      // Handle the error (show an error message, etc.)
    }
  },
    openAddUserModal() {
      // Set isAddingUser to true to show the modal
      this.isAddingUser = true;
    },
    async deleteCustomer(customerId) {
  try {
    // Send a DELETE request to the server
    await axios.delete(`/api/customer/delete/${customerId}`);

    // Optionally, you can fetch the updated customer list
    this.fetchProducts();

    // Display success message
    window.alert('Deleted Customer Account Successfully');
  } catch (error) {
    console.error('Error deleting customer:', error);

    // Display appropriate error message
    if (error.response && error.response.status === 400) {
      window.alert('Cannot delete account. The account is active.');
    } else {
      window.alert('Cannot delete account. The account is active.');
    }
  }
},
    handleImageError(item) {
      // Handle the error when the image fails to load
      console.error('Error loading image:', item);
      // You can perform any necessary error handling here,
      // such as displaying a placeholder image or showing an error message.
    },
    getStatusStyle(status) {
    // Customize this method based on your status values
    if (status === 'active') {
      return { backgroundColor: 'green', color: 'white' };
    } else {
      // Adjust the colors for other statuses as needed
      return { backgroundColor: '', color: '' };
    }
  },
  async editRole(customerId) {
  try {
    // Fetch the customer details using the API
    const response = await axios.get(`/api/customer/edit/${customerId}`); // Adjust the endpoint as per your API

    // Set the edited role data
    this.editedRoleData = {
      customerId: customerId,
      role: response.data.role,
    };

    // Show the modal
    this.isEditingRole = true;
  } catch (error) {
    console.error('Error fetching role details:', error);
    // Handle the error (show an error message, etc.)
  }
},
async saveEditedRole() {
  try {
    // Update the role using the API
    await axios.post(`/api/customer/updateRole/${customerId}`, {
      role: this.editedRoleData.role,
    });

    // Optionally, you can fetch the updated customer list
    await this.fetchProducts();

    // Show a prompt indicating successful edit
    window.alert('Role updated successfully');
  } catch (error) {
    console.error('Error updating role:', error);
    // Handle the error (show an error message, etc.)
    window.alert('Failed to update role');
  } finally {
    // Close the modal
    this.isEditingRole = false;
  }
},

    closeEditRoleModal() {
      // Close the role edit modal without saving changes
      this.isEditingRole = false;
    },


  isEditableCustomer(customerId) {
    // Check if the logged-in customer_id matches the provided customerId
    return customerId === this.$store.state.userId;
  },

  async editCustomer(customerId) {
      try {
        // Fetch the customer details using the API
        const response = await axios.get(`/api/customer/edit/${customerId}`);
        
        // Set the edited customer data
        this.editedCustomer = response.data;

        // Show the modal
        this.isEditing = true;
      } catch (error) {
        console.error('Error fetching customer details:', error);
        // Handle the error (show an error message, etc.)
      }
    },

    async saveEditedCustomer() {
  try {
    // Update the customer details using the API
    await axios.put(`/api/customer/update/${this.editedCustomer.customer_id}`, this.editedCustomer);

    // Optionally, you can fetch the updated customer list
    await this.fetchProducts();

    // Show a prompt indicating successful edit
    window.alert('Edited Successfully');
  } catch (error) {
    console.error('Error updating customer details:', error);
    // Handle the error (show an error message, etc.)
    window.alert('Edit Failed'); // You can customize this message based on your needs
  } finally {
    // Close the modal
    this.isEditing = false;
  }
},


    closeEditModal() {
      // Close the modal without saving changes
      this.isEditing = false;
    },
  logout() {
    sessionStorage.removeItem('token'); // Remove the token from session storage
    this.$router.push('/login'); // Navigate to the login page
  },
  
  async fetchHeaders() {
      try {
        const response = await axios.get('/api/getTableHeaders2'); // Replace with the correct API endpoint
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
        const response = await axios.get('/api/getAll3'); // Replace with the correct endpoint
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