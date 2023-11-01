<template>
  <div id="app">
  <v-app>
  <v-banner
  v-if="deferredPrompt"
  color="info"
  dark
  class="text-left"
  >
  Install our Apps 
  <template v-slot:actions>
  <v-btn text @click="dismiss">Dismiss</v-btn>
  <v-btn text @click="install">Install</v-btn>
  </template>
  </v-banner>
  <router-view>
  </router-view>
  </v-app>
  </div>
  </template>
  <script>
  import Cookies from "js-cookie";
  export default {
  name: "App",
  data() {
return {
deferredPrompt: null
};
},
created() {
window.addEventListener("beforeinstallprompt", e => {
e.preventDefault();
// Stash the event so it can be triggered later.
this.deferredPrompt = e;
if (Cookies.get("add-to-home-screen") === undefined) {
this.deferredPrompt = e;
}
});
window.addEventListener("appinstalled", () => {
this.deferredPrompt = null;
});
},
methods: {
async dismiss() {
Cookies.set("add-to-home-screen", null, { expires: 15 });
this.deferredPrompt = null;
this.deferredPrompt = null;
},
async install() {
this.deferredPrompt.prompt();
}
}
};
</script>