<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SystemExtensionServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }


    public function boot(): void
    {
        $this->loadRoutesFrom(
            base_path(
                'routes/system_extensions.php'
            )
        );
    }
}