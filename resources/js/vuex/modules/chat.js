export default {
    state: {
        online : false,
        items: [],
        contacts: [],
        contactsSelected: []
    },

    mutations: {
        LOAD_MESSAGES(state, messages) {
            state.items = messages
        },

        LOAD_CONTACTS(state, contacts) {
            state.contacts = contacts
        },

        ADD_MESSAGE(state, message) {
            state.items.unshift(message)
        },

        SELECT_USER(state, user) {
          if (!state.contactsSelected.includes(user)) {
              state.contactsSelected.push(user)
          }
        },

        UNSELECTED(state, user) {
            state.contactsSelected.splice(state.contactsSelected.indexOf(user), 1);
        },

        SET_STATUS(state, status) {
            state.online = status
        }


    },

    getters: {
        allMessages (state) {
            if (state.contactsSelected.length > 0) {
                let selecteds = state.contactsSelected.map(user => {
                    return user.uuid
                });

                return state.items.filter(message => {
                    return message.user.uuid.includes(window.Laravel.user) || selecteds.includes(message.user.uuid)
                })
            }

              return state.items
        },

        allContacts (state) {
            return state.contacts
        },

        allSelected (state) {
            return state.contactsSelected
        }
    },

    actions: {
        loadMessages(context) {
            axios.get('/fetchMessages')
                .then(response => {
                    context.commit('LOAD_MESSAGES', response.data)
                })
        },

        loadContacts(context) {
            axios.get('/chat-contacts')
                .then(response => {
                    context.commit('LOAD_CONTACTS', response.data)
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
