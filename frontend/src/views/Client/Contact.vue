<template>
    <body>
        <div class="contact-2-page">
            <form>
                <h1>Contact Us</h1>
                <input type="text" id="firstname" placeholder="First Name" required>
                <input type="text" id="lastname" placeholder="Last Name" required>
                <input type="email" id="email" placeholder="Email" required>
                <input type="text" id="mobile" placeholder="Mobile" required>
                <h4>Type Your Message Here...</h4>
                <textarea required></textarea>
                <input type="submit" value="send" id="button">
            </form>
        </div>
    </body>
</template>

<style>
@import '../../../src/assets/User/css/contact.css';
</style>