<?php

namespace App\Common;

use Stripe\Charge;
use Stripe\Customer;
use Stripe\PaymentMethod;
use Stripe\Subscription;
use Stripe\Token;

class StripePayment
{
    public static function createToken($cardInfo)
    {
        return Token::create([
            'card' => $cardInfo,
        ]);
    }

    public static function createPaymentMethod($cardInfo, $billingDetails = [])
    {
        return PaymentMethod::create([
            'type' => 'card',
            'card' => $cardInfo,
            'billing_details' => $billingDetails,
        ]);
    }

    public static function getListPaymentMethod($customerId, $type)
    {
        return PaymentMethod::all([
            'customer' => $customerId,
            'type' => $type,
        ]);
    }

    public static function retrievePaymentMethod($paymentMethodId)
    {
        return PaymentMethod::retrieve($paymentMethodId);
    }

    public static function updatePaymentMethod($paymentMethodId, $billingDetails = [], $cardInfo = [])
    {
        return PaymentMethod::update($paymentMethodId, [
            'billing_details' => $billingDetails,
            'card' => $cardInfo,
        ]);
    }

    public static function detachPaymentMethod($paymentMethodId)
    {
        return PaymentMethod::retrieve($paymentMethodId)->detach();
    }

    public static function attachPaymentMethod($paymentMethodId, $customerId)
    {
        return PaymentMethod::retrieve($paymentMethodId)->attach(['customer' => $customerId]);
    }

    public static function createCustomer($data)
    {
        return Customer::create($data);
    }

    public static function retrieveCustomer($customerId)
    {
        return Customer::retrieve($customerId);
    }

    public static function listCustomers($limit = 3, $email = '', $created = '')
    {
        return Customer::all([
            'limit' => $limit,
            'email' => $email,
            'created' => $created,
        ]);
    }

    public static function deleteCustomer($customerId)
    {
        return Customer::retrieve($customerId)->delete();
    }

    public static function createCharge($data)
    {
        return Charge::create($data);
    }

    public static function createSubscription($data, $user)
    {
        return $user->newSubscription($data['subscription'], $data['plan_id'])->create($data['payment_method']);
    }

    public static function retrieveSubscription($subscriptionId)
    {
        return Subscription::retrieve($subscriptionId);
    }

    public static function listSubscriptions($limit = 3, $customerId = '', $created = '')
    {
        return Subscription::all([
            'limit' => $limit,
            'customer' => $customerId,
            'created' => $created,
        ]);
    }

    public static function cancelSubscription($subscriptionId)
    {
        return Subscription::retrieve($subscriptionId)->cancel();
    }

    public static function updateSubscription($subscriptionId, $metadata = [])
    {
        return Subscription::update(
            $subscriptionId,
            ['metadata' => $metadata]
        );
    }
}
