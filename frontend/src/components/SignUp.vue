<template>
    <div>
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
                  <form class="pt-3">
                    <div class="form-group">
                      <input type="email" class="form-control form-control-lg" v-model="email" placeholder="Username">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <div class="mt-3">
                      <a class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" href="../../index.html">SIGN IN</a>
                    </div>
                    <div class="my-2 d-flex justify-content-between align-items-center">
                      <div class="form-check">
                        <label class="form-check-label text-muted">
                          <input type="checkbox" class="form-check-input">
                          Keep me signed in
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
                      Don't have an account? <a href="register.html" class="text-primary">Create</a>
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
        email: ''
      }
    }
  }
  </script>
  
  <style scoped>
  h4, h6 {
  text-align: center;
}

form {
  max-width: 420px;
  margin: 30px auto;
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
  