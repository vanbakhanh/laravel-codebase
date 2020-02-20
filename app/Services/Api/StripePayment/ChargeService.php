<?php

namespace App\Services\Api\StripePayment;

use App\Common\StripePayment;

class ChargeService
{
    /**
     * Create charge from card info or customer.
     *
     * @param Request $request
     * @return void
     */
    public function createCharge($request)
    {
        $data = $request->only([
            'customer',
            'amount',
            'description',
            'source',
            'currency',
        ]);

        return StripePayment::createCharge($data);
    }
}
