<template>
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-comments"></i>
            <span class="badge badge-warning navbar-badge">0</span>
        </a>

        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">0 Mensagens</span>
            <div class="dropdown-divider"></div>

<!--            <notification v-for="(notification, index) in allNotifications"
                          :key="index"
                          :notification="notification">
            </notification>-->

            <div class="dropdown-divider"></div>
            <a href="/messages"
               class="dropdown-item dropdown-footer">Ver todas as mensagens</a>
        </div>
    </li>
</template>

<script>
export default {
    name: "NotificationsChat"
}
</script>

<style scoped>

</style>
