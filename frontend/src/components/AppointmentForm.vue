<template>
  <body>
    <div class="form-data">
      <br>
      <h3>Appointment Form</h3>
      <p>To schedule an appointment, please fill out the information below.</p>
      <br>
      <form>
        <div class="form-section">
          <h6>Pet Owner Information</h6>
          <br>
          <div class="form-row">
            <label for="full_name">Full Name</label>
            <input type="text" v-model="appointment.full_name" id="full_name" placeholder="Enter full name" class="form-control"/>
          </div>
          <div class="form-row">
            <label for="contact_no">Contact Number</label>
            <input type="tel" v-model="appointment.contact_no" id="contact_no" placeholder="Enter contact number" class="form-control"/>
          </div>
          <div class="form-row">
            <label for="email_address">Email Address</label>
            <input type="email" v-model="appointment.email_address" id="email_address" placeholder="Enter email address" class="form-control"/>
          </div>
          <div class="form-row">
            <label for="area">Area</label>
            <input type="text" v-model="appointment.area" id="area" placeholder="Enter mobile number" class="form-control"/>
          </div>
          <div class="form-row">
            <label for="city">City</label>
            <input type="text" v-model="appointment.city" id="city" placeholder="Enter City" class="form-control"/>
          </div>
          <div class="form-row">
            <label for="postal_code">Postal Code</label>
            <input type="text" v-model="appointment.postal_code" id="postal_code" placeholder="Postal Code" class="form-control"/>
          </div>
          <div class="form-row">
            <label for="appointment_date">Appointment Date</label>
            <input type="date" v-model="appointment.appointment_date" id="appointment_date" class="form-control"/>
          </div>
        </div>
        <div class="form-section">
          <h6>Appointment Details</h6>
          <br>
          <div class="form-row">
            <label>Appointment Type</label>
            <Checklist :items="appointmentTypes" v-model="selectedAppointmentTypes"/>
          </div>
          <div class="form-row">
            <label>Grooming Type</label>
            <Checklist :items="groomingTypes" v-model="selectedGroomingTypes"/>
          </div>
          <div class="form-row">
            <label>Bath</label>
            <Checklist :items="groomingShampoos" v-model="selectedGroomingShampoos"/>
          </div>
          <div class="center-button">
            <input type="submit" value="Book Now" id="button" style="width: 130px; height: 40px;"/>
          </div>
        </div>
      </form>
    </div>
  </body>
</template>


<script>
import Checklist from './Checklist.vue'; // Create Checklist component

export default {
  data() {
    return {
      appointment: {
        full_name: '',
        area: '',
        // Add more fields here
      },
      appointmentTypes: ['Checkup', 'Vaccine', 'Deworm', 'LabTest'],
      groomingTypes: ['PuppyCut', 'SummerCut', 'SemiKalbo', 'TrimOnly', 'FaceTrim', 'Kalbo'],
      groomingShampoos: ['Regular', 'Medicated', 'AntiMage'],
      selectedAppointmentTypes: [],
      selectedGroomingTypes: [],
      selectedGroomingShampoos: [],
    };
  },
  components: {
    Checklist,
  },
  methods: {
    createAppointment() {
      // Send a POST request to your CodeIgniter 4 API to create an appointment
      const formData = {
        ...this.appointment,
        appointment_type: this.selectedAppointmentTypes,
        grooming_type: this.selectedGroomingTypes,
        grooming_shampoo: this.selectedGroomingShampoos,
      };
      // Use Axios or another HTTP client to send the request
      // Handle the response (success or error)
    },
  },
};
</script>

<style>
  @import '../../src/assets/User/css/appointment.css';
</style>
