<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryToProcessProgresses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('process_progresses', function (Blueprint $table) {
            $table->enum('category', [
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
            ])->default('Outros');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('process_progresses', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }
}

