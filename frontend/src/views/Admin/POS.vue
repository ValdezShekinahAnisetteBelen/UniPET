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
        <v-icon>mdi-paw</v-icon> &nbsp; UniPET POINT OF SALE
        <v-spacer></v-spacer>
       
      </v-card-title>
      <v-row>
        <v-col>
          <div v-if="salesTransactionNumber">
                Sales Transaction Number: {{ salesTransactionNumber }}
          </div>
          <v-simple-table style="margin-top: 20px; border-collapse: separate; border-spacing: 0 8px; width: 100%; margin: 0 auto;">
    <template v-slot:default class="d-flex align-center pe-2" >
      <thead>
        <tr>
          <th style="background-color: #f0f0f0; color: #333; padding: 12px; text-align: left;">Product Name</th>
          <th style="background-color: #f0f0f0; color: #333; padding: 12px; text-align: left;">Price</th>
          <th style="background-color: #f0f0f0; color: #333; padding: 12px; text-align: left;">Quantity</th>
          <th style="background-color: #f0f0f0; color: #333; padding: 12px; text-align: left;">Subtotal</th>
          <!-- Add more headers as needed -->
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, index) in tableData" :key="index">
          <td style="padding: 10px;">{{ item.name }}</td>
          <td style="padding: 10px;">{{ formatCurrency(item.price) }}</td>
          <td style="padding: 10px;">{{ item.quantity }}</td>
          <td style="padding: 10px;">{{ formatCurrency(item.quantity * item.price) }}</td>
          <!-- Add more columns as needed -->
        </tr>
      </tbody>
    </template>
  </v-simple-table>
        </v-col>
      </v-row>
  
      <!-- Fixed input text at the bottom -->
      <v-footer app>
        <v-container>
          <v-row justify="center">
            <v-col cols="12" sm="6">
                <v-text-field
  v-model="inputText"
  label="Quantity@UniveralProductCode"
  outlined
  @keydown.enter="handleEnterKey"
></v-text-field>

<p>PRESS Fn+F5 to set status to transacted</p>
            </v-col>
          </v-row>
        </v-container>
      </v-footer>
    </v-container>
  </v-main>
    </v-app>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        drawer: false,
        inputText: '',
        salesTransactionNumber: null,
        tableData: [],
        quantity:'',
        upc:'',
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
    created(){
      this.salesTransactionNumber = this.generateRandomKey();
    },
    methods: {
  formatCurrency(value) {
      // Ensure that value is a number before using toFixed
      const numericValue = Number(value);

      if (!isNaN(numericValue)) {
        // Format the currency as Philippine Peso
        return `₱${numericValue.toFixed(2)}`;
      } else {
        // Handle the case where value is not a number
        console.error('Invalid numeric value:', value);
        return ''; // or return a default value
      }
    },
      generateRandomKey() {
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        const length = 8;
        let result = '';
        for (let i = 0; i < length; i++) {
          const randomIndex = Math.floor(Math.random() * characters.length);
          result += characters.charAt(randomIndex);
        }
        return result;
      },
      async getSales(){
        const purchase_product = await axios.get(`/api/sales/${this.salesTransactionNumber}`);
        this.tableData = purchase_product.data;
      },
      async handleSales() {
  try {
    const response = await axios.get(`/api/setsales/${this.salesTransactionNumber}`);
    
    // Check if the response contains data
    if (response.data) {
      // Update the salesTransactionNumber and fetch the updated sales data
      this.salesTransactionNumber = this.generateRandomKey();
      this.getSales();
    } else {
      console.error('No data received in the response.');
    }
  } catch (error) {
    console.error('Error in handleSales:', error);
  }
},

async handleEnterKey() {
  try {
    if (this.inputText.includes('@')) {
      const parts = this.inputText.split('@');
      console.log('Split parts:', parts);
      this.quantity = parts[0];
      this.upc = parts[1];
    } else {
      this.upc = this.inputText;
      this.quantity = '1';
    }

    const response = await axios.post('/api/isales', {
      quantity: this.quantity,
      upc: this.upc,
      orderID: this.salesTransactionNumber,
    });

    console.log('Response from API:', response);

    this.inputText = '';
    this.getSales();
  } catch (error) {
    console.error('Error in handleEnterKey:', error);
  }
}
    },
  };
  </script>