<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Tenant;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\Externals\Lemonsqueezy;

class WebhookController extends Controller
{
    public function subscriptionCreated(Request $request)
    {
        $this->verifySubscriptionCreated();

        DB::transaction(function () use ($request) {
            $subscription = $request->collect('data')['attributes'];

            $product = Product::firstWhere('identity', $subscription['product_id']);
            $user = User::firstWhere('email', $subscription['user_email']);
            $tenant = Tenant::firstWhere('email', $subscription['user_email']);

            if (!$tenant) {
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
                $tenant->products()->sync($product);
            }

            if ($user) {
                $user->tenant()->associate($tenant);
                $user->save();

                $user->quizzes?->each->update(['tenant_id' => $tenant->id]);
                $user->userResponses?->each->update(['tenant_id' => $tenant->id]);
            }

            $subscriptionData = [
                'identity' => $request->collect('data')['id'],
                'product_id' => $product?->id,
                'tenant_id' => $tenant?->id,
                ...collect($subscription)->only([
                    'product_name',
                    'user_name',
                    'user_email',
                    'status',
                    'cancelled',
                    'card_brand',
                    'renews_at',
                    'ends_at',
                ])->all(),
            ];

            Subscription::create($subscriptionData);
        }, 3);
    }

    public function subscriptionUpdated(Request $request)
    {
        $this->verifySubscriptionUpdated();

        $requestData = $request->collect('data')['attributes'];
        $subscriptionId = (int) $request->collect('data')['id'];
        $subscription = Subscription::where('identity', $subscriptionId)->firstOrFail();

        $subscriptionData = collect($requestData)->only([
            'product_name',
            'user_name',
            'user_email',
            'status',
            'cancelled',
            'card_brand',
            'renews_at',
            'ends_at',
        ])->all();

        $subscription->update($subscriptionData);
    }



    // ==========Verification methods==============
    // ============================================
    // ============================================
    private function verifySubscriptionCreated()
    {
        $secret = config('lemonsqueezy.webhook.subscription.created.sign');
        $payload = file_get_contents('php://input');
        $hash = hash_hmac('sha256', $payload, $secret);
        $signature = $_SERVER['HTTP_X_SIGNATURE'] ?? '';

        if (!hash_equals($hash, $signature)) {
            throw new \Exception('Invalid signature.');
        }
    }

    private function verifySubscriptionUpdated()
    {
        $secret = config('lemonsqueezy.webhook.subscription.updated.sign');
        $payload = file_get_contents('php://input');
        $hash = hash_hmac('sha256', $payload, $secret);
        $signature = $_SERVER['HTTP_X_SIGNATURE'] ?? '';

        if (!hash_equals($hash, $signature)) {
            throw new \Exception('Invalid signature.');
        }
    }
}
