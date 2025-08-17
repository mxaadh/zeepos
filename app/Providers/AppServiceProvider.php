<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
use PDO;

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
        DB::extend('odbc', function (array $config, string $name) {
            $pdo = new PDO(
                $config['dsn'],
                $config['username'] ?? null,
                $config['password'] ?? null,
                $config['options'] ?? []
            );

            return new Connection(
                $pdo,
                $config['database'] ?? null,
                $config['prefix'] ?? '',
                $config
            );
        });
    }
}
