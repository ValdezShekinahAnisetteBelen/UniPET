<template>
  <v-card
    flat
    title="Audit History"
  >
  <v-btn @click="goBack">Back</v-btn>
    <template v-slot:text>
      <v-text-field
        v-model="search"
        label="Search"
        prepend-inner-icon="mdi-magnify"
        single-line
        variant="outlined"
        hide-details
      ></v-text-field>
    </template>

    <v-data-table
      :headers="headers"
      :items="desserts"
      :search="search"
    ></v-data-table>
  </v-card>
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
       upc: null,
    auditData: null,
       headers: [
         {
           align: 'start',
           key: 'upc',
           sortable: false,
           title: 'UPC',
         },
         { key: 'name', title: 'Name' },
         { key: 'description', title: 'Description' },
         { key: 'oldQuantity', title: 'Old Quantity' },
         { key: 'stock', title: 'Quantity' },
         { key: 'type', title: 'type' },
       ],
       desserts: [],
     }
   },
   
mounted() {
  // Access the UPC parameter passed in the route
  this.upc = this.$route.params.upc;
  this.getAudit();
},
   
   methods:{
     async getAudit(){
      const data = await axios.get(`api/audit/${this.upc}`);
       this.desserts = data.data;
     },
     goBack() {
      this.$router.push('/products2'); // Replace '/audit-history' with your actual route path
    },
   }
 }
</script>