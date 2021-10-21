<?php

/**
 * .class [ TIPO ]
 *
 * @copyright (c) 2018, Carlos Junior
 */
namespace App\Repositories\Core\DigitalPayments\PayPal;

use App\Models\Company;
use App\Repositories\Contracts\AgreementRepositoryInterface;
use Carbon\Carbon;
use PayPal\Api\Agreement;
use PayPal\Api\Payer;
use PayPal\Api\Plan;
use PayPal\Api\ShippingAddress;
use PayPal\Exception\PayPalConnectionException;

class PayPalAgreement extends PayPal implements AgreementRepositoryInterface
{
    /**
     * @param $id
     * @return Plan
     */
    protected function plan($id): Plan
    {
        $plan = new Plan();
        $plan->setId($id);
        return $plan;
    }

    /**
     * @return Payer
     */
    protected function payer(): Payer
    {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        return $payer;
    }

    /**
     * @return ShippingAddress
     */
    protected function shippingAddress(): ShippingAddress
    {
        $shippingAddress = new ShippingAddress();
        $shippingAddress->setLine1('Rua Francisco Mendes Galvão, 250')
            ->setCity('Itu')
            ->setState('SP')
            ->setPostalCode('13311-680')
            ->setCountryCode('BR');
        return $shippingAddress;
    }


    /**
     * @param $id
     * @return string
     */
    protected function agreement($id): string
    {
        $startdate = Carbon::now()->add(1, 'day')->toAtomString();

        $agreement = new Agreement();
        $agreement->setName('SoftPro - Advogado / Contrato de Licença de Uso')
                  ->setDescription('Contrato de Licença de Uso')
                  ->setStartDate($startdate);

        $agreement->setPlan($this->plan($id));
        $agreement->setPayer($this->payer());
      //  $agreement->setShippingAddress($this->shippingAddress());

        $agreement = $agreement->create($this->apiContext);

        return $agreement->getApprovalLink();
    }


    /**
     * @param $company
     * @param $payment_id
     */
    protected function activeCompany(Company $company, $payment_id)
    {
        $company->payment_status = 'active';
        $company->payment_id = $payment_id;
        $company->save();

        session()->forget('company');
    }

    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */

    public function create($id)
    {
        try {

            $url_paypal = $this->agreement($id);
            $token = $this->getTokenPayment($url_paypal);

            return [
                'status'     => true,
                'url_paypal' => $url_paypal,
                'identify'   => $this->identify,
                'token'      => $token
            ];

        } catch (PayPalConnectionException  $ex) {
            dd($ex);
            return [
                'status'    => false,
                'message'   => $ex->getMessage()
            ];

        }
    }

    public function executeAgreement($token, Company $company)
    {
        try {

            $agreement = new Agreement();

            $agreement->execute($token, $this->apiContext);

            $this->activeCompany($company, $agreement->getId());

            return [
                'status'      => true,
                'state'       =>  $agreement->getState(),
            ];

        } catch (PayPalConnectionException  $ex) {
            return [
                'status'      => false,
                'message'   => $ex->getMessage()
            ];

        }
    }

    public function detailAgreement($id)
    {
        $agreement = Agreement::get($id, $this->apiContext);

        return $agreement;
    }

    public function updateCompany(Company $company, array $agreement)
    {
        $plan = \App\Models\Plan::where('key_paypal', $agreement['id'])->first();

        $company->identify =  $this->identify;
        $company->plan_id = $plan->id;
        $company->token_payment = $agreement['token'];
        $company->save();

        return [
            'status' => true
        ];
    }

    private function getTokenPayment(string $url_paypal) : string
    {
        $url = explode('&token=', $url_paypal);
        return $url[1];
    }


}
