/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');
import axios from 'axios';
import store from './store';
import vueCustomScrollbar from 'vue-custom-scrollbar';
import 'vue-custom-scrollbar/dist/vueScrollbar.css';
window.Vue = require('vue');
import App from './App.vue';
Vue.prototype.$http = axios;
axios.defaults.baseURL = '/api/v1/';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('vue-custom-scrollbar', vueCustomScrollbar);

new Vue({
    el: '#app',
    store,
    render: (h) => h(App)
});
