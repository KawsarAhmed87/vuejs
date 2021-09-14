/*momentjs-------------*/


import moment from 'moment';
import Vue from "vue";
Vue.filter('time', (a) => {
  return moment(a).format('Do MMM YYYY, h:mm:ss a');
});
