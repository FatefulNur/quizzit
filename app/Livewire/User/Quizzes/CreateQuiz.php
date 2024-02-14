<?php

namespace App\Livewire\User\Quizzes;

use App\Services\QuizService;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateQuiz extends Component
{
    #[Validate('required|max:255', as: 'quiz title')]
    public $title;

    #[Validate('nullable')]
    public $description;

    #[Validate('nullable')]
    public $type;

    #[Validate('required|date|after:today')]
    public $expired_at;

    #[Validate([
        'questions.*.title' => 'required|max:255',
        'questions.*.hint' => 'nullable',
        'questions.*.marks' => 'required|integer',
        'questions.*.type' => 'required|in:short_text,long_text,radio,checkbox',
        'questions.*.options.*.is_correct' => 'nullable|boolean',
        'questions.*.options.*.label' => 'nullable|max:255',
    ], attribute: [
        'questions.*.title' => 'question title',
        'questions.*.hint' => 'question hint',
        'questions.*.marks' => 'marks',
        'questions.*.type' => 'question type',
        'questions.*.options.*.is_correct' => 'correct',
        'questions.*.options.*.label' => 'label',
    ])]
    public $questions = [];

    public function mount()
    {
        $this->addQuestion();
    }

    public function addQuestion()
    {
        $this->questions[] = [
            'title' => '',
            'hint' => '',
            'marks' => '',
            'type' => '',
            'options' => $this->option(),
        ];
    }

    public function removeQuestion($questionKey)
    {
        unset($this->questions[$questionKey]);
        $this->reset("questions.$questionKey");
    }

    public function resetOptions($questionKey)
    {
        $this->questions[$questionKey]['options'] = $this->option();
    }

    public function addOption($questionKey)
    {
        $this->questions[$questionKey]['options'][] = [
            'label' => 'Option',
            'is_correct' => 0,
        ];
    }

    public function removeOption($questionKey, $optionKey)
    {
        unset($this->questions[$questionKey]['options'][$optionKey]);
        $this->reset("questions.$questionKey.options.$optionKey");
    }

    public function save()
    {
        $validated = $this->validate();

        QuizService::store($validated);

        $this->reset();

        session()->flash('status', 'Success!');

        $this->redirect(Index::class, navigate: true);
    }

    public function render()
    {
        return view('livewire.user.quizzes.create-quiz');
    }

    private function option()
    {
        return [
            [
                'label' => 'Option',
                'is_correct' => 0,
            ]
        ];
    }
}
