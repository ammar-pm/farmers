<template>
    <div  id="container" class="chart-container">
        <vue-plotly :data="data" :layout="layout" :options="options"/>
    </div>
</template>

<script>
    import VuePlotly from '@statnett/vue-plotly';

    export default {
        components: {
            VuePlotly
        },
        props: ['file', 'option'],
        data: function () {
            return {
                scale: 100,
                oldScale:0,
                data: [],
                layout: {},
                options: {
                    mapboxAccessToken: 'pk.eyJ1IjoiYWhheWVrODQiLCJhIjoiY2ptN2hmM2k5NDZyazNxb2JpcHJpejZndyJ9.Oqx-TyF6wFAnnHuxN8c_3Q'
                }
            }
        },
        mounted() {
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
                    //this.options.chart.type = val.type;
                    this.layout.title = val.plotly_title;
                    if (val.plotly_scale != this.oldScale){
                        this.scale = val.plotly_scale;
                        this.oldScale = val.plotly_scale;
                        this.getFile(this.file.id);
                    }
                }, deep:true
            },
        },
        methods: {
            getFile(file_id) {
                //console.log(this.options);
                axios.get('/api/v1/files/plotly_map/'+ file_id + '/' + this.scale)
                    .then(response => {
                        /*static load*/
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

                        //console.log(response.data.traces);
                    });

                //console.log(this.VuePlotly);
                //this.VuePlotly.newPlot();
                //this.VuePlotly.relayout();
            }
        }
    }
</script>

<style scoped>

</style>