import * as md5 from "js-md5";
Vue.component('files', {

    props: ['data','form_id','page_prop','user','app_local'],

    mixins: [require('./../mixins/link-state')],

    data() {
        return {
            rec_size:0,
            showForm: false,
            selectedFile: null,
            showDeleteConfirmation: false,
            fileHaveDatasets: '',
            topics: [],
            records: [],
            selectedtopics:[],
            mylang:'ar',
            all_recs:[],
            page: this.page_prop | 1,
            filters:{
                search_text:"",
                sort_option:"",
                sort_option_type:"",
                sort_option_lang:""
            }
        };
    },
    created() {
        var old = this.$session.get('form_id');
        this.$session.set('form_id',old || this.form_id);
        console.log('-------------Print session details ------------------');
        console.log('id =  '  + this.$session.id());
        console.log('filters =  ');
        console.log(this.$session.get('filters'));
        console.log('form_id =  '  +this.$session.get('form_id') );
        console.log('page =  '  +this.$session.get('page'));

        console.log('-------------------------------');
        if (this.form_id == 0) {
           console.log((this.$session.get('form_id'))?this.$session.get('form_id'):'null');
            if (typeof this.$session.get('filters')  === "undefined"){
                    this.filters = {
                        search_text:"",
                        sort_option:"",
                        sort_option_type:"",
                        sort_option_lang:""
                    };
                this.page = 1;
            }else{
                this.filters = this.$session.get('filters');
                console.log(this.$session.get('form_id'));
                this.page = (this.$session.get('page') && this.$session.get('form_id') != 0 )? this.$session.get('page') : 1;
            }
           //if(this.$session.get('form_id')  &&  this.$session.get('form_id') != 0){
               this.get_searched_files();
               this.setLangModel();
               console.log(11);
               this.getTopics();
               console.log(11);
               this.$session.remove('page');
               this.$session.remove('form_id');
               this.$session.remove('filters');
               this.$session.clear();
               this.$session.set('form_id',this.form_id);
           /*}else{
               this.$session.remove('page');
               this.$session.remove('form_id');
               this.$session.remove('filters');
               this.$session.clear();
               this.getData();
               console.log(this.$session.id());
               this.setLangModel();
               console.log(11);
               this.getTopics();
               console.log(11);
               null;
           };*/
        }else{
            this.getData();
            console.log(this.$session.id());
            this.setLangModel();
            console.log(11);
            this.getTopics();
            console.log(11);
            this.selectedtopics = this.data.topics;
        }
        console.log(this.form_id);
    },
    watch: {
        'selectedtopics': {
            handler: function (val,oldVal) {
                var el = document.getElementById('hiddentopics');
                let arr = Object.keys(val).map((k) => val[k]);
                el.value = JSON.stringify(arr);
                console.log(el.value);
            }, deep:true
        },
        'filters':{
            handler: function (val,oldVal) {
                this.$session.set('filters', this.filters);
            }, deep:true
        },
        'page':{
            handler: function (val,oldVal) {
                this.$session.set('page', this.page);
            }, deep:true
        },
        'mylang': {
            handler: function (val,oldVal) {
                this.getTopics();
                if (this.form_id == 0) {
                    null;
                }else{
                    this.selectedtopics = this.data.topics;
                }
                console.log(this.form_id);
            }, deep:true
        }
    },
    methods: {
        cancel(event) {
          event.preventDefault();
          //window.history.back();
          window.location.href = "/files";
        },
        onSubmit(e) {
            const file = this.$refs.file.files[0];
            if (file.name.substr(file.name.indexOf(".")+1) != 'csv') {
                console.log(file);
                e.preventDefault();
                var msg = (this.app_local == 'en')?'Only Files of type CSV is accepted':'فقط ملفات CSV يمكن قبولها';
                alert(msg);
            }
            console.log("here: " + this.selectedtopics.length)
            if(this.selectedtopics.length == 0){
                // show error message
                $("#no-topics").removeClass("hidden");
                e.preventDefault();
            }
            else {
                $("#no-topics").addClass("hidden");
            }
        },
        setLangModel(){
                var el = document.getElementById('language');
                this.mylang = (el.value == 0) ? 'ar' : el.value ;
                this.selectedtopics = [];
                //console.log(this.mylang);
        },
        toggleShowForm(e) {
            // e.preventDefault();
            this.showForm = !this.showForm;
            document.getElementById('addfile-btn').blur();
            return false;
        },
        toggleShowDeleteConfirmation(file_id, file_name) {
            this.selectedFile = { id: file_id, name: file_name };
            // console.log(this.selectedFile); 
            this.showDeleteConfirmation = !this.showDeleteConfirmation;
            // this.fileHaveDatasets
            var api_url = '/api/v1/files/does_file_have_a_dataset/' + file_id + '/' + this.app_local;
            // console.log(api_url);
            axios.get(api_url,
                {})
                .then(response => {
                    // console.log(response);
                    this.fileHaveDatasets = response.data.msg_text;
                });
        },
        getData() {
            if (this.form_id == 0){
                this.all_recs = this.data;
                this.records = this.all_recs.slice((this.page-1) * 12, (this.page) * 12);
                this.rec_size = this.all_recs.length;
            }
        },
        clickCallback (page){
            this.records = this.all_recs.slice((page-1) * 12, (page) * 12);
            //console.log(this.records);
        },
        get_searched_files() {
            if (typeof this.$session.get('filters')  === "undefined"){
                this.page = 1;
            }else{
                this.page = (this.$session.get('page') && this.$session.get('form_id') != 0 )? this.$session.get('page') : 1;
            }
            axios.post('/api/v1/files/get_searched_files',
                {
                    search_text: this.filters.search_text,
                    sort_option: this.filters.sort_option,
                    sort_option_type: this.filters.sort_option_type,
                    sort_option_lang: this.filters.sort_option_lang
                })
                .then(response => {
                    this.all_recs = response.data.records;
                    if (this.all_recs.slice((this.page-1) * 12, (this.page) * 12).length == 0){
                        this.records = this.all_recs.slice((1-1) * 12, (1) * 12);
                    }else{
                        this.records = this.all_recs.slice((this.page-1) * 12, (this.page) * 12);
                    }
                    //console.log(this.records);
                    this.rec_size = this.all_recs.length;
                });
        },
        getTopics() {
            axios.get('/api/v1/topicsbylang/'+this.mylang)
                .then(response => {
                    this.topics = response.data.records;
                });
        }
    },
});