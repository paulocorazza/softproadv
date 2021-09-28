<template>
    <div>
        <div class="row">
            <div class="col-12">
                <label class="form-control" >Processo: {{ process.number_process }}</label>
            </div>
        </div>

        <v-container fluid>
            <v-alert v-if="error"
                     dense
                     border="left"
                     type="warning"
                v-html="this.errors"
            />


            <v-form
                ref="form"
                v-model="valid"
                lazy-validation
            >

            <v-row>
                <v-col cols="12">
                    <v-autocomplete
                        v-model="form.person"
                        :loading="loading"
                        :items="persons"
                        item-text="name"
                        item-value="id"
                        :search-input.sync="payloadPerson"
                        flat
                        hide-no-data
                        hide-details
                        label="Cliente *"
                        :rules="[v => !!v || 'Cliente é de preenchimento obrigatório']"
                        required
                    >
                        <v-icon
                            slot="append"
                            color="green"
                            @click="newPerson"
                        >
                            fas fa-plus
                        </v-icon>
                    </v-autocomplete>
                </v-col>
            </v-row>

            <v-row>
                <v-col cols="12">
                    <v-autocomplete
                        v-model="form.counterpart"
                        :loading="loading"
                        :items="counterparts"
                        item-text="name"
                        item-value="id"
                        :search-input.sync="payloadCounterPart"
                        flat
                        hide-no-data
                        hide-details
                        label="Parte Contrária *"
                        :rules="[v => !!v || 'Parte Contrária é de preenchimento obrigatório']"
                        required
                    >
                        <v-icon
                            slot="append"
                            color="green"
                            @click="newPerson"
                        >
                            fas fa-plus
                        </v-icon>
                    </v-autocomplete>
                </v-col>
            </v-row>

            <v-row>
                <v-col cols="12">
                    <v-combobox
                        v-model="form.advogados"
                        :items="allAdvogados"
                        label="Advogados *"
                        item-text="name"
                        item-value="id"
                        hide-selected
                        multiple
                        dense
                        chips
                        :rules="[v => !!v || 'Selecione ao menos um advogado']"
                        required
                    ></v-combobox>
                </v-col>
            </v-row>


            <v-row>
                <v-col cols="12">
                    <v-textarea
                        v-model="form.description"
                        label="Anotações Gerais"
                        rows="2"
                    ></v-textarea>
                </v-col>
            </v-row>

             <v-row  class="d-flex justify-space-between">
                 <v-btn
                     color="danger"
                     class="mr-4"
                     @click="close"
                 >
                     Fechar
                 </v-btn>

                <v-btn
                    dark
                    class="mr-4"
                    @click="save"
                >
                    Salvar
                </v-btn>
             </v-row>
            </v-form>
        </v-container>
    </div>
</template>

<script>

const TYPE_PERSON = {
    client : 'Cliente',
    counterPart: 'Parte Contrária'
}

import {mapActions} from 'vuex'

export default {
    name: "ProcessForm",

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

    created() {
        this.clear()
        this.getAdvogados()
            .then((response) => this.allAdvogados = response.data)
    },

    data () {
        return {
            valid: false,
            error: false,
            errors: '',
            payloadPerson: null,
            payloadCounterPart: null,
            loading: false,
            persons: [],
            counterparts: [],
            allAdvogados: [],

            form: {
                person: '',
                counterpart: '',
                advogados: [],
                description: ''
            },
        }
    },

    watch: {
        payloadPerson (val) {
            val && val !== this.select && this.searchPerson(val, TYPE_PERSON.client)
        },

        payloadCounterPart (val) {
            val && val !== this.select && this.searchPerson(val, TYPE_PERSON.counterPart)
        },
    },

    methods: {
        ...mapActions(
            ['loadProcesses', 'getPeople', 'getAdvogados', 'createProcess', 'publishedProcess']
        ),

        clear() {
          this.error = false
          this.form = {
              person: '',
              counterpart: '',
              advogados: [],
              description: ''
          }
        },

        save() {
            if (this.$refs.form.validate()) {
                let params = {
                    person_id: this.form.person,
                    counterpart_id: this.form.counterpart,
                    description: this.form.description,
                    users: this.advogados(),
                    status : 'Em Andamento',
                    type_process: 'Ajuizado',
                    number_process: this.process.number_process
                }

                this.createProcess(params)
                    .then((resp) => {
                        if (resp.data == '1') {
                            this.error = false
                            this.publishedProcess({id: [this.process.id]})
                                .then((resp) => {
                                    this.loadProcesses()
                                    this.close()
                                })
                        } else {
                            this.error = true
                            this.errors = resp.data
                        }
                    })
            }
        },

        newPerson() {
          window.open('/people/create', '_blank')
        },

        searchPerson(val, type) {
            this.loading = true
            this.getPeople({ q : val, type: type })
                .then((response) => {
                    if (type == TYPE_PERSON.client) {
                        this.persons = response.data
                    }

                    if (type == TYPE_PERSON.counterPart) {
                        this.counterparts = response.data
                    }
                })
                .finally(() => this.loading = false)

        },

        close()  {
            this.clear()
            this.$emit('hide')
        },


        advogados () {
            return this.form.advogados.map((adv) => {
                return adv.id
            })
        }


    },


}
</script>

<style scoped>

</style>
