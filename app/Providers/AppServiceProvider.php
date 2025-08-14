<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\Facades\Socialite;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register socialite providers
        Event::listen(function (\SocialiteProviders\Manager\SocialiteWasCalled $event) {
            $event->extendSocialite('keycloak', \SocialiteProviders\Keycloak\Provider::class);
        });

        // Register guards
        Auth::viaRequest('keycloak', function (Request $request) {
            if ($request->header('x-username') && App::environment() == 'local') {
                $username = $request->header('x-username');
                $user = User::where('username', $username)->first();
                if ($user) {
                    return $user;
                }

                return null;
            }

            try {
                $provider = Socialite::driver('keycloak');
                $userData = $provider
                    ->stateless()
                    ->userFromToken($request->bearerToken());
                $username = $userData->getNickname();

                return User::where('username', $username)->first();
            } catch (\Throwable $throwable) {
                if ($throwable->getCode() != 401) {
                    report($throwable);
                }
            }
            return null;
        });
    }
}
