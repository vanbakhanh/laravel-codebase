<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Validators\FileExtensionValidator;
use Illuminate\Pagination\Paginator;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RepositoryServiceProvider::class);
        $this->app->register(ResponseMacroServiceProvider::class);
        $this->app->register(SocialGrantServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        Validator::resolver(function ($translator, $data, $rules, $messages) {
            return new FileExtensionValidator($translator, $data, $rules, $messages);
        });
    }
}
