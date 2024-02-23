<?php

namespace App\Livewire\User\Responses;

use App\Models\UserResponse;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $responses = UserResponse::select()
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('livewire.user.responses.index', compact('responses'));
    }
}
