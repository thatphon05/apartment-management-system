<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setlocale(config('app.locale'));

        Paginator::useBootstrapFive();

        // Prevent Lazy loading
        Model::preventLazyLoading(!$this->app->isProduction());

        // For check query number
        if (!$this->app->isProduction()) {
            $counter = 0;
            $debugQuery = '';
            DB::listen(function ($query) use (&$counter, &$debugQuery) {
                $counter++; // increment for each query was run
                $debugQuery = $query;
            });
            view()->composer('*', function ($view) use (&$counter, &$debugQuery) {
                $view->with('countQuery', $counter);
                $view->with('debugQuery', $debugQuery);
            });
        }
    }
}
