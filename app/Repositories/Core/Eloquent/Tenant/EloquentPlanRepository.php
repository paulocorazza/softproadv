<?php

namespace App\Repositories\Core\Eloquent\Tenant;

use App\Models\Plan;
use App\Repositories\Contracts\PlanRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;
use Illuminate\Support\Facades\DB;

/**
 * .class [ TIPO ]
 *
 * @copyright (c) 2018, Carlos Junior
 */
class EloquentPlanRepository extends BaseEloquentRepository implements PlanRepositoryInterface
{
    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */

    /**
     * @param array $data
     * @param $plan
     * @return array
     */
    private function saveItems(array $data, $plan): array
    {
        $plan->plan_details()->delete();

        $description = array();

        if (isset($data['details'])) {
            foreach ($data['details'] as $item) {
                $description[]['description'] = $item;
            }

            $description = $plan->plan_details()->createMany($description);
        }

        return $description;
    }


    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */

    /**
     * @return string
     */
    public function model()
    {
        return Plan::class;
    }

    public function create(array $data)
    {
        DB::beginTransaction();

        try {
            $plan = parent::create($data);

            $description = $this->saveItems($data, $plan);

            if (!$plan || !$description) {
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
        if (!$plan = parent::find($id)) {
            return [
                'status' => false,
                'message' => 'Registro não encontrado!'
            ];
        }

        DB::beginTransaction();
        try {
            $plan->update($data);

            $description = $this->saveItems($data, $plan);

            if (!$plan || !$description) {
                DB::rollBack();

                return [
                    'status' => false,
                    'message' => 'Não foi possível atualizar o registro'
                ];
            }


            DB::commit();

            return ['status' => true];

        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'status' => false,
                'message' => 'Não foi possível atualizar o registro.' . $e->getMessage()
            ];
        }

    }

}
