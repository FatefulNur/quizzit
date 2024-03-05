<?php

namespace App\Livewire\Actions\Question;

use App\Models\Question;

class Destroy
{
    public function __invoke(string $id): void
    {
        if (!$question = Question::find($id)) {
            return;
        }

        $question->delete();
    }
}
