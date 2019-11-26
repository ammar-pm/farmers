
import VueCharts from 'vue-chartjs';
import { Line } from 'vue-chartjs';

Vue.component('test-small', {
    extends: Line,
    mounted () {
        this.renderChart({
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [
                {
                    label: 'Data One',
                    backgroundColor: '#f87979',
                    data: [40, 39, 10, 40, 39, 80, 40],
                    fill: false
                },
                {
                    label: 'Data two',
                    backgroundColor: '#000000',
                    data: [20, 10, 15, 17, 16, 30, 20],
                    fill: false
                }
            ]
        }, {responsive: true,
            maintainAspectRatio: false})
    }
});
