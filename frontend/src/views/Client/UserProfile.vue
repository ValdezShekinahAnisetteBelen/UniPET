<template>
  
    <body class="home page-template-default page page-id-2767 page-parent theme-pawsitive bt_bb_plugin_active bt_bb_fe_preview_toggle woocommerce-js btHeadingWeight_default btMenuWeight_default btCurrentPage_default btButtonWeight_default btMenuRightEnabled btStickyEnabled btHideHeadline btLightSkin btBelowMenu btNoDashInSidebar noBodyPreloader btDropButtons btTransparentDarkHeader btNoSidebar btMenuRight btMenuInitFinished btRemovePreloader btMenuHorizontal">
      <div class="btPageWrap" id="top">
    <NavigationBar />
    <!-- ... rest of your template ... -->



        <div class="animal-picture">
      <section id="bt_bb_section653e182cbf96f" data-parallax="0.7" data-parallax-offset="0" class="bt_bb_section bt_bb_color_scheme_1 bt_bb_layout_boxed_1200 bt_bb_vertical_align_top bt_bb_parallax bt_bb_background_image bt_bb_top_spacing_large bt_bb_bottom_spacing_large bt_bb_section_with_bottom_coverage_image" style="background-color: #96E6F7; background-image: url(&quot;https_/pawsitive.bold-themes.com/buddy/wp-content/uploads/sites/2/2019/08/background_05.html&quot;); --section-primary-color: #ffffff; --section-secondary-color: #EDCCCD; background-position-y: 0px;" data-bt-override-class="null"><div class="bt_bb_port"><div class="bt_bb_cell"><div class="bt_bb_cell_inner"><div class="bt_bb_row_wrapper"><div class="bt_bb_row" data-bt-override-class="{}" data-structure="6-6">
        <div class="bt_bb_column col-xxl-6 col-xl-6 bt_bb_vertical_align_top bt_bb_align_left bt_bb_padding_normal bt_bb_shape_inherit" data-width="6" data-bt-override-class="{}">
  </div>
    </div></div></div></div></div><div class="bt_bb_section_bottom_section_coverage_image"><img src="User/wp-content/uploads/sites/2/2019/08/white_bottom_wave_02.png" alt="bt_bb_section_bottom_section_coverage_image"></div></section>
        </div>

    <!-- Close the .about-us div here -->
   
  <!-- User Information -->
  <!-- Combined User and Pet Information Form -->
  
  
  <v-main v-if="user">
  <v-container fluid>
    <v-card max-width="450px" class="mx-auto bg" elevation="2">
      <v-img class="" height="200px" :src="user.image || 'http://unblast.com/wp-content/uploads/2021/09/Real-Estate-Agent-Illustration.jpg'" gradient="150deg, rgb(185 224 255 / 58%) 0%, rgb(243 220 246 / 52%) 35%, rgb(223 255 242 / 74%) 74%">
      </v-img>
      <v-row justify="center">
        <v-col align-self="start" class="d-flex justify-center align-center pa-0" cols="12">
          
        </v-col>
      </v-row>
      <v-list-item color="#0000" class="profile-text-name ma-4 pt-16">
        <v-list-item-content>
          <v-list-item-title class="text-h6">
            {{ user.first_name }} {{ user.last_name }}
          </v-list-item-title>
          <v-list-item-subtitle>{{ user.role }}</v-list-item-subtitle>
        </v-list-item-content>
        <v-list-item-action>
        </v-list-item-action>
      </v-list-item>
     
      <v-spacer></v-spacer>
      <v-text-field class="pa-6" v-model="user.phone_number" prepend-icon="mdi-whatsapp" label="phone_number" :disabled="!editBio"></v-text-field>
      <v-text-field class="pa-6" v-model="user.username" prepend-icon="mdi-account" label="username" :disabled="!editBio"></v-text-field>
      <v-text-field class="pa-6" v-model="user.email" prepend-icon="mdi-mail" label="email" :disabled="!editBio"></v-text-field>
      <v-spacer></v-spacer>
      <v-row>
      </v-row>
       <!-- Add an "Edit" button -->
    <v-btn @click="openEditModal" class="edit-button" icon>
      <v-icon>mdi-pencil</v-icon>
    </v-btn>
    </v-card>
  </v-container>
      </v-main>
       <!-- Modal for editing user data -->
    <v-dialog v-model="editModal" max-width="600px">
      <v-card>
        <v-card-title>Edit Profile</v-card-title>
        <v-card-text>
          <!-- Your form fields for editing user data -->
          <v-text-field v-model="editedUser.first_name" label="First Name"></v-text-field>
          <v-text-field v-model="editedUser.last_name" label="Last Name"></v-text-field>
          <v-text-field v-model="editedUser.phone_number" label="Phone Number"></v-text-field>
          <v-text-field v-model="editedUser.username" label="Username"></v-text-field>
          <v-text-field v-model="editedUser.email" label="Email"></v-text-field>
        </v-card-text>
        <v-card-actions>
          <v-btn @click="saveUserData" color="primary">Save</v-btn>
          <v-btn @click="closeEditModal">Cancel</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

  
  
  
  
  
      <div class="btSiteFooter">
    
    <div class="bt_bb_wrapper"><section id="bt_bb_section653e328393367" class="bt_bb_section bt_bb_layout_boxed_1200 bt_bb_vertical_align_top bt_bb_top_spacing_large bt_bb_bottom_spacing_normal" data-bt-override-class="null"><div class="bt_bb_port">
      
      <div class="bt_bb_cell"><div class="bt_bb_cell_inner"><div class="bt_bb_row_wrapper"><div class="bt_bb_row" data-bt-override-class="{}" data-structure="3-3-3-3"><div class="bt_bb_column col-xxl-3 col-xl-3 bt_bb_vertical_align_top bt_bb_align_left bt_bb_padding_normal bt_bb_animation_fade_in animate bt_bb_shape_inherit animated" data-width="3" data-bt-override-class="{}">
        <div class="bt_bb_column_content"><div class="bt_bb_column_content_inner"><div class="bt_bb_image bt_bb_shape_square bt_bb_align_inherit bt_bb_hover_style_simple bt_bb_content_display_always bt_bb_content_align_middle" data-bt-override-class="null"><span><img src="User/wp-content/uploads/sites/2/2019/11/logo_black.svg" alt="Buddy" class="btLazyLoadImage btLazyLoaded"></span></div><div class="bt_bb_separator bt_bb_border_style_none bt_bb_bottom_spacing_normal" data-bt-override-class="null"></div><div class="bt_bb_icon bt_bb_color_scheme_6 bt_bb_style_filled bt_bb_shape_circle bt_bb_size_small bt_bb_align_inherit" style="; --icon-primary-color:#ffffff; --icon-secondary-color:#0CC0DF;" data-bt-override-class="null"><a href="https://twitter.com/bold_themes" target="_blank" data-ico-fontawesome="" class="bt_bb_icon_holder"></a></div><div class="bt_bb_icon bt_bb_color_scheme_6 bt_bb_style_filled bt_bb_shape_circle bt_bb_size_small bt_bb_align_inherit" style="; --icon-primary-color:#ffffff; --icon-secondary-color:#0CC0DF;" data-bt-override-class="null"><a href="https://www.instagram.com/bold_themes/" target="_blank" data-ico-fontawesome="" class="bt_bb_icon_holder"></a></div><div class="bt_bb_icon bt_bb_color_scheme_6 bt_bb_style_filled bt_bb_shape_circle bt_bb_size_small bt_bb_align_inherit" style="; --icon-primary-color:#ffffff; --icon-secondary-color:#0CC0DF;" data-bt-override-class="null"><a href="https://www.facebook.com/boldthemes/" target="_blank" data-ico-fontawesome="" class="bt_bb_icon_holder"></a></div><div class="bt_bb_separator bt_bb_border_style_none bt_bb_bottom_spacing_medium" data-bt-override-class="null"></div></div></div></div><div class="bt_bb_column col-xxl-3 col-xl-3 bt_bb_vertical_align_top bt_bb_align_left bt_bb_padding_normal bt_bb_animation_fade_in animate bt_bb_shape_inherit animated" data-width="3" data-bt-override-class="{}"><div class="bt_bb_column_content"><div class="bt_bb_column_content_inner"><header class="bt_bb_headline bt_bb_color_scheme_3 bt_bb_dash_none bt_bb_size_extrasmall bt_bb_align_inherit" style="; --primary-color:#0CC0DF; --secondary-color:#EDCCCD;" data-bt-override-class="{}"><h5 class="bt_bb_headline_tag"><span class="bt_bb_headline_content"><span>About</span></span></h5></header><div class="bt_bb_separator bt_bb_border_style_none bt_bb_bottom_spacing_small" data-bt-override-class="null"></div><div class="bt_bb_icon bt_bb_style_borderless bt_bb_shape_circle bt_bb_size_xsmall bt_bb_align_left" data-bt-override-class="null"><span data-ico-dripicons="" class="bt_bb_icon_holder">
          <span>Main: J.P Rizal St. Tawiran, Calapan City</span></span></div><div class="bt_bb_separator bt_bb_border_style_none bt_bb_bottom_spacing_small" data-bt-override-class="null"></div>
      <div class="bt_bb_icon bt_bb_style_borderless bt_bb_shape_circle bt_bb_size_xsmall bt_bb_align_left" data-bt-override-class="null"><span data-ico-dripicons="" class="bt_bb_icon_holder"><span>+63 998 868 3908</span></span></div><div class="bt_bb_separator bt_bb_border_style_none bt_bb_bottom_spacing_small" data-bt-override-class="null"></div><div class="bt_bb_icon bt_bb_style_borderless bt_bb_shape_circle bt_bb_size_xsmall bt_bb_align_left" data-bt-override-class="null"><span data-ico-dripicons="" class="bt_bb_icon_holder"><span>Thursday - Friday - Sunday: <br><br> 9:00 AM TO 11:00 AM <br><br> 2:00 PM TO 4:00 PM</span></span></div><div class="bt_bb_separator bt_bb_border_style_none bt_bb_bottom_spacing_medium" data-bt-override-class="null"></div></div></div></div><div class="bt_bb_column col-xxl-3 col-xl-3 bt_bb_vertical_align_top bt_bb_align_left bt_bb_padding_normal bt_bb_animation_fade_in animate bt_bb_shape_inherit animated" data-width="3" data-bt-override-class="{}"><div class="bt_bb_column_content"><div class="bt_bb_column_content_inner"><header class="bt_bb_headline bt_bb_color_scheme_3 bt_bb_dash_none bt_bb_size_extrasmall bt_bb_align_inherit" style="; --primary-color:#0CC0DF; --secondary-color:#EDCCCD;" data-bt-override-class="{}"><h5 class="bt_bb_headline_tag"><span class="bt_bb_headline_content"><span>Quick Links</span></span></h5></header><div class="bt_bb_separator bt_bb_border_style_none bt_bb_bottom_spacing_small" data-bt-override-class="null"></div><div class="bt_bb_custom_menu bt_bb_direction_vertical"><div class="menu-quick-links-container"><ul id="menu-quick-links" class="menu"><li id="menu-item-2555" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-2555"><a href="#">Veterinary Services</a></li>
    <li id="menu-item-2556" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-2556"><a href="#">Grooming Services</a></li>
    <li id="menu-item-2557" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-2557"><a href="#">Bathing Services</a></li>
    <li id="menu-item-2558" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-2558"><a href="#">Request an Appointment</a></li>
    </ul></div></div><div class="bt_bb_separator bt_bb_border_style_none bt_bb_bottom_spacing_medium" data-bt-override-class="null"></div></div></div></div>
    <div class="bt_bb_column col-xxl-3 col-xl-3 bt_bb_vertical_align_top bt_bb_align_left bt_bb_padding_normal bt_bb_animation_fade_in animate bt_bb_shape_inherit animated" data-width="3" data-bt-override-class="{}"><div class="bt_bb_column_content"><div class="bt_bb_column_content_inner"><header class="bt_bb_headline bt_bb_color_scheme_3 bt_bb_dash_none bt_bb_size_extrasmall bt_bb_align_inherit" style="; --primary-color:#0CC0DF; --secondary-color:#EDCCCD;" data-bt-override-class="{}"><h5 class="bt_bb_headline_tag"><span class="bt_bb_headline_content"><span>Newsletter</span></span></h5></header><div class="bt_bb_separator bt_bb_border_style_none bt_bb_bottom_spacing_small" data-bt-override-class="null"></div><div class="bt_bb_contact_form_7">
    <div class="wpcf7 js" id="wpcf7-f1539-p2767-o1" lang="en-US" dir="ltr">
    <div class="screen-reader-response"><p role="status" aria-live="polite" aria-atomic="true"></p> <ul></ul></div>
    <form action="https://pawsitive.bold-themes.com/buddy/#wpcf7-f1539-p2767-o1" method="post" class="wpcf7-form init" aria-label="Contact form" novalidate="novalidate" data-status="init">
    <div style="display: none;">
    <input type="hidden" name="_wpcf7" value="1539">
    <input type="hidden" name="_wpcf7_version" value="5.8.1">
    <input type="hidden" name="_wpcf7_locale" value="en_US">
    <input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f1539-p2767-o1">
    <input type="hidden" name="_wpcf7_container_post" value="2767">
    <input type="hidden" name="_wpcf7_posted_data_hash" value="">
    <input type="hidden" name="_wpcf7_recaptcha_response" value="">
    </div>
    <div class="btNewsletter">
      <div class="btNewsletterColumn">
        <p><span class="wpcf7-form-control-wrap" data-name="your-email"><input size="40" class="wpcf7-form-control wpcf7-email wpcf7-validates-as-required wpcf7-text wpcf7-validates-as-email" aria-required="true" aria-invalid="false" placeholder="Your email" value="" type="email" name="your-email"></span>
        </p>
      </div>
      <div class="btNewsletterButton">
        <p><input class="wpcf7-form-control wpcf7-submit has-spinner" type="submit" value="SUBSCRIBE"><span class="wpcf7-spinner"></span>
        </p>
      </div>
    </div><div class="wpcf7-response-output" aria-hidden="true"></div>
    </form>
    </div>
    </div><div class="bt_bb_separator bt_bb_border_style_none bt_bb_bottom_spacing_medium" data-bt-override-class="null"></div></div></div></div></div></div></div></div></div></section></div><footer class="btLightSkin"></footer>
    </div>
    
    
   </div>
  </body>
        </template>

  <script>

