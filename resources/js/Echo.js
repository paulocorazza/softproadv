import store from './vuex/store'

const typesNotifications = {
    event: 'App\\Notifications\\UserLinkedEvent'
}


if (window.Laravel.user) {
    window.Echo.private(`notification-created.${window.Laravel.user}`)
        .notification((notification) => {
            if (window.Laravel.user == notification.user_id) {
                store.commit('ADD_NOTIFICATION', notification)
            }
        })
}




