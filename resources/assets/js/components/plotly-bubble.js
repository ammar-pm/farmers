// JavaScript source code
import * as Plotly from 'plotly.js';

Vue.component('plotly-bubble', {
    template: "<div v-bind:id='divId' v-on:send_labels_geos='getLabelsGeos($event)'></div>",
    props: ['file', 'option','user','app_local'],
        data: function () {
            return {
                source:[],
                scale: 100,
                oldScale:0,
                data: [],
                local_labels_geos:[],
                divId:'test2',
                dimoptions:{},
                layout: {},
                config: {
                    showSendToCloud: true
                },
                frames:[]
            }
        },
    mounted() {
        var copied = JSON.parse(JSON.stringify(this.option));
        this.source[0] = copied;
        this.scale = (this.option.plotly_scale == null?this.scale:this.option.plotly_scale);
        this.getFile(this.file.id);
    },
    watch: {
        'file': {
            handler: function (val,oldVal) {
                this.scale = (val.plotly_scale == null?this.scale:val.plotly_scale);
                this.getFile(this.file.id);
            }, deep:true
        },
        'option': {
            handler: function (val,oldVal) {
                if (this.rstr2b64(JSON.stringify(this.source[0])).localeCompare(this.rstr2b64(JSON.stringify(val)))  == 0){
                    return;
                }else{
                    var copied = JSON.parse(JSON.stringify(val));
                    this.source[0] = copied;
                }
                //this.options.chart.type = val.type;
                console.log('watcher called : ');
                //console.log(this.option.fdimload.fdim);
                this.layout.title = val.plotly_title;
                if (val.plotly_scale != this.oldScale){
                    this.scale = val.plotly_scale;
                    this.oldScale = val.plotly_scale;
                    this.getFile(this.file.id);
                }else{
                    this.getFile(this.file.id);
                }
            }, deep:true
        },
    },
    methods: {
        Plot() {
            //return Plotly.newPlot(this.divId, this.data, this.layout);
            return Plotly.newPlot(this.divId,{data:this.data, layout:this.layout, config:this.config,frames:this.frames});

        },
        getFile(file_id) {
            let vfdim = {};
            let vfaggvalue = null;
            let vbasevalue = null;
            let vuserlang = this.app_local;
            let vyears_fields = null;
            if(this.option){
                if (this.option.X != null){
                    vfdim = {
                        X:this.option.X,
                        Y:(this.option.Y == null?this.option.X:this.option.Y),
                        Z:(this.option.Z == null?this.option.X:this.option.Z)
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
            axios.post('/api/v1/files/plotly_bubble',{file_id:file_id,
                                                      scale:this.scale,
                                                      fdim:vfdim,
                                                      fbase:vbasevalue,
                                                      fagg:vfaggvalue,
                                                      lang:vuserlang,
                                                      years_fields:vyears_fields
            }).then(response => {
                    if (response.data.msg.msg_code == 2){
                        // go to options tab
                        Bus.$emit('ChangeTab', 3);
                        // instead showing alert, color input in red and show message
                        // $(".dataset-wizard #xaxis").css({"border-bottom-color": "red", "background": "rgba(255, 0, 0,0.1)" });
                        // $("#baseselector").css({"border-bottom-color": "red", "background": "rgba(255, 0, 0,0.1)" });
                        //alert(response.data.msg.msg_text);
                        return;
                    }
                    /*static load*/
                    this.data=response.data.traces;
                    this.frames=response.data.frames;
                    this.layout = {
                        autosize: true,
                        height: 600,
                        margin: {
                            l: 45,
                            r: 15,
                            t: 35,
                            b: 15,
                            pad: 4
                        },
                        xaxis: {
                            title: response.data.labels.x,
                            range: [response.data.range.xmin, response.data.range.xmax]
                        },
                        yaxis: {
                            title: response.data.labels.y,
                            range: [response.data.yrange.ymin, response.data.yrange.ymax]
                        },
                        hovermode: 'closest',
                        // We'll use updatemenus (whose functionality includes menus as
                        // well as buttons) to create a play button and a pause button.
                        // The play button works by passing `null`, which indicates that
                        // Plotly should animate all frames. The pause button works by
                        // passing `[null]`, which indicates we'd like to interrupt any
                        // currently running animations with a new list of frames. Here
                        // The new list of frames is empty, so it halts the animation.
                        updatemenus: [{
                            x: 0,
                            y: 0,
                            yanchor: 'top',
                            xanchor: 'left',
                            showactive: false,
                            direction: 'left',
                            type: 'buttons',
                            pad: {t: 15, r: 5},
                            buttons: [{
                                method: 'animate',
                                args: [null, {
                                    mode: 'immediate',
                                    fromcurrent: true,
                                    transition: {duration: 300},
                                    frame: {duration: 500, redraw: false}
                                }],
                                label: 'Play'
                            }, {
                                method: 'animate',
                                args: [[null], {
                                    mode: 'immediate',
                                    transition: {duration: 0},
                                    frame: {duration: 0, redraw: false}
                                }],
                                label: 'Pause'
                            }]
                        }],
                        // Finally, add the slider and use `pad` to position it
                        // nicely next to the buttons.
                        sliders: [{
                            pad: {l:133},
                            currentvalue: {
                                visible: false,
                                //prefix: 'Year:',
                                //xanchor: 'right',
                                //font: {size: 20, color: '#666'}
                            },
                            steps: response.data.sliderSteps
                        }]
                    };
                   // console.log(this.data);
                    Plotly.newPlot(this.divId,{data:this.data, layout:this.layout, config:this.config,frames:this.frames});
                });
        },
        rstr2b64(input)
        {
            var b64pad  = "";
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
            return output;
        }
    }
});