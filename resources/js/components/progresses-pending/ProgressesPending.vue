<template>
    <div>
        <vue-snotify></vue-snotify>
        <div class="btns">
            <button @click.prevent="btnPublished" class="btn bg-yellow text-white" id="btnPublished">Publicar
                Selecionados
            </button>
            <button @click.prevent="btnArchived" class="btn bg-dark" id="btnArchved">Arquivar Selecionados</button>
        </div>

        <vodal :show="showModal"
               animation="zoom"
               @hide="hideModal"
               :width="800"
               :height="500">
            <progress-form
                :progress="this.progress"
                @hide="hideModal"
            >

            </progress-form>
        </vodal>

        <table id="tabela" class="table table-hover  table-responsive-sm" style="width:100%">
            <thead class="thead-dark">
            <tr>
                <th><input type="checkbox" @click="selectAll" v-model="allSelected"></th>
                <th scope="col">Data</th>
                <th scope="col">Categoria</th>
                <th scope="col">Processo</th>
                <th scope="col">Cliente</th>
                <th scope="col">Descrição</th>
                <th scope="col">Prazo</th>
                <th width="50px" scope="col"></th>
            </tr>
            </thead>

            <tbody>
            <tr v-for="(progress, index) in this.allProgress" :key="index">
                <td><input type="checkbox" v-model="Ids" @click="select" :value="progress.id"></td>
                <td>{{ progress.date_br }}</td>
                <td>{{ progress.category }}</td>
                <td>{{ progress.process.number_process }}</td>
                <td>{{ progress.process.person.name }}</td>
                <td>{{ progress.description }}</td>
                <td>{{ progress.date_term_br }}</td>
                <td>
                    <button @click.prevent="detail(progress.id)" class="badge bg-yellow">Detalhes</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import {mapActions, mapGetters} from 'vuex'

export default {
    name: "ProgressesPending",

    data() {
        return {
            allSelected: false,
            Ids: [],
            showModal: false,
            progress: {
                id: '',
                description: 'teste',
                publication: '',
                date: '',
                date_term: '',
                concluded: false,
                category: '',
                process: {
                    number_process : '',
                    person: {
                        name: ''
                    }
                }
            }
        }
    },

    created() {
        this.loadProgresses()
    },


    computed: {
        ...mapGetters(['allProgress'])
    },

    methods: {
        ...mapActions(['loadProgresses', 'getProgress', 'published', 'archived']),

        async btnPublished() {
            if (this.Ids.length > 0) {
                const toast = this.$snotify.confirm('Confirma o publicação dos andamentos selecionados?', 'Confirmação', {
                    timeout: 5000,
                    showProgressBar: false,
                    closeOnClick: true,
                    pauseOnHover: true,
                    buttons: [
                        {
                            text: 'Sim', action: () => {
                                this.published({id: this.Ids})
                                    .then(() => this.loadProgresses())

                                this.$snotify.remove(toast.id)

                            }, bold: false
                        },
                        {text: 'Não', action: () => this.$snotify.remove(toast.id)},
                    ]
                });
            }

        },

        async btnArchived() {
            if (this.Ids.length > 0) {
                const toast = this.$snotify.confirm('Confirma o arquivamento dos andamentos selecionados?', 'Confirmação', {
                    timeout: 5000,
                    showProgressBar: false,
                    closeOnClick: true,
                    pauseOnHover: true,
                    buttons: [
                        {
                            text: 'Sim', action: () => {
                                this.archived({id: this.Ids})
                                    .then(() => this.loadProgresses())
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
                for (var progress in this.allProgress) {
                    this.Ids.push(this.allProgress[progress].id.toString());
                }
            }
        },
        select: function () {
            this.allSelected = false;
        },

         detail(id) {
             this.getProgress(id)
             .then((response) => {
                 this.progress = response.data
                 this.showModal = true
             })

        },

        hideModal() {
            this.showModal = false
        }
    },


}
</script>

<style scoped>
.btns {
    margin-bottom: 5px;
}
</style>
