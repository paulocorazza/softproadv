<template>
    <div>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">{{ allNotifications.length}}</span>
            </a>

            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">{{ allNotifications.length}} Notificações</span>
            <div class="dropdown-divider"></div>

             <notification v-for="(notification, index) in allNotifications"
             :key="index"
             :notification="notification">
             </notification>

            <div class="dropdown-divider"></div>
            <a v-if="allNotifications.length > 0" @click.prevent="markAllAsRead" href="#" class="dropdown-item dropdown-footer">Marcar todas como lidas</a>
        </div>
        </li>
    </div>
</template>

<script>
import {mapActions, mapGetters} from 'vuex'

export default {
    name: "Notifications",

    mounted() {
        this.loadNotifications()
    },

    computed: {
        ...mapGetters(['allNotifications'])
    },

    methods: {
        ...mapActions(['loadNotifications', 'markAllAsRead']),
    }

}
</script>

<style scoped>

</style>
