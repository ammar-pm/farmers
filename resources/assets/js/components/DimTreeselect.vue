<!-- Vue SFC -->
<template>
    <div id="app">

                <treeselect
                        :value-consists-of="valueConsistsOf"
                        :multiple="true"
                        :options="options"
                        v-model="value"
                />
        <button class="btn btn-default" title="Validate selection"
                @click="validateSelection">
            <i class="fa fa-check-square-o"></i>
        </button>
    </div>
</template>

<script>
    // import the component
    import Treeselect  from '@riophae/vue-treeselect'
    // import the styles
    import '@riophae/vue-treeselect/dist/vue-treeselect.css'

   export default {
        // register the component
        components: {  Treeselect  },
        props: ['file', 'library','option'],
        data() {
            return {
                // my values
                branchNodesCount2:0,
                valueConsistsOf: 'LEAF_PRIORITY',
                // define default value
                value: [],
                // define options
                options: [],
                fdim:{}
            }
        },
        watch: {
            value() {
                let dim = {}
                const { treeselect } = {'treeselect':this.$children[0]}
                let branchNodesCount = 0
                let xcount = 0
                let ycount = 0
                let zcount = 0
                // Reverse the array first, we only want the last branch node
                const newValue = this.value.slice().reverse().filter(id => {
                    this.branchNodesCount2 = this.value.length
                    let cnt = (this.branchNodesCount2 > 0) ? this.branchNodesCount2 : 0
                    const node = treeselect.getNode(id)

                    if (node.raw.id.search("X#") != -1 && ++xcount === 1 ){dim.X = node.raw.id.replace("X#",""); return true;}
                    if (node.raw.id.search("Y#") != -1 && ++ycount === 1 ){dim.Y = node.raw.id.replace("Y#","");return true;}
                    if (node.raw.id.search("Z#") != -1 && ++zcount === 1 ){dim.Z = node.raw.id.replace("Z#","");return true;}
                    // rewarite the logic here to chose One child for each axies X Y Z
                    //if (node.isLeaf && cnt  <= 3 && cnt > 0) return true
                    //if (!node.isLeaf) cnt = cnt + 2
                    //if (++branchNodesCount === 1) return true
                    return false
                }).reverse()
                // Only assign new value when there were more than one branch nodes checked
                // Otherwise we could run into infinite loop
                //this.value = newValue
                // defer the execution of anonymous function for
                // 3 seconds and go to next line of code.
                //this.pause(500)
                //if (xcount + ycount + zcount >= 3) this.value = newValue
                if (this.value.length > 3) this.value = newValue

            },
            file(){
                this.value = [];
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
            if (this.option.fdimload.fdim_value){
                this.value = this.option.fdimload.fdim_value
            }
        },
        methods: {
           pause(milliseconds) {
               var dt = new Date();
               while ((new Date()) - dt <= milliseconds) { /* Do nothing */ }
           },
           validateSelection(){
               let dim = {}
               const { treeselect } = {'treeselect':this.$children[0]}
               let branchNodesCount = 0
               let xcount = 0
               let ycount = 0
               let zcount = 0
               // Reverse the array first, we only want the last branch node
               const newValue = this.value.slice().reverse().filter(id => {
                   this.branchNodesCount2 = this.value.length
                   let cnt = (this.branchNodesCount2 > 0) ? this.branchNodesCount2 : 0
                   const node = treeselect.getNode(id)

                   if (node.raw.id.search("X#") != -1 && ++xcount === 1 ){dim.X = node.raw.id.replace("X#",""); return true;}
                   if (node.raw.id.search("Y#") != -1 && ++ycount === 1 ){dim.Y = node.raw.id.replace("Y#","");return true;}
                   if (node.raw.id.search("Z#") != -1 && ++zcount === 1 ){dim.Z = node.raw.id.replace("Z#","");return true;}
                   // rewarite the logic here to chose One child for each axies X Y Z
                   //if (node.isLeaf && cnt  <= 3 && cnt > 0) return true
                   //if (!node.isLeaf) cnt = cnt + 2
                   //if (++branchNodesCount === 1) return true
                   return false
               }).reverse()
               // Only assign new value when there were more than one branch nodes checked
               // Otherwise we could run into infinite loop
               //this.value = newValue
               // defer the execution of anonymous function for
               // 3 seconds and go to next line of code.
               //this.pause(500)
               //if (xcount + ycount + zcount >= 3) this.value = newValue
               //console.log(this.library);
               switch (this.library) {
                   case 'tableau':
                       if (xcount === 0 ){alert('You have to select an feature for the X axis');}
                       else if (ycount === 0 ){alert('You have to select an feature for the Y axis');}
                       else if (zcount === 0 ){alert('You have to select an feature for the Z axis');}
                       else {
                           this.fdim = dim;
                           // send selection to the parent datasets
                           let fdimload = {
                               fdim:this.fdim,
                               fdim_value: newValue
                           };
                           this.$root.$emit('getFdim', fdimload);
                       }
                       break;
                   case 'plotly':
                       if (xcount === 0 ){alert('You have to select an feature for the X axis');}
                       else if (ycount === 0 ){alert('You have to select an feature for the Y axis');}
                       else if (zcount === 0 ){alert('You have to select an feature for the Z axis');}
                       else {
                           this.fdim = dim;
                           // send selection to the parent datasets
                           let fdimload = {
                               fdim:this.fdim,
                               fdim_value: newValue
                           };
                           this.$root.$emit('getFdim', fdimload);
                       }
                       break;
                   case 'chartjs':
                       if (xcount === 0 ){alert('You have to select an feature for the X axis');}
                       else if (ycount === 0 ){alert('You have to select an feature for the Y axis');}
                       else {
                           this.fdim = dim;
                           // send selection to the parent datasets
                           let fdimload = {
                               fdim:this.fdim,
                               fdim_value: newValue
                           };
                           this.$root.$emit('getFdim', fdimload);
                       }
               }


               //console.log(this.fdim);
               this.value = newValue

           },
            get_json_dim_data() {
               //console.log(this.file);
                axios.get('/api/v1/files/get_json_dim_data/' + this.file.id)
                    .then(response => {
                        if (response.data) {
                            this.options = response.data.options
                            //console.log(response.data);
                        }
                    });
            }
       }
    }
</script>



