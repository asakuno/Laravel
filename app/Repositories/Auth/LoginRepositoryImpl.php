<?php
declare(strict_types=1);

namespace App\Repositories\Auth;

use App\DataTransferObjects\Auth\LoginData;
use App\Repositories\Auth\LoginRepository;

class LoginRepositoryImpl implements LoginRepository
{
    public function attemptLogin(LoginData $credentials): string|bool
    {
        return auth()->attempt([
            'email' => $credentials->email,
            'password' => $credentials->password,
        ]);
    }
}
