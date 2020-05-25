
require('./bootstrap');

window.Vue = require('vue');


Vue.component('home', require('./components/Home.vue').default);
Vue.component('user', require('./components/test/User.vue').default);



const app = new Vue({
    el: '#app',
});
