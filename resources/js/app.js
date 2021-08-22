require('./bootstrap');

import Vue from "vue";
import store from './vuex/store'
import vuetify from 'vuetify'
import "vuetify/dist/vuetify.min.css";

Vue.component('notifications', require('./components/notifications/Notifications.vue').default)
Vue.component('notification', require('./components/notifications/Notification.vue').default)
Vue.component('notifications-chat', require('./components/chat/NotificationsChat.vue').default)
Vue.component('chat', require('./components/chat/Chat.vue').default)
Vue.component('chatMessage', require('./components/chat/ChatMessage.vue').default)
Vue.component('chatSend', require('./components/chat/ChatSend.vue').default)

Vue.use(vuetify)

const app = new Vue({
    el: '#app',
    store
})
