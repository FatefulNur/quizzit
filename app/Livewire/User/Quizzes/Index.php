<?php

namespace App\Livewire\User\Quizzes;

use App\Services\QuizService;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    #[Url(except: '', history: true)]
    public string $date = '';

    #[Url(except: false, history: true)]
    public $isPrivate = false;

    public function queryParams()
    {
        return [
            'date' => $this->date,
            'private' => $this->isPrivate,
        ];
    }

    public function render()
    {
        $quizzes = QuizService::get($this->queryParams())
            ->select([
                'title',
                'description',
                'type',
                'marks_total',
                'started_at',
                'expired_at',
                'created_at',
            ])
            ->where('user_id', auth()->id())
            ->paginate(10);

        return view('livewire.user.quizzes.index', compact('quizzes'));
    }
}
