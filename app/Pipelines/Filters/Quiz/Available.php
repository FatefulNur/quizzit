<?php

namespace App\Pipelines\Filters\Quiz;

use App\Enums\QuizDateFilter;
use Closure;

class Available
{
    public function handle(array $contents, Closure $next)
    {
        if ($contents['params']['date'] === QuizDateFilter::AVAILABLE->value) {
            $contents['builder']
                ->whereDate('started_at', '<=', now())
                ->whereDate('expired_at', '>', now());
        }

        return $next($contents);
    }
}
