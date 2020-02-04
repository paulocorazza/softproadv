<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\SubscriptionRepositoryInterface;
use App\Repositories\Core\DigitalPayments\PayPal\PayPalSubscription;

class SubscriptionController extends Controller
{
    private $subscription;


    public function __construct(SubscriptionRepositoryInterface $subscription)
    {
        $this->subscription = $subscription;

        $this->subscription->setSubscription(new PayPalSubscription());
    }


    public function createPlan($id)
    {
        return $this->subscription->create($id);
    }

    public function listPlan()
    {
        dd($this->subscription->listPlan());
    }

    public function showPlan($id)
    {
        dd($this->subscription->planDetail($id));
    }

    public function activatePlan($id)
    {
        return $this->subscription->activate($id);
    }

    public function generatePlan()
    {
        $id = request()->get('id');

        $activate = $this->subscription->createActivate($id);

        if ($activate) {
            return $this->getResponse($activate);
        }
    }

    /**
     * @param \PayPal\Api\Plan $activate
     * @return \Illuminate\Http\JsonResponse
     */
    protected function getResponse(\PayPal\Api\Plan $activate): \Illuminate\Http\JsonResponse
    {
        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'id' => $activate->getId(),
                'state' => 'active'
            ]);
        }
    }

}
