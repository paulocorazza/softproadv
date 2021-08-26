<template>
    <div class="card-footer">
        <form action="#" method="post" @submit.prevent="sendMessage">
            <div class="input-group">
                <input type="text" name="message" v-model="newMessage" placeholder="Digite aqui ..." class="form-control">
                <span class="input-group-append">
                      <button @click.prevent="sendMessage" type="button" class="btn btn-primary">Enviar</button>
                 </span>
            </div>
        </form>
    </div>
</template>

<script>
import {mapActions, mapGetters} from 'vuex'
export default {
    name: "ChatSend",

    data() {
        return {
            newMessage: ''
        }
    },

    methods : {
        ...mapActions(['addMessage']),

        sendMessage() {
            let params = {
                'message' : this.newMessage,
            }

            if (this.allSelected.length > 0) {
                params.users = this.allSelected
            }

            this.addMessage(params)
            this.newMessage = ''
        }
    },

    computed: {
        ...mapGetters(['allSelected'])
    }

}
</script>

<style scoped>

</style>
