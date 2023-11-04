<template>
    <body>
    <div class="form-data">
        <br>
        <h3>Appointment Form</h3>
        <p>To schedule an appointment, please fill out the information below.</p>
        <br>
        <form>
            <div class="form-section">
                <h6>Appointment Details</h6>
                <br>
                <div class="form-row">
                    <label for="full-name">Full Name</label>
                    <input type="text" id="full-name" placeholder="Enter full name" class="form-control">
                </div>
                <div class="form-row">
                    <label for="mobile-number">Mobile Number</label>
                    <input type="tel" id="mobile-number" placeholder="Enter mobile number" class="form-control">
                </div>
                <div class="form-row">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" placeholder="Enter email address" class="form-control">
                </div>
                <div class="form-row">
                    <label for="appointment-date">Appointment Date</label>
                    <input type="date" id="appointment-date" class="form-control">
                </div>
                <div class="form-row">
                    <label for="image-upload">Upload Image</label>
                    <input type="file" id="image-upload" class="form-control" accept="image/*">
                </div>
            </div>
            <div class="form-section">
                <h6>Address Details</h6>
                <br>
                <div class="form-row">
                    <label for="area">Area</label>
                    <input type="text" id="area" placeholder="Enter area" class="form-control">
                </div>
                <div class="form-row">
                    <label for="city">City</label>
                    <input type="text" id="city" placeholder="Enter city" class="form-control">
                </div>
                <div class="form-row">
                    <label for="state">State</label>
                    <input type="text" id="state" placeholder="Enter state" class="form-control">
                </div>
                <div class="form-row">
                    <label for="postal-code">Postal Code</label>
                    <input type="text" id="postal-code" placeholder="Postal code" class="form-control">
                </div>
                <div class="form-row">
                    <input type="submit" value="Book Now" id="button">
                </div>
            </div>
        </form>
    </div>
</body>

</template>
<style>
  @import '../../../src/assets/User/css/appointment.css';
</style>