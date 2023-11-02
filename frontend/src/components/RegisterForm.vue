<template>
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
            <h4>New here? Register Now</h4>
            <h6 class="font-weight-light"> It only takes a few steps to Register</h6>
            <form class="pt-3">
              <div class="form-group">
                <input type="text" class="form-control form-control-lg" id="exampleInputUsername1" placeholder="Username">
              </div>
              <div class="form-group">
                <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email">
              </div>
          
              <div class="form-group">
                <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
              </div>
              <div class="mb-4">
                <div class="form-check">
                  <label class="form-check-label text-muted">
                    <input type="checkbox" class="form-check-input">
                    I agree to all Terms & Conditions
                  </label>
                </div>
              </div>
              <div class="mt-3">
                <a class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" href="../../index.html">REGISTER</a>
              </div>
              <div class="text-center mt-4 font-weight-light">
                Already have an account? <a href="login.html" class="text-primary">Login</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- content-wrapper ends -->
  </div>
  <!-- page-body-wrapper ends -->
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