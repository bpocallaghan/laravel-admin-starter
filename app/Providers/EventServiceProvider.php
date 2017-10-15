<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        // auth
        'App\Events\UserRegistered' => [],

        // log actions
        'App\Events\ActivityWasTriggered' => [
            'App\Listeners\SaveActivity',
        ],
        'App\Events\ContactUsFeedback' => [
            'App\Listeners\EmailContactUsToClient',
            'App\Listeners\EmailContactUsToAdmin',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
