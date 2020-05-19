<?php
namespace App\Repositories\Core\Eloquent\Tenant;

use App\Models\Phase;
use App\Models\TypeAction;
use App\Repositories\Contracts\TypeActionRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;


/**
 * .class [ TIPO ]
 *
 * @copyright (c) 2018, Carlos Junior
 */
class EloquentTypeActionRepository extends BaseEloquentRepository
    implements TypeActionRepositoryInterface
{
    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */


    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */
    public function model()
    {
        return TypeAction::class;
    }


    public function dataTables($column, $view)
    {
        $model = $this->model
            ->query()
            ->with('group_action');


        return Datatables()->eloquent($model)
            ->addColumn($column, $view)
            ->make(true);
    }


    public function getPhases($id)
    {
        $typeAction = $this->relationships('phases')->find($id);

        $phases = $typeAction->phases;

        return Datatables()->collection($phases)->addColumn('action', function ($phases) use ($id) {
            return '<a href="/type-actions/' . $id . '/phase/' . $phases->id . '/delete"' . 'class="badge bg-danger j_link_delete">Deletar</a>';
        })
            ->make(true);
    }

    public function getPhasesNotIn($typeAction)
    {
        return Phase::WhereNotIn('id', function ($query) use ($typeAction) {
            $query->select('phase_type_action.phase_id');
            $query->from('phase_type_action');
            $query->whereRaw("phase_type_action.type_action_id = {$typeAction->id}");
        })->get();
    }


    public function getPhasesSelect($id)
    {
        if ($id) {

            $typeAction = $this->relationships([
                'phases' => function ($query) {
                    $query->orderBy('name');
                }
            ])->find($id);

            return [
                'status'  => true,
                'data'    => $typeAction->phases,
            ];
        }

        return [
            'status' => false,
            'message' => 'Não foi possível realizar a pesquisa.'
        ];
    }
}
