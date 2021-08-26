<template>
    <li data-widget="chat-pane-toggle">
        <a @click.prevent="addUserSend" href="#">
            <img v-if="user.image" class="contacts-list-img" :src="user.url_image" :alt="user.name">
            <img v-else class="contacts-list-img" src="/assets/images/no-image.png" alt="usuário">

            <div class="contacts-list-info">
                          <span class="contacts-list-name">
                            {{ user.name }}
                          </span>
            </div>
            <!-- /.contacts-list-info -->
        </a>
    </li>
</template>

<script>
import {mapMutations} from 'vuex'
export default {
    name: "Contacts",

    props: ['user'],

    methods: {
        ...mapMutations(['SELECT_USER']),

        addUserSend() {
            this.SELECT_USER(this.user)
        }
    }
}
</script>

<style scoped>

</style>
