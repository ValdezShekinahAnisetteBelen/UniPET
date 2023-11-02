<template>
  <div>
    <div class="navbar">
      <ul>
        <li><a href="/">Home</a></li>
        <li><a href="#">Pages</a></li>
        <li><a href="/Shop">Shop</a></li>
      </ul>
    </div>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0">
          <div class="row w-100 mx-0">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                <div class="brand-logo">
                  <img src="" alt="">
                </div>
                <h4>Hello! Let's get started</h4>
                <h6 class="font-weight-light">Sign in to continue.</h6>
                <form @submit.prevent="signIn">
                  <div class="form-group">
                    <input type="email" class="form-control form-control-lg" v-model="email" placeholder="Email">
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-lg" v-model="password" placeholder="Password">
                  </div>
                  <div class="mt-3">
                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                  </div>
                  <div class="my-2 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                      <label class="form-check-label text-muted">
                        <input type="checkbox" class="form-check-input" v-model="rememberMe"> Keep me signed in
                      </label>
                    </div>
                    <a href="#" class="auth-link text-black">Forgot password?</a>
                  </div>
                  <div class="mb-2">
                    <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                      <i class="ti-facebook mr-2"></i>Connect using Facebook
                    </button>
                  </div>
                  <div class="text-center mt-4 font-weight-light">
                    Don't have an account? <a href="RegisterForm" class="text-primary">Create</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      email: '',
      password: '',
      rememberMe: false,
    };
  },
  methods: {
    signIn() {
      // Handle sign-in logic here
      console.log('Signing in...');
    },
  },
};
</script>

<style scoped>
body {
  background-color: skyblue; /* Change the background color as desired */
  margin: 0;
  padding: 0;
}
.navbar {
  position: fixed;
  top: 0cm;
  left: 35cm;
  width: 30%;
  background-color: skyblue; /* Change the background color as desired */
  padding: 20px; 
  z-index: 500;
  text-align: right;/* Adjust the z-index to ensure it's above other content */
}

.navbar li {
  display: inline;
  margin: 0 10px 20px;
  padding: 0 50px 0 50px;

  
}

h4 {
  text-align: center;
  margin-top: 5cm; /* Remove the top margin */
}

h6 {
  text-align: center;
  margin: 0; /* Remove all margins */
}

form {
  max-width: 420px;
  margin: 1cm auto;
  background: white;
  padding: 40px;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  text-align: center;
 
}

label {
  color: #aaa;
  display: inline-block;
  margin: 20px 0 15px;
  font-size: 0.6em;
  text-transform: uppercase;
  letter-spacing: 1px;
  font-weight: bold;
}

input {
  display: block;
  padding: 10px 6px;
  width: 100%;
  box-sizing: border-box;
  border: none;
  border-bottom: 1px solid #ddd;
  color: #555;
}
</style>
