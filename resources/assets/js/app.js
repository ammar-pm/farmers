require('spark-bootstrap');
require('./spark-components/bootstrap');
require('./components/bootstrap');

//import '@babel/polyfill';


import InstantSearch from 'vue-instantsearch';
Vue.use(InstantSearch);

import Notify from 'vue2-notify';
Vue.use(Notify, {visibility: 3000, position:'top-right', permanent: false});

import VueSession from 'vue-session';
Vue.use(VueSession,{persist:true});

import Pagination from 'vue-pagination-2';
Vue.component('pagination', Pagination);

import Datatable from 'vue2-datatable-component';
Vue.use(Datatable);

import BootstrapVue from 'bootstrap-vue';
Vue.use(BootstrapVue);

Vue.use(require('vue-moment'));

import Treeselect  from '@riophae/vue-treeselect';
import '@riophae/vue-treeselect/dist/vue-treeselect.css';
Vue.component('agg-tree-select', Treeselect);

import vSelect from 'vue-select'
Vue.component('v-select', vSelect)

import Vuetify from 'vuetify'
Vue.use(Vuetify)

import { loadProgressBar } from 'axios-progress-bar'
loadProgressBar()


import Multiselect from 'vue-multiselect';
Vue.component('multiselect', Multiselect);
import 'vue-multiselect/dist/vue-multiselect.min.css'

Vue.component('high-chart', require('./components/Highchart.vue'));
Vue.component('my-tree-select', require('./components/Treeselect.vue'));
Vue.component('gov-map', require('./components/Map.vue'));
Vue.component('plotly-map-chart', require('./components/Plotly.vue'));
Vue.component('data-table-adv', require('./components/data-table.vue'));

require('./views');

//test
Vue.component('test', require('./components/Test.vue'));

import countTo from 'vue-count-to';

Vue.component('countto', countTo);

//script2

import VS2 from 'vue-script2';

Vue.use(VS2);

Vue.directive('init', {
    bind: function(el, binding, vnode) {
        vnode.context[binding.arg] = binding.value;
    }
});

Vue.config.errorHandler = function (err, vm, info)  {
    console.log('[Global Error Handler]: Error in ' + info + ': ' + err);
};


Vue.prototype.Lang = window.Lang;

var app = new Vue({
  mixins: [require('spark')],
  created() {
      this.$session.start();
  }
});
