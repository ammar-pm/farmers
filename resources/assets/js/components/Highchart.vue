<template>
  <div  id="container" class="chart-container">
    <vue-highcharts ref="highcharts" :highcharts="highcharts" :options="options"></vue-highcharts>
  </div>
</template>

<script>

    import VueHighcharts from "vue2-highcharts";
    var Highcharts = require("highcharts");
    require('highcharts-grouped-categories')(Highcharts);
    import * as md5 from 'js-md5';


    export default {

        components: {
            VueHighcharts
        },

        props: ['file', 'option','user','app_local'],

        data: function() {
            return {
                source:[],
                series_cp:[],
                options: {
                    chart: {
                        renderTo: "container",
                        type: this.option.type,
                        zoomType: this.option.zoomtype,
                        height: this.option.height,
                        inverted: false
                    },
                    title: {
                        useHTML: true,
                        x: -10,
                        y: 8,
                        text: ''
                    },
                    tooltip: {
                        useHTML: true
                    }
                },
                highcharts : Highcharts
            }
        },
        created() {
            var copied = JSON.parse(JSON.stringify(this.option));
            this.source[0] = copied;
            this.source[1] = new Date();
            this.getFile(this.file.id);
        },
        watch: {
            'file': {
                handler: function (val,oldVal) {
                    this.getFile(this.file.id);
                }, deep:true
            },

            'option': {
                handler: function (val,oldVal) {
                    var a = this.source[1];
                    var b = new Date();
                    var c = b.getTime() - a.getTime();
                    console.log(a.getTime());
                    console.log(b.getTime());
                    console.log(b.getTime() - a.getTime());
                    if (c <= 800  ) {
                        return;
                    }else{
                        this.source[1] = b;
                    }
                    if (this.rstr2b64(JSON.stringify(this.source[0])).localeCompare(this.rstr2b64(JSON.stringify(val)))  == 0){
                        return;
                    }else{
                        var copied = JSON.parse(JSON.stringify(val));
                        this.source[0] = copied;
                    }
                    this.options.chart.type = val.type;
                    this.options.chart.zoomtype = val.zoomtype;
                    this.options.title.text = val.highchart_title;
                    this.options.chart.height = val.height;
                    //Highcharts.setOptions(this.options);
                    this.getFile(this.file.id);
                    console.log(this.source);
                }, deep:true
            },

        },

        methods: {

            getFile(record) {
                //console.log(this.options);
                let vfdim = {};
                let vfaggvalue = null;
                let vbasevalue = null;
                let vuserlang = this.app_local;
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
                if(this.user) {
                    vuserlang = this.user.language;
                }
                if(this.option.years_field) {
                    vyears_fields = this.option.years_field;
                }
                axios.post('/api/v1/files/highchart2',{file_id:record,
                    fdim:vfdim,
                    fbase:vbasevalue,
                    fagg:vfaggvalue,
                    lang:vuserlang,
                    charttype:this.option.type,
                    years_fields:vyears_fields
                }).then(response => {
                    console.log(this.$parent);
                    if (response.data.msg.msg_code == 2){
                        // go to options tab
                        Bus.$emit('ChangeTab', 3);
                        // instead showing alert, color input in red and show message
                        $(".dataset-wizard #xaxis").css({"border-bottom-color": "red", "background": "rgba(255, 0, 0,0.1)" });
                        //alert(response.data.msg.msg_text);
                        return;
                    }
                    this.series_cp = response.data.series;
                    this.options = {
                        series: {
                            connectNulls: true
                        },
                        chart: {
                            renderTo: "container",
                            type: this.option.type,
                            zoomType: this.option.zoomtype,
                            height: this.option.height,
                            inverted: false
                        },

                        legend: {
                            enabled:true,
                            useHTML: Highcharts.hasBidiBug,
                            layout: 'vertical',
                            align: 'right',
                            verticalAlign: 'top',
                            navigation: {
                                activeColor: '#3E576F',
                                animation: true,
                                arrowSize: 12,
                                inactiveColor: '#CCC',
                                style: {
                                    fontWeight: 'bold',
                                    color: '#333',
                                    fontSize: '12px'
                                }
                            }
                        },

                        title: {
                            useHTML: true,
                            x: -10,
                            y: 8,
                            text: '',
                            useHTML: Highcharts.hasBidiBug
                        },

                        // colors: ['#11547b', '#11547b', '#11547b', '#11547b', '#11547b', '#11547b', '#11547b', '#11547b', '#11547b'],
                        series: response.data.series,
                        xAxis: {
                            title: {
                                useHTML: Highcharts.hasBidiBug
                            },
                            categories: response.data.categories,
                            labels: {
                                step: 1,
                                rotation: 0
                            }
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: this.option.highchart_title,
                                useHTML: Highcharts.hasBidiBug
                            },
                            labels: {
                                overflow: 'justify',
                                format: '{value}'
                            }
                        },
                        tooltip: {
                            formatter: function(d){
                                var all_series = response.data.series;
                                var all_tmp = '';
                                for (var key in all_series) {
                                    if (all_series.hasOwnProperty(key) && all_series[key].name == this.series.name) {
                                        all_tmp = all_series[key].toolname;
                                        break;
                                    }
                                }
                                var all = all_tmp.split('$$');
                                var rV = '';
                                var arrayLength = all.length;
                                for (var i = 0; i < arrayLength; i++) {
                                    rV += '<span style="color:' + this.point.color + '">\u25CF</span> ' + '' + '<b> ' + all[i] + '</b><br/>';
                                }
                                rV += '<span style="color:' + this.point.color + '">\u25CF</span> ' + '' + '<b> value:' + this.y + '</b><br/>';
                                return rV;
                            },
                            useHTML: true
                        }
                    }
                    //document.querySelector("input[name=hc_heigh]").value = this.options.chart.height;
                    Highcharts.chart(this.options);
                    // $("#hc_heigh").val(this.options.chart.height.toString() | '800');
                });
                /////////////old code////////////
                /*       axios.get('/api/v1/files/highchart/'+ record)
                           .then(response => {
                               this.options = {

                           chart: {
                               renderTo: "container",
                               type: this.option.type,
                               zoomType: this.option.zoomtype,
                               height: this.option.height,
                               inverted: false
                           },

                           legend: {
                               layout: 'vertical',
                               align: 'right',
                               verticalAlign: 'top',
                               navigation: {
                                   activeColor: '#3E576F',
                                   animation: true,
                                   arrowSize: 12,
                                   inactiveColor: '#CCC',
                                   style: {
                                       fontWeight: 'bold',
                                       color: '#333',
                                       fontSize: '12px'
                                   }
                               }
                           },

                           title: {
                               useHTML: true,
                               x: -10,
                               y: 8,
                               text: ''
                           },

                           // colors: ['#11547b', '#11547b', '#11547b', '#11547b', '#11547b', '#11547b', '#11547b', '#11547b', '#11547b'],
                           series: response.data.series,
                           xAxis: {
                               categories: response.data.categories,
                               labels: {
                                   step: 1,
                                   rotation: 0
                               }
                           },
                           yAxis: {
                               min: 0,
                               title: {
                                   text: this.option.highchart_title
                               },
                               labels: {
                                   overflow: 'justify'
                               }
                           }
                       }
                       Highcharts.chart(this.options);
                   }
                       );*/
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

        }
    }
</script>