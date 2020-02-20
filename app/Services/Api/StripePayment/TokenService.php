<?php

namespace App\Services\Api\StripePayment;

use App\Common\StripePayment;

class TokenService
{
    /**
     * Create token from card info.
     *
     * @param Request $request
     * @return void
     */
    public function createToken($request)
    {
        $cardInfo = $request->only([
            'number',
            'exp_month',
            'exp_year',
            'cvc',
            'name',
        ]);

        return StripePayment::createToken($cardInfo);
    }
}
