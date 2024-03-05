<?php

dataset('quiz_validation', [
    'Empty Properties' => [
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        [
            'title',
            'expired_at',
            'questions.0.title',
            'questions.0.marks',
            'questions.0.type',
        ]
    ],
    'invalid started_date string' => [
        'Quiz title',
        'Quiz Description',
        true,
        'random_string',
        now(),
        'question 1?',
        'short text',
        2,
        'short_text',
        [
            'started_at'
        ],
    ],
    'invalid expired_date string' => [
        'Quiz title',
        'Quiz Description',
        true,
        now(),
        'random_string',
        'question 1?',
        'short text',
        2,
        'short_text',
        [
            'expired_at'
        ],
    ],
    'expired_date before started_at' => [
        'Quiz title',
        'Quiz Description',
        true,
        now()->addDay(),
        now(),
        'question 1?',
        'short text',
        2,
        'short_text',
        [
            'started_at',
            'expired_at',
        ],
    ],
    'invalid question_marks data type' => [
        'Quiz title',
        'Quiz Description',
        true,
        now()->subDays(2),
        now()->subDay(),
        'question 1?',
        'short text',
        '1_00',
        'short_text',
        [
            'questions.0.marks'
        ],
    ],
    'invalid question type' => [
        'Quiz title',
        'Quiz Description',
        true,
        now(),
        now()->addDays(4),
        'question 1?',
        'short text',
        100,
        'textarea',
        [
            'questions.0.type'
        ],
    ],
]);
