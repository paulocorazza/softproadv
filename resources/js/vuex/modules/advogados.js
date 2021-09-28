export default {
    actions: {
        getAdvogados(context) {
            return axios.get('/users/advogados/search')
        },
    }
}
