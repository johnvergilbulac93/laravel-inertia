/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import {HasError, AlertError } from 'vform';
import swal from 'sweetalert2';
import moment from 'moment';



window.swal = swal
const toast = swal.mixin({
    toast: true,
    position: 'top',
    showConfirmButton: false,
    timer: 3000
});
window.toast = toast

Vue.prototype.$route = route

Vue.filter('textformat', function(data){
  return data.charAt(0).toUpperCase() + data.slice(1)
});
Vue.filter('dateformat', function(created){
  return moment(created).format('LL'); 
});

import { App, plugin } from '@inertiajs/inertia-vue'
import Vue from 'vue'

Vue.use(plugin)

const el = document.getElementById('app')

if (el){
  new Vue({
    render: h => h(App, {
      props: {
        initialPage: JSON.parse(el.dataset.page),
        resolveComponent: name => require(`./Pages/${name}`).default,
      },
    }),
  }).$mount(el)
}


Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

// window.Vue = require('vue').default;
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('Layout', require('./Pages/Layout/Menu.vue').default);

// Vue.config.devtools = false
// Vue.config.debug = false
// Vue.config.silent = true

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#app',
// });
