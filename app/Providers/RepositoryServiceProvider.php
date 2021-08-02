<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Repositories\Contracts\RoleRepository::class, \App\Repositories\Eloquents\RoleRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\PermissionRepository::class, \App\Repositories\Eloquents\PermissionRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\UserRepository::class, \App\Repositories\Eloquents\UserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\PasswordResetRepository::class, \App\Repositories\Eloquents\PasswordResetRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\ProfileRepository::class, \App\Repositories\Eloquents\ProfileRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\FileRepository::class, \App\Repositories\Eloquents\FileRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\ImageRepository::class, \App\Repositories\Eloquents\ImageRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\AudioRepository::class, \App\Repositories\Eloquents\AudioRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\VideoRepository::class, \App\Repositories\Eloquents\VideoRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\FcmUserRepository::class, \App\Repositories\Eloquents\FcmUserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\FcmNotificationRepository::class, \App\Repositories\Eloquents\FcmNotificationRepositoryEloquent::class);
        //:end-bindings:
    }
}
