<?php

namespace App\Enums;

enum ValidationRule: string
{
    case GREATER_THAN = 'greater_than';
    case GREATER_THAN_OR_EQUAL_TO = 'greater_than_or_equal_to';
    case LESS_THAN = 'less_than';
    case LESS_THAN_OR_EQUAL_TO = 'less_than_or_equal_to';
    case EQUAL_TO = 'equal_to';
    case NOT_EQUAL_TO = 'not_equal_to';
    case BETWEEN = 'between';
    case NOT_BETWEEN = 'not_between';
    case IS_NUMBER = 'is_number';
    case WHOLE_NUMBER = 'whole_number';

    case URL = 'url';
    case EMAIL = 'email';
    case CONTAINS = 'contains';
    case DOES_NOT_CONTAIN = 'does_not_contain';

    case MAX_CHARACTERS = 'max_characters';
    case MIN_CHARACTERS = 'min_characters';

    case REGEX_CONTAINS = 'regex_contains';
    case REGEX_DOES_NOT_CONTAIN = 'regex_does_not_contain';
    case REGEX_MATCHES = 'regex_matches';
    case REGEX_DOES_NOT_MATCH = 'regex_does_not_match';

    case SELECT_AT_LEAST = 'select_at_least';
    case SELECT_AT_MOST = 'select_at_most';
    case SELECT_EXACTLY = 'select_exactly';

    public function type(): string
    {
        return match ($this) {
            self::GREATER_THAN,
            self::GREATER_THAN_OR_EQUAL_TO,
            self::LESS_THAN,
            self::LESS_THAN_OR_EQUAL_TO,
            self::EQUAL_TO,
            self::NOT_EQUAL_TO,
            self::BETWEEN,
            self::NOT_BETWEEN,
            self::IS_NUMBER,
            self::WHOLE_NUMBER => 'number',

            self::URL,
            self::EMAIL,
            self::CONTAINS,
            self::DOES_NOT_CONTAIN => 'text',

            self::MAX_CHARACTERS,
            self::MIN_CHARACTERS => 'length',

            self::REGEX_CONTAINS,
            self::REGEX_DOES_NOT_CONTAIN,
            self::REGEX_MATCHES,
            self::REGEX_DOES_NOT_MATCH => 'regex',

            self::SELECT_AT_LEAST,
            self::SELECT_AT_MOST,
            self::SELECT_EXACTLY => 'select',
        };
    }
}
