<template>
    <v-dialog v-model="isDialogVisible" max-width="500">
      <v-card>
        <v-card-title>Edit Customer</v-card-title>
        <v-card-text>
          <!-- Display the customer details in textboxes for editing -->
                   <v-text-field v-model="editedCustomer.first_name" label="First Name"></v-text-field>
          <v-text-field v-model="editedCustomer.last_name" label="Last Name"></v-text-field>
          <v-text-field v-model="editedCustomer.email" label="Email"></v-text-field>
          <v-text-field v-model="editedCustomer.phone_number" label="Phone Number"></v-text-field>
          <v-text-field v-model="editedCustomer.username" label="username"></v-text-field>
          <v-text-field v-model="editedCustomer.password" label="password"></v-text-field>
          <v-text-field v-model="editedCustomer.status" label="status"></v-text-field>
          <v-text-field v-model="editedCustomer.role" label="role"></v-text-field>          
          <!-- Add other text fields for the remaining fields -->
  
          <!-- ... other fields ... -->
        </v-card-text>
        <v-card-actions>
          <v-btn @click="saveChanges">Save Changes</v-btn>
          <v-btn @click="closeModal">Close</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </template>
  
  <script>
  export default {
    props: {
      dialog: Boolean,
      editedCustomer: Object,
    },
  
    data() {
      return {
        isDialogVisible: false,
      };
    },
  
    watch: {
      dialog(newVal) {
        // Update the local state when the prop changes
        this.isDialogVisible = newVal;
      },
    },
  
    methods: {
      saveChanges() {
        // Notify the parent component to save the changes
        this.$emit('save');
      },
  
      closeModal() {
        // Notify the parent component to close the modal without saving changes
        this.$emit('close');
      },
    },
  };
  </script>
  