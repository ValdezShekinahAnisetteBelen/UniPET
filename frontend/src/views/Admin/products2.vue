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
    <v-main class="d-flex align-center justify-center" style="min-height: 300px; background-color: #ECECEC;">
      <v-data-table v-model:search="search" :headers="headers" :items="desserts">

      <template v-slot:item="{ item }">
        <tr>
          <td>{{ item.upc }}</td>
          <td>{{ item.name }}</td>
          <td>{{ item.description }}</td>
          <td>{{ item.stock }}</td>
          <td>{{ item.price }}</td>
          <td>{{ item.productgroup }}</td>
          <td>
            <v-btn @click="openQuantityModal(item)">
              Add stock
            </v-btn>
            <br>
            <router-link :to="{ path: '/history/' + item.upc }" class="button">Audit</router-link>
          </td>
        </tr>
      </template>
    </v-data-table>
  
    <!-- stock Modal -->
    <v-dialog v-model="quantityModal" max-width="400">
      <v-card>
        <v-card-title>Add stock</v-card-title>
        <v-card-text>
          <!-- Your stock input field and other necessary fields go here -->
          <v-text-field v-model="quantityToAdd" label="stock"></v-text-field>
        </v-card-text>
        <v-card-actions>
          <v-btn @click="addQuantity">Add</v-btn>
          <v-btn @click="closeQuantityModal">Close</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-main>
    </v-app>
  </template>
  
    <script>
    import axios from 'axios'
      export default {
        data () {
          return {
            quantityModal: false,
        selectedProduct: null,
        quantityToAdd: 0,
            search: '',
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
  
            headers: [
              {
                align: 'start',
                key: 'upc',
                sortable: false,
                title: 'UPC',
              },
              { key: 'name', title: 'Name' },
              { key: 'description', title: 'Description' },
              { key: 'stock', title: 'Current Stocks' },
              { key: 'price', title: 'price' },
              { key: 'cateogry', title: 'productgroup' },
            ],
            desserts: [],
          }
        },
        created(){
          this.getProducts();
        },
        methods:{
          openQuantityModal(item) {
        this.selectedProduct = item;
        this.quantityToAdd = 0;
        this.quantityModal = true;
      },
  
      closeQuantityModal() {
        this.selectedProduct = null;
        this.quantityToAdd = 0;
        this.quantityModal = false;
      },
      async addQuantity() {
        // Perform the logic to add stock using axios or your preferred method
        // Update the selected product's stock in the desserts array
        // Close the modal
        const updatedProduct = { ...this.selectedProduct };
        updatedProduct.stock += parseInt(this.quantityToAdd);
        // Perform the logic to update the stock on the server using axios or your preferred method
        // For example, you might need to make a POST request to update the stock
        await axios.post('/api/updateQuantity', {
          upc: updatedProduct.upc,
          stock: this.quantityToAdd,
        });
        
        // Find the index of the updated product in the desserts array
        const index = this.desserts.findIndex((product) => product.upc === updatedProduct.upc);
        this.getProducts();
        // Update the product in the desserts array
        // if (index !== -1) {
        //   this.$set(this.desserts, index, updatedProduct);
        // }
  
        // Close the modal
        this.closeQuantityModal();
      },
          async getProducts(){
            const data = await axios.get('/api/getProducts');
            this.desserts = data.data;
          }
        }
      }
    </script>