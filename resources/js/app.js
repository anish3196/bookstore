require('./bootstrap');
import { createApp } from 'vue';
import mainapp from './components/mainapp.vue';
import router from './router';
import 'view-ui-plus/dist/styles/viewuiplus.css'
import ViewUIPlus from 'view-ui-plus'
import common from './common';
import store from './store';





createApp(mainapp).mixin(common).use(store).use(ViewUIPlus).use(router).mount("#app");
// window.Vue = require('vue');

// Vue.component('mainapp',require('./components/mainapp.vue').default)

// const app = new Vue({
//     el:'#app'
// })