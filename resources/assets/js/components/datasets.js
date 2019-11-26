import html2canvas from 'html2canvas';
import Canvas2Image from 'canvas2image';

Vue.component('datasets', {

    props: ['user','app_local','ds_id'],

    mixins: [require('./../mixins/link-state')],

    data() {
        return {
            tabsOn: true,
            tabIndex: 0,
            // maxTabIndex: 0,
            page: 1,
            call_response:[],
            textdang:true,
            record: null,
            rec_size:0,
            records: [],
            filters:{
                search_text:"",
                sort_option:"",
                sort_option_type:"",
                export_option: "",
                sort_option_type:"",
                sort_option_lang: ""
            },
            export_url: "",
            all_recs:[],
            files: [],
            file: '',
            output: null,
            preview_url: null,
            periods: [],
            topics: [],
            governorates: [],
            indicators: [],
            filelist:'',
            taglist: [],
            chartjsdata: [],
            chartjslabel: [],
            labels_geos: [],
            related_datasets: [],
            all_related_datasets:[],
            chartobject: [],
            tabvizlist: [],
            showfileid: '',
            chartoption: '',
            chartupdatedata: '',
            updated: '',
            created: '',
            created_by: '',
            trash:false,
            selectedDatasets: {},
            form: new SparkForm({
                id:'',
                title: '',
                form_data: null,
                topicid:[],
                description: '',
                preview: '',
                periods: [],
                topics: [],
                governorates: [],
                indicators: [],
                years_field: [],
                public: '',
                featured: '',
                language: '',
                related_id:'',
                tags: [],
                file_id: [],
                library: '',
                favorites: [],
                fdimload:[],
                faggload:{
                    valueConsistsOf: 'ALL_WITH_INDETERMINATE',
                    sortValueBy:'INDEX',
                    clearOnSelect: true,
                    options:[],
                    value:[]
                },
                fbaseload:{
                    valueConsistsOf: 'ALL_WITH_INDETERMINATE',
                    sortValueBy:'INDEX',
                    clearOnSelect: true,
                    options:[],
                    value:[]
                },
                options: {
                    XColumn:[]
                }
            }),
            createForm: new SparkForm({
                id: '',
                title: '',
                library: 'chartjs',
                public: 0,
                featured: 0,
                related_id:'',
                language: this.app_local,
                //language: '',
                created_by: this.user ? this.user.id : ''
            }),
        };
    },
    computed: {
        classObject: function () {
            if (this.call_response.msg_code) {
                return {
                    'fa': true,
                    'far': false,
                    'fa-heart': true,
                    'text-danger': true
                };
            } else {
                return {
                    'fa': false,
                    'far': true,
                    'fa-heart': true,
                    'text-danger': false
                };
            }
        },
        vheight:function () {
            return $(window).height() - 40;
        },
    },
    watch: {
       /* 'form.library': {
            handler: function (val,oldVal) {
                if (val=='chartjs' && this.form.file_id){
                    this.form.options.type = (this.form.options.type != 'bar' && this.form.options.type != 'horizontal-bar' && this.form.options.type != 'line') ? 'line' : this.form.options.type;
                    this.getFile([this.form.file_id],0);
                    console.log(this.form.options.fdimload);
                    console.log(val);
                }
            }, deep:true
        },*/
         'form.library': {
            handler: function (val,oldVal) {
                if(val=='chartjs' || val=="highchart" || val=="tableau") {
                    this.form.options.type =  this.form.options.type || 'line';
                }
                if(val == "plotly") {
                    this.form.options.type = this.form.options.type || "scattergeo";
                }
            }, deep:true
        },
        'form.topicid': {
            handler: function (val,oldVal) {
                console.log(typeof this.form.topicid);
                console.log(this.form.topicid);
                if (this.form.topicid != null){
                    console.log('not null');
                    //this.getFileTopicId();
                }else{
                    console.log('null');
                    this.getFiles();
                }
            }, deep:true
        },
        'form.options.fbasevalue': {
            handler: function (val,oldVal) {
                if( val == null ||  val == "") {
                    document.getElementById("baseselector").style.background = "#fee2e1";
                } else {
                    document.getElementById("baseselector").style.background = "transparent";
                }
            }, deep:true
        },
        'form.topics': {
            handler: function (val,oldVal) {
                if( val == null ||  val == "") {
                    document.getElementById("topics-select").getElementsByClassName("multiselect__tags")[0].style.background = "#fee2e1";
                } else {
                    document.getElementById("topics-select").getElementsByClassName("multiselect__tags")[0].style.background = "transparent";
                }
            }, deep:true
        },
        'form.title': {
            handler: function (val,oldVal) {
                if( val == null ||  val == "") {
                    document.getElementById("dataset-title").style.background = "#fee2e1";
                } else {
                    document.getElementById("dataset-title").style.background = "transparent";
                }
            }, deep:true
        }
    },
    mounted() {
        this.usePushStateForLinks();
    },
    created() {
        var self = this;
        Bus.$on('SendChartJs', this.GetChartJs);
        // Bus.$on('ChangeTab', this.ChangeTab);
        Bus.$on('linkHashChanged', function (hash, parameters) {
            if (hash != 'dataset') {
                return true;
            }
            if (parameters && parameters.length > 0) {
                self.getRecord(parameters[0],0);
            }

            return true;
        });
        //this.$root.$on('getFdim', this.enforcegetFdim);
        this.getFiles();
        this.getRecords();
        this.getPeriods();
        this.getTopics();
        this.getGovernorates();
        this.getIndicators();
        this.getRelated_datasets();
        // under test
        if(this.ds_id){
            this.getRecord(this.ds_id);
        }
    },

    methods: {
        exportt() {
            // if(this.filters.export_option == "pdf") {
                window.print();
            // }
        },
        printt() {
            let vc = this
            let filename = 'Abdo222' + '.png';
            html2canvas(this.$refs.capture).then(canvas => {
                var image = canvas.toDataURL("image/jpg");
                this.form.preview = image;
                //this.preview_url = image;
            });
        },
        exportChart() {
            html2canvas(document.querySelector("#chart")).then(canvas => {
                console.log(canvas);
                var image = canvas.toDataURL("image/jpg");
                this.export_url = image;
                var link = document.getElementById("visual-export-link");
                link.setAttribute("href", this.export_url);
                link.click();
            });
        },
        handleFileUpload() {
            this.file = this.$refs.file.files[0];
            // const file = e.target.files[0];
            this.preview_url = URL.createObjectURL(this.file);
            // console.log(preview_url);
             },
        toggleTabs() {
            this.tabsOn = !this.tabsOn;
        },
        hideTabs() {
            this.tabsOn = false;
        },
        // todo: remove show tabs on tab title clicked
        showTabs() {
            this.tabsOn = true;
        },
        nextTab() {
            // console.log();
            
            // next tab
            var nextNav = document.getElementsByClassName("nav-tabs")[0].getElementsByClassName("active")[0].parentElement.nextElementSibling;
            // var nextNav = currentNav.parentElement.nextElementSibling.getElementsByClassName("nav-link")[0];

            // currentNav.setAttribute("disabled","");
            // currentNav.classList.add("disabled");
            

            // nextNav.removeAttribute("disabled");
            // nextNav.classList.remove("disabled");
            // nextNav.classList.add("active");
            
            // console.log(nextNav);
            // console.log(nextNav);

            // // next content
            // var currentContent = document.getElementsByClassName("dataset-wizard")[0].getElementsByClassName("tab-content")[0].getElementsByClassName("active")[0];
            // var nextContent = currentContent.nextElementSibling;
            
            // currentContent.classList.add("disabled");
            // currentContent.classList.remove("show");
            // currentContent.classList.remove("active");
            
            // nextContent.classList.remove("disabled");
            // nextContent.classList.add("show");
            // nextContent.classList.add("active");

            // console.log(currentContent);
            // console.log(nextContent);

            
            // todo: add required classes to required inputs
            // check all required fields
            var requiredFields = document.getElementsByClassName("dataset-wizard")[0].getElementsByClassName("tab-content")[0].getElementsByClassName("active")[0].getElementsByClassName("required");
            console.log(requiredFields);
            /// $(".tab-pane.show.active .form-group .required").each do
            var i;
            var valid = true;

            for (i = 0; i < requiredFields.length; i++) { 
              // text += cars[i] + "<br>";
              // if $el.val().trim != "" go to next tab
              if ( requiredFields[i].value.trim() == "" ) {
                valid = false;
                requiredFields[i].style.background = "#fee2e1";
              } else {
                requiredFields[i].style.background = "transparent";
              }
            }

            // validating library
            if ( this.tabIndex == 1 ) {
                if ( this.form.library == "plotly" && this.form.options.fbasevalue.length < 1) {
                    valid = false;
                    document.getElementById("baseselector").style.background = "#fee2e1";
                } 
                if ( this.form.library == "plotly" && this.form.options.fbasevalue.length > 0) {
                    document.getElementById("baseselector").style.background = "transparent";
                }
            
                // this.form.options.iframe_url should be filled
                if ( this.form.library == "iframe" ) {
                  console.log("iframe");
                  if (this.form.options.iframe_url == undefined || this.form.options.iframe_url.trim() == "") {
                    valid = false;
                    document.getElementsByClassName("data-libraries")[0].getElementsByClassName("form-control")[0].style.background = "#fee2e1";
                  } else {
                    document.getElementsByClassName("data-libraries")[0].getElementsByClassName("form-control")[0].style.background = "transparent";
                  }
                }
            }
            
            // validating topics
            if ( this.tabIndex == 4 ) {
              // console.log(this.form.topics.length);
              if ( this.form.topics.length < 1) {
                valid = false;
                document.getElementById("topics-select").getElementsByClassName("multiselect__tags")[0].style.background = "#fee2e1";
              } else {
                valid = true;
                document.getElementById("topics-select").getElementsByClassName("multiselect__tags")[0].style.background = "transparent";
              }
            } 
            // else {
            //     document.getElementById("baseselector").style.background = "transparent";
            // }
            
            // var tabsNav = document.getElementsByClassName("nav-tabs")[0];
            // var activeNav = tabsNav.getElementsByClassName("active")[0];
            // var nextNav = activeNav.parentElement.nextElementSibling;

            // document.getElementsByClassName(".nav-tabs").first() //.nav-item .active").parent("li").next();
            // if( this.tabIndex <= this.maxTabIndex ) {
           if(valid) {
                // nextNav.classList.remove("disabledTab");
                this.tabIndex = this.tabIndex + 1
                // this.maxTabIndex = this.maxTabIndex + 1
                console.log(this.tabIndex)
            } else {
                console.log("please fill required fields!");
            }
            // }
            
            
        },
        prevTab() {
          this.tabIndex = this.tabIndex - 1
        },
        fullScreen() {
          /* Get the element you want displayed in fullscreen mode (a video in this example): */
          var elem = document.getElementById("dataset-view");
          console.log(elem);

          /* When the openFullscreen() function is executed, open the video in fullscreen.
            Note that we must include prefixes for different browsers, as they don't support the requestFullscreen method yet */
          if (elem.requestFullscreen) {
            elem.requestFullscreen();
          } else if (elem.mozRequestFullScreen) { /* Firefox */
            elem.mozRequestFullScreen();
          } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari and Opera */
            elem.webkitRequestFullscreen();
          } else if (elem.msRequestFullscreen) { /* IE/Edge */
            elem.msRequestFullscreen();
          }
        },
        GetChartJs(load){
            //this.form.options = load;
            /*console.log("Start");
            console.time("Promise");
            new Promise(done => setTimeout(() => done(), 5000));
            console.log("End");
            console.timeEnd("Promise");*/
            //this.getFile([this.form.file_id]);
            null;
        },
        ChangeTab(load){
            //this.form.options = load;
            this.tabIndex = 1;
            // call for data tree filling
            this.get_json_dim_data([this.form.file_id]);
            this.get_json_aggr_data([this.form.file_id]);
            this.get_json_years_data([this.form.file_id]);

        },
        enforcegetFdim(fdimload){
            console.log('call recieved ');
            console.log(fdimload);
            this.form.options.fdimload = fdimload;
            console.log(this.form.options.fdimload);
        },
        getLabelsGeos: function (data) {
            this.labels_geos = data;
            //console.log(data);
        },
        getRecords() {
            // loadProgressBar();
            console.log("start")

            // app.nprogress.start()
            //console.log('getRecords starts in repsonse to a call from datasets.grid');
            axios.get('/api/v1/datasets')
                .then(response => {
                    this.all_recs = response.data.records;
                    this.records = this.all_recs.slice((this.page-1) * 18, (this.page) * 18);
                    //console.log(this.records);
                    this.rec_size = this.all_recs.length;
                    console.log("end")
                });
        },

        addTag (newTag) {
            const tag = {
                name: newTag,
                code: newTag.substring(0, 2) + Math.floor((Math.random() * 10000))
            }
            this.taglist.push(tag)
            this.form.tags.push(tag)
        },

        loadurl(){
            if (this.form.options.tableau_url) {
                this.tabvizlist = [this.form.options.tableau_url];
                this.createViz(1);
            }
        },

        createViz(vizPlusMinus) {

            var vizList = this.tabvizlist;

            var viz,

                vizLen = vizList.length,

                vizCount = 0;

            var vizDiv = document.getElementById("vizContainer"),
                options = {
                    hideTabs: true
                };

            vizCount = vizCount + vizPlusMinus;

            if (vizCount >= vizLen) {
                // Keep the vizCount in the bounds of the array index.
                vizCount = 0;
            } else if (vizCount < 0) {
                vizCount = vizLen - 1;
            }

            if (viz) { // If a viz object exists, delete it.
                viz.dispose();
            }

            var vizURL = vizList[vizCount];
            viz = new tableau.Viz(vizDiv, vizURL, options);
        },

        getPeriods() {
            axios.get('/api/v1/periods')
                .then(response => {
                    this.periods = response.data.records;
                });
        },

        getTopics() {
            axios.get('/api/v1/topics')
                .then(response => {
                    this.topics = response.data.records;
                });
        },
        getFileTopicId() {
            axios.get('/api/v1/files/bytopic/'+this.form.topicid.id)
                .then(response => {
                    this.files = Object.keys(response.data).map(name => ({ 'name':name +' ID:'+response.data[name], id: response.data[name]}));
                });
        },
        getGovernorates() {
            axios.get('/api/v1/governorates')
                .then(response => {
                    this.governorates = response.data.records;
                });
        },
        setNewFormDefaults() {
            // Governorates
            axios.get('/api/v1/def_governorates/'+this.app_local)
                .then(response => {
                    this.form.governorates = response.data.records;
                });
            //  selected language
            this.form.language = this.app_local
        },
        getIndicators() {
            axios.get('/api/v1/indicators')
                .then(response => {
                    this.indicators = response.data.records;
                });
        },
        getRelated_datasets() {
            axios.get('/api/v1/get_related_datasets')
                .then(response => {
                    this.all_related_datasets = response.data.records;
                    this.related_datasets = response.data.records;
                });
        },
        titleWithLang ({ title, language }) {
            return `${title} — [${(language == 'en')?'English':'العربية'}]`
        },
        FilterRelated_datasets(id) {
            var me = this;
            console.log(' dthis ' + this.form.language);
            var found = this.all_related_datasets.filter(function(element) {
                console.log(' d ' + me.form.language);
                console.log(' did ' + id);
                return element.id !== id;
            });
            this.related_datasets = found;
            console.log('found :');
            console.log(found);
            //this.related_datasets = found ? found : this.related_datasets;
        },
        getFiles(){
            axios.get('/api/v1/files')
                .then(response => {
                    this.files = Object.keys(response.data).map(name => ({ 'name':name +' ID:'+response.data[name], id: response.data[name]}));
                });
        },

        getFile(record_file_id, created_flag) {
            created_flag = created_flag || 0;
            this.setFileId(record_file_id[0].id);
            let vfdim = {};
            let vfaggvalue = null;
            let vbasevalue = null;
            let vuserlang = this.app_local;
            if(this.form.options){
                if (this.form.options.X != null){
                    vfdim = {
                        X:this.form.options.X,
                        Y:this.form.options.X,
                        Z:this.form.options.X
                    };
                }else{
                    this.get_json_dim_data(record_file_id);
                    this.get_json_aggr_data(record_file_id);
                    this.get_json_years_data(record_file_id);
                    // this.tabIndex = 1;
                    // instead showing alert, color input in red and show message
                    $(".dataset-wizard #xaxis").css({"border-bottom-color": "red", "background": "rgba(255, 0, 0,0.1)" });
                    return;
                }
            }
            if(this.form.options.faggvalue) {
                vfaggvalue = this.form.options.faggvalue;
            }
            if(this.form.options.fbasevalue) {
                vbasevalue = this.form.options.fbasevalue;
            }
            if(this.user) {
                vuserlang = this.user.language;
            }
            if (this.form.library !== 'chartjs'){
                this.get_json_dim_data(record_file_id);
                this.get_json_aggr_data(record_file_id);
                this.get_json_years_data(record_file_id);
                return;
            }
            axios.post('/api/v1/files/chartjs2',{file_id:record_file_id[0].id,
                fdim:vfdim,
                fbase:vbasevalue,
                fagg:vfaggvalue,
                charttype:this.form.options.type,
                language:this.form.language,
                lang:vuserlang
            }).then(response => {
                if (response.data.msg.msg_code == 2){
                    // go to library tab
                    // this.tabIndex = 1;
                    // instead showing alert, color input in red and show message
                    $(".dataset-wizard #xaxis").css({"border-bottom-color": "red", "background": "rgba(255, 0, 0,0.1)" });
                    alert(response.data.msg.msg_text); // when you select a file
                    // merge library and options tabs in one tab
                    return;
                }
                if (response.data) {
                    this.file = response.data.results;
                    this.chartjsdata = response.data.dataset;
                    this.chartjslabel = response.data.out_labels;

                    this.chartoption  = this.form.options;

                    this.updatePointStyle();

                    this.chartobject = {
                        title: this.title,
                        labels: this.chartjslabel,
                        datasets: this.chartjsdata,
                    };
                }
            });

            if (created_flag == 0){
                this.get_json_dim_data(record_file_id);
                this.get_json_aggr_data(record_file_id);
                this.get_json_years_data(record_file_id);
            }

        },

        updatePointStyle() {
            this.chartupdatedata = [];
            this.chartupdatedata.spanGaps    = this.form.options.spanGaps;
            this.chartupdatedata.fill        = this.form.options.fill;
            this.chartupdatedata.pointStyle  = this.form.options.pointStyle;
            this.chartupdatedata.pointRadius = this.form.options.pointRadius;
            this.chartupdatedata.tension     = this.form.options.tension;
            this.chartupdatedata.XColumn     = this.form.options.XColumn;
        },
        getUrlSource(){
            var url = window.parent.location.href;
            var source = url.split(/\/+/g)[2];
            return source;
        },
        getUrlBase(){
            var url = window.parent.location.href;
            var source = url.split(/\/+/g)[0] + '//' + url.split(/\/+/g)[1];
            return source;
        },
        bulletGraphs(text){
            var source = text.split(/\/+/g);
            return source;
        },
        getRecord(record,flag) {
            var flag = flag || 0;
            var filelng = '0Ini';
            console.log('------getUrlSource id----');
            console.log(this.getUrlSource());
            console.log('---- end getUrlSource record ------');
            this.trash = false;
            //get primary data
            axios.get('/api/v1/datasets/'+record)
                .then(response => {
                    // var dId = response.data.record.id;
                    // var dTitle = response.data.record.title;
                    // this.selectedDatasets.push([dId, dTitle]);
                    // console.log(this.selectedDatasets);
                    history.pushState(null, null, '#/dataset/' + response.data.record.id);
                    this.form.id           = response.data.record.id;
                    this.form.title        = response.data.record.title;
                    this.form.description  = (this.getUrlSource().replace('#','') == 'library' && response.data.record.description)? '<ul>' + response.data.record.description.split(/(\;)/g).filter(sent => sent.length > 2).map(res => '<li>' + res + '</li>').join('') + '</ul>' : response.data.record.description;
                    this.form.options      = response.data.options;
                    this.form.library      = response.data.record.library;
                    if (parseInt(response.data.record.files.length, 10) >= 1) {
                        this.form.file_id = { id: response.data.record.files[0].id, name: response.data.record.files[0].title +" ID:"+response.data.record.files[0].id };
                        //this.getFile([this.form.file_id],0);
                        this.get_json_dim_data([this.form.file_id]);
                        this.get_json_aggr_data([this.form.file_id]);
                        this.get_json_years_data([this.form.file_id]);
                        this.setFileId(this.form.file_id.id);
                        //this.get_json_dim_data([this.form.file_id]);
                        //this.get_json_aggr_data([this.form.file_id]);
                        //console.log(this.form.options);
                    } else {
                        this.form.file_id = [];
                        this.setFileId("");
                    }
                    console.log("end")
                });
            // get additional data
            axios.get('/api/v1/datasets/'+record)
                .then(response => {
                    this.form.preview      = response.data.record.preview;
                    this.form.public       = response.data.record.public;
                    this.form.featured     = response.data.record.featured;
                    this.form.language     = response.data.record.language;
                    this.form.periods      = response.data.record.periods;
                    this.form.topics       = response.data.record.topics;
                    this.form.governorates = response.data.record.governorates;
                    this.form.indicators   = response.data.record.indicators;
                    this.form.tags         = response.data.record.tags;
                    this.form.topicid         = response.data.record.topicid;
                    this.form.favorites    = response.data.record.favorites;
                    this.updated           = response.data.record.updated_at;
                    this.created           = response.data.record.created_at;
                    this.created_by        = response.data.record.user.name;
                    // get related filtered
                    this.FilterRelated_datasets(record);
                    var data_rid =  response.data.record.related_id;
                    var found = this.all_related_datasets.filter(function(element) {
                        return element.id === data_rid;
                    });
                    this.form.related_id = found;
                    if (flag == 1) {
                    this.setNewFormDefaults();
                    }
                });

            // get additional data
            axios.get('/api/v1/datasets/'+record)
                .then(response => {
                    this.form.options.fdimload = response.data.options.fdimload || [];
                    this.form.options.type = response.data.options.type || '';
                });

            if (this.form.options == null || this.form.options == false) {
                this.form.options = {};
            }

            console.log('------Print spark form ----');
            console.log(this.form);
            console.log('---- end Print spark form ------');
        },

        getFileId(value){
            this.getFile([this.form.file_id],0);
            this.form.options.XColumn = [];
            this.form.options.fbasevalue = [];
            this.form.options.faggvalue = [];
            this.form.options.years_field = [];
            this.form.options.X = null;
            this.form.options.Y = null;
            this.form.options.Z = null;
        },

        setFileId(value){
            this.showfileid = value;
        },

        saveRecord(){
          var valid = true;
          // if type == iframe
          if ( this.form.library != "iframe" ) {
            if (this.form.file_id.length == 0) {
              // topics should be selected
              valid = false;
              this.tabIndex = 0;
              document.getElementById("file-select").style.background = "#fee2e1";
            }
          } 
 
          if( valid ) {
            Spark.post('/api/v1/dataset/save', this.form)
               .then(response => {
                   this.getRecords();
               });
            this.updatePreviewImage();
          }
        },

        updatePreviewImage(){
            var formData = new FormData();
            formData.append('file', this.file);
            formData.append('dataset_id', this.form.id);
            axios.post('/api/v1/dataset/updatePreviewImage',
                formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
            ).then(response => {
            }).catch(function(){console.log('Upload Failed!');});
        },

        createRecord(){
            Spark.post('/api/v1/dataset/save', this.createForm)
                .then(response => {
                    this.createForm.title = '';
                    this.form.id = response.id;
                    //console.log(this.form.id);
                    this.getRecord(response.id,1);
                    //this.setNewFormDefaults();
                    //console.log('test');
                });
            //alert('abed333');
            this.$forceUpdate();
            //var element = document.getElementById("new_dataset_form").submit();
            //console.log(this.form.id);
        },

        deleteRecord(id) {
          // if(this.filters.sort_option == "") {
          //   console.log(this.filters.sort_option);
          // }
            axios.delete('api/v1/datasets/' + id)
                .then((res) => {
                    this.get_searched_datasets();
                    /*if(this.filters.sort_option != "") {
                      this.get_searched_datasets();
                    } else {
                      this.getRecords(); 
                    }*/
                    this.allRecords();
                    this.trash = true;
                })
        },

        allRecords() {
            this.form.id = null;
            this.form.successful = false;
            this.createForm.successful = false;
            this.chartobject = null;
            history.pushState(null, null, "#/");
            this.get_searched_datasets();
        },

        clickCallback (page){
            this.records = this.all_recs.slice((page-1) * 18, (page) * 18);
            //console.log(this.records);
        },
        get_sorted_datasets() {
          console.log("sort")
            //console.log('getRecords starts in repsonse to a call from datasets.grid');
            axios.get('/api/v1/datasets/get_sorted_datasets/'+ this.filters.sort_option+'/'+this.filters.sort_option_type)
                .then(response => {
                    this.all_recs = response.data.records;
                    this.records = this.all_recs.slice((this.page-1) * 18, (this.page) * 18);
                    //console.log(this.records);
                    this.rec_size = this.all_recs.length;
                });
        },
        get_searched_datasets() {
            //console.log('getRecords starts in repsonse to a call from datasets.grid');
            axios.post('/api/v1/datasets/get_searched_datasets',
                {
                    search_text: this.filters.search_text,
                    sort_option: this.filters.sort_option,
                    sort_option_type: this.filters.sort_option_type,
                    sort_option_lang: this.filters.sort_option_lang
                })
                .then(response => {
                    this.all_recs = response.data.records;
                    if (this.all_recs.slice((this.page-1) * 18, (this.page) * 18).length == 0){
                        this.records = this.all_recs.slice((1-1) * 18, (1) * 18);
                    }else{
                        this.records = this.all_recs.slice((this.page-1) * 18, (this.page) * 18);
                    }
                    //console.log(this.records);
                    this.rec_size = this.all_recs.length;
                });
        },
        addToFavourites(){
            axios.get('/api/v1/favorite_api/'+this.form.id+'/'+this.user.id)
                .then(response => {
                    this.call_response = response.data.response;
                    var el = document.getElementById('myheart');
                    if(this.call_response.msg_code){
                        el.classList.add('fa');
                        el.classList.add('text-danger');
                        el.classList.remove('far');
                        // alert(this.call_response.msg_text);
                    }else{
                        el.classList.add('far');
                        el.classList.remove('fa');
                        el.classList.remove('text-danger');
                        // alert(this.call_response.msg_text);
                    }

                });
            //this.$forceUpdate();
        },
        get_json_aggr_data(record_file_id) {
            axios.get('/api/v1/files/get_json_aggr_data/' + record_file_id[0].id) //this.file.id
                .then(response => {
                    if (response.data) {
                        this.form.faggload = {
                            valueConsistsOf: 'LEAF_PRIORITY',
                            sortValueBy:'INDEX',
                            clearOnSelect: true,
                            options:response.data.options,
                            value:[]
                        };
                        this.form.fbaseload = {
                            valueConsistsOf: 'LEAF_PRIORITY',
                            sortValueBy:'INDEX',
                            clearOnSelect: true,
                            options:response.data.options_nochildren,
                            value:[]
                            //  this.form.fbaseload = fbaseload;
                        };
                    }
                });
        },
        get_json_dim_data(record_file_id) {
            axios.get('/api/v1/files/get_json_dim_data/' + record_file_id[0].id)
                .then(response => {
                    if (response.data) {
                        this.form.fdimload = response.data.options
                    }
                });
        },
        get_json_years_data(record_file_id) {
            axios.get('/api/v1/files/get_json_years_data/' + record_file_id[0].id)
                .then(response => {
                    if (response.data) {
                        this.form.years_field = response.data.options
                    }
                });
        }
        //// end of methods
    }});