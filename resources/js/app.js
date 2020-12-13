
require('./bootstrap');

window.Vue = require('vue');


Vue.component('home', require('./components/Home.vue').default);
Vue.component('user', require('./components/test/User.vue').default);

import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
Vue.use(ElementUI);
// * Import các component (App, home)

// import Header from './layouts/Header'
import App from './App.vue'
import Home from './components/views/Home.vue'
import Upload from './components/views/Upload.vue'
import Subscription from './components/views/Subscription.vue'
import Login from './components/auth/Login.vue'
import Register from './components/auth/Register.vue'
import TestUpload from './components/views/TestUpload.vue'
import axios from 'axios';

// import VueAuth from '@websanova/vue-auth'
// import VueAxios from 'vue-axios';

const router = new VueRouter({
    mode: 'history',
    routes: [

        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
        },
        {
            path: '/register',
            name: 'register',
            component: Register,
        },
        {
            path: '/upload',
            name: 'upload',
            component: Upload,
        },
        {
            path: '/subscription',
            name: 'subscription',
            component: Subscription,

        }, {
            path: '/t-upload',
            name: 'test-upload',
            component: TestUpload,
        },
    ],
});


const app = new Vue({
    el: '#app',
    components: { App },
    router,

}).$mount('#app');