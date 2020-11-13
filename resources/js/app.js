require('./bootstrap');

window.Vue = require('vue');

import moment from 'moment';

Vue.filter('formatDate', function(value) {
    if (value) {
        return moment(String(value)).format('MM.DD.YYYY HH:MM')
    }
});

Vue.component('chat-app', require('./components/ChatApp.vue').default)
Vue.component('sidebar', require('./components/Sidebar.vue').default)

const app = new Vue({
    el: '#app',
});
