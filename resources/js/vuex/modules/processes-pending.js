export default {
    state: {
        items: [],
    },

    mutations: {
        LOAD_PROCESSES(state, processes) {
            state.items = processes
        },

        ADD_PROCESS(state, progress) {
            state.items.unshift(progress)
        }
    },

    getters: {
        allProcesses(state) {
            return state.items
        }
    },

    actions: {
        loadProcesses(context) {
            axios.get('/monitor/processes')
                .then(response => {
                    context.commit('LOAD_PROCESSES', response.data)
                })
        },

        getProcess(context, id) {
            return axios.get(`/monitor/processes/${id}`)
        },

        getProcesses(context, params) {
          return axios.post('/process/search', params)
        },

        createProcess(context, params) {
            return new Promise((resolve, reject) => {
                axios.post(`/processes`, params)
                    .then(response => resolve(response))
                    .catch(error => reject(error))
            })
        },

        updateProcess(context, params) {
            return new Promise((resolve, reject) => {
                axios.put(`/processes/${params.id}/sync`, params)
                    .then(response => resolve(response))
                    .catch(error => reject(error))
            })
        },

        publishedProcess(context, params) {
            axios.post('/monitor/processes/published', params)
        },

        archivedProcess(context, params) {
            axios.post('/monitor/processes/archived', params)
        }
    }

}
