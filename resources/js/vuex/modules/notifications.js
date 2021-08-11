export default {
    state: {
        items: []
    },

    mutations: {
        LOAD_NOTIFICATIONS(state, notifications) {
            state.items = notifications
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
                    console.log(response)
                    context.commit('LOAD_NOTIFICATIONS', response.data.notifications)
                })
        }
    }


}
