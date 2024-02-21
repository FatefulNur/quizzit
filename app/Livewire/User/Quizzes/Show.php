<?php

namespace App\Livewire\User\Quizzes;

use App\Models\Quiz;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Show extends Component
{
    public function mount(Quiz $quiz)
    {
        // dump($quiz);
    }

    #[Layout('components.layouts.guest')]
    public function render()
    {
        return view('livewire.user.quizzes.show');
    }
}
