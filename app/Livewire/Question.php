<?php

namespace App\Livewire;

use Livewire\Component;

class Question extends Component
{
    public string $questionType;

    public function render()
    {
        return view('livewire.question');
    }
}
