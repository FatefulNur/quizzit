<?php

namespace App\Enums;

enum FeedbackType: string
{
    case GENERAL = 'general';
    case CORRECT_ANSWER = 'correct_answer';
    case INCORRECT_ANSWER = 'incorrect_answer';
}
