<template>
<body>
    <div class="navbar">
    <ul>
    <li><a href="/">Home</a></li>
    <li><a href="#">Pages</a></li>
    <li><a href="/Shop">Shop</a></li>
    </ul>
</div>

<div class="contact-2-page">
    <form>
        <h1>Contact Us</h1>
        <input type="text" id="firstname" placeholder="First Name" required>
        <input type="text" id="lastname" placeholder="Last Name" required>
        <input type="email" id="email" placeholder="Email" required>
        <input type="tel" id="mobile" placeholder="Mobile" required>
        <h7>Type Your Message Here...</h7>
        <textarea required></textarea>
        <input type="submit" value="Send" id="button">
    </form>
</div>
</body>
</template>
 
<style> 
@import '../../../src/assets/User/css/contact.css'; 
</style>  