import Vue from "vue"
import Vuex from 'vuex'
import notifications from "./modules/notifications";
import messageNotifications from "./modules/message-notifications"
import chat from "./modules/chat"
import progresses from "./modules/progresses-pending"
import processes from "./modules/processes-pending"
import people from "./modules/people"
import advogados from  "./modules/advogados"

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        notifications,
        messageNotifications,
        chat,
        progresses,
        processes,
        people,
        advogados
    }
})
