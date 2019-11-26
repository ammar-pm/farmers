<!-- Vue SFC -->
<template>
    <div id="app">

        <div class="form-group">
            <label for="sel1">X axis:<sup>*</sup></label>
            <select  class="form-control" id="xaxis" name="xaxis" v-model="fdim.X" v-on:change="sendfdim($event)" required>
                <option v-for="toption in options"
                        :value="toption"
                        :selected="fdim.X == toption ? 'selected' : ''">{{ toption }}</option>
            </select>
        </div>
        <div class="form-group">
            <label for="sel1">Y axis:<sup>*</sup></label>
            <select  class="form-control" id="yaxis" name="yaxis" v-model="fdim.Y" v-on:change="sendfdim($event)" required>
                <option v-for="toption in options"
                        :value="toption"
                        :selected="fdim.Y == toption ? 'selected' : ''">{{ toption }}</option>
            </select>
        </div>
        <div class="form-group">
            <label for="sel1">Z axis:<sup>*</sup></label>
            <select  class="form-control" id="zaxis" name="zaxis" v-model="fdim.Z" v-on:change="sendfdim($event)" required>
                <option v-for="toption in options"
                        :value="toption"
                        :selected="fdim.Z == toption ? 'selected' : ''">{{ toption }}</option>
            </select>
        </div>
    </div>
</template>

<script>
   export default {
        props: ['file', 'library','option'],
        data() {
            return {
                options:[],
                fdim:{
                    X:'',
                    Y:'',
                    Z:''
                }
            }
        },
        watch: {
            file(){
                // send selection to the parent datasets
                let fdimload = {
                    fdim:{},
                    fdim_value: []
                };
                this.$root.$emit('getFdim', fdimload);
                this.get_json_dim_data();
            }
        },
        created(){
            this.get_json_dim_data();
            if (this.option.fdimload.fdim){
                this.fdim = this.option.fdimload.fdim;
            }
        },
        methods: {
           pause(milliseconds) {
               var dt = new Date();
               while ((new Date()) - dt <= milliseconds) { /* Do nothing */ }
           },
            get_json_dim_data() {
               //console.log(this.file);
                axios.get('/api/v1/files/get_json_dim_data/' + this.file.id)
                    .then(response => {
                        if (response.data) {
                            this.options = response.data.options
                        }
                    });
            },
            sendfdim: function (event) {
                // send selection to the parent datasets
                let fdimload = {
                    fdim:this.fdim,
                    fdim_value: []
                };
                this.$root.$emit('getFdim', fdimload);
            }
       }
    }
</script>



