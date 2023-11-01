<template>
  <div>
    <h1 class="title">Product </h1>
    <router-link :to="{ name: 'AddProduct' }" class="button is-primary">Add New</router-link>
    <table class="table is-striped is-fullwidth">
      <thead>
        <tr>
          <th>Name</th>
          <th>Description</th>
          <th>Price</th>
          <th>Stock</th>
          <th>Image</th>
          <th>Product Group</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="product in products" :key="product.id">
          <td>{{ product.name }}</td>
          <td>{{ product.description }}</td>
          <td>{{ product.price }}</td>
          <td>{{ product.stock }}</td>
          <td>{{ product.image }}</td>
          <td>{{ product.productgroup }}</td>
          <td>
            <router-link :to="{ name: 'EditProduct', params: { id: product.id } }" class="button is-info is-small">Edit</router-link>
            <button class="button is-danger is-small" @click="deleteProduct(product.id)">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "Product",
  data() {
    return {
      products: [],
    };
  },
  created() {
    this.getProducts();
  },
  methods: {
    async getProducts() {
      try {
        const response = await axios.get("product");
        this.products = response.data;
      } catch (error) {
        console.log(error);
      }
    },
    async deleteProduct(id) {
      try {
        await axios.delete(`product/${id}`);
        this.getProducts();
      } catch (error) {
        console.log(error);
      }
    },
  },
};
</script>

<style></style>
