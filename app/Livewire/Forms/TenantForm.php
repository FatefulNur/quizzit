<?php

namespace App\Livewire\Forms;

use App\Jobs\UpdateLemonCustomer;
use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Tenant;
use Illuminate\Validation\Rule;

class TenantForm extends Form
{
    #[Validate]
    public $name = '';

    #[Validate]
    public $email = '';
    public $city = '';
    public $region = '';
    public $country = 'BD';

    public function setTenant(Tenant $tenant)
    {
        $this->name = $tenant->name;
        $this->email = $tenant->email;
        $this->city = $tenant->city;
        $this->region = $tenant->region;
        $this->country = $tenant->country;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'email' => ['required', 'email', Rule::unique('tenants', 'email')->ignore(auth()->user()->tenant?->id)],
            'city' => 'nullable',
            'region' => 'nullable',
            'country' => 'nullable',
        ];
    }

    public function update()
    {
        $this->validate();

        $tenant = tap(auth()->user()->tenant)->update(
            $this->all()
        );

        $data = $tenant->only([
            'name',
            'email',
            'city',
            'region',
            'country'
        ]);

        UpdateLemonCustomer::dispatch(
            $tenant->identity,
            $data,
        );
    }
}
