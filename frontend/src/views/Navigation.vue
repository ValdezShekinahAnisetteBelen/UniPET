<template>
    <NavigationBar />
  </template>
  
  <script>
  import { defineComponent } from 'vue';
  
  // Components
  import NavigationBar from '../views/Client/NavigationBar';

  
  export default defineComponent({
    name: 'NavigationBar',
  
    components: {
        NavigationBar
}
  });
  </script>
  