import store from './vuex/store'

const typesNotifications = {
    event: 'App\\Notifications\\UserLinkedEvent'
}

if (window.Laravel.user) {
/*    window.Echo.channel('softproadv_database_notification-created')
        .listen('NotificationCreated', (notification) => {
            console.log(notification)
                if (window.Laravel.user == notification.user_id) {
                    store.commit('ADD_NOTIFICATION', notification)
                }
        })*/


    window.Echo.channel('softproadv_database_notification-created')
        .notification((notification) => {
            if (window.Laravel.user == notification.user_id) {
                store.commit('ADD_NOTIFICATION', notification)
            }
        })
}


