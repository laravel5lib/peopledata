
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('spinner', require('./components/Utils/Spinner.vue'));
Vue.component('member-show', require('./components/Members/MemberShow.vue'));
Vue.component('member-edit', require('./components/Members/MemberEdit.vue'));

import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import locale from 'element-ui/lib/locale/lang/en'
Vue.use(ElementUI, { locale })
import Vue2TouchEvents from 'vue2-touch-events'
Vue.use(Vue2TouchEvents)

const app = new Vue({
    el: '#app'
});

window.vm = app;