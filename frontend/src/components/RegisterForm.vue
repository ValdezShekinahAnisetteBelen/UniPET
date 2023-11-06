<template>
    <div class="container-scroller">
  <div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="content-wrapper d-flex align-items-center auth px-0">
      <div class="row w-100 mx-0">
        <div class="col-lg-4 mx-auto">
          <div class="auth-form-light text-left py-5 px-4 px-sm-5">
            <div class="brand-logo">
              <img src="User/wp-content/uploads/sites/2/2019/11/login.svg" alt="">
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
                Already have an account? <a href="/SignUp" class="text-primary">Login</a>
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
loadScripts() {
          const scriptUrls = [
          '../../../../frontend/public/User/vendor.bundle.base.js',
          '../../../../frontend/public/User/off-canvas.js',
          '../../../../frontend/public/User//hoverable-collapse.js',
          '../../../../frontend/public/User/template.js',
          '../../../../frontend/public/User/settings.js',
          '../../../../frontend/public/User/todolist.js',
          ];
          const head = document.getElementsByTagName('head')[0];
          scriptUrls.forEach((scriptUrl) => {
            const script = document.createElement('script');
            script.src = scriptUrl;
            script.async = true;
            head.appendChild(script);
          });
      },
};
</script>

<style scoped>
    @import '../../src/assets/User/css/themify-icons.css';
    @import '../../src/assets/User/css/feather.css';
    @import '../../src/assets/User/css/vendor.bundle.base.css';
    @import '../../src/assets/User/css/stylel.css';
</style>