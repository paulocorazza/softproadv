<?php

namespace App\Http\Controllers\Tenant;

use App\Events\Tenant\CompanyCreated;
use App\Events\Tenant\DatabaseCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCompanyFormRequest;
use App\Models\Company;
use Illuminate\Http\Request;
use View;

class CompanyController extends Controller
{
    private $company;
    private $totalPage = 15;


    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     *
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $dataForm = $request->except('_token');

            if (isset($dataForm['category_id']) || isset($dataForm['name']) || isset($dataForm['url']) ||
                isset($dataForm['description']) || isset($dataForm['id'])) {
                return $this->search($request);
            }

            $companies = $this->company
                              ->orderBy('id')
                              ->paginate($this->totalPage);

            return View::make('tenants.companies.partials.table', compact('companies'))->render();
        }

        $companies = $this->company
                          ->orderBy('id')
                          ->paginate($this->totalPage);

        return view('tenants.companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tenants.companies.create');
    }

    /**
     * @param StoreUpdateCompanyFormRequest $request
     * @return array|\Illuminate\Http\RedirectResponse|null
     */
    public function store(StoreUpdateCompanyFormRequest $request)
    {
        $company = $this->company->create($request->all());

        if (!$company) {
            return redirect()->route('companies.create');
        }

        //Caso o banco esteja em outro servidor, precisa chamar o método que alterna a conexão
        //verifica deseja ou não criar a database
        if ($request->has('create_database')) {
            event(new CompanyCreated($company));
        } else {
            event(new DatabaseCreated($company));
        }


        return redirect()->route('companies.index')
                         ->with('success', 'Cadastro realizado com sucesso!');
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = $this->company->find($id);

        if (!$company)
            return redirect()->back();

        return view('tenants.companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = $this->company->find($id);

        if (!$company)
            return redirect()->back();

        return view('tenants.companies.create', compact('company'));
    }

    /**
     * @param StoreUpdateCompanyFormRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreUpdateCompanyFormRequest $request, $id)
    {
        if (!$company = $this->company->find($id))
            return redirect()->back()->withInput();

        $company->update($request->all());

        return redirect()->route('companies.index')
                         ->with('success', 'Cadastro atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$company = $this->company->find($id))
             return redirect()->back();

        $company->delete();

        return redirect()->route('companies.index')
                         ->withSucces('Deletado com sucesso');
    }

    public function search()
    {

    }
}
