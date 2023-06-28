<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Bind the installed state to the container.
        $this->app->singleton('installed', function (): bool {
            // TODO: Cache this state to disk when running the Artisan cache/optimize command.

            try {
                // Check if necessary migrations are already run
                return DB::table('migrations')->count() > 0;
            } catch (QueryException) {
                return false;
            }
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
