<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * @OA\Info(
 *     version="0.1",
 *     title="Job Application API Documentation",
 * )
 * @OA\Server(
 *     url="http://localhost/api",
 *     description="In Docker Container"
 * )
 * @OA\Server(
 *     url="http://localhost:8000/api",
 *     description="In Artisan Serve"
 * )
 */
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
        //
    }
}
