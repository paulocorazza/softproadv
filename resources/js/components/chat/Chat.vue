<template>
    <div class="card direct-chat direct-chat-primary">
        <div class="card-header ui-sortable-handle">
            <h3 class="card-title">Mensagens</h3>
            <chat-users-selected
                v-for="(user, index) in allSelected"
                :key="index"
                :user="user"
            />


            <div class="card-tools">
                <button type="button" class="btn btn-tool" title="Contatos" data-widget="chat-pane-toggle">
                    <i class="fas fa-comments"></i>
                </button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <!-- Conversations are loaded here -->
            <div class="direct-chat-messages">
                <chat-message
                    v-for="(message, index) in allMessages"
                    :message="message"
                    :key="index"
                />
            </div>

            <div class="direct-chat-contacts">
                <ul class="contacts-list">
                    <chat-contacts
                        v-for="(contact, index) in allContacts"
                        :user="contact"
                        :key="index"
                    />
                </ul>
                <!-- /.contacts-list -->
            </div>
            <!--/.direct-chat-messages-->
        </div>
        <!-- /.card-body -->
        <chat-send/>
        <!-- /.card-footer-->
    </div>
</template>

<script>
import {mapActions, mapGetters, mapMutations} from 'vuex'

export default {
    name: "Chat",

    mounted() {
        this.loadMessages()
        this.loadContacts()
        this.SET_STATUS(true)
        this.markAllMessageAsRead()
    },

    beforeUnmount() {
      this.SET_STATUS(false)
    },

    methods: {
        ...mapActions(['loadMessages', 'loadContacts', 'markAllMessageAsRead']),
        ...mapMutations(['ADD_MESSAGE', 'SET_STATUS'])
    },

    computed: {
        ...mapGetters(['allMessages', 'allContacts', 'allSelected'])
    }


}
</script>

<style scoped>
.direct-chat-messages {
    height: 400px;
    overflow: auto;
    transform: rotate(180deg);
}

.direct-chat-contacts {
    height: 400px;
}


</style>
