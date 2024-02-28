<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Tenant;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

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

    public function store()
    {
        $this->validate();

        DB::transaction(function () {
            $tenant = Tenant::query()->updateOrCreate(
                ['email' => $this->email],
                $this->all(),
            );

            auth()->user()->update(['tenant_id' => $tenant->id]);

            return $tenant;
        });
    }
}
