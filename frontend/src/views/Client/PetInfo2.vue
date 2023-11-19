<template>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, user-scalable=yes">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.19.0/font/bootstrap-icons.css" rel="stylesheet">
        
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name='robots' content='max-image-preview:large' />
        
        <link rel='dns-prefetch' href='http://fonts.googleapis.com/' />
        <link rel="alternate" type="application/rss+xml" title="Buddy &raquo; Feed" href="feed/index.html" />
        <link rel="alternate" type="application/rss+xml" title="Buddy &raquo; Comments Feed" href="comments/feed/index.html" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
        
        <link rel='stylesheet' id='pawsitive-fonts-css' href='https://fonts.googleapis.com/css?family=Nunito+Sans%3A100%2C200%2C300%2C400%2C500%2C600%2C700%2C800%2C900%2C100italic%2C200italic%2C300italic%2C400italic%2C500italic%2C600italic%2C700italic%2C800italic%2C900italic%7CNunito%3A100%2C200%2C300%2C400%2C500%2C600%2C700%2C800%2C900%2C100italic%2C200italic%2C300italic%2C400italic%2C500italic%2C600italic%2C700italic%2C800italic%2C900italic%7CNunito+Sans%3A100%2C200%2C300%2C400%2C500%2C600%2C700%2C800%2C900%2C100italic%2C200italic%2C300italic%2C400italic%2C500italic%2C600italic%2C700italic%2C800italic%2C900italic%7CNunito+Sans%3A100%2C200%2C300%2C400%2C500%2C600%2C700%2C800%2C900%2C100italic%2C200italic%2C300italic%2C400italic%2C500italic%2C600italic%2C700italic%2C800italic%2C900italic%7CNunito+Sans%3A100%2C200%2C300%2C400%2C500%2C600%2C700%2C800%2C900%2C100italic%2C200italic%2C300italic%2C400italic%2C500italic%2C600italic%2C700italic%2C800italic%2C900italic%7CNunito%3A100%2C200%2C300%2C400%2C500%2C600%2C700%2C800%2C900%2C100italic%2C200italic%2C300italic%2C400italic%2C500italic%2C600italic%2C700italic%2C800italic%2C900italic&#038;subset=latin%2Clatin-ext&#038;ver=1.0.0' type='text/css' media='all' />
        
        <link rel="https://api.w.org/" href="wp-json/index.html" />
        <link rel="alternate" type="application/json" href="../../../../frontend/public/User/wp-json/wp/v2/pages/2767.json" /><link rel="EditURI" type="application/rsd+xml" title="RSD" href="xmlrpc0db0.php?rsd" />
        <meta name="generator" content="WordPress 6.3.2" />
        <meta name="generator" content="WooCommerce 8.2.0" />
        <link rel="canonical" href="index.html" />
        <link rel='shortlink' href='index.html' />
        <link rel="alternate" type="application/json+oembed" href="../../../../frontend/public/User/wp-json/oembed/1.0/embed0ee1.json" />
        <link rel="alternate" type="text/xml+oembed" href="../../../../frontend/public/User/wp-json/oembed/1.0/embed858d" />
        
            <body class="home page-template-default page page-id-2767 page-parent theme-pawsitive bt_bb_plugin_active bt_bb_fe_preview_toggle woocommerce-js btHeadingWeight_default btMenuWeight_default btCurrentPage_default btButtonWeight_default btMenuRightEnabled btStickyEnabled btHideHeadline btLightSkin btBelowMenu btNoDashInSidebar noBodyPreloader btDropButtons btTransparentDarkHeader btNoSidebar btMenuRight btMenuInitFinished btRemovePreloader btMenuHorizontal">
            
            <div class="btPageWrap" id="top">
                
                <div class="btVerticalHeaderTop">
                            <div class="btVerticalMenuTrigger">&nbsp;<div class="bt_bb_icon" data-bt-override-class="null"><a href="#" target="_self" data-ico-fa="" class="bt_bb_icon_holder"></a></div></div>
                        
                    <div class="btLogoArea">
                        <div class="logo">
                            <span>
                                <a href="index.html"><img class="btMainLogo" data-hw="2.1111111111111" src="../../../../frontend/public/User/wp-content/uploads/sites/2/2019/11/logo_black.svg" alt=""></a></span>
                        </div>
                    </div>
                </div>
            <div class="page-content" style="background-image: url('images/wizard-v1.jpg')">
                <div class="wizard-v1-content">
            <div class="wizard-form">
        <section class="container-fluid p-4">
            <!-- row -->
            <div class="row justify-content-center">
              <div class="col-lg-8 col-12">
                <!-- card -->
                <div class="new">
                     <!-- card body -->
                  <div class="card-body">
                    
                    <div class="mb-6">
                </div>
                </div>
                </div>
                <div class="card">
    <body>
      <div class="container">
        
        <form @submit.prevent="save">
          <div class="row">
            <div class="col-md-6">
              <div class="form-data">
                <h3>Appointment and Pet Information Form</h3>
                <p>
                  To schedule an appointment and enter pet details, please fill out
                  the information below:
                </p>
                <div class="form-section">
                  <br>
                  <br>
                  <h6>Pet Owner Information</h6>
                  <div class="form-row">
                    <label for="full_name">Full Name</label>
                    <input
                      type="text"
                      v-model="appointment.full_name"
                      id="full_name"
                      placeholder="Enter full name"
                      class="form-control"
                    />
                  </div>
                  <div class="form-row">
                    <label for="contact_no">Contact No</label>
                    <input
                      type="tel"
                      v-model="appointment.contact_no"
                      id="contact_no"
                      placeholder="Enter contact number"
                      class="form-control"
                    />
                  </div>
                  <!-- Add other Pet Owner Information fields here -->
                  <div class="form-row">
                    <label for="email_address">Email Address</label>
                    <input
                      type="email"
                      v-model="appointment.email_address"
                      id="email_address"
                      placeholder="Enter email address"
                      class="form-control"
                    />
                  </div>
                  <div class="form-row">
                    <label for="area">Area</label>
                    <input
                      type="text"
                      v-model="appointment.area"
                      id="area"
                      placeholder="Enter area"
                      class="form-control"
                    />
                  </div>
                  <div class="form-row">
                    <label for="city">City</label>
                    <input
                      type="text"
                      v-model="appointment.city"
                      id="city"
                      placeholder="Enter city"
                      class="form-control"
                    />
                  </div>
                  <div class="form-row">
                    <label for="postal_code">Postal Code</label>
                    <input
                      type="text"
                      v-model="appointment.postal_code"
                      id="postal_code"
                      placeholder="Enter postal code"
                      class="form-control"
                    />
                  </div>
                  <div class="form-row">
                    <label for="appointment_date">Appointment Date</label>
                    <input
                      type="date"
                      v-model="appointment.appointment_date"
                      id="appointment_date"
                      class="form-control"
                    />
                  </div>
                </div>
              </div>
            </div>
          
            <div class="col-md-6">
              <div class="form-data">
                <div class="form-section">
                  <br>
                  <h6>Pet Details</h6>
                  <div class="form-row">
                    <label for="pet_name">Pet Name</label>
                    <input
                      type="text"
                      v-model="appointment.pet_name"
                      id="pet_name"
                      placeholder="Enter pet name"
                      class="form-control"
                    />
                  </div>
                  <div class="form-row">
                    <label for="breed">Breed</label>
                    <input
                      type="text"
                      v-model="appointment.breed"
                      id="breed"
                      placeholder="Enter breed"
                      class="form-control"
                    />
                  </div>
                  <div class ="form-row">
                    <label for="date_of_birth">Date of Birth</label>
                    <input
                      type="date"
                      v-model="appointment.date_of_birth"
                      id="date_of_birth"
                      class="form-control"
                    />
                  </div>
                  <div class="form-row">
                    <label for="weight">Weight</label>
                    <input
                      type="number"
                      v-model="appointment.weight"
                      id="weight"
                      placeholder="Enter weight"
                      class="form-control"
                    />
                  </div>
                  <div class="form-row">
                    <label for="color">Color</label>
                    <input
                      type="text"
                      v-model="appointment.color"
                      id="color"
                      placeholder="Enter color"
                      class="form-control"
                    />
                  </div>
                  <div class="form-row">
                    <label for="temperature">Temperature</label>
                    <input
                      type="number"
                      v-model="appointment.temperature"
                      id="temperature"
                      placeholder="Enter temperature"
                      class="form-control"
                    />
                  </div>
                  <div class="form-row" id="drag-and-drop-container">
        <label for="image-upload">Drag and Drop or Click to Upload Image</label>
        <input
            type="file"
            @change="handleImageUpload"
            id="image-upload"
            class="form-control"
            accept="image/*"
        />
    </div>
                  <div class="sending-message">
                     <br>
                     Sending your appointment request...
                     <textarea placeholder="Additional comments" required></textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      
      <div class="col-md-6">
              <div class="form-data">
                <div class="form-section">
                  <div class="form-section">
                    <h6>Pet Checklist</h6>
                    <section>
                      <div class="form-row">
                        <label>Appointment Type</label>
                        <div>
              <button
                v-for="item in appointment_type"
                :key="item"
                :class="{ active: selectedappointment_type.includes(item) }"
                @click="toggleAppointmentType(item)"
              >
                {{ item }}
              </button>
            </div>
                      </div>
                    </section>
                    <section>
                      <div class="form-row">
                        <label>Grooming Type</label>
                        <div>
              <button
                v-for="item in grooming_type"
                :key="item"
                :class="{ active: selectedgrooming_type.includes(item) }"
                @click="toggleGroomingType(item)"
              >
                {{ item }}
              </button>
            </div>
                      </div>
                    </section>
                    <section>
                      <div class="form-row">
                        <label>Bath Type</label>
                        <div>
              <button
                v-for="item in grooming_shampoo"
                :key="item"
                :class="{ active: selectedgrooming_shampoo.includes(item) }"
                @click="toggleGroomingShampoo(item)"
              >
                {{ item }}
              </button>
            </div>
            <div class="center-button">
              <br>
              <br>
              <br>
              <input type="submit" value="Submit Form" id="button">
            </div>
                  </div>
                    </section>
                  </div>
                </div>
              </div>
            </div>
    
      <!-- <div>
        <insert @data-saved="getInfo" />
        <table>
          <thead>
            <tr>
              <th>Pet Name</th>
              <th>Breed</th>
              <th>Date of Birth</th>
              <th>Weight</th>
              <th>Color</th>
              <th>Temperature</th>
              <th>Full Name</th>
              <th>Area</th>
              <th>City</th>
              <th>Postal Code</th>
              <th>Contact No</th>
              <th>Email Address</th>
              <th>Appointment Date</th>
              <th>Appointment Type</th>
              <th>Grooming Type</th>
              <th>Grooming Shampoo</th>
              <th>Image</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="pet in pet">
              <td>{{ pet.pet_name }}</td>
              <td>{{ pet.breed }}</td>
              <td>{{ pet.date_of_birth }}</td>
              <td>{{ pet.weight }}</td>
              <td>{{ pet.color }}</td>
              <td>{{ pet.temperature }}</td>
              <td>{{ pet.full_name }}</td>
              <td>{{ pet.area }}</td>
              <td>{{ pet.city }}</td>
              <td>{{ pet.postal_code }}</td>
              <td>{{ pet.contact_no }}</td>
              <td>{{ pet.email_address }}</td>
              <td>{{ pet.appointment_date }}</td>
              <td>{{ pet.appointment_type }}</td>
              <td>{{ pet.grooming_type }}</td>
              <td>{{ pet.grooming_shampoo }}</td>
              <td>{{ pet.image }}</td>
            </tr>
          </tbody>
        </table>
      </div> -->
    </body>  
      </div>
                <!-- card -->
               
              </div>
            </div>
          </section>
          </div>
        </div>
        </div>
    
            </div>
            </body> 
                </template>
    
    <script>
    import axios from 'axios';
    
    export default {
      data() {
        return {
          pet: [],
          appointment: {
            pet_name: '',
            breed: '',
            date_of_birth: '',
            weight: '',
            color: '',
            temperature: '',
            full_name: '',
            area: '',
            city: '',
            postal_code: '',
            contact_no: '',
            email_address: '',
            appointment_date: '',
            appointment_type: '',
            grooming_type: '',
            grooming_shampoo: '',
            image: '',
          },
          appointment_type: ['Checkup', 'Vaccine', 'Deworm', 'LabTest'],
          grooming_type: ['PuppyCut', 'SummerCut', 'SemiKalbo', 'TrimOnly', 'FaceTrim', 'Kalbo'],
          grooming_shampoo: ['Regular', 'Medicated', 'AntiMage'],
          selectedappointment_type: [],
          selectedgrooming_type: [],
          selectedgrooming_shampoo: [],
        };
      },
      methods: {
        showConfirmationDialog() {
        if (window.confirm('Are you sure you want to book now?')) {
          // User clicked OK, proceed with the form submission
          this.save(); // Call your save method here
        } else {
          // User clicked Cancel, do nothing or show a message
        }
      },
        toggleAppointmentType(item) {
          if (this.selectedappointment_type.includes(item)) {
            this.selectedappointment_type = this.selectedappointment_type.filter((i) => i !== item);
          } else {
            this.selectedappointment_type.push(item);
          }
        },
    
        toggleGroomingType(item) {
          if (this.selectedgrooming_type.includes(item)) {
            this.selectedgrooming_type = this.selectedgrooming_type.filter((i) => i !== item);
          } else {
            this.selectedgrooming_type.push(item);
          }
        },
    
        toggleGroomingShampoo(item) {
          if (this.selectedgrooming_shampoo.includes(item)) {
            this.selectedgrooming_shampoo = this.selectedgrooming_shampoo.filter((i) => i !== item);
          } else {
            this.selectedgrooming_shampoo.push(item);
          }
        },
        async getInfo() {
          try {
            const inf = await axios.get('getData1');
            this.pet = inf.data;
          } catch (error) {
            console.error(error);
          }
        },
        async save() {
          try {
            const ins = await axios.post('save', {
              pet_name: this.appointment.pet_name,
              breed: this.appointment.breed,
              date_of_birth: this.appointment.date_of_birth,
              weight: this.appointment.weight,
              color: this.appointment.color,
              temperature: this.appointment.temperature,
              full_name: this.appointment.full_name,
              area: this.appointment.area,
              city: this.appointment.city,
              postal_code: this.appointment.postal_code,
              contact_no: this.appointment.contact_no,
              email_address: this.appointment.email_address,
              appointment_date: this.appointment.appointment_date,
              appointment_type: this.selectedappointment_type,
              grooming_type: this.selectedgrooming_type,
              grooming_shampoo: this.selectedgrooming_shampoo,
              image: this.appointment.image,
            });
            this.selectedappointment_type; // Your toggled appointment_type
        this.selectedgrooming_type; // Your toggled grooming_type
        this.selectedgrooming_shampoo; // Your toggled grooming_shampoo
    
            // Clear the form fields after saving
            for (const key in this.appointment) {
              if (Array.isArray(this.appointment[key])) {
                this.appointment[key] = [];
              } else {
                this.appointment[key] = '';
              }
            }
    
            // Clear the selected items after saving
            this.selectedAppointmentType = [];
            this.selectedGroomingType = [];
            this.selectedGroomingShampoo = [];
    
            this.$emit('data-saved');
            this.getInfo();
          } catch (error) {
            console.error(error);
          }
        },
    
        createAppointment() {
          // Send a POST request to your CodeIgniter 4 API to create an appointment
          // Handle the response (success or error)
        },
        createappointment() {
          // Send a POST request to your CodeIgniter 4 API to create pet info
          // Handle the response (success or error)
        },
        handleImageUpload(event) {
          // Handle image upload and add the image data to the appointment object
          const file = event.target.files[0];
          if (file) {
            this.appointment.image = file;
          }
        },
      },
      loadScripts() {
              const scriptUrls = [
                "../../../../frontend/public/User/assets/libs/jquery/dist/jquery.min.js",
                "../../../../frontend/public/User/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js",
                "../../../../frontend/public/User/assets/libs/simplebar/dist/simplebar.min.js",
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
    
    <style>
        @import '../../../src/assets/User/css/petinfo.css';
        @import '../../../src/assets/User/css/new.css';
        @import '../../../src/assets/User/css/style1.css';
        @import '../../../src/assets/User/css/style2.css';
        @import '../../../src/assets/User/css/style10.css';
        @import '../../../src/assets/User/css/classic-theme-styles-inline-css.css';
        @import '../../../src/assets/User/css/global-styles-inline-css.css';
        @import '../../../../frontend/public/User/wp-content/plugins/bold-page-builder/css/front_end/content_elements.crush1849.css';
        @import '../../../../frontend/public/User/wp-content/plugins/bold-page-builder/slick/slick1849.css';
        @import '../../../../frontend/public/User/wp-content/plugins/bt_cost_calculator/style.mine35d.css';
        @import '../../../../frontend/public/User/wp-content/plugins/contact-form-7/includes/css/stylesf658.css';
        @import '../../../src/assets/User/css/global-styles-inline-css.css';
        @import '../../../src/assets/User/css/woocommerce-inline-inline-css';
        @import '../../../../frontend/public/User/wp-content/themes/pawsitive/stylee35d.css';
        @import '../../../src/assets/User/css/style3.css';
        @import '../../../src/assets/User/css/bt_bb_color_schemes';
        @import '../../../src/assets/User/css/menu2.css';
        
        </style>