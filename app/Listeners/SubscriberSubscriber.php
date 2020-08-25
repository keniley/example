<?php

namespace App\Listeners;

use App\Model\GdprAction;

class SubscriberSubscriber
{
    const GDPRACTION = 'newsletter.verifed.send';

    public function sendVerification($event)
    {
        $action = new GdprAction();
        $action->gdpr_action_type_id = self::GDPRACTION;
        $action->model = get_class($event->model);
        $action->model_id = $event->model->id;
        $action->ip = 'localhost';
        $action->save();
    }
    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'App\Events\Subscriber\Created',
            'App\Listeners\SubscriberSubscriber@sendVerification'
        );
    }
}