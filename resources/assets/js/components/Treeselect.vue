<!-- Vue SFC -->
<template>
    <div id="app">
        <treeselect v-model="value" :multiple="true" :options="options" />
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
                // define default value
                value: [],
                // define options
                options: [ {
                    id: 'year',
                    label: 'year',
                    children: [ {
                        id: 'year Set As X',
                        label: 'year As X',
                    }, {
                        id: ' year Set As y',
                        label: 'year As y',
                    } ],
                },{
                    id: 'avg_house_count',
                    label: 'avg_house_count',
                    children: [ {
                        id: 'avg_house_count Set As X',
                        label: 'avg_house_count As X',
                    }, {
                        id: ' avg_house_count Set As y',
                        label: 'avg_house_count As y',
                    } ],
                } ],
            }
        },
        watch: {
            value() {
                const { treeselect } = {'treeselect':this.$children[0]}
                let branchNodesCount = 0
                // Reverse the array first, we only want the last branch node
                const newValue = this.value.slice().reverse().filter(id => {
                    const node = treeselect.getNode(id)
                    // rewarite the logic here to chose One child for each axies X Y Z
                    console.log(node);
                    if (node.isLeaf) return true
                    if (++branchNodesCount === 1) return true
                    return false
                }).reverse()
                // Only assign new value when there were more than one branch nodes checked
                // Otherwise we could run into infinite loop
                //this.value = newValue
                if (branchNodesCount > 1) this.value = newValue

            },
        }
    }
</script>

<style>
    .vue-treeselect__menu, .multiselect__content-wrapper {
        max-height: 140px !important;
    }
</style>
