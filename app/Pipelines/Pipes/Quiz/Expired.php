<?php

namespace App\Pipelines\Pipes\Quiz;

use App\Enums\QuizDateFilter;
use Closure;

class Expired
{
    public function handle(array $contents, Closure $next)
    {
        if ($contents['params']['date'] === QuizDateFilter::EXPIRED->value) {
            $contents['builder']
                ->where('expired_at', '<=', now());
        }

        return $next($contents);
    }
}
