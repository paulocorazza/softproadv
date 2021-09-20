export default {
    state: {
        items: [],
    },

    mutations: {
        LOAD_PROGRESSES(state, progresses) {
            state.items = progresses
        },
    },

    getters: {
        allProgress (state) {
            return state.items
        }
    },

    actions: {
        loadProgresses(context) {
            axios.get('/monitor/progresses')
                .then(response => {
                    context.commit('LOAD_PROGRESSES', response.data)
                })
        },

        published(context, params) {
            axios.post('/monitor/published', params)
        },

        archived(context, params) {
            axios.post('/monitor/archived', params)
        }
    }

}
