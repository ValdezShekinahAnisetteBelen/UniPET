<template>
  <v-app>
    <v-container fluid>
      <v-row align="center" justify="center">
        <v-col cols="12" sm="8" md="4">
          <v-card class="auth-form-light text-left py-5 px-4 px-sm-5">
            <v-img
              src="User/wp-content/uploads/sites/2/2019/11/login.svg"
              alt="logo"
              class="brand-logo"
            ></v-img>
            <h4>Hello! let's get started</h4>
            <h6 class="font-weight-light">Sign in to continue.</h6>
            <v-form @submit.prevent="login">
              <v-text-field
                v-model="username"
                label="username"
                outlined
                class="form-group"
              ></v-text-field>
              <v-text-field
                v-model="password"
                label="password"
                type="password"
                outlined
                class="form-group"
              ></v-text-field>
              <v-btn
                type="submit"
                block
                color="primary"
                class="btn-lg font-weight-medium auth-form-btn"
              >
                SIGN IN
              </v-btn>
              <div class="my-2 d-flex justify-content-between align-items-center">
                <v-checkbox
                  v-model="rememberMe"
                  label="Keep me signed in"
                  class="form-check"
                ></v-checkbox>
                <v-btn text class="auth-link" @click="forgotPassword">
                  Forgot password?
                </v-btn>
              </div>
              <v-btn
                block
                color="facebook"
                class="btn-lg auth-form-btn"
                @click="connectWithFacebook"
              >
                <v-icon left>mdi-facebook</v-icon> Connect using Facebook
              </v-btn>
              <div class="text-center mt-4 font-weight-light">
                Don't have an account? <a href="/register" class="text-primary">Register</a>
              </div>
            </v-form>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>

<script>
import axios from 'axios';
import router from '@/router';

export default {
  data() {
    return {
      username:"",
      password:"",
      errorMsg:"",
    };
  },
  methods: {
      // Handle sign-in logic here
      async login() {
       const d = await axios.post("api/login", {
        username : this.username,
        password: this.password
       });
       if(d.data.msg== 'okay') {
        sessionStorage.setItem("token", d.data.token);
        router.push('/');
        
       }
      }
    },
    forgotPassword() {
      // Handle forgot password logic here
      console.log('Forgot password clicked...');
    },
    connectWithFacebook() {
      // Handle Facebook login logic here
      console.log('Connect with Facebook clicked...');
    },
  };
</script>

<style scoped>
  @import '../../src/assets/User/css/themify-icons.css';
  @import '../../src/assets/User/css/feather.css';
  @import '~vuetify/dist/vuetify.min.css';
  /* Additional styling from your existing CSS */
  @import '../../src/assets/User/css/vendor.bundle.base.css';
  @import '../../src/assets/User/css/stylel.css';
</style>
