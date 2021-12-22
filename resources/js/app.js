require('./bootstrap');
import Vue from 'vue/dist/vue'
window.Vue = Vue
import store from './store/index';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
Vue.use(ElementUI);
Vue.component('create-post', require('./components/post/Create.vue').default);
Vue.component('all-posts', require('./components/post/List.vue').default);
const app = new Vue({
    store,
    el: '#app',
});
