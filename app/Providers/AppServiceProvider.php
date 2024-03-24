<?php

namespace App\Providers;

use Geocoder\Provider\Nominatim\Nominatim;
use GuzzleHttp\Client;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

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
        $this->app->bind(Nominatim::class, function ($app) {
            // Code pour créer et configurer une instance de Nominatim selon vos besoins
            $httpClient = new Client();
            $provider = Nominatim::withOpenStreetMapServer($httpClient, 'Your User Agent');

            // Retourner l'instance configurée
            return $provider;
        });

        Paginator::useBootstrapFive();
    }
}
