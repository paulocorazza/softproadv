<template>
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span v-if="(this.allProgress.length > 0) || (this.allProcesses.length > 0)"
                  class="badge badge-warning navbar-badge">{{ allNotifications.length + 1 }}</span>
            <span v-else class="badge badge-warning navbar-badge">{{ allNotifications.length }}</span>
        </a>

        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a v-if="allProgress.length > 0" href="/monitor/progresses">
                <span class="dropdown-item dropdown-header">{{ allProgress.length }} Andamento(s) pendente(s)</span>
            </a>

            <a v-if="allProcesses.length > 0" href="/monitor/processes">
                <span
                    class="dropdown-item dropdown-header">{{
                        allProcesses.length
                    }} Processo(s) por OAB pendente(s)</span>
            </a>

            <div class="dropdown-divider"></div>
            <span class="dropdown-item dropdown-header">{{ allNotifications.length }} Notificações</span>
            <div class="dropdown-divider"></div>


            <notification v-for="(notification, index) in allNotifications"
                          :key="index"
                          :notification="notification">
            </notification>

            <div class="dropdown-divider"></div>
            <a v-if="allNotifications.length > 0" @click.prevent="markAllAsRead" href="#"
               class="dropdown-item dropdown-footer">Marcar todas como lidas</a>
        </div>
    </li>
</template>

<script>
import {mapActions, mapGetters} from 'vuex'

export default {
    name: "Notifications",

    mounted() {
        this.loadNotifications()
        this.loadProcesses()
        this.loadProgresses()
    },

    computed: {
        ...mapGetters(['allNotifications', 'allProgress', 'allProcesses']),

    },

    methods: {
        ...mapActions(['loadNotifications', 'loadProgresses', 'loadProcesses', 'markAllAsRead']),
    }

}
</script>

<style scoped>

</style>
