<template>
    <div data-app>
        <a href="#" class="dropdown-item">
            <v-tooltip bottom>
                <template v-slot:activator="{ on, attrs }">
                    <v-btn text
                        v-bind="attrs"
                        v-on="on"
                           class="text-lowercase"
                    >
                        <i class="fas fa-envelope mr-2"></i>
                        {{ item.title_limit }}
                    </v-btn>
                    <span @click.prevent="markAsRead(item.id)" class="float-right text-muted text-sm">Lida</span>
                </template>
                <div>
                    <p>{{ item.user.name}} adicionou você em uma atividade</p>
                    <p>Início em: {{ item.start_br }}</p>
                    <p>Fim em: {{ item.end_br}}</p>
                </div>
            </v-tooltip>
        </a>
    </div>
</template>

<script>
import { mapActions } from 'vuex'

export default {
    name: "Notification",
    props: ['notification'],

    computed: {
        item() {
            return this.notification.data.data
        }
    },

    methods: {
        ...mapActions(['markAsRead'])
    }
}
</script>

<style scoped>

</style>
