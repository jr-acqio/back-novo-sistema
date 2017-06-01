<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\Modules\Access\Contracts\UserRepository::class, \Modules\Access\Repositories\UserRepositoryEloquent::class);
        $this->app->bind(\Modules\Boletos\Contracts\BoletoRepository::class, \Modules\Boletos\Repositories\BoletoRepositoryEloquent::class);
        $this->app->bind(\Modules\Boletos\Contracts\ConcilationRepository::class, \Modules\Boletos\Repositories\ConcilationRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\BoletoOcorrenciaRepository::class, \App\Repositories\BoletoOcorrenciaRepositoryEloquent::class);
        //:end-bindings:
    }
}
