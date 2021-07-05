<?php
namespace App\Repositories\Core\Eloquent\Tenant;

use App\Models\FinancialAccount;
use App\Models\FinancialCategory;
use App\Repositories\Contracts\FinancialAccountRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;
use Illuminate\Support\Facades\DB;

/**
 * .class [ TIPO ]
 *
 * @copyright (c) 2018, Carlos Junior
 */
class EloquentFinancialAccountRepository extends BaseEloquentRepository
    implements FinancialAccountRepositoryInterface
{
    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */


    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */
    public function model()
    {
        return FinancialAccount::class;
    }

    public function create(array $data)
    {
        DB::beginTransaction();

        try {

            $financialAccount = parent::create($data);

            $instructions = $this->saveInstructions($data, $financialAccount);

            if (!$financialAccount || !$instructions) {
                DB::rollBack();

                return [
                    'status' => false,
                    'message' => 'Não foi possível salvar o registro'
                ];
            }

            DB::commit();

            return ['status' => true];


        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'status' => false,
                'message' => 'Não foi possível salvar o registro.' . $e->getMessage()
            ];
        }
    }


    public function update($id, array $data)
    {
        if (!$financialAccount = parent::find($id)) {
            return [
                'status' => false,
                'message' => 'Registro não encontrado!'
            ];
        }


        DB::beginTransaction();

        try {

            $financialAccount->update($data);

            $instructions = $this->saveInstructions($data, $financialAccount);

            if (!$financialAccount || !$instructions) {
                DB::rollBack();

                return [
                    'status' => false,
                    'message' => 'Não foi possível atualizar o registro'
                ];
            }


            DB::commit();

            return [
                'status' => true,
                'message' => 'Registro atualizado com sucesso!'
            ];


        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'status' => false,
                'message' => 'Não foi possível atualizar o registro.' . $e->getMessage()
            ];
        }
    }

    private function saveInstructions(array $data, FinancialAccount $financialAccount)
    {
        $financialAccount->instructions()->delete();

        $instructions = $this->getInstructions($data['instructions']);

        if (count($instructions) > 0) {
            $financialAccount->instructions()->createMany($instructions);
        }

        return true;
    }

    /**
     * @param $instructions1
     * @param array $instructions
     * @return array
     */
    private function getInstructions(array $instructions): array
    {
        $newInstructions = [];

        foreach ($instructions as $instruction) {
            if (!empty($instruction['instruction'])) {
                array_push($newInstructions, $instruction);
            }
        }
        return $newInstructions;
    }

}
