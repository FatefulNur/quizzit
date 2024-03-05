<?php

namespace App\Pipelines;

use App\Pipelines\BaseFilter;
use App\Pipelines\Pipes\Quiz\Expired;
use App\Pipelines\Pipes\Quiz\IsPrivate;
use App\Pipelines\Pipes\Quiz\Available;

class QuizFilter extends BaseFilter
{
    public function getFilters(): array
    {
        return [
            Available::class,
            Expired::class,
            IsPrivate::class,
        ];
    }
}
