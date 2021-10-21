import store from './vuex/store'

import typesNotifications from "./vuex/typeNotifications";

if (window.Laravel.user) {
    window.Echo.private(`notification-created.${window.Laravel.user}`)
        .notification((notification) => {
            if (window.Laravel.user == notification.user_id) {
                if (notification.type !== typesNotifications.message) {
                    store.commit('ADD_NOTIFICATION', notification)
                }

                if (notification.type == typesNotifications.message) {
                    if (!store.state.chat.online) {
                        store.commit('ADD_MESSAGE_NOTIFICATION', notification)
                    }

                    store.commit('ADD_MESSAGE', notification.data)
                }
            }
        })
}

window.Echo.private(`progresses.${window.Laravel.company}`)
    .listen('CreateProgressIntegration', function (progress) {
        store.commit('ADD_PROGRESS', progress.progress)
    })

window.Echo.private(`processes.${window.Laravel.company}`)
    .listen('CreateProcessIntegration', function (process) {
        store.commit('ADD_PROCESS', process.process)
    })




