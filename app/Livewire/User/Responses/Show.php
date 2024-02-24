<?php

namespace App\Livewire\User\Responses;

use App\Models\UserResponse;
use Livewire\Component;
use Livewire\Attributes\Layout;

class Show extends Component
{
    public ?UserResponse $response;

    public function mount(UserResponse $response)
    {
        $this->response = $response;
    }

    #[Layout('components.layouts.guest')]
    public function render()
    {
        return view('livewire.user.responses.show');
    }
}
