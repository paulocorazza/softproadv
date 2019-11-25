<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateCompanyFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->segment(3);

        return [
            'name'          => 'required|min:3|max:100',
            'subdomain'     => "required|min:3|max:191|unique:companies,subdomain,{$id},id",
            'db_database'   => "required|min:3|max:191|unique:companies,db_database,{$id},id",
            'db_host'       => 'required|min:3|max:100',
            'db_username'   => 'required|min:3|max:100',
            'db_password'   => 'required|min:3|max:35',
        ];
    }
}
