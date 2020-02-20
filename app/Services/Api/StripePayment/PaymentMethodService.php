<?php

namespace App\Services\Api\StripePayment;

use App\Common\StripePayment;

class PaymentMethodService
{
    /**
     * Create payment method.
     *
     * @param Request $request
     * @return void
     */
    public function createPaymentMethod($request)
    {
        $cardInfo = $request->only([
            'number',
            'exp_month',
            'exp_year',
            'cvc',
        ]);

        return StripePayment::createPaymentMethod($cardInfo, $request->get('billing_details'));
    }

    /**
     * List customer's payment method.
     *
     * @param Request $request
     * @return void
     */
    public function getListPaymentMethod($request)
    {
        $customer = user()->stripe_id;

        if (!$customer) {
            return null;
        }

        return StripePayment::getListPaymentMethod($customer, 'card');
    }

    /**
     * Retrieve payment method.
     *
     * @param Request $request
     * @return void
     */
    public function retrievePaymentMethod($request)
    {
        return StripePayment::retrievePaymentMethod($request->get('payment_method'));
    }

    /**
     * Update payment method.
     *
     * @param Request $request
     * @return void
     */
    public function updatePaymentMethod($request)
    {
        $paymentMethod = $request->get('payment_method');
        $billingDetails = $request->get('billing_details');
        $cardInfo = $request->get('card');

        return StripePayment::updatePaymentMethod($paymentMethod, $billingDetails, $cardInfo);
    }

    /**
     * Attach payment method to a customer.
     *
     * @param Request $request
     * @return void
     */
    public function attachPaymentMethod($request)
    {
        if (!user()->stripe_id) {
            user()->createAsStripeCustomer();
        }

        return StripePayment::attachPaymentMethod($request->get('payment_method'), user()->stripe_id);
    }

    /**
     * Detach payment method from a customer.
     *
     * @param Request $request
     * @return void
     */
    public function detachPaymentMethod($request)
    {
        return StripePayment::detachPaymentMethod($request->get('payment_method'));
    }
}
