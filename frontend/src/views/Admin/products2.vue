<template>
    <!-- ... existing code ... -->
    <v-data-table
      :headers="headers"
      :items="desserts"
      :search="search"
    >
      <template v-slot:item="{ item }">
        <tr>
          <td>{{ item.upc }}</td>
          <td>{{ item.name }}</td>
          <td>{{ item.description }}</td>
          <td>{{ item.stock }}</td>
          <td>{{ item.unit_price }}</td>
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
              { key: 'unit_price', title: 'unit_price' },
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