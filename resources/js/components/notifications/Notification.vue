<template>
    <div data-app>
        <a href="#" class="dropdown-item">
            <v-tooltip bottom>
                <template v-slot:activator="{ on, attrs }">
                    <v-btn text
                        v-bind="attrs"
                        v-on="on"
                    >
                        <i class="fas fa-envelope mr-2"></i>
                        {{ item.title_limit}}
                    </v-btn>
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
export default {
    name: "Notification",
    props: ['notification'],

    computed: {
        item() {
            return this.notification.data.data
        }
    }
}
</script>

<style scoped>

</style>
