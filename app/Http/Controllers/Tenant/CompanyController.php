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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     * @throws \Exception
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {
            return Datatables()->eloquent(Company::query())->addColumn('action', 'tenants.companies.partials.acoes')
                                                           ->make(true);
        }



        return view('tenants.companies.index');
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

        if (!$company) {
            return redirect()->back();
        }

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

        if (!$company) {
            return redirect()->back();
        }

        return view('tenants.companies.create', compact('company'));
    }

    /**
     * @param StoreUpdateCompanyFormRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreUpdateCompanyFormRequest $request, $id)
    {
        if (!$company = $this->company->find($id)) {
            return redirect()->back()->withInput();
        }

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
        if (!$company = $this->company->find($id)) {
            return redirect()->back();
        }

        $company->delete();

        return redirect()->route('companies.index')
            ->withSucces('Deletado com sucesso');
    }
}
