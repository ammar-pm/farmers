Vue.component('alert', {
	props: ['message', 'isError'],
	template: '<span></span>',
	data() {
        return {
        	
        }
    },

    mounted() {
        if (this.isError) {
            this.$notify.error(this.isError);
        }
        if (this.message) {
            this.$notify.success(this.message);   
        }
    }
})	