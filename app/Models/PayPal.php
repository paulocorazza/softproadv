<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use PayPal\Api\ChargeModel;
use PayPal\Api\Currency;
use PayPal\Api\MerchantPreferences;
use PayPal\Api\PaymentDefinition;
use PayPal\Api\Plan;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;


class PayPal extends Model
{
    private $apiContext;
    private $identify;
    private $company;
    private $plan;

    public function __construct(Company $company, \App\Models\Plan $plan)
    {
        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(config('paypal.client_id'),
                                     config('paypal.secret_id'))
        );

        $this->apiContext->setConfig(config('paypal.settings'));

        $this->identify = bcrypt(uniqid(date('YmdHis')));

        $this->company = $company;
        $this->plan = $plan;
    }



}
