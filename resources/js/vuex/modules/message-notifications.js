export default {
    state: {
        items: []
    },

    mutations: {
        LOAD_MESSAGE_NOTIFICATIONS(state, messages) {
            state.items = messages
        },

        MARK_AS_MESSAGE_RED(state, id) {
            let index = state.items.filter(notification => notification.id === id)
            state.items.splice(index, 1)
        },

        MARK_ALL_MESSAGE_AS_RED(state) {
            state.items = []
        },

        ADD_MESSAGE_NOTIFICATION(state, notification) {
            state.items.unshift(notification)
        }
    },

    getters: {
        allMessageNotifications (state) {
            return state.items
        },
     },

    actions: {
        loadMessageNotifications(context) {
            axios.get('/message-notifications')
                .then(response => {
                    context.commit('LOAD_MESSAGE_NOTIFICATIONS', response.data.data)
                })
        },

        markAsRead(context, params) {
             axios.put('/messages-read', params)
                .then(() => context.commit('MARK_AS_MESSAGE_RED', params.id))
        },

        markAllAsRead(context, params) {
            axios.put('/messages-all-read', params)
                .then(() => context.commit('MARK_ALL_MESSAGE_AS_RED'))
        }
    }


}
