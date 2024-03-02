<?php

namespace App\Constants\Product;

class Fresher
{
    public const NAME = 'Fresher';
    public const MAX_ATTEMPT_QUIZZES = 5;

    public static function getFacilities(): array
    {
        return [
            '5 total Quizzes',
        ];
    }
}
