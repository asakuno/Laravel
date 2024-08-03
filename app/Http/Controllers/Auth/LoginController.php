<?php
declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use App\UseCases\Auth\LoginUseCase;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function __construct(
        private readonly LoginUseCase $loginUseCase,
    ){
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function __invoke(LoginRequest $request): JsonResponse
    {
        $token = $this->loginUseCase->execute($request->getLoginData());

        if (!$token) {
            return response()->json(['error' => 'Oh Unauthorized'], 401);
        }

        $user = Auth::user();

        return response()->json([
            'user' => $user,
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }
}
