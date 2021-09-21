export default {
    state: {
        items: [],
    },

    mutations: {
        LOAD_PROGRESSES(state, progresses) {
            state.items = progresses
        },

        ADD_PROGRESS(state, progress) {
            state.items.unshift(progress)
        }
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

        getProgress(context, id) {
           return axios.get(`/progresses/${id}`)
        },

        updateProgress(context, params) {
            return new Promise((resolve, reject) => {
                axios.post(`/progresses/${params.id}`, params)
                    .then(response => resolve(response))
                    .catch(error => reject(error))
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
