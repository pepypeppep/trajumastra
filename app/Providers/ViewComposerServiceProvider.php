<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\View\Composers\NavigationComposer;
use App\View\Composers\PreferenceComposer;
use App\View\Composers\FormComposer;
use App\View\Composers\ThemeModeComposer;
use App\View\Composers\CounterActiveTransactions;

class ViewComposerServiceProvider extends ServiceProvider
{
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
        // Navigation
        View::composer(['layouts.sidebar'], NavigationComposer::class);

        /* Preference */
        // Admin
        View::composer(['layouts.master-without-nav'], PreferenceComposer::class);
        View::composer(['layouts.master'], PreferenceComposer::class);
        // Guest
        View::composer(['layouts.guest.master'], PreferenceComposer::class);
    }
}
