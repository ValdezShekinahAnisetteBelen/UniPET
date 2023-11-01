<template>
  <Online_Store />
</template>

<script>
import { defineComponent } from 'vue';

// Components
import Online_Store from '../views/Client/Online_Store.vue';

export default defineComponent({
  name: 'HomeView',

  components: {
    Online_Store,
  },
});
</script>
