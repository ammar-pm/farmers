import { VueCharts, mixins } from 'vue-chartjs';
import * as md5 from 'js-md5';
const { reactiveData } = mixins
Vue.component('line-chart', {
    props: ['id', 'labels', 'data','option','file'],
    extends: VueCharts.Line,
    mixins: [reactiveData],
    data: () => ({
        source:[],
        chartData:'',
        chartOptions: {
            responsive: true,
            maintainAspectRatio: false,
        },
        chartdataoption:'',
        chartobject: [],
        chartoption: '',
        chartjsdata: [],
        chartjslabel: [],
    }),

    created() {
        var copied = JSON.parse(JSON.stringify(this.option));
        this.source[0] = copied;
        this.source[1] = new Date();
        this.getFile([this.file],'line created');
        // this.chartDataOptions(this.chartoptiondata);
    },

    watch: {
        /*'chartoptiondata': {
          handler: function (val,oldVal) {
              this.chartDataOptions(val);
              this.$data._chart.destroy();
              this.renderChart(this.chartData, this.options);
          }, deep:true
        },*/
        'option': {
            handler: function (val,oldVal) {
                var a = this.source[1];
                var b = new Date();
                var c = b.getTime() - a.getTime();
                console.log(a.getTime());
                console.log(b.getTime());
                console.log(b.getTime() - a.getTime());

                if (c <= 50  ) {
                    return;
                }else{
                    this.source[1] = b;
                }

                if (this.rstr2b64(JSON.stringify(this.source[0])).localeCompare(this.rstr2b64(JSON.stringify(val)))  == 0){
                    return;
                }else{
                    console.log('objects not equals');
                    var copied = JSON.parse(JSON.stringify(val));
                    this.source[0] = copied;
                }
                //if (this.rstr2b64(JSON.stringify(this.old_option)).localeCompare(this.rstr2b64(JSON.stringify(val)))  == 0) {
                this.getFile([this.file],'option');
                console.log(this.source);
            }, deep:true
        },
        'file': {
            handler: function (val,oldVal) {
                /*if (this.rstr2b64(JSON.stringify(this.source[0])).localeCompare(this.rstr2b64(JSON.stringify(val)))  == 0){
                    return;
                }else{
                    var copied = JSON.parse(JSON.stringify(val));
                    this.source[0] = copied;
                }*/
                this.getFile([this.file],'line file');
            }, deep:true
        },
        /*'chartdataoption': {
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
        },*/

    },
    methods: {
        chartDataOptions(newoption){
            this.chartOptions.tooltips = {
                enabled: true,
                mode: 'single',
                callbacks: {
                    label: function(tooltipItems, data) {
                        var res = data.datasets[tooltipItems.datasetIndex].toollabel.split('$$');
                        //res.push("value:" + tooltipItems.y);
                        res.push("value:" + tooltipItems.yLabel);
                        return res;
                    }
                }
            };

            this.chartOptions.scales = {
                xAxes: [{
                    ticks: {
                        maxRotation: 90, // angle in degrees
                        //beginAtZero: true // angle in degrees
                    },
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
                    /*ticks: {
                        beginAtZero: true // angle in degrees
                    },*/
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

            this.chartOptions.legend = {
                display: newoption.legend,
                position: newoption.legendPosition,
                labels: {
                    fontColor: "#9A9A9A",
                    usePointStyle: true,
                }
            };

            this.chartOptions.legendCallback = function(chart) {
                var text = [];
                text.push('<ul class="' + chart.id + '-legend">');
                for (var i = 0; i < chart.data.datasets.length; i++) {
                    text.push('<li><span style="background-color:' +
                        chart.data.datasets[i].backgroundColor +
                        '"></span>');
                    if (chart.data.datasets[i].label) {
                        text.push(chart.data.datasets[i].label);
                    }
                    text.push('</li>');
                }
                text.push('</ul>');
                return text.join('');
            };

            /*this.chartOptions.legendCallback = function(chart){
                  return 'abed';
                  var labels = ["SolarCity", "Einstein", "SpaceX", "Mars", "Tesla"];
                  var backgroundColor = [
                      "rgba(242,58,48, 0.1)",
                      "rgba(110,75,63,1)",
                      "rgba(55,72,172,1)",
                      "rgba(0,39,39,1)",
                      "rgba(166,176,69,1)"
                  ];

                  var text = [];
                  text.push('<ul class="' + chart.id + '-legend">');
                  for (var i = 0; i < labels.length; i++) {
                      text.push(
                          '<li><span style="background-color:' + backgroundColor[i] + '">'
                      );
                      if (labels[i]) {
                          text.push(labels[i]);
                          console.log(labels[i]);
                      }
                      text.push("</span></li>");
                  }
                  text.push("</ul>");

                  return text.join("");
            };*/
            var self = this;
            $.map(this.chartobject.datasets, function( value, index ) {
                //self.chartobject.datasets[index].spanGaps    = newoption.spanGaps;
                self.chartobject.datasets[index].pointStyle  = newoption.pointStyle;
                self.chartobject.datasets[index].fill = newoption.fill ? newoption.fill : false;
                self.chartobject.datasets[index].pointRadius = newoption.pointRadius;
                self.chartobject.datasets[index].tension     = newoption.tension;
            });

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
        getFile(record_file_id,vsource) {
            console.log(vsource);
            let vfdim = {};
            let vfaggvalue = null;
            let vbasevalue = null;
            let vyears_fields = null;
            if(this.option){
                if (this.option.X != null){
                    vfdim = {
                        X:this.option.X,
                        Y:this.option.X,
                        Z:this.option.X
                    };
                }
            }
            if(this.option.faggvalue) {
                vfaggvalue = this.option.faggvalue;
            }
            if(this.option.fbasevalue) {
                vbasevalue = this.option.fbasevalue;
            }
            if(this.option.years_field) {
                vyears_fields = this.option.years_field;
            }
            axios.post('/api/v1/files/chartjs2',{file_id:record_file_id[0].id,
                fdim:vfdim,
                fbase:vbasevalue,
                fagg:vfaggvalue,
                charttype:this.option.type,
                years_fields:vyears_fields
            }).then(response => {
                if (response.data.msg.msg_code == 2){
                    // go to options tab
                    Bus.$emit('ChangeTab', 3);
                    // instead showing alert, color input in red and show message
                    $(".dataset-wizard #xaxis").css({"border-bottom-color": "red", "background": "rgba(255, 0, 0,0.1)" });
                    //alert(response.data.msg.msg_text);
                    return;
                }

                if (response.data) {
                    this.chartjsdata = response.data.dataset;
                    this.chartjslabel = response.data.out_labels;
                    this.chartoption  = this.option;

                    this.chartobject = {
                        title: this.title,
                        labels: this.chartjslabel,
                        datasets: this.chartjsdata,
                    };

                    this.updatePointStyle(this.option);
                    this.chartDataOptions(this.option);

                    this.$data._chart.destroy();
                    console.log('renderChart is on the next line');
                    this.renderChart(this.chartobject, this.chartOptions);
                }
            });
        },
        updatePointStyle(newoption) {
            //this.chartOptions.spanGaps    = newoption.spanGaps;
            this.chartOptions.fill        = newoption.fill;
            this.chartOptions.pointStyle  = newoption.pointStyle;
            this.chartOptions.pointRadius = newoption.pointRadius;
            this.chartOptions.tension     = newoption.tension;
            this.chartOptions.XColumn     = newoption.XColumn;
        },
        rstr2b64(input)
        {
            /*var b64pad  = "";
            try { b64pad } catch(e) { b64pad=''; }
            var tab = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
            var output = "";
            var len = input.length;
            for(var i = 0; i < len; i += 3)
            {
                var triplet = (input.charCodeAt(i) << 16)
                    | (i + 1 < len ? input.charCodeAt(i+1) << 8 : 0)
                    | (i + 2 < len ? input.charCodeAt(i+2)      : 0);
                for(var j = 0; j < 4; j++)
                {
                    if(i * 8 + j * 6 > input.length * 8) output += b64pad;
                    else output += tab.charAt((triplet >>> 6*(3-j)) & 0x3F);
                }
            }
            return output;*/
            return md5(input);
        },
        objectEquals(x, y) {
            // if both are function
            if (x instanceof Function) {
                if (y instanceof Function) {
                    return x.toString() === y.toString();
                }
                return false;
            }
            if (x === null || x === undefined || y === null || y === undefined) { return x === y; }
            if (x === y || x.valueOf() === y.valueOf()) { return true; }

            // if one of them is date, they must had equal valueOf
            if (x instanceof Date) { return false; }
            if (y instanceof Date) { return false; }

            // if they are not function or strictly equal, they both need to be Objects
            if (!(x instanceof Object)) { return false; }
            if (!(y instanceof Object)) { return false; }

            var p = Object.keys(x);
            var that = this;
            return Object.keys(y).every(function (i) { return p.indexOf(i) !== -1; }) ?
                p.every(function (i) { return that.objectEquals(x[i], y[i]); }) : false;
        }
    },
})