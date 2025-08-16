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
        View::composer(['layouts.sidebar'], NavigationComposer::class);
    }
}
