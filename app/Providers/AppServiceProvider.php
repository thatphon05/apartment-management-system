<?php

namespace App\Providers;

use App\Models\Building;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Carbon;
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

        $this->getBuildings();
    }

    protected function getBuildings(): void
    {
        view()->composer('layouts.admin', function (View $view) {
            $view->with('navBuildingList', Building::select(['id', 'name'])->latest('name')->get());
        });
    }
}
