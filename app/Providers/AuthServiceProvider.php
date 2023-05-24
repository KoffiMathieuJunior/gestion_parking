<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
// use Laravel\Passport\Passport;
// use App\Models\Passport\AuthCode;
// use App\Models\Passport\Client;
// use App\Models\Passport\PersonalAccessClient;
// use App\Models\Passport\RefreshToken;
// use App\Models\Passport\Token;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        // dd('boot.'.now()->addDays(15));
        $this->registerPolicies();
        // Passport::routes();

        // Passport::useTokenModel(Token::class);
        // Passport::useRefreshTokenModel(RefreshToken::class);
        // Passport::useAuthCodeModel(AuthCode::class);
        // Passport::useClientModel(Client::class);
        // Passport::usePersonalAccessClientModel(PersonalAccessClient::class);

        // Passport::hashClientSecrets();
        // Passport::tokensExpireIn(now()->addDays(15));
        // Passport::refreshTokensExpireIn(now()->addDays(30));
        // Passport::personalAccessTokensExpireIn(now()->addMonths(6));
        // Password::hash
        //
    }

}
