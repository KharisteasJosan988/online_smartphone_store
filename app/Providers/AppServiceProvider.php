<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;
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
        view()->composer('frontend.checkout', function ($view) {
            $response = Http::withHeaders([
                'key' => config('services.rajaongkir.key'),
            ])->get(config('services.rajaongkir.base_url') . '/province');

            $provinces = $response->successful()
                ? $response->json()['rajaongkir']['results']
                : [];

            $view->with('provinces', $provinces);
        });
    }
}
