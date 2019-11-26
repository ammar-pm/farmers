import { VueCharts, mixins } from 'vue-chartjs';
const { reactiveData } = mixins
Vue.component('doughnut-chart', {
    props: ['chartobject', 'chartoptiondata', 'id', 'labels', 'data', 'chartdataoption','option'],
    extends: VueCharts.Doughnut,
    mixins: [reactiveData],
    data: () => ({
        chartData:'',
        chartOptions: {
            responsive: true,
            maintainAspectRatio: false,
        }
    }),

    created() {
        this.chartDataOptions(this.chartoptiondata);
    },

    watch: {
        'chartoptiondata': {
            handler: function (val,oldVal) {
                this.chartDataOptions(val);
                this.$data._chart.destroy();
                this.renderChart(this.chartData, this.options);
            }, deep:true
        },
        'option': {
            handler: function (val,oldVal) {
                Bus.$emit('SendChartJs', this.option);
            }, deep:true
        },
        'chartdataoption': {
            handler: function (val,oldVal) {

                var self = this;

                $.map(this.chartobject.datasets, function( value, index ) {
                    self.chartobject.datasets[index].spanGaps    = val.spanGaps;
                    self.chartobject.datasets[index].pointStyle  = val.pointStyle;
                    self.chartobject.datasets[index].fill        = val.fill ? val.fill : false;
                    self.chartobject.datasets[index].pointRadius = val.pointRadius;
                    self.chartobject.datasets[index].tension     = val.tension;

                });

                this.$data._chart.destroy();

                this.chartData = this.chartobject;

                this.renderChart(this.chartData, this.chartOptions)

            }, deep:true
        },

    },

    methods: {
        getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        },
        chartDataOptions(newoption){
            this.chartOptions.tooltips = {
                enabled: true,
                mode: 'single',
                callbacks: {
                    label: function(tooltipItems, data) {
                        var res = data.datasets[tooltipItems.datasetIndex].toollabel.split('-');
                        //res.push("value:" + tooltipItems.y);
                        res.push("yLabel:" + tooltipItems.yLabel);
                        return res;
                    }
                }
            };
            this.chartOptions.scales = {
                xAxes: [{
                    gridLines: {
                        display: false,
                        color: "black",
                    },
                    stacked: newoption.stacked,
                    scaleLabel: {
                        display: true,
                        labelString: newoption.xLabel ? newoption.xLabel : '',
                        fontColor: "green"
                    }
                }],
                yAxes: [{
                    gridLines: {
                        color: "black",
                        borderDash: [2, 5],
                    },
                    stacked: newoption.stacked,
                    scaleLabel: {
                        display: true,
                        labelString: newoption.yLabel ? newoption.yLabel : '',
                        fontColor: "green"
                    }
                }]
            };

            /*this.chartOptions.tooltips = {
                  callbacks: {
                      label: function(item, data) {
                          console.log(data.labels, item);
                          return data.datasets[item.datasetIndex].label+ ": "+ data.labels[item.index]+ ": "+ data.datasets[item.datasetIndex].data[item.index];
                      }
                  }
            };*/

            this.chartOptions.legend = {
                display: newoption.legend,
                position: newoption.legendPosition,
                labels: {
                    usePointStyle: true
                }
            };

            this.chartData = this.chartobject;
            this.options = this.chartOptions;

            // update selection by column
            /*try {
                if (typeof newoption.XColumn !== 'undefined' && newoption.XColumn.length != 0){
                    this.chartData.datasets.forEach(function(element) {
                        element.hidden = true;
                    });
                }

                this.chartData.datasets.forEach(function(element) {
                    if (typeof newoption.XColumn !== 'undefined'){
                        newoption.XColumn.forEach(function(col_name) {
                            var str1 = element.label.toString().replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '');
                            var str2 = col_name.toString().replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '');
                            element.hidden = ( str2.trim() == str1.trim() ? false : element.hidden);
                        });
                    }
                });
            }catch(err) {}*/
            // end update selection by column

        },

    },
})