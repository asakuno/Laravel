<?php

declare(strict_types=1);

namespace App\Enums\User;

enum UserType : int
{
    case FREE = 1;

    case NORMAL = 2;

    case PREMIUM = 3;

    public static function values() :array
    {
        return array_map(static fn (self $item) => $item->value, self::cases());
    }

    public function getPermission(): array
    {
        return match ($this)
        {
            self::FREE => UserPermission::DefaultAll(),
            self::NORMAL => UserPermission::PremiumAll(),
            self::PREMIUM => UserPermission::PremiumAll(),
        };
    }

    public function checkPermission(int $permission_id): bool
    {
        return in_array($permission_id, $this->getPermission(), true);
    }
}
