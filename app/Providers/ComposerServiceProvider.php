<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Notifications\Notifiable;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // view()->composer('Notifications.Notification', function($view)
        //     {
        //         $view->with('latest',MeetingRequest::where('request_to',78)->first());
        //     });
        $this->composeNav();

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    public function composeNav()
    {
        view()->composer('Notifications.Notification', 'App\Http\ViewComposers\MeetingComposer@organisers');
        view()->composer('Notifications.Notification', 'App\Http\ViewComposers\MeetingComposer@deligates');

    }
}
