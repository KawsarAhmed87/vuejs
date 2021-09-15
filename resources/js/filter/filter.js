/*momentjs-------------*/


import moment from 'moment';
import Vue from "vue";
Vue.filter('time', (a) => {
  return moment(a).format('Do MMM YYYY, h:mm:ss a');
});

Vue.filter('sortName', (name, length) => {
  return name.substring(0, length);
});

Vue.filter('firtUpper', (text='') => {
  return text.charAt(0).toUpperCase() + text.slice(1);
});



