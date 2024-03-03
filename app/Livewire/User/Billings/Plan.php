<?php

namespace App\Livewire\User\Billings;

use App\Models\Product;
use Livewire\Component;
use App\Services\Externals\Lemonsqueezy;

class Plan extends Component
{
    public function cancel($id)
    {
        $response = Lemonsqueezy::cancelSubscription($id);

        if ($response->failed()) {
            session()->flash('status', 'Failed!');

            $this->redirect(self::class, navigate: true);
        }

        sleep(3);

        $this->redirect(self::class, navigate: true);
    }

    public function resume($id)
    {
        $response = Lemonsqueezy::resumeSubscription($id);

        if ($response->failed()) {
            session()->flash('status', 'Failed!');

            $this->redirect(self::class, navigate: true);
        }

        sleep(3);

        $this->redirect(self::class, navigate: true);
    }

    public function render()
    {
        $products = Product::all();

        return view('livewire.user.billings.plan', compact('products'));
    }
}
