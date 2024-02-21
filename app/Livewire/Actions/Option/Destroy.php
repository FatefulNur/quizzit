<?php

namespace App\Livewire\Actions\Option;

use App\Models\Option;

class Destroy
{
    public function __invoke(string $id): void
    {
        if (!$option = Option::find($id)) {
            return;
        }

        $option->delete();
    }
}
