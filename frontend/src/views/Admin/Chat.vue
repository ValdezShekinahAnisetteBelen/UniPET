<template>
  <div>
    <!-- Your Messenger Chat Plugin Code -->
    <div id="fb-root"></div>

    <!-- Your Chat Plugin code -->
    <div id="fb-customer-chat" class="fb-customerchat"></div>

    <h1>This is a Heading</h1>
    <p>This is a paragraph.</p>
  </div>
</template>

<script>
export default {
  mounted() {
    var chatbox = document.getElementById('fb-customer-chat');
    chatbox.setAttribute("page_id", "135374673003890");
    chatbox.setAttribute("attribution", "biz_inbox");

    window.fbAsyncInit = function () {
      FB.init({
        xfbml: true,
        version: 'v18.0'
      });
    };

    (function (d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s);
      js.id = id;
      js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
  }
}
</script>

<style scoped>
/* Your component styles go here */
</style>
