require('./bootstrap');

import Vue from "vue";
import store from './vuex/store'
import vuetify from 'vuetify'
import "vuetify/dist/vuetify.min.css";

Vue.component('notifications', require('./components/notifications/Notifications.vue').default)
Vue.component('notification', require('./components/notifications/Notification.vue').default)

Vue.use(vuetify)

const app = new Vue({
    el: '#app',
    store
})
