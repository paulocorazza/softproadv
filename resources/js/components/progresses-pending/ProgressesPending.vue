<template>
    <div>
        <div class="btns">
            <button @click.prevent="btnPublished" class="btn bg-yellow text-white" id="btnPublished">Publicar Selecionados</button>
            <button @click.prevent="btnArchived" class="btn bg-dark" id="btnArchved">Arquivar Selecionados</button>
        </div>

        <table id="tabela" class="table table-hover  table-responsive-sm" style="width:100%">
            <thead class="thead-dark">
            <tr>
                <th><input type="checkbox" @click="selectAll" v-model="allSelected"></th>
                <th scope="col">Data</th>
                <th scope="col">Processo</th>
                <th scope="col">Cliente</th>
                <th scope="col">Descrição</th>
                <th width="50px" scope="col"></th>
            </tr>
            </thead>

            <tbody>
            <tr v-for="(progress, index) in this.allProgress" :key="index">
                <td><input type="checkbox" v-model="Ids" @click="select" :value="progress.id"></td>
                <td>{{ progress.date_br }}</td>
                <td>{{ progress.process.number_process }}</td>
                <td>{{ progress.process.person.name }}</td>
                <td>{{ progress.description }}</td>
                <td>
                    <button @click.prevent="btnVer"  class="badge bg-yellow">Detalhes</button>
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
            Ids: []
        }
    },

    created() {
        this.loadProgresses()
    },


    computed: {
        ...mapGetters(['allProgress'])
    },

    methods: {
        ...mapActions(['loadProgresses', 'published', 'archived']),

        async btnPublished() {
            if (this.Ids.length > 0) {
                await  this.published({id: this.Ids})
                this.loadProgresses()
            }
        },

        async btnArchived() {
            if (this.Ids.length > 0) {
              await this.archived({id: this.Ids})
              this.loadProgresses()
            }
        },

        selectAll: function() {
            this.Ids = [];

            if (!this.allSelected) {
                for (var progress in this.allProgress) {
                    this.Ids.push(this.allProgress[progress].id.toString());
                }
            }
        },
        select: function() {
            this.allSelected = false;
        }
    },
}
</script>

<style scoped>
    .btns {
        margin-bottom: 5px;
    }
</style>
