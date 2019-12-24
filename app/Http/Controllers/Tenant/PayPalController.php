<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\PayPal;
use App\Models\Plan;
use Illuminate\Http\Request;
use Session;

class PayPalController extends Controller
{
   public function paypal($companyUuid, $planId)
   {
        $company = Company::where('uuid', $companyUuid)->first();

        $plan =  Plan::find($planId);

        $paypal = new PayPal($company, $plan);

        $result = $paypal->generate();

       if (!$result['status']) {
           return redirect()->route('cart')->with('message', 'Erro inesperado');
       }

       $paymentID = $result['payment_id'];
       $identify = $result['identify'];


       Session::put('payment_id', $paymentID);

       return redirect()->away($result['url_paypal']);
   }

    public function returnPayPal(Request $request)
    {
        $success = ($request->success == 'true') ? true : false;
        $paymentId = $request->paymentId;
        $token = $request->token;
        $PayerID = $request->PayerID;

        dd($success, $paymentId, $token, $PayerID);
   }
}
