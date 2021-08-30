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
            'cellphone'     => 'required|max:15',
            'cpf'           => "required|min:3|max:191|unique:companies,cpf,{$id},id",
            'oab'           => 'required|max:8',
            'uf_oab'        => 'required|max:2',
            'qtd_processes' => 'required',
            'email'         => "required|min:3|max:191|confirmed|unique:companies,email,{$id},id",
            'subdomain'     => "required|min:3|max:191|unique:companies,subdomain,{$id},id",
        ];
    }
}
