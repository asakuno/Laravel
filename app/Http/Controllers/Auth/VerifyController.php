<?php
declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\VerifyRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Repositories\User\UserRepository;
use Illuminate\Http\JsonResponse;

class VerifyController extends Controller
{
    public function __construct(
        private readonly UserRepository $userRepository
    ){
    }

    public function verify(int $user_id, Request $request): RedirectResponse|JsonResponse
    {
        if(!$request->hasValidSignature()){
            return redirect()->to('/');
        }

        $user = $this->userRepository->findOrFail($user_id);

        if(!$user->hasVerifiedEmail()){
            $user->markEmailAsVerified();
        }

        return response()->json([
            'message' => 'verify success',
            'status_code' => 200,
        ]);
    }

    public function resend(VerifyRequest $request): JsonResponse
    {
        $user = $this->userRepository->fetchUserByEmail($request->getEmail());
        $user->sendEmailVerificationNotification();

        return response()->json([
            'message' => 'email resend'
        ]);
    }
}
