<template>
    <div>
        <div class="row">
            <div class="col-12">
                <label class="form-control" >Processo: {{ progress.process.number_process }} - {{ progress.process.person.name }}</label>
            </div>
        </div>


        <div class="row">
            <div class="col-12">
                <select class="form-control" v-model="progress.category">
                    <option v-for="(category, index) in categories" :key="index"                          >
                        {{ category }}
                    </option>
                </select>
            </div>
        </div>


        <div class="row">
            <div class="col-12 col-sm-3">
                <div class="form-group label-float">
                    <label for="progress_date">Data</label>
                    <input id="progress_date" class="form-control" v-model="progress.date" type="date"
                           placeholder=" " autofocus>
                </div>
            </div>


            <div class="col-12 col-sm-6">
                <div class="form-group label-float ">
                    <label for="progress_description">Descrição</label>
                    <input id="progress_description" class="form-control" v-model="progress.description" type="text"
                           placeholder=" ">
                </div>
            </div>


            <div class="col-12 col-sm-3">
                <div class="form-group label-float">
                    <label for="progress_date_term">Prazo</label>
                    <input id="progress_date_term" class="form-control" type="date"
                           placeholder=" "  v-model="progress.date_term">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <textarea cols="30" rows="4" class="form-control" v-model="progress.publication"></textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="icheck-primary d-inline">
                    <input id="progress_concluded" type="checkbox" v-model="progress.concluded">
                    <label for="progress_concluded">Concluído</label>
                </div>
            </div>
        </div>

        <div class="row d-flex justify-content-between mt-3 ml-0 mr-0">
            <button class="btn btn-danger d-inline" @click.prevent="close">Fechar</button>
            <button class="btn btn-primary d-inline" @click.prevent="save">Salvar</button>
        </div>
    </div>
</template>

<script>
import {mapActions} from 'vuex'
export default {
    name: "ProgressForm",

    props: {
        progress: {
            required: false,
            type: Object | Array,
            default: () => ({
                id: '',
                description: '',
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
            })
        }
    },

    data () {
        return {
            categories: [
                'Acórdão',
                'Alvará',
                'Arquivamento dos autos',
                'Ata de audiência ou registro de realização',
                'Certidão ou guia',
                'Conclusos',
                'Contestação',
                'Custas',
                'Decorrido o prazo',
                'Designação de audiência',
                'Despacho ou decisão',
                'Distribuição',
                'Documento',
                'Execução',
                'Extinção',
                'Homologação de acordo',
                'Intimação',
                'Juntada de petição',
                'Laudo',
                'Mandado oficial de justiça',
                'Manifestação',
                'Mero expediente',
                'Notificação',
                'Penhora',
                'Prazo para manifestação',
                'Publicação no DOE',
                'Razões ou contrarrazões de recurso',
                'Recurso',
                'Remessa ou recebimento dos autos',
                'Sentença',
                'Trânsito em julgado',
                'Outros'
            ]
        }
    },

    methods: {
        ...mapActions(
            ['updateProgress', 'loadProgresses']
        ),

        save(id) {
            this.updateProgress(this.progress)
                .then((response) => this.loadProgresses())

            this.close()
        },

        close()  {
            this.$emit('hide')
        },

    }
}
</script>

<style scoped>

</style>
