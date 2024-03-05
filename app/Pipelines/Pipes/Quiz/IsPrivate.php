<?php

namespace App\Pipelines\Pipes\Quiz;

use App\Enums\QuizType;
use Closure;

class IsPrivate
{
    public function handle(array $contents, Closure $next)
    {
        if ($contents['params']['private']) {
            $contents['builder']
                ->where('type', QuizType::PRIVATE ->value);
        }

        return $next($contents);
    }
}
