<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\StripePayment\Charge\CreateRequest as CreateChargeRequest;
use App\Http\Requests\Api\StripePayment\Charge\CreateWithTokenRequest as CreateChargeWithTokenRequest;
use App\Http\Requests\Api\StripePayment\Customer\CreateRequest as CreateCustomerRequest;
use App\Http\Requests\Api\StripePayment\PaymentMethod\CreateRequest as CreatePaymentMethodRequest;
use App\Http\Requests\Api\StripePayment\PaymentMethod\ListRequest as ListPaymentMethodRequest;
use App\Http\Requests\Api\StripePayment\PaymentMethod\RetrieveRequest as RetrievePaymentMethodRequest;
use App\Http\Requests\Api\StripePayment\PaymentMethod\UpdateRequest as UpdatePaymentMethodRequest;
use App\Http\Requests\Api\StripePayment\PaymentMethod\AttachRequest as AttachPaymentMethodRequest;
use App\Http\Requests\Api\StripePayment\PaymentMethod\DetachRequest as DetachPaymentMethodRequest;
use App\Http\Requests\Api\StripePayment\Subscription\CreateRequest as CreateSubscriptionRequest;
use App\Http\Requests\Api\StripePayment\Subscription\CreateWithPaymentMethodRequest as CreateSubscriptionWithPaymentMethodRequest;
use App\Http\Requests\Api\StripePayment\Token\CreateRequest as CreateTokenRequest;
use App\Services\Api\StripePayment\ChargeService;
use App\Services\Api\StripePayment\CustomerService;
use App\Services\Api\StripePayment\PaymentMethodService;
use App\Services\Api\StripePayment\SubscriptionService;
use App\Services\Api\StripePayment\TokenService;
use Illuminate\Http\Request;
use Stripe\Stripe;

class StripePaymentController extends AbstractController
{
    /**
     * @var TokenService $tokenService
     */
    protected $tokenService;

    /**
     * @var CustomerService $customerService
     */
    protected $customerService;

    /**
     * @var ChargeService $chargeService
     */
    protected $chargeService;

    /**
     * @var PaymentMethodService $paymentMethodService
     */
    protected $paymentMethodService;

    /**
     * @var SubscriptionService $subscriptionService
     */
    protected $subscriptionService;

    /**
     * Create a new controller instance.
     *
     * @param TokenService $tokenService
     * @param CustomerService $customerService
     * @param ChargeService $chargeService
     * @param PaymentMethodService $paymentMethodService
     * @param SubscriptionService $subscriptionService
     */
    public function __construct(
        TokenService $tokenService,
        PaymentMethodService $paymentMethodService,
        CustomerService $customerService,
        ChargeService $chargeService,
        SubscriptionService $subscriptionService
    ) {
        Stripe::setApiKey(config('services.stripe.secret'));
        $this->tokenService = $tokenService;
        $this->paymentMethodService = $paymentMethodService;
        $this->customerService = $customerService;
        $this->chargeService = $chargeService;
        $this->subscriptionService = $subscriptionService;
    }

    /**
     * Create token from card info.
     *
     * @param Request $request
     * @return Response
     */
    public function createToken(CreateTokenRequest $request)
    {
        $this->apiData = $this->tokenService->createToken($request);

        return $this->success();
    }

    /**
     * Create payment method from card info.
     *
     * @param Request $request
     * @return Response
     */
    public function createPaymentMethod(CreatePaymentMethodRequest $request)
    {
        $this->apiData = $this->paymentMethodService->createPaymentMethod($request);

        return $this->success();
    }

    /**
     * List customer's payment method.
     *
     * @param ListPaymentMethodRequest $request
     * @return Response
     */
    public function getListPaymentMethod(ListPaymentMethodRequest $request)
    {
        $this->apiData = $this->paymentMethodService->getListPaymentMethod($request);

        return $this->success();
    }

    /**
     * Retrieve payment method.
     *
     * @param RetrievePaymentMethodRequest $request
     * @return Response
     */
    public function retrievePaymentMethod(RetrievePaymentMethodRequest $request)
    {
        $this->apiData = $this->paymentMethodService->retrievePaymentMethod($request);

        return $this->success();
    }

    /**
     * Update payment method.
     *
     * @param UpdatePaymentMethodRequest $request
     * @return Response
     */
    public function updatePaymentMethod(UpdatePaymentMethodRequest $request)
    {
        $this->apiData = $this->paymentMethodService->updatePaymentMethod($request);

        return $this->success();
    }

    /**
     * Attach payment method to a customer.
     *
     * @param AttachPaymentMethodRequest $request
     * @return Response
     */
    public function attachPaymentMethod(AttachPaymentMethodRequest $request)
    {
        $this->apiData = $this->paymentMethodService->attachPaymentMethod($request);

        return $this->success();
    }

    /**
     * Detach payment method from a customer.
     *
     * @param DetachPaymentMethodRequest $request
     * @return Response
     */
    public function detachPaymentMethod(DetachPaymentMethodRequest $request)
    {
        $this->apiData = $this->paymentMethodService->detachPaymentMethod($request);

        return $this->success();
    }

    /**
     * Create charge from token or customer.
     *
     * @param Request $request
     * @return Response
     */
    public function createCharge(CreateChargeRequest $request)
    {
        $this->apiData = $this->chargeService->createCharge($request);

        return $this->success();
    }

    /**
     * Create token and create charge.
     *
     * @param Request $request
     * @return Response
     */
    public function createChargeWithToken(CreateChargeWithTokenRequest $request)
    {
        $response = $this->tokenService->createToken($request);
        $request->merge([
            'source' => $response['id'],
        ]);

        $this->apiData = $this->chargeService->createCharge($request);

        return $this->success();
    }

    /**
     * Create customer.
     *
     * @param Request $request
     * @return Response
     */
    public function createCustomer(CreateCustomerRequest $request)
    {
        $this->apiData = $this->customerService->createCustomer($request);

        return $this->success();
    }

    /**
     * Create subscription.
     *
     * @param Request $request
     * @return Response
     */
    public function createSubscription(CreateSubscriptionRequest $request)
    {
        $this->apiData = $this->subscriptionService->createSubscription($request);

        return $this->success();
    }

    /**
     * Create payment method and create subscription.
     *
     * @param Request $request
     * @return Response
     */
    public function createSubscriptionWithPaymentMethod(CreateSubscriptionWithPaymentMethodRequest $request)
    {
        $response = $this->paymentMethodService->createPaymentMethod($request);
        $request->merge([
            'payment_method' => $response['id'],
        ]);

        $this->apiData = $this->subscriptionService->createSubscription($request);

        return $this->success();
    }
}
