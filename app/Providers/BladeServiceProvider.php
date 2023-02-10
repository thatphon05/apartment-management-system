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
        $this->useNavActive();
    }

    private function useNavActive()
    {
        Blade::directive('navactive', function ($expression) {
            return "<?php echo request()->is($expression) ? 'active' : ''; ?>";
        });
    }
}
