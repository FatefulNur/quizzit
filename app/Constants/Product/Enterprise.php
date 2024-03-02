<?php

namespace App\Constants\Product;

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
