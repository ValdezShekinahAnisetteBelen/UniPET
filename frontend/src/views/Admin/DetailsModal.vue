<template>
    <v-dialog v-model="modalOpen" max-width="800px">
      <v-card>
        <v-card-title>{{ modalTitle }}</v-card-title>
        <v-card-text>
          <!-- Display details in a styled table with separate columns for fields and values -->
          <v-simple-table>
            <template v-slot:default>
              <tbody>
                <tr v-for="(value, key) in flattenDetails(modalDetails)" :key="key">
                  <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">{{ key }}</td>
                  <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">{{ value }}</td>
                </tr>
              </tbody>
            </template>
          </v-simple-table>
        </v-card-text>
        <v-card-actions>
          <v-btn @click="closeModal">Close</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </template>
  <script>
  export default {
    data() {
      return {
        modalOpen: false,
        modalTitle: '',
        modalDetails: null,
        modalHeaders: [], // Define your modal headers array
      };
    },
    methods: {
        flattenDetails(details) {
      const flattenedDetails = {};

      const flatten = (obj, prefix = '') => {
        for (const [key, value] of Object.entries(obj)) {
          const propName = prefix + key;
          if (typeof value === 'object' && value !== null) {
            flatten(value, propName + '.');
          } else {
            flattenedDetails[propName] = value;
          }
        }
      };

      flatten(details);

      return flattenedDetails;
    },

    closeDetailsModal() {
      this.$refs.detailsModal.closeModal();
    },
    // Check if a value is an object
    isObject(value) {
      return value !== null && typeof value === 'object' && !Array.isArray(value);
    },
      openModal(field, id) {
        // Your logic to fetch details based on field and id
        // For example, use axios to fetch details from the server
        // and update modalDetails, modalTitle, and modalHeaders
        this.modalDetails = {
          field,
          // Add other details based on your data structure
        };
        this.modalTitle = `${field} Details`; // Replace this with the appropriate title
  
        // Assume you have a function to fetch headers based on field
        this.modalHeaders = this.fetchModalHeaders(field);
  
        this.modalOpen = true;
      },
      closeModal() {
        this.modalOpen = false;
        this.modalDetails = null;
        this.modalTitle = '';
        this.modalHeaders = [];
      },
      fetchModalHeaders(field) {
        // Your logic to fetch headers based on field
        // Replace this with actual headers based on your data structure
        return [
          { text: 'Field', value: 'field' },
          // Add other headers based on your data structure
        ];
      },
    },
  };
  </script>
  