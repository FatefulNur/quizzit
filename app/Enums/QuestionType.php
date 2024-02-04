<?php

namespace App\Enums;

enum QuestionType: string
{
    case SHORT_TEXT = 'short_text';
    case LONG_TEXT = 'long_text';
    case RADIO = 'radio';
    case CHECKBOX = 'checkbox';
}