import NavigationBar from './NavigationBar'
import axios from 'axios';
export default {
    components: {
    NavigationBar, // Register the component
  },
    data() {
      return {
        editModal: false,
      editedUser: {
        first_name: '',
        last_name: '',
        phone_number: '',
        username: '',
        email: '',
      },
        user: {
      first_name: '',
      last_name: '',
      email: '',
      phone_number: '',
      username: '',
      image: '',
      role: '',
      // ... other fields ...
    },
       
        bioIcon: "mdi-pencil",
      };
    },
    methods: {
      // Open the edit modal and fetch user data
    openEditModal() {
      this.editModal = true;

      // Fetch user data for editing
      this.editedUser = { ...this.user };
    },
      async fetchUserData() {
    try {
        const response = await axios.get(`/api/user-profile/${this.$store.state.userId}`);

        // Assuming the response.data structure matches the UserModel fields
        const userData = response.data;

        this.user = {
            customer_id: userData.customer_id,
            first_name: userData.first_name,
            last_name: userData.last_name,
            email: userData.email,
            phone_number: userData.phone_number,
            username: userData.username,
            password: userData.password, // Include the password if needed
            token: userData.token, // Include the token if needed
            status: userData.status, // Include the status if needed
            role: userData.role, // Include the role if needed
            image: userData.image, // Include the image if needed
            // ... other fields ...
        };

        // ... handle other fields ...

    } catch (error) {
        console.error('Error fetching user data', error);
    }
},

async saveUserData() {
        try {
            // Extract only the necessary fields for updating
            const { first_name, last_name, email, phone_number, username, image } = this.editedUser;

            const response = await axios.put(`/api/save-profile/${this.$store.state.userId}`, {
                customer_id: this.$store.state.userId,
                first_name,
                last_name,
                email,
                phone_number,
                username,
                image,
                // ... other fields ...

                // Exclude fields that may not need to be updated
            });

            console.log(response.data.message);
            // Close the edit modal after saving
            this.closeEditModal();
            this.fetchUserData();
        } catch (error) {
            console.error('Error saving user data', error);
        }
    },
closeEditModal() {
      this.editModal = false;
    },

    loadScripts() {
              if (this.myObject && this.myObject.content) {
                console.log(this.myObject.content);
  
                const scriptUrls = [
                '/User/wp-includes/js/jquery/jquery.min3088.js',
              '/User/wp-includes/js/jquery/jquery-migrate.min5589.js',
              '/User/wp-content/plugins/bold-page-builder/slick/slick.min1849.js',
              '/User/wp-content/plugins/bold-page-builder/content_elements_misc/js/jquery.magnific-popup.min1849.js',
              '/User/wp-content/plugins/bold-page-builder/content_elements_misc/js/content_elements1849.js',
              '/User/wp-content/plugins/bt_cost_calculator/jquery.dde35d.js',
              '/User/wp-content/plugins/bt_cost_calculator/cc.maine35d.js',
              '/User/bt_cc_main-js-after.js',
              '/User/js1.js',
              '/User/js2.js',
              '/User/js3.js',
              '/User/js4.js',
              '/User/js5.js',
              '/User/js6.js',
              '/User/js7.js',
              '/User/js8.js',
              '/User/js9.js',
              '/User/js10.js',
              '/User/js11.js',
              '/User/js12.js',
              '/User/wp-content/plugins/contact-form-7/includes/swv/js/indexf658.js',
              '/User/wp-content/plugins/contact-form-7/includes/js/indexf658.js',
              '/User/wp-content/plugins/woocommerce/assets/js/jquery-blockui/jquery.blockUI.minf0ea.js',
              '/User/js13.js',
              '/User/wp-content/plugins/woocommerce/assets/js/frontend/add-to-cart.min2632.js',
              '/User/wp-content/plugins/woocommerce/assets/js/js-cookie/js.cookie.mine1a3.js',
              '/User/js14.js',
              '/User/wp-content/plugins/woocommerce/assets/js/frontend/woocommerce.min2632.js',
              '/User/wp-content/plugins/duracelltomi-google-tag-manager/js/gtm4wp-form-move-tracker7100.js',
              '/User/wp-content/themes/pawsitive/framework/js/fancySelecte35d.js',
              '/User/wp-content/themes/pawsitive/framework/js/header.misce35d.js',
              '/User/wp-content/themes/pawsitive/framework/js/misce35d.js',
              '/User/wp-content/plugins/bold-page-builder/content_elements/bt_bb_section/bt_bb_elementse35d.js',
              '/User/wp-content/themes/pawsitive/bold-page-builder/content_elements/bt_bb_floating_image/bt_bb_floating_imagee35d.js',
              '/User/wp-content/themes/pawsitive/bold-page-builder/content_elements/bt_bb_organic_animation/anime.mine35d.js',
              '/User/wp-content/themes/pawsitive/bold-page-builder/content_elements/bt_bb_organic_animation/maine35d.js',
              '/User/wp-includes/js/jquery/ui/core.min3f14.js',
              '/User/wp-includes/js/jquery/ui/datepicker.min3f14.js',
                          'https://code.jquery.com/jquery-3.5.1.slim.min.js',
              'https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js',
              'https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js',
            
                ];
  
                // Load jQuery first
                const jqueryScript = document.createElement('script');
                jqueryScript.src = scriptUrls[0];
                jqueryScript.async = true;
                jqueryScript.onload = () => {
                  console.log('jQuery loaded successfully');
                  // Now load other scripts
                  scriptUrls.slice(1).forEach(url => {
                    const script = document.createElement('script');
                    script.src = url;
                    script.async = true;
                    script.onload = () => {
                      console.log(`Script loaded successfully: ${url}`);
                    };
                    script.onerror = (error) => {
                      console.error(`Error loading script: ${url}`, error);
                    };
  
                    document.head.appendChild(script);
                  });
                };
                jqueryScript.onerror = (error) => {
                  console.error('Error loading jQuery', error);
                };
                document.head.appendChild(jqueryScript);
              }
            },
          },
          computed: {
    userImage() {
      return this.user && this.user.image
        ? this.user.image
        : 'http://unblast.com/wp-content/uploads/2021/09/Real-Estate-Agent-Illustration.jpg';
    },
  },

          mounted() {
            this.fetchUserData();
            // Trigger loadScripts on window.onload
            window.onload = () => {
              console.log('Window onload event triggered');
              this.loadScripts();
            };
          },
        };
  </script>
  
  <style>
  @import '../../../src/assets/User/css/style2.css';
