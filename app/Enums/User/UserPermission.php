<?php

declare(strict_types=1);

namespace App\Enums\User;

enum UserPermission : int
{
    case DEFAULT = 1;

    case PREMIUM = 2;

    public static function DefaultAll(): array
    {
        return [
            self::DEFAULT->value,
            self::PREMIUM->value,
        ];
    }

    public static function PremiumAll(): array
    {
        return [
            self::PREMIUM->value,
        ];
    }
}
