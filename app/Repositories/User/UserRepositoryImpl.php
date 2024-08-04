<?php
declare(strict_types=1);

namespace App\Repositories\User;

use App\DataTransferObjects\Auth\RegisterUserData;
use App\Repositories\User\UserRepository;
use App\Models\User;

class UserRepositoryImpl implements UserRepository
{
    /**
     * @inheritDoc
     */
    public function store(RegisterUserData $registerUserData): User
    {
        return User::create($registerUserData->toArray());
    }

    /**
     * @inheritDoc
     */
    public function findOrFail(int $user_id): User
    {
        return User::findOrFail($user_id);
    }

    /**
     * @inheritDoc
     */
    public function fetchUserByEmail(string $email): User
    {
        return User::where('email', '=', $email)->first;
    }
}
