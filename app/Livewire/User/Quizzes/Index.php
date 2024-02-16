<?php

namespace App\Livewire\User\Quizzes;

use App\Models\Quiz;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function render()
    {
        $quizzes = Quiz::select([
            'title',
            'description',
            'type',
            'marks_total',
            'created_at',
        ])
            ->where('user_id', auth()->id())
            ->simplePaginate(10);

        return view('livewire.user.quizzes.index', compact('quizzes'));
    }
}
