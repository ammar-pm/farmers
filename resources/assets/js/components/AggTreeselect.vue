<!-- Vue SFC -->
<template>
    <div id="app">
        <treeselect
                v-model="value"
                :sort-value-by="sortValueBy"
                :value-consists-of="valueConsistsOf"
                :multiple="true"
                :options="options" />
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
        data() {
            return {
                // my values
                branchNodesCount2:0,
                valueConsistsOf: 'ALL_WITH_INDETERMINATE',
                sortValueBy:'INDEX',
                // define default value
                value: [],
                // define options
                options: [ {
                    id: 'geo',
                    label: 'geo',
                    children: [ {
                        id: '1011',
                        label: '1011',
                    }, {
                        id: '1012',
                        label: '1012',
                    }, {
                        id: '1013',
                        label: '1013',
                    } ],
                },{
                    id: 'type_of_building',
                    label: 'type_of_building',
                    children: [ {
                        id: 'villa',
                        label: 'villa',
                    }, {
                        id: 'house',
                        label: 'house',
                    }, {
                        id: 'building',
                        label: 'building',
                    } ],
                } ],
            }
        }/*,
        watch: {
            value() {
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

                    if (node.raw.id.search("X") != -1 && xcount == 0 ){xcount = xcount + 1;return true;}
                    if (node.raw.id.search("Y") != -1 && ycount == 0 ){ycount = ycount + 1; return true;}
                    if (node.raw.id.search("Z") != -1 && zcount == 0 ){zcount = zcount + 1; return true;}
                    // rewarite the logic here to chose One child for each axies X Y Z
                    //if (node.isLeaf && cnt  <= 3 && cnt > 0) return true
                    //if (!node.isLeaf) cnt = cnt + 2
                    //if (++branchNodesCount === 1) return true
                    return false
                }).reverse()
                // Only assign new value when there were more than one branch nodes checked
                // Otherwise we could run into infinite loop
                //this.value = newValue
                if (this.value.length > 3) this.value = newValue

            },
        }*/
    }
</script>



