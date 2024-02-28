<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Tenant;
use App\Models\Subscription;
use App\Services\Externals\Lemonsqueezy;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function storeSubscription(Request $request)
    {
        $this->verifyStoreSubscription();

        $subscription = $request->collect('data')['attributes'];
        $plan = Plan::firstWhere('identity', $subscription['product_id']);

        $customer = Lemonsqueezy::getCustomer($subscription['customer_id'])['data'];
        $customerData = [
            'identity' => $customer['id'],
            ...collect($customer['attributes'])->only([
                'name',
                'email',
                'city',
                'region',
                'country',
            ])->all(),
        ];
        $tenant = Tenant::create($customerData);

        $subscriptionData = [
            'identity' => $request->collect('data')['id'],
            'plan_id' => $plan?->id,
            'tenant_id' => $tenant?->id,
            'plan_name' => $subscription['product_name'],
            'user_name' => $subscription['user_name'],
            'user_email' => $subscription['user_email'],
            'status' => $subscription['status'],
            'card_brand' => $subscription['card_brand'],
            'cancelled' => $subscription['cancelled'],
            'renews_at' => $subscription['renews_at'],
            'ends_at' => $subscription['ends_at'],
        ];
        Subscription::create($subscriptionData);
    }

    private function verifyStoreSubscription()
    {
        $secret = config('lemonsqueezy.webhook.subscription.created.sign');
        $payload = file_get_contents('php://input');
        $hash = hash_hmac('sha256', $payload, $secret);
        $signature = $_SERVER['HTTP_X_SIGNATURE'] ?? '';

        if (!hash_equals($hash, $signature)) {
            throw new \Exception('Invalid signature.');
        }
    }
}
