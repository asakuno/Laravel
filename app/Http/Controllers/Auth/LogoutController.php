<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use PHPOpenSourceSaver\JWTAuth\JWTAuth;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;

class LogoutController extends Controller
{
    public function __construct(
        private readonly JWTAuth $auth
    ) {}

    /**
     * @throws JWTException
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse|JWTException
    {
        try {
            $this->auth->invalidate($this->auth->getToken());

            return response()->json(['message' => 'Successfully logged out'], 200);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Failed to logout, please try again.'], 500);
        }
    }
}
