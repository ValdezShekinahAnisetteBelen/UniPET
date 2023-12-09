<template>
    <v-dialog v-model="modalOpen" max-width="800px">
      <v-card>
        <v-card-title>Details</v-card-title>
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
          <button @click="copyToClipboard(modalDetails)">Copy to Clipboard</button>
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
      async copyToClipboard() {
  try {
    // Create an array to store details
    const detailsArray = [];

    // Iterate over modalDetails and add each property to the array
    for (const key in this.modalDetails) {
      if (key === 'items') {
        // Special handling for items array
        detailsArray.push('Items:');
        for (const itemKey in this.modalDetails[key]) {
          const item = this.modalDetails[key][itemKey];
          detailsArray.push(`  Quantity: ${item.quantity}, Name: ${item.name}`);
        }
      } else {
        const value = this.modalDetails[key];

        // Check if the value is an object, stringify it without brackets
        const formattedValue = this.isObject(value) ? this.formatObject(value) : value;

        detailsArray.push(`${key.charAt(0).toUpperCase() + key.slice(1)}: ${formattedValue}`);
      }
    }

    // Create a string by joining the array elements with newline characters
    const detailsString = detailsArray.join('\n');

    // Use the Clipboard API to write text to the clipboard
    await navigator.clipboard.writeText(detailsString);

    // Use window.prompt to notify the user
    window.prompt('Details copied to clipboard. Press Ctrl+C to copy.', detailsString);
  } catch (error) {
    console.error('Error copying to clipboard:', error);
    alert('Error copying to clipboard. Please try again.');
  }
},


formatObject(obj) {
  // Convert object to string without brackets
  return JSON.stringify(obj).slice(1, -1);
},



capitalizeFirstLetter(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
  },
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
    closeModal() {
      // Your logic for closing the modal
      this.$emit('update:modalOpen', false);
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
  