import Vue from "vue"
import Vuex from 'vuex'
import notifications from "./modules/notifications";
import messageNotifications from "./modules/message-notifications"
import chat from "./modules/chat"

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        notifications,
        messageNotifications,
        chat
    }
})
