<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
        
        // Gate::policy(\App\Models\Blog\Author::class, \App\Policies\Blog\AuthorPolicy::class);
        // Gate::policy(\Ramnzys\FilamentEmailLog\Models\Email::class, \App\Policies\EmailPolicy::class);
    }
    
}
