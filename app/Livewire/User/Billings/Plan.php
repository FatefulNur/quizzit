<?php

namespace App\Livewire\User\Billings;

use App\Models\Product;
use Livewire\Component;

class Plan extends Component
{
    public function render()
    {
        $products = Product::all();

        return view('livewire.user.billings.plan', compact('products'));
    }
}
