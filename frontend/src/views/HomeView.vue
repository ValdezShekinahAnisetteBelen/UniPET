<template>
  <Online_Store />
</template>

<script>
import { defineComponent } from 'vue';

// Components
import Online_Store from '../components/Client/Online_Store';

export default defineComponent({
  name: 'HomeView',

  components: {
    Online_Store,
  },
});
</script>
