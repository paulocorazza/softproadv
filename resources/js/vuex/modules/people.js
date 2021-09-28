export default {
    actions : {
        getPeople(context, params) {
            return axios.post('/people/search', params)
        },
    }
}
