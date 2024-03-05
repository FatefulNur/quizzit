<?php

namespace App\Pipelines\Pipes\Quiz;

use App\Enums\QuizDateFilter;
use Closure;

class Available
{
    public function handle(array $contents, Closure $next)
    {
        if ($contents['params']['date'] === QuizDateFilter::AVAILABLE->value) {
            $contents['builder']
                ->where('started_at', '<=', now())
                ->where('expired_at', '>', now());
        }

        return $next($contents);
    }
}
