<?php

namespace App\Enums;

enum QuestionType: string
{
    case SHORT_ANSWER = 'short_answer';
    case PARAGRAPH = 'paragraph';
    case MULTIPLE_CHOICE = 'multiple_choice';
    case CHECKBOXES = 'checkboxes';
}
