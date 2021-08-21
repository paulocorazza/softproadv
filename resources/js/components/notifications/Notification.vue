<template>
    <div data-app>
        <a @click.prevent="redirect" href="#" class="dropdown-item">
            <v-tooltip bottom>
                <template v-slot:activator="{ on, attrs }">
                    <v-btn text
                        v-bind="attrs"
                        v-on="on"
                        class="text-lowercase"
                    >
                        <i :class="classObject"></i>
                         {{ title }}
                    </v-btn>
                    <span @click.prevent="markAsRead(item.id)" class="float-right text-muted text-sm">Lida</span>
                </template>

                <div v-if="notification.type == 'App\\Notifications\\UserLinkedEvent'">
                    <p v-if="item.audience == 0">{{ item.user.name}} adicionou você em uma atividade</p>
                    <p v-else-if="item.audience == 1">{{ item.user.name}} adicionou você em uma audiência</p>
                    <p v-if="item.process">Referente ao processo: {{ item.process.number_process}}</p>
                   <p v-if="item.process">{{ item.process.person.name}}</p>
                    <p>Início em: {{ item.start_br }}</p>
                    <p>Fim em: {{ item.end_br}}</p>
                </div>

                <div v-else>
                    <p>{{ item.user.name}} adicionou você em um novo processo</p>
                </div>
            </v-tooltip>
        </a>
    </div>
</template>

<script>
import { mapActions } from 'vuex'

const typesNotifications = {
    event: 'App\\Notifications\\UserLinkedEvent',
    process: 'App\\Notifications\\UserLinkedProcess',
}

export default {
    name: "Notification",
    props: ['notification'],

    computed: {
        item() {
            return this.notification.data.data
        },

        title() {
          return this.notification.type == typesNotifications.event ? this.item.title_limit : this.item.process_person
        },

        classObject() {
            return {
                'fas fa-tasks': this.item.audience === 0,
                'fas fa-envelope': this.item.audience === 1,
                'fas fa-balance-scale' : this.notification.type == typesNotifications.process
            }
        }
    },

    methods: {
        ...mapActions(['markAsRead']),

         redirect() {
              this.markAsRead({id : this.notification.id})

               this.notification.type == typesNotifications.event ?
                window.location.href = `/events/${this.item.id}` :
                window.location.href = `/processes/${this.item.id}`

        }
    }
}
</script>

<style scoped>

</style>
