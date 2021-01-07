/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

Vue.component('form-steps', require('./components/form/StepsListComponent.vue').default);
Vue.component('form-general', require('./components/form/GeneralComponent.vue').default);
Vue.component('form-internal', require('./components/form/InternalComponent.vue').default);
Vue.component('form-remarks', require('./components/form/RemarksComponent.vue').default);

Vue.component('switchletter', require('./components/Form.vue').default);

const app = new Vue({
    el: '#app'
});