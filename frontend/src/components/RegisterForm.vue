<template>
  <v-container fluid class="container-scroller">
    <v-row align="center" justify="center">
      <v-col cols="12" md="4">
        <v-card class="auth-form-light text-left py-5 px-4 px-sm-5">
          <v-img src="User/wp-content/uploads/sites/2/2019/11/login.svg" alt="Logo"></v-img>
          <h4>New here? Register Now</h4>
          <h6 class="font-weight-light">It only takes a few steps to Register</h6>
          <v-form @submit.prevent="register" class="pt-3">
            <v-text-field v-model="username" label="Username" outlined></v-text-field>
            <v-text-field v-model="email" label="Email" outlined></v-text-field>
            <v-text-field v-model="password" label="Password" type="password" outlined></v-text-field>
            <v-text-field v-model="passwordConfirm" label="Confirm Password" type="password" outlined></v-text-field>
            <div v-if="message === 'passwordMismatch'" class="mb-4 text-red">Passwords do not match</div>
            <v-checkbox v-model="rememberMe" label="I agree to all Terms & Conditions" class="mb-4"></v-checkbox>
            <v-btn block color="primary" dark type="submit">REGISTER</v-btn>
            <div class="text-center mt-4 font-weight-light">
              Already have an account? <router-link to="/login" class="text-primary">Login</router-link>
            </div>
          </v-form>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import router from '@/router';
import axios from 'axios';

export default {
  data() {
    return {
      username: '',
      email: '',
      password: '',
      passwordConfirm: '',
      rememberMe: false,
      message: '',
    };
  },
  methods: {
    async register() {
      if (this.password === this.passwordConfirm) {
        try {
          const response = await axios.post('api/register', {
            username: this.username,
            email: this.email,
            password: this.password,
          });

          if (response.data.msg === 'okay') {
            alert('Registered successfully');
            router.push('/login');
          } else {
            this.message = 'error';
          }
        } catch (error) {
          console.error('Error during registration:', error);
          this.message = 'error';
        }
      } else {
        this.message = 'passwordMismatch';
      }
    },
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

/* Add any additional scoped styles here */
.text-red {
  color: red;
}
</style>
