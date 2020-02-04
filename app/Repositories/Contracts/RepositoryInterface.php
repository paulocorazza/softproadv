<?php

namespace App\Repositories\Contracts;

interface RepositoryInterface
{
    public function get();
    public function find($id, $columns = ['*']);
    public function findByField($field, $value = null, $columns = ['*']);
    public function WhereIn($field, array $values, $columns = ['*']);
    public function WhereNotIn($field, array $values, $columns = ['*']);
    public function WhereBetween($field, array $values, $columns = ['*']);
    public function where($field, $operator = '=', $value, $columns = ['*']);
    public function whereFirst($field,  $operator = '=', $value);
    public function paginate($totalPage = 10);
    public function create(array $data);
    public function update($id, array $data);
    public function updateOrCreate(array $attributes, array $values = []);
    public function delete($id);
    public function orderBy($column, $order = 'DESC');
    public function dataTables($column, $view);
    public function relationships($relationships);
    public function pluck($column, $key = null);
    public function rules($id = '');
}
