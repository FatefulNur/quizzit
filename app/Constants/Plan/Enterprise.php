<?php

namespace App\Constants\Plan;

class Enterprise
{
    public const NAME = 'Enterprise';
    public const MAX_ATTEMPT_QUIZZES = 5;

    public static function getFacilities(): array
    {
        return [
            'Unlimited Quizzes',
        ];
    }
}
