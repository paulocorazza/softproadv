<template>
    <div>
        <vue-snotify></vue-snotify>
        <div class="btns">
            <button @click.prevent="btnArchived" class="btn bg-dark" id="btnArchved">Arquivar Selecionados</button>
        </div>

        <vodal :show="showFormCreate"
               animation="zoom"
               @hide="hideModal"
               :width="800"
               :height="550">
            <process-form
                :process="this.process"
                @hide="hideModal"
            >
            </process-form>
        </vodal>

        <vodal :show="showProcesses"
               animation="zoom"
               @hide="hideModalProcess"
               :width="800"
               :height="550">
            <process-list
                :process="this.process"
                @hideList="hideModalProcess"
            >
            </process-list>
        </vodal>

        <table id="tabela" class="table table-hover  table-responsive-sm" style="width:100%">
            <thead class="thead-dark">
            <tr>
                <th><input type="checkbox" @click="selectAll" v-model="allSelected"></th>
                <th scope="col">Data</th>
                <th scope="col">OAB</th>
                <th scope="col">UF</th>
                <th scope="col">Processo</th>
                <th scope="col">Tribunal</th>
                <th width="200px" scope="col"></th>
            </tr>
            </thead>

            <tbody>
            <tr v-for="(process, index) in this.allProcesses" :key="index">
                <td><input type="checkbox" v-model="Ids" @click="select" :value="process.id"></td>
                <td>{{ process.created_at_br }}</td>
                <td>{{ process.oab }}</td>
                <td>{{ process.uf }}</td>
                <td>{{ process.number_process }}</td>
                <td>{{ process.tribunal}}</td>
                <td>
                    <button @click.prevent="create(process.id)" class="badge bg-primary">Criar</button>
                    <button @click.prevent="vincular(process.id)" class="badge bg-secondary">Vincular</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import {mapActions, mapGetters} from 'vuex'

export default {
    name: "ProcessesPending",

    data() {
        return {
            allSelected: false,
            Ids: [],
            showFormCreate: false,
            showProcesses: false,
            process: {
                id: '',
                created_at_br: '',
                oab : '',
                uf: '',
                tribunal: '',
                number_process: '',
            }
        }
    },

    created() {
        this.loadProcesses()
    },


    computed: {
        ...mapGetters(['allProcesses'])
    },

    methods: {
        ...mapActions(['loadProcesses', 'getProcess',  'archivedProcess']),

        btnArchived() {
            if (this.Ids.length > 0) {
                const toast = this.$snotify.confirm('Confirma o arquivamento dos processos selecionados?', 'Confirmação', {
                    timeout: 5000,
                    showProgressBar: false,
                    closeOnClick: true,
                    pauseOnHover: true,
                    buttons: [
                        {
                            text: 'Sim', action: () => {
                                this.archivedProcess({id: this.Ids})
                                    .then(() => this.loadProcesses())

                                this.$snotify.remove(toast.id)

                            }, bold: false
                        },
                        {text: 'Não', action: () => this.$snotify.remove(toast.id)},
                    ]
                })
            }
        },

        selectAll: function () {
            this.Ids = [];

            if (!this.allSelected) {
                for (var process in this.allProcesses) {
                    this.Ids.push(this.allProcesses[process].id.toString());
                }
            }
        },
        select: function () {
            this.allSelected = false;
        },

         create(id) {
             this.getProcess(id)
             .then((response) => {
                 this.process = response.data
                 this.showFormCreate = true
             })
        },

        vincular(id) {
            this.getProcess(id)
                .then((response) => {
                    this.process = response.data
                    this.showProcesses = true
                })
        },

        hideModal() {
            this.showFormCreate = false
        },

        hideModalProcess() {
            this.showProcesses = false
        }
    },


}
</script>

<style scoped>
.btns {
    margin-bottom: 5px;
}
</style>
