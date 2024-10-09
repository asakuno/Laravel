<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use PHPOpenSourceSaver\JWTAuth\JWTAuth;

class RefreshController extends Controller
{
    public function __construct(
        private readonly JWTAuth $auth
    ){
    }

    /**
     * トークンのリフレッシュ
     *
     * @throws JWTException
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse|JWTException
    {
        try {
            $token = $this->auth->parseToken()->refresh();
            return response()->json(['token' => $token], 200);
        } catch (JWTException $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }
    }
}
