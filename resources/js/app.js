require('./bootstrap');

window.Vue = require('vue');

Vue.component('chat-app', require('./components/ChatApp.vue').default)
Vue.component('sidebar', require('./components/Sidebar.vue').default)

const app = new Vue({
    el: '#app',
});
