<?php

namespace App\Listeners;

use App\Service\UrlService;
use App\Service\ContentService;

class ContentSubscriber
{
    private $contentService;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(ContentService $contentService)
    {
        $this->contentService = $contentService;
    }


    public function refreshCache($event)
    {
        $this->contentService->refresh($event->model->id);
    }

    public function updateUrl($event)
    {
        $slug = $event->data['url_slug'] ?? '';
        $static = $even->data['url_static'] ?? null;

        $url_service = new UrlService();
        $url_service->setController('ContentController')
            ->setObject($event->model->id)
            ->setTitle($event->model->title)
            ->setSlug($slug)
            ->setStatic($static)
            ->generate();
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        
        $events->listen(
            'App\Events\Content\Updated',
            'App\Listeners\ContentSubscriber@refreshCache'
        );

        $events->listen(
            'App\Events\Content\Updated',
            'App\Listeners\ContentSubscriber@updateUrl'
        );

        $events->listen(
            'App\Events\Content\Deleted',
            'App\Listeners\ContentSubscriber@refreshCache'
        );
        
    }
}