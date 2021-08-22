<template>
    <div>
        <div class="card direct-chat direct-chat-primary">
            <div class="card-header ui-sortable-handle">
                <h3 class="card-title">Mensagens</h3>
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
                <!--/.direct-chat-messages-->

            </div>
            <!-- /.card-body -->
                <chat-send/>
            <!-- /.card-footer-->
        </div>
    </div>
</template>

<script>
import {mapActions, mapGetters, mapMutations} from 'vuex'
import store from "../../vuex/store";

export default {
    name: "Chat",

    mounted() {
        this.loadMessages()
    },

    methods: {
        ...mapActions(['loadMessages']),
        ...mapMutations(['ADD_MESSAGE'])
    },

    computed : {
      ...mapGetters(['allMessages'])
    }


}
</script>

<style scoped>

</style>
