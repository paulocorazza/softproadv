<template>
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-comments"></i>
            <span class="badge badge-warning navbar-badge">{{ allMessageNotifications.length }}</span>
        </a>

        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">{{ allMessageNotifications.length }} Mensagens</span>
            <div class="dropdown-divider"></div>

            <div class="dropdown-divider"></div>
            <a href="/messages"
               class="dropdown-item dropdown-footer">Ver todas as mensagens</a>
        </div>
    </li>
</template>

<script>
import {mapGetters, mapActions} from 'vuex'
export default {
    name: "NotificationsChat",

    mounted() {
        this.loadMessageNotifications()
    },

    methods: {
      ...mapActions(['loadMessageNotifications'])
    },

    computed: {
        ...mapGetters(['allMessageNotifications'])
    }
}
</script>

<style scoped>

</style>
