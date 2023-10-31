<template>
    <booking-form />
  </template>
  
  <script>
  import Booking from "@/components/Booking.vue"; // Adjust the path to your component
  
  export default {
    components: {
      'booking-form': Booking,
    },
  };
  </script>
  