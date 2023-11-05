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
                    <input type="text" id="full-name" placeholder="Enter full name" class="form-control">
                </div>
                <div class="form-row">                  
                    <input type="tel" id="mobile-number" placeholder="(000) 000-0000" class="form-control">
                </div>
                <div class="form-row">                  
                    <input type="email" id="email" placeholder="ex: myname@example.com" class="form-control">
                </div>
                <div class="form-row">
                    <input type="date" id="appointment-date" class="form-control">
                </div>
                <div class="form-row">
                    <label>Upload Image</label>
                    <input type="file" id="image-upload" class="form-control" accept="image/*">
                </div>

                <div class="form-section">
        <h6>Request</h6>
        <br>
        <div class="form-row">
            <label for="request-checkbox">Select Request(s)</label>
            <div class="checkbox-list">
                <label>
                    <input type="checkbox" name="request" value="check-up">
                    Check Up
                </label>
                <label>
                    <input type="checkbox" name="request" value="vaccine">
                    Vaccine
                </label>
                <label>
                    <input type="checkbox" name="request" value="deworm">
                    Deworm
                </label>
                <label>
                    <input type="checkbox" name="request" value="labtest">
                    Labtest
                </label>
            </div>
        </div>
    </div>

            </div>
            <div class="form-section">
                <h6>Address Details</h6>
                <br>
                <div class="form-row">
                    <input type="text" id="area" placeholder="Enter area" class="form-control">
                </div>
                <div class="form-row">
                    <input type="text" id="city" placeholder="Enter city" class="form-control">
                </div>
                <div class="form-row">
                    <input type="text" id="postal-code" placeholder="Postal code" class="form-control">
                </div>
                
                <div class="form-row">
                <label for="service-type">Groom</label>
                <select id="groom-service-type" class="form-control" multiple>
                  <option value="puppy-cut">Puppy Cut</option>
                  <option value="summer-cut">Summer Cut</option>
                  <option value="semi-kalbo">Semi Kalbo</option>
                  <option value="trim-only">Trim Only</option>
                  <option value="face-trim">Face Trim</option>
                  <option value="kalbo">Kalbo</option>
                </select>
                </div>

                <div class="form-row">
                 <label for="service-type">Bath</label>
                 <select id="bath-service-type" class="form-control" multiple>
                  <option value="regular">Regular</option>
                  <option value="medicated">Medicated</option>
                  <option value="antimage">Antimage</option>
                 </select>
                </div>

                <div class="sending-message">
                <br>
                 Sending your appointment request...
                 <textarea placeholder="Additional comments" required></textarea>
                 <div class="center-button">
                  <input type="submit" value="Submit Form" id="button" style="width: 130px; height: 40px;">
                 </div>
                </div>
            </div>  
        </form>
    </div>
</body>

</template>
<style>
  @import '../../../src/assets/User/css/appointment.css';
</style>