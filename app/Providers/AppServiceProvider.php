<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Http\Resources\Json\JsonResource;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(\L5Swagger\L5SwaggerServiceProvider::class);
    }
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        // JsonResource::withoutWrapping();
        Model::unguard();
        ResetPassword::createUrlUsing(function (User $user, string $token) {
            return '/password-reset?token='.$token;
        });
    }
}
