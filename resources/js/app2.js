

window.Vue = require('vue');

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import {routes} from './routes/routes';
  
  const router = new VueRouter({
    routes,
  // mode: 'history', 

  });



/*vuex------------------*/
import Vuex from 'vuex';
Vue.use(Vuex);
import storeData from './store/store';

const store = new Vuex.Store(
  storeData,
)

import {filter} from './filter/filter';

Vue.component('front-master', require('./components/frontend/LayoutMaster.vue').default);


import './helpers/mixin';




const app = new Vue({
    el: '#app',
    router,
    store,
});
