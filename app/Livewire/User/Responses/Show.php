<?php

namespace App\Livewire\User\Responses;

use Livewire\Component;
use Livewire\Attributes\Layout;

class Show extends Component
{

    #[Layout('components.layouts.guest')]
    public function render()
    {
        return view('livewire.user.responses.show');
    }
}
