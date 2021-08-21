export default {
    state: {
        items: []
    },

    mutations: {
        LOAD_NOTIFICATIONS(state, notifications) {
            state.items = notifications
        },

        MARK_AS_RED(state, id) {
            let index = state.items.filter(notification => notification.id === id)
            state.items.splice(index, 1)
        },

        MARK_ALL_AS_RED(state) {
            state.items = []
        },

        ADD_NOTIFICATION(state, notification) {
            state.items.unshift(notification)
        }
    },

    getters: {
        allNotifications (state) {
            return state.items
        }
    },

    actions: {
        loadNotifications(context) {
            axios.get('/notifications')
                .then(response => {
                    context.commit('LOAD_NOTIFICATIONS', response.data.notifications)
                })
        },

        markAsRead(context, params) {
             axios.put('/notifications-read', params)
                .then(() => context.commit('MARK_AS_RED', params.id))
        },

        markAllAsRead(context, params) {
            axios.put('/notifications-all-read', params)
                .then(() => context.commit('MARK_ALL_AS_RED'))
        }
    }


}
