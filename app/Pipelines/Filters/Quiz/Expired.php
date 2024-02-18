<?php

namespace App\Pipelines\Filters\Quiz;

use App\Enums\QuizDateFilter;
use Closure;

class Expired
{
    public function handle(array $contents, Closure $next)
    {
        if ($contents['params']['date'] === QuizDateFilter::EXPIRED->value) {
            $contents['builder']
                ->whereDate('expired_at', '<=', now());
        }

        return $next($contents);
    }
}
