<?php
declare(strict_types=1);

namespace App\Repositories\Auth;

use App\DataTransferObjects\Auth\LoginData;

interface LoginRepository
{
    public function attemptLogin(LoginData $credentials): string|bool;
}
