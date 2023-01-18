<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        Blade::directive('navactive', function ($expression) {
            return "<?php echo request()->is($expression) ? 'active' : ''; ?>";
        });
    }
}
