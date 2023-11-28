<template>
    <v-app>
      <v-app-bar app color="#03C9D7">
        <v-app-bar-nav-icon @click.stop="drawer = !drawer" color="#FFFF"></v-app-bar-nav-icon>
        <v-app-bar-title class="d-inline align-center" style="color: #FFFFFF;">
          UniPET
          <v-icon color="#FFFF">mdi-paw</v-icon>
        </v-app-bar-title>
      </v-app-bar>
  
      <v-navigation-drawer
        app
        v-model="drawer"
        style="color: #FB9678; overflow-y: auto;"
        class="custom-scrollbar"
      >
      <v-list style="background-color: #03C9D7;">
  <v-list-item>
    <v-list-item-content>
      <v-list-item-icon>
      </v-list-item-icon>
      <v-list-item-title>DASHBOARD</v-list-item-title>
    </v-list-item-content>
  </v-list-item>
  <router-link v-for="(link, index) in links1" :key="index" :to="link.route" class="nav-link" style="color: #03C9D7; font-weight: bold; display: flex; align-items: center;">
    <v-icon>{{ link.icon }}</v-icon>
    {{ link.text }}
  </router-link>
</v-list>

<v-list style="background-color: #03C9D7;">
  <v-list-item>
    <v-list-item-content>
      <v-list-item-icon>
      </v-list-item-icon>
      <v-list-item-title>E-COMMERCE</v-list-item-title>
    </v-list-item-content>
  </v-list-item>
  <router-link v-for="(link, index) in links2" :key="index" :to="link.route" class="nav-link" style="color: #03C9D7; font-weight: bold; display: flex; align-items: center;">
    <v-icon>{{ link.icon }}</v-icon>
    {{ link.text }}
  </router-link>
</v-list>

<v-list style="background-color: #03C9D7;">
  <v-list-item>
    <v-list-item-content>
      <v-list-item-icon>
      </v-list-item-icon>
      <v-list-item-title>PETS APPOINTMENT</v-list-item-title>
    </v-list-item-content>
  </v-list-item>
  <router-link v-for="(link, index) in links3" :key="index" :to="link.route" class="nav-link" style="color: #03C9D7; font-weight: bold; display: flex; align-items: center;">
    <v-icon>{{ link.icon }}</v-icon>
    {{ link.text }}
  </router-link>
</v-list>

<v-list style="background-color: #03C9D7;">
  <v-list-item>
    <v-list-item-content>
      <v-list-item-icon>
      </v-list-item-icon>
      <v-list-item-title>ACCOUNTS</v-list-item-title>
    </v-list-item-content>
  </v-list-item>
  <router-link v-for="(link, index) in links4" :key="index" :to="link.route" class="nav-link" style="color: #03C9D7; font-weight: bold; display: flex; align-items: center;">
    <v-icon>{{ link.icon }}</v-icon>
    {{ link.text }}
  </router-link>
</v-list>
  
      </v-navigation-drawer>
  
      <v-main class="d-flex align-center justify-center" style="min-height: 300px;">
  
        <v-container class="bg-white"> <!-- Set background color to white -->
          <v-row no-gutters>
            <v-col>
              <v-sheet class="pa-2 ma-2 shadow"> <!-- Add shadow class for shadows -->
                <p>Top 5 Best-Selling Products in the Year 2023</p>
<div v-if="productData.length > 0" class="d-flex flex-row flex-nowrap overflow-auto">
  <div v-for="(item, index) in productData" :key="index" class="card mr-3" style="width: 18rem; position: relative;">
    <div v-if="index < 5" style="position: absolute; top: 10px; left: 10px; background-color: #0CC0DF; color: white; border-radius: 30%; padding: 5px; font-size: 15px;">
      {{ index + 1 }}
    </div>
    <img :src="item.productImage" class="card-img-top" alt="Product Image" style="max-width: 100%; height: auto;">
    <div class="card-body">
      <p class="card-text">Product ID: {{ item.productId }}</p>
      <p class="card-text">Product Name: {{ item.productName }}</p>
      <p class="card-text">Total Sales: {{ item.totalSales }}</p>
    </div>
  </div>
</div>

              </v-sheet>
            </v-col>
  
            <v-col cols="6">
              <v-sheet class="pa-2 ma-2 shadow">
                <div>
                <p>Distribution of Appointments by Area in the Year 2023</p>
                <AppointmentsByArea :appointment="appointment" :chartOptions2="chartOptions2" />
            </div>
              </v-sheet>
            </v-col>
  
            <v-col>
              <v-sheet class="pa-2 ma-2 shadow">
                .v-col-auto
              </v-sheet>
            </v-col>
          </v-row>
  
          <v-row no-gutters>
            <v-col>
              <v-sheet class="pa-2 ma-2 shadow">
                .v-col-auto
              </v-sheet>
            </v-col>
  
            <v-col cols="2">
              <v-sheet class="pa-2 ma-2 shadow">
                .v-col-2
              </v-sheet>
            </v-col>
  
            <v-col>
              <v-sheet class="pa-2 ma-2 shadow">
                .v-col-auto
              </v-sheet>
            </v-col>
          </v-row>
        </v-container>
  
      </v-main>
    </v-app>
  </template>
  
  <script>
