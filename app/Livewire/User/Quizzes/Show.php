<?php

namespace App\Livewire\User\Quizzes;

use App\Models\Quiz;
use App\Services\UserResponseService;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Show extends Component
{
    public ?Quiz $quiz;

    public $answers = [];

    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz;

        foreach ($this->quiz->questions as $question) {
            $this->answers[] = [
                'answer' => [],
                'option_id' => [],
                'question_id' => $question->id,
            ];
        }
    }

    public function setAnswer($questionKey, $answers)
    {
        $this->answers[$questionKey]['answer'] = $answers;
    }

    public function rules()
    {
        return [
            'answers.*.answer' => 'array|required',
            'answers.*.option_id' => 'array|required',
            'answers.*.question_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'answers.*.answer' => 'You must be answered at least one.',
        ];
    }

    public function save()
    {
        $validated = $this->validate();

        $response = UserResponseService::store($this->quiz, $validated['answers']);

        session()->flash('status', 'Success!');

        $this->reset();

        $this->redirectRoute('notify.responses.show', $response->id, navigate: true);
    }

    #[Layout('components.layouts.guest')]
    public function render()
    {
        return view('livewire.user.quizzes.show');
    }
}
