require('./bootstrap');
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
window.Vue = require('vue');
import router from './router';
Vue.use(BootstrapVue);
Vue.use(IconsPlugin);
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import ViewUI from 'view-design';
import 'view-design/dist/styles/iview.css';
Vue.use(ViewUI);
import common from './common';
Vue.mixin(common);
import App from './components/mainapp.vue';
import InstantSearch from 'vue-instantsearch';
Vue.use(InstantSearch);

Vue.component('mainapp', require('./components/mainapp').default);

const app = new Vue({
    el: '#app',
    router,
    render: h => h(App),
});
