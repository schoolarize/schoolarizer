<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use Illuminate\Routing\Router;

use App\Http\Middleware\Permission\Permission;
use App\Http\Middleware\Permission\PermissionViaRole;
use App\Http\Middleware\Permission\PermissionOrRole;


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
        Schema::defaultStringLength(191);

        $router = $this->app->make(Router::class);


        $router->aliasMiddleware('permission', Permission::class);
        $router->aliasMiddleware('permissionViaRole', PermissionViaRole::class);
        $router->aliasMiddleware('permissionOrRole', PermissionOrRole::class);
    }
}
