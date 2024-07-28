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
}
