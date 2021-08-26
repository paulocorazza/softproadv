<template>
    <div class="d-inline-flex">
        <img v-if="user.image" class="contacts-list-img user-selected" :src="user.url_image" :alt="user.name">
        <img v-else class="contacts-list-img user-selected" src="/assets/images/no-image.png" alt="usuário">

        <a href="" @click.prevent="remove">
            <span class="badge">
                <i class="fas fa-times"></i>
            </span>
        </a>
    </div>
</template>

<script>
import {mapMutations} from 'vuex'
export default {
    name: "ChatUsersSelecteds",

    props: ['user'],

    methods: {
        ...mapMutations(['UNSELECTED']),

        remove() {
            this.UNSELECTED(this.user)
        }
    }
}
</script>

<style scoped>
.user-selected {
    margin-left: 5px;
}
</style>
