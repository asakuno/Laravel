<?php

namespace App\Providers;

use App\Enums\User\UserType;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Http\Response;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        //
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('check_user_permission', function (User $user, int $permission_id) {
            return UserType::tryFrom($user->account_type)->checkPermission($permission_id)
                ? Response::allow()
                : Response::deny('権限がありません');
        });
    }
}
