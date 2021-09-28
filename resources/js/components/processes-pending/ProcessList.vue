<template>
    <v-card>
        <v-card-title>
            Processos {{ this.process.number_process }}
            <v-spacer></v-spacer>
            <v-text-field
                v-model="search"
                append-icon="mdi-magnify"
                label="Pesquisar por Cliente"
                single-line
                hide-details
            ></v-text-field>
        </v-card-title>

        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Parte Contrária</th>
                    <th width="200px" scope="col"></th>
                </tr>
            </thead>

            <tbody>
            <tr v-for="(process, index) in items" :key="index">
                <td>{{ process.id }}</td>
                <td>{{ process.person.name }}</td>
                <td>{{ process.counter_part.name }}</td>
                <td>
                    <button @click.prevent="sync(process.id)" class="badge bg-primary">Vincular</button>
                </td>
            </tr>
            </tbody>
        </table>

    </v-card>
</template>

<script>
import {mapActions} from "vuex";

export default {
    name: "ProcessList",

    props: {
        process: {
            required: false,
            type: Object | Array,
            default: () => ({
                id: '',
                created_at: '',
                oab : '',
                uf: '',
                tribunal: '',
                number_process: '',
            })
        }
    },

    data() {
        return {
            search: '',
            headers: [
                { text: 'Id', value: 'id' },

            ],
            items: []
        }
    },

    watch: {
        search (val) {
            val && val !== this.select && this.searchProcess(val)
        },

    },


    methods : {
        ...mapActions(['getProcesses', 'updateProcess', 'loadProcesses', 'publishedProcess']),

        searchProcess(val) {
            let params = {
                searchPending : val
            }

          this.getProcesses(params)
               .then((resp) => this.items = resp.data.data)
        },

        sync(process) {
            let params = {
                id : process,
                number_process: this.process.number_process
            }

            this.updateProcess(params)
                .then((resp) => {
                    if (resp.status == '200') {
                        this.publishedProcess({id: [this.process.id]})
                            .then(() => {
                                this.loadProcesses()
                                this.close()
                            })
                    }
                })
        },

        close()  {
            this.$emit('hideList')
        },
    }
}
</script>

<style scoped>

</style>
