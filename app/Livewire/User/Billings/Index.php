<?php

namespace App\Livewire\User\Billings;

use App\Constants\Product\Fresher;
use App\Livewire\Forms\TenantForm;
use App\Models\Product;
use Livewire\Component;

class Index extends Component
{
    public TenantForm $form;

    public function mount()
    {
        $tenant = auth()->user()->tenant;

        if ($tenant) {
            $this->form->setTenant($tenant);
        }
    }

    public function saveChanges()
    {
        $this->form->update();

        session()->flash('status', 'Saved!');

        $this->redirect(self::class, navigate: true);
    }

    public function render()
    {
        $product = auth()->user()->tenant?->products()?->first();

        if (!$product) {
            $product = Product::firstWhere('name', Fresher::NAME);
        }

        return view('livewire.user.billings.index', compact('product'));
    }
}
