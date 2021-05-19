<?php
namespace App\Repositories\Core\Eloquent\Tenant;

use App\Models\District;
use App\Models\Stick;
use App\Repositories\Contracts\DistrictRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;


/**
 * .class [ TIPO ]
 *
 * @copyright (c) 2018, Carlos Junior
 */
class EloquentDistrictRepository extends BaseEloquentRepository
    implements DistrictRepositoryInterface
{
    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */


    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */
    public function model()
    {
        return District::class;
    }

    public function getDistricts()
    {
        return $this->model->orderBy('name')
                           ->get()
                           ->pluck('name', 'id');
    }

    public function getSticks($id)
    {
        $district = $this->relationships('sticks')->find($id);

        $sticks = $district->sticks;


        return Datatables()->collection($sticks)->addColumn('action', function ($sticks) use ($id) {
            return '<a href="/districts/' . $id . '/sticks/' . $sticks->id . '/delete"' . 'class="badge bg-danger j_link_delete">Deletar</a>';
        })
            ->make(true);
    }

    public function getSticksAvailable(District $district)
    {
        return Stick::WhereNotIn('id', function ($query) use ($district) {
            $query->select('district_stick.stick_id');
            $query->from('district_stick');
            $query->whereRaw("district_stick.district_id = {$district->id}");
        })->get();
    }
}
