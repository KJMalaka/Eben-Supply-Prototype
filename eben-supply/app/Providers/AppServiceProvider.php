<?php
// PRT362S — Eben Supply | Group KN3

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useTailwind();

        // Behind a reverse proxy that terminates TLS (ngrok, Render, etc.),
        // trust its forwarded headers so generated URLs use the right scheme.
        if (!empty($_SERVER['HTTP_X_FORWARDED_PROTO'])) {
            URL::forceScheme($_SERVER['HTTP_X_FORWARDED_PROTO']);
        }

        // ngrok also rewrites the host, so force the full root URL for it too.
        if (!empty($_SERVER['HTTP_X_FORWARDED_HOST'])) {
            $scheme = $_SERVER['HTTP_X_FORWARDED_PROTO'] ?? 'https';
            $host   = $_SERVER['HTTP_X_FORWARDED_HOST'];
            URL::forceRootUrl("{$scheme}://{$host}");
        }
    }
}
