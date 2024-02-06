<?php

namespace App\Enums;

enum QuestionType: string
{
    case SHORT_TEXT = 'short_text';
    case LONG_TEXT = 'long_text';
    case RADIO = 'radio';
    case CHECKBOX = 'checkbox';

    public function getLabel(): string
    {
        return match ($this) {
            self::SHORT_TEXT => 'Short Text',
            self::LONG_TEXT => 'Long Text',
            self::RADIO => 'Radio Button',
            self::CHECKBOX => 'Check Lists',
        };
    }
}
