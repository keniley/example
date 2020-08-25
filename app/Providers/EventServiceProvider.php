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
    protected $listen = [];

    /**
     * The subscriber classes to register.
     *
     * @var array
     */
    protected $subscribe = [
        'App\Listeners\AdminSubscriber',
        'App\Listeners\CompanySubscriber',
        'App\Listeners\ContentSubscriber',
        'App\Listeners\MessageSubscriber',
        'App\Listeners\OfficeSubscriber',
        'App\Listeners\OptionsSubscriber',
        'App\Listeners\SubscriberSubscriber',
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
