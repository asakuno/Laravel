<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException;
use PHPOpenSourceSaver\JWTAuth\JWTAuth;

class AuthMeController extends Controller
{
    public function __construct(
        private readonly JWTAuth $auth
    ){
    }

    /**
     * 認証情報を返す
     *
     * @throws TokenExpiredException
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse|TokenExpiredException
    {
        try {
            $user = $this->auth->parseToken()->authenticate();
            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }
        } catch (TokenExpiredException $e) {
            return response()->json(['error' => 'Token expired'], 401);
        }

        return response()->json($user);
    }
}
