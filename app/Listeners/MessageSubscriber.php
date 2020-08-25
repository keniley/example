<?php

namespace App\Listeners;

use App\Model\GdprAction;
use App\Service\MessageService;
use App\Facade\Email;
use App\Mail\MessageFromWeb;

class MessageSubscriber
{
    const GDPRACTION = 'main.consent';

    private $messageService;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    public function sendToAdmin($event)
    {
        $message = $event->model;

        Email::to('petr.jelinek@oxyshop.cz')->send(new MessageFromWeb($message));
    }

    public function sendToVisitor($event)
    {
        $message = $event->model;

        Email::to($message->email)->send(new MessageFromWeb($message));
    }

    public function refreshCache($event)
    {
        $this->messageService->refresh();
    }

    public function gdprCreated($event)
    {
        $action = new GdprAction();
        $action->gdpr_action_type_id = self::GDPRACTION;
        $action->model = get_class($event->model);
        $action->model_id = $event->model->id;
        $action->ip = request()->ip();
        $action->save();
    }

    public function markAsRead($event)
    {
        $message = $event->model;

        $message->shown = 1;
        $message->read_at = Date('Y-m-d H:i:s', Time());
        $message->save();

        $this->messageService->refresh();
    }
    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'App\Events\Message\Created',
            'App\Listeners\MessageSubscriber@sendToAdmin'
        );

        $events->listen(
            'App\Events\Message\Created',
            'App\Listeners\MessageSubscriber@sendToVisitor'
        );

        $events->listen(
            'App\Events\Message\Created',
            'App\Listeners\MessageSubscriber@refreshCache'
        );

        $events->listen(
            'App\Events\Message\Created',
            'App\Listeners\MessageSubscriber@gdprCreated'
        );

        $events->listen(
            'App\Events\Message\Shown',
            'App\Listeners\MessageSubscriber@markAsRead'
        );
    }
}