<?php

namespace App\Livewire\User\Billings;

use App\Models\Plan as PlanModel;
use Livewire\Component;

class Plan extends Component
{
    public function render()
    {
        $plans = PlanModel::all();

        return view('livewire.user.billings.plan', compact('plans'));
    }
}
