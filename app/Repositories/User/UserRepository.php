<?php

declare(strict_types=1);

namespace App\Repositories\User;

use Illuminate\Support\Facades\Auth;
use App\DataTransferObjects\Auth\RegisterUserData;
use App\Models\User;

interface UserRepository
{
    /**
     * @param RegisterUserData $registerUserData
     * @return User
     */
    public function store(RegisterUserData $registerUserData): User;

    /**
     * @param int $user_id
     * @return User
     */
    public function findOrFail(int $user_id): User;

    /**
     * emailからUser取得
     *
     * @param string $email
     * @return User
     */
    public function fetchUserByEmail(string $email): User;
}
