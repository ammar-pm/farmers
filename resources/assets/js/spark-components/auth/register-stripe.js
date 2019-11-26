var base = require('auth/register-stripe');

Vue.component('spark-register-stripe', {
    mixins: [base],
    data() {
        return {
            HalHal: true
        }},
    mounted() {
        this.exportt();
    },
    methods: {
        exportt() {
            this.selectedPlan = {"id":"free","name":"Free","price":0,"trialDays":0,"interval":"monthly","features":[],"active":true,"attributes":[],"type":"team"};
            this.registerForm.plan='free'
            console.log('component loaded');
        },
    }
});
