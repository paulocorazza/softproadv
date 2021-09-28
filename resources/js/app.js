require('./bootstrap');

import Vue from "vue";
import store from './vuex/store'
import Vuetify from 'vuetify';
import "vuetify/dist/vuetify.min.css";



import Vodal from 'vodal';

Vue.component('notifications', require('./components/notifications/Notifications.vue').default)
Vue.component('notification', require('./components/notifications/Notification.vue').default)
Vue.component('notifications-chat', require('./components/chat/NotificationsChat.vue').default)
Vue.component('chat', require('./components/chat/Chat.vue').default)
Vue.component('chatMessage', require('./components/chat/ChatMessage.vue').default)
Vue.component('chatSend', require('./components/chat/ChatSend.vue').default)
Vue.component('chatContacts', require('./components/chat/ChatContacts.vue').default)
Vue.component('chatUsersSelected', require('./components/chat/ChatUsersSelected.vue').default)
Vue.component('progressPending', require('./components/progresses-pending/ProgressesPending.vue').default)
Vue.component('progressForm', require('./components/progresses-pending/ProgressForm.vue').default)
Vue.component('processPending', require('./components/processes-pending/ProcessesPending.vue').default)
Vue.component('processForm', require('./components/processes-pending/ProcessForm.vue').default)
Vue.component('processList', require('./components/processes-pending/ProcessList.vue').default)

Vue.component(Vodal.name, Vodal);

Vue.use(Vuetify, {
    iconfont: 'fa'
})

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify(),
    store
})



