<?php

namespace App\Livewire\Actions\Question;

use App\Models\Question;

class DestroyRelations
{
    public function __invoke(string $id, string ...$relations): void
    {
        if (!$question = Question::find($id)) {
            return;
        }

        foreach ($relations as $relation) {
            if ($question->$relation()->doesntExist()) {
                continue;
            }

            $question->$relation()->delete();
        }

        return;
    }
}
