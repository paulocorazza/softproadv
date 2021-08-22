<template>
    <div class="card-footer">
        <form action="#" method="post">
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
import {mapActions} from 'vuex'
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
            this.addMessage({'message' : this.newMessage})
            this.newMessage = ''
        }
    }
}
</script>

<style scoped>

</style>
