var base = require('navbar/navbar');

Vue.component('spark-navbar', {
    mixins: [base],
    data: function () {
        return {
            activeItemId: '',
            menus_name:["datasets","files","posts","widgets","menus","periods","governorates","indicators","users","settings"]
        }
    },
    mounted() {
        this.styleMenu();
    },
    methods: {
        styleMenu(){
            var currentUrl = window.location.pathname;
            for (var i = 0; i < this.menus_name.length; i++) {
                //console.log(currentUrl.indexOf(this.menus_name[i]));
                if(currentUrl.indexOf(this.menus_name[i]) !== -1 ){
                    var el = document.getElementById(this.menus_name[i]);
                    el.style.fontWeight = 'bold';
                    el.classList.add('clicked_abed');
                    break;
                }
            }
        },
        setActive(mname){
            this.clicked_abed =!this.clicked_abed;
            var sess_activeItemId = this.$session.get('activeItemId');
            if (mname !== ''){
                this.$session.set('activeItemId',mname);
            }
            this.activeItemId = this.$session.get('activeItemId');
        }
    }
});
