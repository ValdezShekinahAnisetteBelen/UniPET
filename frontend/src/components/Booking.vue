<template>
    <div>
      <h1>UniPET</h1>
  
      <form @submit.prevent="submitForm">
        <label for="first_name">First Name:</label>
        <input v-model="formData.firstName" type="text" id="first_name" name="first_name" required>
  
        <label for="last_name">Last Name:</label>
        <input v-model="formData.lastName" type="text" id="last_name" name="last_name" required>
  
        <label for="address">Address:</label>
        <input v-model="formData.address" type="text" id="address" name="address" required>
  
        <label for="email">Email:</label>
        <input v-model="formData.email" type="email" id="email" name="email" required>
  
        <label for="phone">Phone Number:</label>
        <input v-model="formData.phone" type="tel" id="phone" name="phone" required>
  
        <label for="date">Choose Date:</label>
        <input v-model="formData.date" type="date" id="date" name="date" required>
  
        <label for="dog_boarding">Dog Boarding:</label>
        <input v-model="formData.dogBoarding" type="checkbox" id="dog_boarding" name="dog_boarding">
  
        <!-- Add more fields as needed -->
  
        <input type="submit" value="Submit">
      </form>
    </div>
  </template>
  
  <script>
  export default {
    name:"Booking",
    data() {
      return {
        formData: {
          firstName: "",
          lastName: "",
          address: "",
          email: "",
          phone: "",
          date: "",
          dogBoarding: false, // Default value for checkbox
          // Add more data properties as needed
        },
      };
    },
    methods: {
      submitForm() {
        // Handle form submission here
        // Access form data using this.formData.firstName, this.formData.lastName, etc.
        // For example, you can send this data to a server or perform other actions.
      },
    },
  };
  </script>
  