<?php
declare(strict_types=1);

namespace App\UseCases\Auth;

use App\Models\User;
use App\DataTransferObjects\Auth\RegisterUserData;
use App\Repositories\User\UserRepository;


class RegisterUseCase
{
    public function __construct(
        private readonly UserRepository $userRepository
    ){
    }

    /**
     * @param RegisterData $registerData
     * @return User
     */
    public function execute(RegisterUserData $registerUserData): User
    {
        return $this->userRepository->store($registerUserData);
    }
}
