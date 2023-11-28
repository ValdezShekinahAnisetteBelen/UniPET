<template>
    <div>
        <canvas ref="chartRef"></canvas>
    </div>
  </template>
  
  <script>
  import { ref, onMounted, watch } from 'vue';
  import { Chart, BarController, CategoryScale, LinearScale } from 'chart.js';
  
  Chart.register(BarController, CategoryScale, LinearScale);
  
  export default {
    props: {
      appointment: {
        type: Object,
        required: true,
      },
      chartOptions2: {
        type: Object,
        default: () => ({}),
      },
    },
    setup(props) {
      const chartRef = ref(null);
      let myChart = null;
  
      onMounted(() => {
        const ctx = chartRef.value.getContext('2d');
        myChart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: props.appointment.labels,
            datasets: [
              {
                label: 'Distribution of Appointments by Area in the Year 2023',
                data: props.appointment.datasets[0].data,
                backgroundColor: [
                  'rgba(75, 192, 192, 0.8)',
                  'rgba(255, 99, 132, 0.8)',
                  'rgba(54, 162, 235, 0.8)',
                  'rgba(153, 102, 255, 0.8)',
                ],
              },
            ],
          },
          options: props.chartOptions2,
        });
      });
  
      watch(
        () => props.appointment,
        (newData) => {
          if (myChart) {
            myChart.data.labels = newData.labels;
            myChart.data.datasets[0].data = newData.datasets[0].data;
            myChart.update();
          }
        },
        { deep: true }
      );
  
      return {
        chartRef,
      };
    },
  };
  </script>
  