export default {
    state: {
        items: [],
        states: []
    },

    mutations: {
        LOAD_PROCESSES(state, processes) {
            state.items = processes
        },

        ADD_PROCESS(state, progress) {
            state.items.unshift(progress)
        },

        LOAD_STATES(state, states) {
            state.states = states
        }
    },

    getters: {
        allProcesses(state) {
            return state.items
        },

        allStates(state) {
            return state.states
        }
    },

    actions: {
        loadProcesses(context) {
            axios.get('/monitor/processes')
                .then(response => {
                    context.commit('LOAD_PROCESSES', response.data)
                })
        },

        loadStates(context) {
            axios.get('/all-states-monitors')
                .then(response => {
                    context.commit('LOAD_STATES', response.data)
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
                    .catch((error) =>  {
                        reject(error)

                    })
            })
        },

        publishedProcess(context, params) {
            axios.post('/monitor/processes/published', params)
        },

        archivedProcess(context, params) {
            axios.post('/monitor/processes/archived', params)
        },

        startMonitorOAB(context, params) {
            return new Promise((resolve, reject) => {
                axios.post('/monitor/oab/create', params)
                    .then(response => resolve(response))
                    .catch(error => reject(error.response.data.errors))
            })
        },

    }

}
