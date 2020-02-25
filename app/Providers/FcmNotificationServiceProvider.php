<?php

namespace App\Providers;

use App\Notifications\Channels\FcmChannel;
use Illuminate\Notifications\ChannelManager;
use Illuminate\Support\ServiceProvider;

class FcmNotificationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make(ChannelManager::class)->extend('fcm', function () {
            return $this->app->make(FcmChannel::class);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
