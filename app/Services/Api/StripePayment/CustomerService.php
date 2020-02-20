<?php

namespace App\Services\Api\StripePayment;

use App\Common\StripePayment;

class CustomerService
{
    /**
     * Create customer for payment.
     *
     * @param Request $request
     * @return void
     */
    public function createCustomer($request)
    {
        $data = $request->only([
            'email',
            'source',
            'name',
            'description',
        ]);

        return StripePayment::createCustomer($data);
    }

    /**
     * Retrieve a customer.
     *
     * @param Response $request
     * @return void
     */
    public function retrieveCustomer($request)
    {
        return StripePayment::retrieveCustomer($request->get('customer_id'));
    }
}
