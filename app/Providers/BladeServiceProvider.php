<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->useNavActive();
    }

    /**
     * Activate active class
     */
    protected function useNavActive(): void
    {
        Blade::directive('navactive', function ($expression) {
            return "<?php echo request()->is($expression) ? 'active' : ''; ?>";
        });
    }
}
