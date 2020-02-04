<?php

namespace App\Repositories\Core;

use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Exceptions\NotModelDefined;


/**
 * .class [ TIPO ]
 *
 * @copyright (c) 2018, Carlos Junior
 */
class BaseEloquentRepository implements RepositoryInterface
{
    protected $model;
    protected $with = [];

    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */
    /**
     * @return \Illuminate\Contracts\Foundation\Application|mixed
     * @throws NotModelDefined
     */
    private function resolveModel()
    {
        if (!method_exists($this, 'model')) {
            throw new NotModelDefined;
        }

        return app($this->model());
    }

    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */

    /**
     * BaseEloquentRepository constructor.
     * @throws NotModelDefined
     */
    public function __construct()
    {
        $this->model = $this->resolveModel();
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return $this->model->get();
    }


    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = ['*'])
    {
        return $this->model->findOrFail($id, $columns);
    }


    /**
     * @param $field
     * @param null $value
     * @param array $columns
     * @return mixed
     */
    public function findByField($field, $value = null, $columns = ['*'])
    {
        return $this->model->where($field, '=', $value)->get($columns);
    }

    /**
     * @param $field
     * @param array $values
     * @param array $columns
     * @return mixed
     */
    public function WhereIn($field, array $values, $columns = ['*'])
    {
        return $this->model->whereIn($field, $values)->get($columns);
    }


    /**
     * @param $field
     * @param array $values
     * @param array $columns
     * @return mixed
     */
    public function WhereNotIn($field, array $values, $columns = ['*'])
    {
        return $this->model->whereNotIn($field, $values)->get($columns);
    }


    /**
     * @param $field
     * @param array $values
     * @param array $columns
     * @return mixed
     */
    public function WhereBetween($field, array $values, $columns = ['*'])
    {
        return $this->model->whereBetween($field, $values)->get($columns);
    }

    /**
     * @param $field
     * @param string $operator
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function where($field, $operator = '=', $value, $columns = ['*'])
    {
        return $this->model->where($field, $operator, $value)
            ->get($columns);
    }


    /**
     * @param $field
     * @param string $operator
     * @param $value
     * @return mixed
     */
    public function whereFirst($field, $operator = '=', $value)
    {
        return $this->model->where($field, $operator, $value)
            ->first();
    }

    /**
     * @param int $totalPage
     * @return mixed
     */
    public function paginate($totalPage = 10)
    {
        return $this->model->paginate($totalPage);
    }


    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function update($id, array $data)
    {
        $model = $this->find($id);

        return $model->update($data);
    }


    public function updateOrCreate(array $attributes, array $values = [])
    {
        return $this->model->updateOrCreate($attributes, $values);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $model = $this->find($id);

        return $model->delete();
    }

    /**
     * @param $column
     * @param string $order
     * @return $this
     */
    public function orderBy($column, $order = 'DESC')
    {
        $this->model = $this->model->orderBy($column, $order);

        return $this;
    }

    /**
     * @param mixed ...$relationships
     * @return $this
     */
    public function relationships($relationships)
    {
        $this->model = $this->model->with($relationships);

        return $this;
    }


    /**
     * @param $column
     * @param $view
     * @param int $totalPage
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function dataTables($column, $view)
    {
        return Datatables()->eloquent($this->model->query())->addColumn($column, $view)
            ->make(true);
    }


    /**
     * @param $column
     * @param null $key
     * @return mixed
     */
    public function pluck($column, $key = null)
    {
        return $this->model->pluck($column, $key);
    }


    /**
     * @param string $id
     * @return mixed
     */
    public function rules($id = '')
    {
        return $this->model->rules($id);
    }

}
