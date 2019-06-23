//import { Popper } from 'popper.js'
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import 'jquery-ui/ui/widgets/autocomplete.js';
import 'jquery-ui/ui/core.js';
import 'jquery-ui/ui/widget.js';
import 'jquery-ui/ui/widgets/mouse.js';
import 'jquery-ui/ui/widgets/draggable.js';

import 'bootstrap-colorpicker/dist/js/bootstrap-colorpicker.js';

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('neworder-component', require('./components/NewOrderComponent.vue').default);
Vue.component('newmessage-component', require('./components/NewMessageComponent.vue').default);

const app = new Vue({
    el: '#app'
});
