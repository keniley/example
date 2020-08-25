<?php

namespace App\Listeners;

use Larapp\Options\Facade\Options;

class OptionsSubscriber
{
    public function refreshCache($event)
    {
        Options::restore();
    }
    
    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'App\Events\Admin\AllUpdated',
            'App\Listeners\OptionsSubscriber@refreshCache'
        );
    }
}