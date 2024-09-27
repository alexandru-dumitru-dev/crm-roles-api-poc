<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum RolesEnum: string
{
    use EnumToArray;

    case USER = 'user';
    case ADMIN = 'admin';
    case TRAINER = 'trainer';
    case STUDENT = 'student';

    public function label(): string
    {
        return match ($this) {
            static::USER => 'User',
            static::ADMIN => 'Admin',
            static::TRAINER => 'Trainer',
            static::STUDENT => 'Student'
        };
    }
}
