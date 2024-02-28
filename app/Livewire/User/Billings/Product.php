<?php

namespace App\Livewire\User\Billings;

use App\Models\Plan;
use Livewire\Component;

class Product extends Component
{
    public function render()
    {
        $plans = Plan::all();

        return view('livewire.user.billings.product', compact('plans'));
    }
}
