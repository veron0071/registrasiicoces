<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Participant;

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
        View::composer('layouts.admin', function ($view) {
            $view->with('sidebarStats', [
                'total' => Participant::count(),
                'presenters' => Participant::where('category', 'presenter')->count(),
                'non_presenters' => Participant::where('category', 'non_presenter')->count(),
            ]);
        });
    }
}
