<?php

namespace App\Enums;

enum FormStatus: string
{
    case PRIVATE = 'private';
    case PUBLISHED = 'published';
    case DRAFT = 'draft';
    case SCHEDULED = 'scheduled';
    case EXPIRED = 'expired';
}
