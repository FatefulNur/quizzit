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
        [
            'title',
            'expired_at',
            'questions.0.title',
            'questions.0.marks',
            'questions.0.type',
        ]
    ],
    'Wrong expired_date string' => [
        'Quiz title',
        'Quiz Description',
        true,
        'random_string',
        'question 1?',
        'short text',
        2,
        'short_text',
        [
            'expired_at'
        ],
    ],
    'Past expired_date string' => [
        'Quiz title',
        'Quiz Description',
        true,
        now()->subDay(),
        'question 1?',
        'short text',
        2,
        'short_text',
        [
            'expired_at'
        ],
    ],
    'Wrong question_marks data type' => [
        'Quiz title',
        'Quiz Description',
        true,
        now()->subDay(),
        'question 1?',
        'short text',
        '1_00',
        'short_text',
        [
            'questions.0.marks'
        ],
    ],
    'Wrong question type' => [
        'Quiz title',
        'Quiz Description',
        true,
        now()->subDay(),
        'question 1?',
        'short text',
        '1_00',
        'textarea',
        [
            'questions.0.type'
        ],
    ],
]);
