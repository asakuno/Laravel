<?php
declare(strict_types=1);

namespace App\UseCases\Auth;

use App\Repositories\Auth\LoginRepository;
use App\DataTransferObjects\Auth\LoginData;

class LoginUseCase
{
    public function __construct(
        private readonly LoginRepository $loginRepository
    ){
    }

    /**
     * @param LoginData $credentials
     * @return string|bool
     */
    public function execute(LoginData $credentials): string|bool
    {
        $token = $this->loginRepository->attemptLogin($credentials);

        if (!$token) {
            return false;
        }

        return $token;
    }
}
