export default {
    state: {
        items: []
    },

    mutations: {
        LOAD_MESSAGES(state, messages) {
            state.items = messages
        },

        ADD_MESSAGE(state, message) {
            console.log(message)
            state.items.push(message)
        }
    },

    getters: {
        allMessages (state) {
            return state.items
        }
    },

    actions: {
        loadMessages(context) {
            axios.get('/fetchMessages')
                .then(response => {
                    context.commit('LOAD_MESSAGES', response.data)
                })
        },

        addMessage(context, params) {
            axios.post('/sendMessage', params)
                .then(response => {
                    context.commit('ADD_MESSAGE', response.data)
                })
        }
    }

}
