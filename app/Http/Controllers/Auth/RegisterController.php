<?php
declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Auth\RegisterRequest;
use App\UseCases\Auth\RegisterUseCase;

class RegisterController extends Controller
{
    public function __construct(
        private readonly RegisterUseCase $registerUseCase
    ){
    }

    public function __invoke(RegisterRequest $request): JsonResponse
    {
        $user = $this->registerUseCase->execute($request->getRegisterParams());

        $user->sendEmailVerificationNotification();

        return response()->json([
            'message' => 'ユーザーの作成に成功しました!',
            'user' => $user
        ]);
    }
}
