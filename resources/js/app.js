

require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import {Form} from 'vform';
import {HasError, AlertError} from 'vform/src/components/bootstrap5';

window.Form = Form;

Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);



import {routes} from './routes/routes';
  
  const router = new VueRouter({
    routes,
    mode: 'history', 

  });

  /* sweetalert2.................. */

  import Swal from 'sweetalert2';
  window.Swal = Swal;

  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  });
 window.Toast = Toast;


/*toastr-------------*/

import toastr from 'toastr';
window.toastr = toastr;

/*vuex------------------*/
import Vuex from 'vuex'
Vue.use(Vuex)

import storeData from './store/store'

const store = new Vuex.Store(
  storeData,
)



Vue.component('example-component', require('./components/ExampleComponent.vue').default);



const app = new Vue({
    el: '#app',
    router,
    store
});
