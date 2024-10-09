<?php

declare(strict_types=1);

namespace App\DataTransferObjects\Auth;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class RegisterUserData extends Data
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public int $accountType,
    ){
    }
}