import axios from 'axios';
import 'chartjs-adapter-moment';
import 'chartjs-adapter-date-fns';
import { Chart, LineController, LineElement, PointElement, LinearScale, CategoryScale } from 'chart.js';
import { ref, onMounted, watch } from 'vue';
import DynamicCharts from './DynamicCharts.vue';
import AppointmentsByArea from './Appointments_by_Area.vue';

Chart.register(LineController, LineElement, PointElement, LinearScale, CategoryScale);

export default {
  components: {
    DynamicCharts,
    AppointmentsByArea,
  },
  data() {
    return {
      productData: [],
      drawer: false,
      chartData: {},
      appointment: {},
      chartOptions: {},
      chartOptions2: {},
      links1: [
      { text: ' Key Metrics ', route: '/Dashboard', icon: 'mdi-view-dashboard' },
    ],
    links2: [
      { text: ' Orders ', route: '/admin/orders', icon: 'mdi-cart' },
      { text: ' Products ', route: '/admin/products', icon: 'mdi-cart' },
    ],
    links3: [
      { text: ' Appointments ', route: '/admin/Appointments', icon: 'mdi-paw' },
      { text: ' Pets ', route: '/admin/Pets', icon: 'mdi-paw' },
      { text: ' Customers ', route: '/admin/Customers', icon: 'mdi-paw' },
    ],
    links4: [
      { text: ' Customer Profiles ', route: '/admin/Profiles', icon: 'mdi-account' },
      { text: ' Admin Accounts ', route: '/admin/Admin', icon: 'mdi-account' },
      { text: ' Customers Payment Status ', route: '/admin/Payment', icon: 'mdi-account' },
    ],
  };
  },
  setup() {
    const appointment = ref({
      labels: [],
      datasets: [
        {
          data: [],
          backgroundColor: [
            'rgba(75, 192, 192, 0.8)',
            'rgba(255, 99, 132, 0.8)',
            'rgba(54, 162, 235, 0.8)',
            'rgba(153, 102, 255, 0.8)',
          ],
        },
      ],
    });
    let myChart;

    onMounted(() => {
      // Initialization logic can be added here if needed
    });

    watch(
      () => appointment.value,
      (newData) => {
        if (myChart) {
          myChart.data = {
            labels: newData.labels,
            datasets: [
              {
                label: 'Distribution of Appointments by Area in the Year 2023',
                data: newData.datasets[0].data,
                backgroundColor: [
                  'rgba(75, 192, 192, 0.8)',
                  'rgba(255, 99, 132, 0.8)',
                  'rgba(54, 162, 235, 0.8)',
                  'rgba(153, 102, 255, 0.8)',
                ],
              },
            ],
          };
          myChart.update();
        }
      },
      { deep: true }
    );
    const chartData = ref({
      labels: [],
      datasets: [
        {
          data: [],
          backgroundColor: [
            'rgba(75, 192, 192, 0.8)',
            'rgba(255, 99, 132, 0.8)',
            'rgba(54, 162, 235, 0.8)',
            'rgba(153, 102, 255, 0.8)',
          ],
        },
      ],
    });
    let myChart2;

    onMounted(() => {
      // Initialization logic can be added here if needed
    });

    watch(
  () => chartData,
  (newData) => {
    if (myChart2) {
      myChart2.data = {
        labels: newData.map((product) => product.product_name),
        datasets: [
          {
            label: 'Top 5 Best-Selling Products in the Year 2023',
            data: newData.map((product) => product.sales_count),
            backgroundColor: [
              'rgba(75, 192, 192, 0.8)',
              'rgba(255, 99, 132, 0.8)',
              'rgba(54, 162, 235, 0.8)',
              'rgba(153, 102, 255, 0.8)',
            ],
          },
        ],
      };
      myChart2.update();
    }
  },
  { deep: true }
);

    return {
      appointment,
      chartData,
    };
  },
  methods: {
  navigate(link) {
    console.log(`Navigating to: ${link.route}`);
  },
  fetchAppointmentDistributionByArea(year) {
    axios.get(`api/appointments/distribution/${year}`).then((response) => {
      this.appointment.labels = response.data.map((item) => item.area);
      this.appointment.datasets[0].data = response.data.map((item) => item.count);
    });
  },
  // New method to fetch best-selling products
  // Assuming this is within your Vue component

  fetchBestSellingProducts(year) {
  axios.get(`api/best/products/${year}`)
    .then((response) => {
      console.log('Response from API:', response.data);

      // Extract product_id, name, image, and total_sales for display
      const productData = response.data.data.map((item) => ({
        productId: item.product_id,
        productName: item.name,
        productImage: item.image, // Assuming the image URL is provided
        totalSales: item.total_sales,
      }));

      // Update chart data
      this.chartData = {
        labels: productData.map((item) => item.productId),
        datasets: [
          {
            label: 'Top 5 Best-Selling Products in the Year 2023',
            data: productData.map((item) => item.totalSales),
            backgroundColor: [
              'rgba(75, 192, 192, 0.8)',
              'rgba(255, 99, 132, 0.8)',
              'rgba(54, 162, 235, 0.8)',
              'rgba(153, 102, 255, 0.8)',
            ],
          },
        ],
      };

      // Set up additional data for display in the template
      this.productData = productData;
    })
    .catch((error) => {
      console.error('Error fetching best-selling products:', error);
    });
},
  },
mounted() {
  this.fetchAppointmentDistributionByArea(2023);
  this.fetchBestSellingProducts(2023); // Fetch best-selling products on mount
},
};
</script>