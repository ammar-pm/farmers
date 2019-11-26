<template>
    <div>
        <datatable v-bind="$data"></datatable>
    </div>
</template>

<script>
    import orderBy from 'lodash/orderBy'
    import components from './comps/'
    export default {
        components,
        props: ['copy_data','form_id','app_local'],
        data: () => ({
            row:{},
            amINestedComp: !!this.row,
            local_data: [],
            supportBackup: true,
            supportNested: true,
            tblClass: 'table-bordered',
            tblStyle: 'color: #666',
            pageSizeOptions: [5, 10, 15, 20],
            columns: [],
            data: [],
            total: 0,
            selection: [],
            query: this.amINestedComp ? { uid: this.row.friends } : {}
        }),
        watch: {
            query: {
                handler (query) {
                    // console.log(query);
                    this.getData(query);
                },
                deep: true
            }
        },
        mounted() {
            this.getJsonData();
        },
        created(){
            this.$root.$on('ChangedRow', this.getChangedRow);
            this.$root.$on('DelRow', this.enforceDelRow);
        },
        methods: {
            getJsonData(){
                axios.get('/api/v1/files/get_json_all_row_qry2/'+ this.form_id)
                    .then(response => {
                        this.local_data = JSON.stringify(response.data);
                        this.getTableHeader();
                        this.getData();
                    });
            },
            getChangedRow(changedrow){
                var  myJSON = JSON.stringify(changedrow);
                axios.get('/api/v1/files/update_json_row/'+ this.form_id + '/' + myJSON)
                    .then(response => {

                    });
            },
            enforceDelRow(delrow){
                if (confirm('Are you sure you want to delete this record from the database?')) {
                    // Save it!
                    var  myJSON = delrow.uid;
                    axios.get('/api/v1/files/delete_json_row/'+ this.form_id + '/' + myJSON)
                        .then(response => {
                            this.local_data = JSON.stringify(response.data);
                            this.getTableHeader();
                            this.getData();
                        });
                }
            },
            get_json_file_data(){
                axios.get('/api/v1/files/get_json_file_data/'+ this.form_id)
                    .then(response => {
                        this.local_data = response.data;
                    });
            },
            getTableHeader() {
                var obj = JSON.parse(this.local_data);
                var header = Object.keys(obj[0]);
                // console.log(header);
                this.columns = (() => {
                    const cols = header.map(function(val) {
                        console.log(val);
                        return { title: val,thComp: 'FilterTh', field: val, sortable: true };
                    })
                    cols.push({ title: 'Operation' ,tdComp: 'Opt', visible: true })
                    const groupsDef = {
                        Normal: header,
                        Sortable: header,
                        Extra: ['Operation']
                    }
                    return cols.map(col => {
                        Object.keys(groupsDef).forEach(groupName => {
                            if (groupsDef[groupName].includes(col.title)) {
                                col.group = groupName
                            }
                        })
                        // console.log(col);
                        return col
                    })
                })();
                // console.log(this.columns);
                /*this.columns = header.map(function(val) {
                    return { title: val, field: val, sortable: true };
                });
                this.columns.push({ title: 'Operation', tdComp: 'Opt', visible: 'true' });*/
            },
            getData(q) {
                var defq = { limit: 10, offset: 0, sort:'', order: '' };
                q = q || defq;
                var obj = JSON.parse(this.local_data);
                var header = Object.keys(obj[0]);
                // custom query conditions
                header.forEach(field => {
                    switch (typeof(q[field])) {
                        case 'string':
                            //obj = obj.filter(row => row[field].toLowerCase().includes(q[field].toLowerCase()))
                            obj = obj.filter(function (i,n){
                                return i[field].toString().toLowerCase().includes(q[field].toLowerCase());
                            });
                            break
                        default:
                            // nothing to do
                            break
                    }
                });
                //sort
                if (q.sort) {
                    obj = orderBy(obj, q.sort, q.order)
                }
                this.data = obj.slice(q.offset, q.offset + q.limit);
                this.total = obj.length;
            },
            alertSelectedUids () {
                alert(this.selection.map(({ uid }) => uid))
            }

        }
    }

</script>
