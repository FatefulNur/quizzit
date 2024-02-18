<?php

namespace App\Pipelines;

use App\Pipelines\BaseFilter;
use App\Pipelines\Filters\Quiz\Expired;
use App\Pipelines\Filters\Quiz\IsPrivate;
use App\Pipelines\Filters\Quiz\Available;

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
