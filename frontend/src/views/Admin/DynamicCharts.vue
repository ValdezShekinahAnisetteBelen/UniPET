<template>
    <div>
      <canvas ref="chartRef"></canvas>
    </div>
  </template>
  
  <script>
  import { ref, onMounted, watch } from 'vue';
  import { Chart, BarController, BarElement, LinearScale, CategoryScale } from 'chart.js';
  
  Chart.register(BarController, BarElement, LinearScale, CategoryScale);
  
  export default {
    props: {
      chartData: {
        type: Object,
        required: true,
      },
      chartOptions: {
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
            labels: props.chartData.labels,
            datasets: props.chartData.datasets,
          },
          options: props.chartOptions,
        });
      });
  
      watch(
        () => props.chartData.datasets,
        (newDatasets) => {
          if (myChart) {
            myChart.data.datasets = newDatasets;
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
  