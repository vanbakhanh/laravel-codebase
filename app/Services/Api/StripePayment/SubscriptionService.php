<?php

namespace App\Services\Api\StripePayment;

use App\Common\StripePayment;
use App\Exceptions\Api\BadRequestException;

class SubscriptionService
{
    /**
     * Create subscription.
     *
     * @param Request $request
     * @return void
     */
    public function createSubscription($request)
    {
        $data = $request->only([
            'plan_id',
            'payment_method',
            'subscription',
        ]);
        $user = auth()->user();

        if ($user->subscribedToPlan($data['plan_id'], $data['subscription'])) {
            throw new BadRequestException('You already subscribed this plan.');
        }

        return StripePayment::createSubscription($data, $user);
    }
}
