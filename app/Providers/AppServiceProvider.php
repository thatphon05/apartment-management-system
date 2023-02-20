<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register blade services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap blade services.
     */
    public function boot(): void
    {
        Carbon::setlocale(config('app.locale'));

        Paginator::useBootstrapFive();

        Model::shouldBeStrict(!app()->isProduction());

        $this->useDBListening();

    }

    /**
     * Check query amount
     */
    protected function useDBListening(): void
    {
        if (!$this->app->isProduction()) {
            $counter = 0;
            $debugQuery = '';

            DB::listen(function (QueryExecuted $query) use (&$counter, &$debugQuery) {
                $counter++; // increment for each query was run
                $debugQuery = $query;
            });

            view()->composer('*', callback: function (View $view) use (&$counter, &$debugQuery) {
                $view->with('countQuery', $counter);
                $view->with('debugQuery', $debugQuery);
            });
        }
    }
}
