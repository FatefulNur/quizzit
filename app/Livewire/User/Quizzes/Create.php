<?php

namespace App\Livewire\User\Quizzes;

use App\Enums\QuestionType;
use App\Services\QuizService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Create extends Component
{
    public $title;
    public $description;
    public $type;
    public $timer;
    public $started_at;
    public $expired_at;


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

        $this->dispatch('question-added');
    }

    public function removeQuestion($questionKey)
    {
        unset($this->questions[$questionKey]);
        $this->reset("questions.$questionKey");
    }

    public function resetOptions($questionKey)
    {
        $this->reset("questions.$questionKey.options");
        $this->questions[$questionKey]['options'] = $this->option();
    }

    public function addOption($questionKey)
    {
        $optionsCount = count($this->questions[$questionKey]['options']);
        $this->questions[$questionKey]['options'][] = [
            'label' => 'Option ' . ($optionsCount + 1),
            'is_correct' => false,
        ];
    }

    public function removeOption($questionKey, $optionKey)
    {
        unset($this->questions[$questionKey]['options'][$optionKey]);
        $this->reset("questions.$questionKey.options.$optionKey");
    }

    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'description' => 'nullable',
            'type' => 'nullable',
            'timer' => 'nullable|integer|max:150',
            'started_at' => 'required|date|before:expired_at',
            'expired_at' => 'required|date|after:started_at',
            'questions.*.title' => 'required|max:255',
            'questions.*.hint' => 'nullable',
            'questions.*.marks' => 'required|integer|min:0|max:100',
            'questions.*.type' => ['required', Rule::enum(QuestionType::class)],
            'questions.*.options.*.is_correct' => 'nullable|boolean',
            'questions.*.options.*.label' => 'nullable|max:255',
        ];
    }

    public function validationAttributes()
    {
        return [
            'title' => 'quiz title',
            'questions.*.title' => 'question title',
            'questions.*.hint' => 'question hint',
            'questions.*.marks' => 'marks',
            'questions.*.type' => 'question type',
            'questions.*.options.*.is_correct' => 'correct',
            'questions.*.options.*.label' => 'label',
        ];
    }

    public function save()
    {
        if (Gate::denies('create-quiz')) {
            return $this->redirectRoute('notify.plans.create_quiz');
        }

        $validated = $this->validate();

        $quiz = QuizService::store($validated);

        $this->reset();

        session()->flash('status', 'Success!');

        $this->redirectRoute('user.quizzes.edit', $quiz->id, navigate: true);
    }

    public function render()
    {
        return view('livewire.user.quizzes.create');
    }

    private function option()
    {
        return [
            [
                'label' => 'Option 1',
                'is_correct' => false,
            ]
        ];
    }
}
