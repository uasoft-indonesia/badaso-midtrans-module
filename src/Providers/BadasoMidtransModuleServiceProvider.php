<?php

namespace Uasoft\Badaso\Module\Midtrans\Providers;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Uasoft\Badaso\Module\Midtrans\BadasoMidtransModule;
use Uasoft\Badaso\Module\Midtrans\Commands\BadasoMidtransSetup;
use Uasoft\Badaso\Module\Midtrans\Facades\BadasoMidtransModule as FacadesBadasoMidtransModule;

class BadasoMidtransModuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $kernel = $this->app->make(Kernel::class);

        $loader = AliasLoader::getInstance();
        $loader->alias('BadasoMidtransModule', FacadesBadasoMidtransModule::class);

        $this->app->singleton('badaso-midtrans-module', function () {
            return new BadasoMidtransModule();
        });

        $this->loadRoutesFrom(__DIR__.'/../Routes/api.php');

        $this->publishes([
            __DIR__.'/../Seeder' => database_path('seeders/Badaso/Midtrans'),
            __DIR__.'/../Images' => storage_path('app/public/files/shares')
        ], 'BadasoMidtrans');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConsoleCommands();
    }

    /**
     * Register the commands accessible from the Console.
     */
    private function registerConsoleCommands()
    {
        $this->commands(BadasoMidtransSetup::class);
    }
}
