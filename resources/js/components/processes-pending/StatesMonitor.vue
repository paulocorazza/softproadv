<template>
    <div>
        <div class="btns d-flex justify-content-between">
            <button
                class="btn btn-primary mr-4"
                @click="startMonitor"
            >
                Buscar
            </button>

            <button
                class="btn btn-danger mr-4"
                @click="close"
            >
                Fechar
            </button>
        </div>

        <div v-if="errors.ids">
            <div class="alert alert-danger alert-dismissible">
                <button @click.prevent="closeError" type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    ×
                </button>
                <h4><i class="fa fa-check"></i> Limite Atingido!</h4>
                {{ this.errors.ids[0] }}
            </div>
        </div>

        <table id="tabela" class="table table-hover  table-responsive-sm" style="width:100%">
            <thead class="thead-dark">
            <tr>
                <th><input type="checkbox" @click="selectAll" v-model="allSelected"></th>
                <th scope="col">OAB</th>
                <th scope="col">UF</th>
            </tr>
            </thead>

            <tbody>
            <tr v-for="(state, index) in this.allStates" :key="index">
                <td><input type="checkbox" v-model="Ids" @click="select" :value="state.id"></td>
                <td>{{ state.user.oab }}</td>
                <td>{{ state.state.letter }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import {mapActions, mapGetters} from 'vuex'

export default {
    name: "StatesMonitor",

    data() {
        return {
            allSelected: false,
            Ids: [],
            errors: {}
        }
    },

    computed: {
        ...mapGetters(['allStates'])
    },

    methods: {
        ...mapActions(['startMonitorOAB']),

        selectAll: function () {
            this.Ids = [];

            if (!this.allSelected) {
                for (var state in this.allStates) {
                    this.Ids.push(this.allStates[state].id.toString());
                }
            }
        },
        select: function () {
            this.allSelected = false;
        },

        startMonitor() {
            this.startMonitorOAB({ids: this.Ids})
                .then(() => {
                    this.close()
                })
                .catch((error) => {
                    this.errors = error
                })
        },

        close() {
            this.Ids = []
            this.$emit('hideMonitorStates')
            this.closeError()
        },

        closeError() {
            this.errors = {}
        }
    }
}
</script>

<style scoped>
.btns {
    margin-bottom: 5px;
}
</style>
