<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\AgreementRepositoryInterface;
use App\Repositories\Contracts\CompanyRepositoryInterface;
use App\Repositories\Core\DigitalPayments\PayPal\PayPalAgreement;
use Illuminate\Http\Request;


class AgreementController extends Controller
{
    private $agreement;
    private $company;

    public function __construct(AgreementRepositoryInterface $agreement, CompanyRepositoryInterface $company)
    {
         $this->agreement = $agreement;

         $this->agreement->setAgreement(new PayPalAgreement());

         $this->company = $company;
    }

    public function createAgreement($companyUuid, $id)
    {
        $result = $this->agreement->create($id);

        if (!$result['status']) {
            return redirect()->back()
                             ->with('message', $result['message']);
        }

        $company = $this->company->where('uuid', '=', $companyUuid)->first();


        $response = $this->agreement->updateCompany($company, $id);


        if (!$response['status']) {
            return redirect()->back()
                             ->with('message', $response['message']);
        }

        return redirect()->away($result['url_paypal']);
    }

    public function execute(Request $request)
    {
        $success = ($request->success == 'true') ? true : false;
        $token = $request->token;

        if (!session()->has('company')) {
            return redirect()->route('index')
                             ->withErrors( 'Falha de autenticação');
        }

        $companySession = session()->get('company');

        $company = $this->company->where('uuid', '=', $companySession['uuid'])->first();

        $site = 'http://' . $company->subdomain . env('APP_SUBDOMAIN');


        if (!$success) {
            return redirect()->away($site)
                             ->withErrors( 'errors','Solicitação cancelada');
        }

        if (empty($token)) {
            return redirect()->away($site)
                             ->withErrors( 'errors','Falha de autenticação');
        }

        $response = $this->agreement->executeAgreement($token, $company);

        if (!$response['status']) {
            return redirect()->back()
                             ->with('message', $response['message']);
        }

        return redirect()->away($site);
    }

    public function detailAgreement($id)
    {
        dd($this->agreement->detailAgreement($id));
    }



}
