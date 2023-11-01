<template>
    <SignUp />
  </template>
  
  <script>
  import { defineComponent } from 'vue';
  
  // Components
  import SignUp from '../components/SignUp';
  
  export default defineComponent({
    name: 'SignUp',
  
    components: {
      SignUp
    }
  });
  </script>
  