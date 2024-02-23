<?php

namespace App\Livewire\User\Quizzes;

use App\Livewire\Actions\Question\DestroyRelations;
use App\Models\Quiz;
use Livewire\Component;
use App\Enums\QuestionType;
use App\Services\QuizService;
use Illuminate\Validation\Rule;
use App\Livewire\Actions\Question\Destroy as DestroyQuestion;
use App\Livewire\Actions\Option\Destroy as DestroyOption;

class Edit extends Component
{
    public ?Quiz $quiz;

    public $title;
    public $description;
    public $type;
    public $started_at;
    public $expired_at;
    public $questions = [];

    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz;

        $this->authorize('update', $this->quiz);

        $type = $this->quiz->isPrivate() ? true : false;

        $this->title = $this->quiz->title;
        $this->description = $this->quiz->description;
        $this->type = $type;
        $this->started_at = $this->quiz->started_at->toString();
        $this->expired_at = $this->quiz->expired_at->toString();

        foreach ($this->quiz->questions as $question) {
            $options = [];

            foreach ($question->options as $option) {
                $options[] = [
                    'id' => $option->id,
                    'is_correct' => $option->is_correct,
                    'label' => $option->label,
                ];
            }

            $this->questions[] = [
                'id' => $question->id,
                'title' => $question->title,
                'hint' => $question->hint,
                'marks' => $question->marks,
                'type' => $question->type->value,
                'options' => $options,
            ];
        }
    }

    public function addQuestion()
    {
        $this->questions[] = [
            'id' => '',
            'title' => '',
            'hint' => '',
            'marks' => '',
            'type' => '',
            'options' => $this->option(),
        ];
    }

    public function removeQuestion(DestroyQuestion $destroy, $questionKey)
    {
        $question = $this->questions[$questionKey];
        $destroy($question['id']);
        unset($question);
        $this->reset("questions.$questionKey");
    }

    public function resetOptions(DestroyRelations $destroyRelations, $questionKey)
    {
        $question = $this->questions[$questionKey];
        $destroyRelations($question['id'], 'options');
        $question['options'] = $this->option();
        // $this->reset("questions.$questionKey.options.*.is_correct");
        // $this->reset("questions.$questionKey.options.*.label");
        // TODO: Fix
    }

    public function addOption($questionKey)
    {
        $optionsCount = count($this->questions[$questionKey]['options']);
        $this->questions[$questionKey]['options'][] = [
            'id' => '',
            'label' => 'Option ' . ($optionsCount + 1),
            'is_correct' => false,
        ];
    }

    public function removeOption(DestroyOption $destroy, $questionKey, $optionKey)
    {
        $option = $this->questions[$questionKey]['options'][$optionKey];
        $destroy($option['id']);
        unset($option);
        $this->reset("questions.$questionKey.options.$optionKey");
    }

    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'description' => 'nullable',
            'type' => 'nullable',
            'started_at' => 'required|date|before:expired_at',
            'expired_at' => 'required|date|after:started_at',
            'questions.*.id' => 'nullable|uuid',
            'questions.*.title' => 'required|max:255',
            'questions.*.hint' => 'nullable',
            'questions.*.marks' => 'required|integer|min:1|max:100',
            'questions.*.type' => ['required', Rule::enum(QuestionType::class)],
            'questions.*.options.*.id' => 'nullable|uuid',
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
        $validated = $this->validate();

        QuizService::update(
            $this->quiz,
            $validated
        );

        $this->reset();

        session()->flash('status', 'Success!');

        $this->redirect(Index::class, navigate: true);
    }

    public function render()
    {
        return view('livewire.user.quizzes.edit');
    }

    private function option()
    {
        return [
            [
                'id' => '',
                'label' => 'Option 1',
                'is_correct' => false,
            ]
        ];
    }
}
