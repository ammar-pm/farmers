// JavaScript source code
import * as Plotly from 'plotly.js';

Vue.component('plotly-map', {
    template: "<div v-bind:id='divId'></div>",
    props: ['file', 'option','user','app_local'],
        data: function () {
            return {
                source:[],
                scale: 100,
                oldScale:0,
                data: [],
                local_labels_geos:[],
                divId:'test',
                layout: {},
                options: {
                    mapboxAccessToken: 'pk.eyJ1IjoicG1hb3F1ZSIsImEiOiJjanZpMHNnNGowMHlvM3lxbHA3ZWdodzlyIn0.6m3CU9tWBXh1Jt7xMRYxOw' //abed token
                    //mapboxAccessToken: 'pk.eyJ1IjoibDIzNDUiLCJhIjoiY2p2Z2hlYnVyMDczcTN5amQ5NjR0ODI2ayJ9.RiyuDKsiI3I0M2mrPjNqeA' //lour token
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
            console.log(this.divId);
            return Plotly.newPlot(this.divId, this.data, this.layout);
        },
        getFile(file_id) {
            let vfdim = {};
            let vfaggvalue = null;
            let vbasevalue = null;
            let vuserlang = this.app_local;
            let vyears_fields = null;
            if(this.option) {
                if (this.option.X != null){
                vfdim = {
                    X: this.option.X,
                    Y: this.option.X,
                    Z: this.option.X
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
            axios.post('/api/v1/files/plotly_map2',{file_id:file_id,
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
                this.data=response.data.traces;
                this.frames=response.data.frames;
                this.layout = {
                    autosize: true,
                    height: $(window).height() - 220,
                    margin: {
                        l: 15,
                        r: 15,
                        t: 35,
                        b: 5,
                        pad: 4
                    },
                    hovermode: 'closest',
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
                    showlegend: true,
                    title: this.option.plotly_title,
                    mapbox: {
                        //style:'mapbox://styles/l2345/cjvglr7l209441flhvoqaszx5', // Lour working
                        //style:'mapbox://styles/ahayek84/cjvgx5yiy00ws1cmuyzfv7t1m', // abed worked 1 Streets-copy slider broken
                        //style: 'mapbox://styles/ahayek84/cjvgy0ouq01qb1co8b1em3jtt', // abed worked 1 Streets-copy  slider broken
                        accesstoken:response.data.style_load.accesstoken,
                        style: response.data.style_load.style,
                        layers:[
                            {
                                sourcetype: 'geojson',
                                source:'/map_layers/geojson/Locality2017.json',
                                type:'line',
                                line:{
                                    width:0.5
                                },
                                color:'#adacac'
                            }
                        ],
                        /*layers:[
                            {
                                sourcetype: 'geojson',
                                source:'/map_layers/geojson/Locality2017.json',
                                type:'line',
                                line:{
                                    width:1
                                },
                                color:'#444',
                                fill:'toself',
                                fillcolor:'#000'
                            },
                            {
                                sourcetype: 'geojson',
                                source:'/map_layers/geojson/Palestine_Border.json',
                                type:'line',
                                line:{
                                    width:1
                                },
                                color:'#444'
                            },
                            {
                                sourcetype: 'geojson',
                                source:'/map_layers/geojson/Governorates.json',
                                type:'line',
                                line:{
                                    width:1
                                },
                                color:'#ff0000'
                            }
                        ],*/
                        bearing: 0,
                        center: {
                            lat: 31.814685,
                            lon: 35.208116
                        },
                        pitch: 0,
                        zoom: 7.5,
                    },
                    sliders :[{
                        pad: {l:133},
                        currentvalue: {
                            visible: false,
                            //prefix: 'Year:',
                            //xanchor: 'right',
                           // font: {size: 20, color: '#666'}
                        },
                        steps: response.data.sliderSteps
                    }]
                };
                this.options= {
                    mapboxAccessToken: response.data.style_load.accesstoken //abed token
                    //mapboxAccessToken: 'pk.eyJ1IjoibDIzNDUiLCJhIjoiY2p2Z2hlYnVyMDczcTN5amQ5NjR0ODI2ayJ9.RiyuDKsiI3I0M2mrPjNqeA' //lour token
                };
                this.local_labels_geos=response.data.labels_geos;
                this.$emit('send_labels_geos', this.local_labels_geos);

                // console.log(this.data);
                //Plotly.newPlot(this.divId, this.data, this.layout, this.options);
                //Plotly.newPlot(this.divId, this.data, this.layout, this.options);

                Plotly.newPlot(this.divId,{data:this.data, layout:this.layout, config:this.options,frames:this.frames});
                });

            /*axios.get('/api/v1/files/plotly_map/'+ file_id + '/' + this.scale)
                .then(response => {
                    this.data=response.data.traces;
                    this.layout = {
                        autosize: true,
                        height: 600,
                        margin: {
                            l: 15,
                            r: 15,
                            t: 35,
                            b: 15,
                            pad: 4
                        },
                        showlegend: true,
                        title: this.option.plotly_title,
                        mapbox: {
                            bearing: 0,
                            center: {
                                lat: 31.814685,
                                lon: 35.208116
                            },
                            pitch: 0,
                            zoom: 8
                        },
                        sliders :[{
                            pad: {t: 5},
                            steps:response.data.steps
                        }]
                    };
                    this.options= {
                        mapboxAccessToken: 'pk.eyJ1IjoiYWhheWVrODQiLCJhIjoiY2ptN2hmM2k5NDZyazNxb2JpcHJpejZndyJ9.Oqx-TyF6wFAnnHuxN8c_3Q'
                    };
                    this.local_labels_geos=response.data.labels_geos;
                    this.$emit('send_labels_geos', this.local_labels_geos);

                    Plotly.newPlot(this.divId, this.data, this.layout, this.options);
                    //console.log(response.data.traces);
                });*/
            //this.Plot();
            //console.log(this.VuePlotly);
            //this.VuePlotly.newPlot();
            //this.VuePlotly.relayout();
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