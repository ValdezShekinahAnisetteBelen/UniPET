<template>
       <v-navigation-drawer     :value="drawer"
    @input="$emit('update:drawer', $event)"
    style="color: #FB9678; overflow-y: auto;"
    class="custom-scrollbar"
  >
          <v-app-bar app color="#03C9D7">
        <v-app-bar-nav-icon @click.stop="drawer = !drawer" color="#FFFF"></v-app-bar-nav-icon>
        <v-app-bar-title class="d-inline align-center" style="color: #FFFFFF;">
          UniPET
          <v-icon color="#FFFF">mdi-paw</v-icon>
        </v-app-bar-title>
      </v-app-bar>
      

    <button @click="toggleDrawer">Toggle Drawer</button>

    <v-list style="background-color: #03C9D7;">
  <v-list-item>
    <v-list-item-content>
      <v-list-item-icon>
      </v-list-item-icon>
      <v-list-item-title>DASHBOARD</v-list-item-title>
    </v-list-item-content>
  </v-list-item>
  <router-link v-for="(link, index) in links1" :key="index" :to="link.route" class="nav-link" style="color: #03C9D7; font-weight: bold; display: flex; align-items: center;">
    <v-icon>{{ link.icon }}</v-icon>
    {{ link.text }}
  </router-link>
</v-list>
  
        <v-list style="background-color: #03C9D7;">
  <v-list-item>
    <v-list-item-content>
      <v-list-item-icon>
      </v-list-item-icon>
      <v-list-item-title>E-COMMERCE</v-list-item-title>
    </v-list-item-content>
  </v-list-item>
  <router-link v-for="(link, index) in links2" :key="index" :to="link.route" class="nav-link" style="color: #03C9D7; font-weight: bold; display: flex; align-items: center;">
    <v-icon>{{ link.icon }}</v-icon>
    {{ link.text }}
  </router-link>
</v-list>

<v-list style="background-color: #03C9D7;">
  <v-list-item>
    <v-list-item-content>
      <v-list-item-icon>
      </v-list-item-icon>
      <v-list-item-title>PETS APPOINTMENT</v-list-item-title>
    </v-list-item-content>
  </v-list-item>
  <router-link v-for="(link, index) in links3" :key="index" :to="link.route" class="nav-link" style="color: #03C9D7; font-weight: bold; display: flex; align-items: center;">
    <v-icon>{{ link.icon }}</v-icon>
    {{ link.text }}
  </router-link>
</v-list>

<v-list style="background-color: #03C9D7;">
  <v-list-item>
    <v-list-item-content>
      <v-list-item-icon>
      </v-list-item-icon>
      <v-list-item-title>ACCOUNTS</v-list-item-title>
    </v-list-item-content>
  </v-list-item>
  <router-link v-for="(link, index) in links4" :key="index" :to="link.route" class="nav-link" style="color: #03C9D7; font-weight: bold; display: flex; align-items: center;">
    <v-icon>{{ link.icon }}</v-icon>
    {{ link.text }}
  </router-link>
</v-list>
</v-navigation-drawer>
  </template>
  
  <script>
  export default {
    props: {
      drawer: Boolean,
    },
    data() {
      return {
        links1: [
      { text: ' Key Metrics ', route: '/admin/dashboard', icon: 'mdi-view-dashboard' },
    ],
    links2: [
      { text: ' Order ', route: '/admin/order', icon: 'mdi-cart' },
      { text: ' Products ', route: '/admin/dashboard', icon: 'mdi-cart' },
    ],
    links3: [
      { text: ' Appointments ', route: '/admin/dashboard', icon: 'mdi-paw' },
      { text: ' Pets ', route: '/admin/dashboard', icon: 'mdi-paw' },
      { text: ' Customers ', route: '/admin/dashboard', icon: 'mdi-paw' },
    ],
    links4: [
      { text: ' Customer Profiles ', route: '/admin/dashboard', icon: 'mdi-account' },
      { text: ' Admin Accounts ', route: '/admin/dashboard', icon: 'mdi-account' },
      { text: ' Customers Payment Status ', route: '/admin/dashboard', icon: 'mdi-account' },
    ],
      };
    },
    methods: {
    // Emit an event to update the drawer state in the parent
    toggleDrawer() {
      this.$emit('update:drawer', !this.drawer);
    },
  },
  };
  </script>
  
  <style scoped>
  /* Add component-specific styles here */
  </style>
  