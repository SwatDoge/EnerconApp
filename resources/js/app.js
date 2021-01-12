require('./bootstrap');

window.Vue = require('vue');

//form
Vue.component('form-steps', require('./components/form/StepsListComponent.vue').default);
Vue.component('form-general', require('./components/form/GeneralComponent.vue').default);
Vue.component('form-internal', require('./components/form/InternalComponent.vue').default);
Vue.component('form-remarks', require('./components/form/RemarksComponent.vue').default);

//inputs
Vue.component('input-dropdown', require('./components/input/SelectInputComponent.vue').default);
Vue.component('input-dropdownv2', require('./components/input/_SelectInputComponent.vue').default);

Vue.component('switchletter', require('./components/Form.blade.vue').default);

const app = new Vue({
    el: '#app'
});