@import '../../../src/assets/User/css/style4.css';
@import '../../../src/assets/User/css/style5.css';
@import '../../../src/assets/User/css/style6.css';
@import '../../../src/assets/User/css/style7.css';
@import '../../../src/assets/User/css/style8.css';
@import '../../../src/assets/User/css/style9.css';
@import '../../../src/assets/User/css/style10.css';
@import '../../../src/assets/User/css/style13.css';
@import '../../../src/assets/User/css/style14.css';
@import '../../../src/assets/User/css/styles.css';
@import '../../../../frontend/public/User/wp-content/themes/pawsitive/stylee35d.css';
@import '../../../../frontend/public/User/wp-content/plugins/bold-page-builder/slick/slick1849.css';
@import '../../../../frontend/public/User/wp-content/plugins/bt_cost_calculator/style.mine35d.css';
@import '../../../../frontend/public/User/wp-content/plugins/contact-form-7/includes/css/stylesf658.css';
@import '../../../../frontend/public/User/wp-content/plugins/bold-page-builder/css/front_end/content_elements.crush1849.css';
  .avatar-center-heigth {
    position: absolute;
  }
  
  .profile-text-name {
    margin-top: 70px;
  }
  
  .sutitles {
    margin: 5px;
    padding: 16px;
  }
  
  .upload-btn {
    position: absolute !important;
    z-index: 999;
    top: 121px;
    color: cadetblue;
    background: blueviolet;
    background: rgb(125,198,163);
    background: linear-gradient(50deg, rgba(125,198,163,1) 0%, rgba(35,216,227,1) 72%);
  }
  
  .bg {
    background: rgb(255,197,185);
    background: linear-gradient(0deg, rgba(255,197,185,0.711922268907563) 0%, rgba(220,246,223,0.6671043417366946) 35%, rgba(255,255,255,0.7539390756302521) 74%), url(http://unblast.com/wp-content/uploads/2021/09/Real-Estate-Agent-Illustration.jpg);
  }
  
  .avatar-shadow {
    box-shadow: 0px 0px 10px 0px rgba(50,12,112,0.75);
    -webkit-box-shadow: 0px 0px 10px 0px rgba(50,12,112,0.75);
    -moz-box-shadow: 0px 0px 10px 0px rgba(50,12,112,0.75);
  }
  </style>